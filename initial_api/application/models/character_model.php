<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * This is the primary character model to retrieve all character information
 *      such as bags, stats and equipment, etc...
 *
 * Class Character_model
 */
class Character_model extends CI_Model {

    public function __construct(){

        parent::__construct();

    }

    /**
     * Returns all characters
     *
     * @return mixed
     */
    public function get_characters(){

        $this->db
            ->from('characters');

        return $this->db->get->result();

    }

    /**
     * Returns a single character
     *
     * @param $character_id
     * @return mixed
     */
    public function get_character($character_id){

        $this->db
            ->from('characters')
            ->where('character_id', $character_id);

        return $this->db->get->result();

    }

    /**
     * Returns a single characters bags
     *
     * @param $character_id
     * @return mixed
     */
    public function get_bags($character_id){

        $this->db
            ->from('character_bag_join')
            ->join('items', 'character_bag_join_item_id = item_id')
            ->join('item_types', 'item_item_type_id = item_type_id')
            ->join('item_type_properties', 'item_type_id = item_type_item_type_id', 'left')
            ->where('character_bag_join_character_id', $character_id);

        return $this->db->get()->result();

    }

}
