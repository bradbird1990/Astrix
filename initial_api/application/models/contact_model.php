<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Contact_Model extends Base_Model {

    public function __construct(){

        parent::__construct();

    }

    /**
     * Returns a single contact
     *
     * @param int $contact_id
     *
     * @return stdClass
     */
    public function get_contact($contact_id){

        $this->db
            ->from('contacts')
            ->join('contact_types', 'contact_contact_type_id = contact_type_id', 'left')
            ->where('contact_id', $contact_id);

        return $this->db->get()->result();

    }

    /**
     * Returns all contacts
     *
     * @return stdClass
     */
    public function get_contacts(){

        $this->db
            ->from('contacts')
            ->join('contact_types', 'contact_contact_type_id = contact_type_id', 'left')
            ->order_by('contact_name');

        return $this->db->get()->result();

    }

    /**
     * Adds a contact location to a contact
     *
     * @param int $contact_id
     *
     * @return int
     */
    public function post_contact_location($contact_id){

        $this->db
            ->insert('contact_locations', array(
                'contact_location_contact_id' => $contact_id
            ));

        return $this->db->insert_id();

    }

    /**
     * Returns all contact locations
     *
     * @param int $contact_id
     *
     * @return stdClass
     */
    public function get_contact_locations($contact_id){

        $this->db
            ->from('contact_locations')
            ->join('countries', 'contact_location_country_id = country_id', 'left')
            ->where('contact_location_contact_id', $contact_id)
            ->order_by('contact_location_is_primary', 'desc');

        return $this->db->get()->result();

    }

    /**
     * Deletes a contacts location
     *
     * @param int $contact_location_id
     *
     * @return int
     */
    public function delete_contact_location($contact_location_id){

        $this->db
            ->where('contact_location_id', $contact_location_id)
            ->delete('contact_locations');

        return $this->db->affected_rows();

    }

    /**
     * Returns all of a contacts comms
     *
     * @param int $contact_id
     *
     * @return stdClass
     */
    public function get_contact_comms($contact_id){

        $this->db
            ->from('contact_comms')
            ->join('contact_comm_types', 'contact_comm_contact_comm_type_id = contact_comm_type_id', 'left')
            ->where('contact_comm_contact_id', $contact_id)
            ->order_by('contact_comm_is_primary', 'desc');

        return $this->db->get()->result();

    }

    /**
     * Returns a contacts comm
     *
     * @param int $contact_comm_id
     *
     * @return stdClass
     */
    public function get_contact_comm($contact_comm_id){

        $this->db
            ->from('contact_comms')
            ->join('contact_comm_types', 'contact_comm_contact_comm_type_id = contact_comm_type_id', 'left')
            ->where('contact_comm_id', $contact_comm_id);

        return $this->db->get()->result();

    }

    /**
     * Returns all comm types
     *
     * @return stdClass
     */
    public function get_comm_types(){

        $this->db
            ->from('contact_comm_types');

        return $this->db->get()->result();

    }

    /**
     * Returns all comm types
     *
     * @param int $contact_comm_id
     * @param int $contact_comm_type_id
     *
     * @return stdClass
     */
    public function change_contact_comm_type_id($contact_comm_id, $contact_comm_type_id){

        $this->db
            ->where('contact_comm_id', $contact_comm_id)
            ->update('contact_comms', array('contact_comm_contact_comm_type_id' => $contact_comm_type_id));

        return $this->db->affected_rows();

    }

    /**
     * Adds a comm to a contact
     *
     * @param int $contact_id
     *
     * @return int
     */
    public function add_contact_comm($contact_id){

        $this->db
            ->insert('contact_comms', array(
                'contact_comm_contact_id' => $contact_id
            ));

        return $this->db->insert_id();

    }

    /**
     * Deletes a contacts comm
     *
     * @param int $contact_comm_id
     *
     * @return int
     */
    public function delete_contact_comm($contact_comm_id){

        $this->db
            ->where('contact_comm_id', $contact_comm_id)
            ->delete('contact_comms');

        return $this->db->affected_rows();

    }

    /**
     * Makes a contact comm primary
     *
     * @param int $contact_comm_id
     *
     * @return int
     */
    public function make_primary_contact_comm($contact_comm_id){

        $this->db
            ->update('contact_comms', array('contact_comm_is_primary' => null));

        $this->db
            ->where('contact_comm_id', $contact_comm_id)
            ->update('contact_comms', array('contact_comm_is_primary' => 1));

        return $this->db->affected_rows();

    }

    /**
     * Get a contacts relating contacts by type ID
     * This is a complicated query; read the inline comments below for more information
     *
     * @param int $contact_id
     * @param int $contact_type_id
     *
     * @return stdClass
     */
    public function get_contacts_contacts($contact_id, $contact_type_id){

        // Asks for the same set of data but opposites
        $set_1 = $this->get_set($contact_id, $contact_type_id, 'a', 'b');
        $set_2 = $this->get_set($contact_id, $contact_type_id, 'b', 'a');

        // We combine the sets to return all matching results as if it is one query
        return array_merge($set_1, $set_2);

    }

    /**
     * This a composite function of get_contacts_contacts and just returns one side of the set
     *
     * @param int $contact_id
     * @param int $contact_type_id
     * @param string $set_1
     * @param string $set_2
     *
     * @return stdClass
     */
    function get_set($contact_id, $contact_type_id, $set_1, $set_2){

        // Run this on a to b
        $this->db
            // We only need data from the join and the relating table
            ->select('contacts.*, contacts_type.*, contacts_contacts.*')

            // Collect entire first contact and type information
            ->from('contacts as contact')
            ->join('contact_types as contact_type', 'contact.contact_contact_type_id = contact_type.contact_type_id', 'left')

            // Collect entire join data (So we can get the first contacts ID without overwriting the second contacts ID)
            ->join('contacts_contacts', 'contact.contact_id = contact_contact_contact_id_' . $set_1)

            // Collect entire second contact and type information
            ->join('contacts as contacts', 'contact_contact_contact_id_' . $set_2 . ' = contacts.contact_id')
            ->join('contact_types as contacts_type', 'contacts.contact_contact_type_id = contacts_type.contact_type_id', 'left')

            // Find via first contacts ID and second contacts type ID (eg. All of first contacts relating contacts that are companies; not people)
            ->where('contact.contact_id', $contact_id);

        // Find via second contacts contact type ID if it has been asked for
        if($contact_type_id){

            $this->db->where('contacts_type.contact_type_id', $contact_type_id);

        }

        return $this->db->get()->result();

    }

    /**
     * Updates a contacts comm details
     *
     * @param int $contact_comm
     *
     * @return int
     */
    public function update_contact_comm($contact_comm){

        $contact_comm = parent::remove_non_existing_columns('contact_comms', $contact_comm);

        $this->db
            ->where($contact_comm['meta_data']['primary_key'], $contact_comm['meta_data']['primary_key_id'])
            ->update('contact_comms', $contact_comm['data']);

        return $this->db->affected_rows();

    }

}
