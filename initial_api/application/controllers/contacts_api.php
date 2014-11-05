<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

require(APPPATH . 'libraries/REST_Controller.php');

class Contacts_api extends REST_Controller {

    public function __construct(){

        parent::__construct();

        $this->load->model('contact_model');

    }

    /**
     * Get a contact
     */
    public function contact_get(){

        $contact = $this->contact_model->get_contact($this->get('contact_id'));

        if($contact){

            $this->response($contact, 200);

        }
        else{

            $this->response(null, 404);

        }

    }

    /**
     * Get all contacts
     */
    public function contacts_get(){

        $contacts = $this->contact_model->get_contacts();

        if($contacts){

            $this->response($contacts, 200);

        }
        else{

            $this->response(null, 404);

        }

    }

    /**
     * Add a contact location
     */
    public function contact_location_post(){

        $contact_location_id = $this->contact_model->post_contact_location($this->request->body['contact_id']); // Todo Need to work out why we cannot do it the normal way

        if($contact_location_id){

            $this->response($contact_location_id, 200);

        }
        else{

            $this->response(null, 404);

        }

    }

    /**
     * Get a contacts locations
     */
    public function contact_locations_get(){

        $contact_locations = $this->contact_model->get_contact_locations($this->get('contact_id'));

        if($contact_locations){

            $this->response($contact_locations, 200);

        }
        else{

            $this->response(null, 404);

        }

    }

    /**
     * Remove a contacts location details
     */
    public function delete_contact_location_post(){

        $contact_location_id = $this->contact_model->delete_contact_location($this->request->body['contact_location_id']); // Todo Need to work out why we cannot do it the normal way

        if($contact_location_id){

            $this->response($contact_location_id, 200);

        }
        else{

            $this->response(null, 404);

        }

    }

    /**
     * Get a contacts comm details
     */
    public function contact_comms_get(){

        $contact_comms = $this->contact_model->get_contact_comms($this->get('contact_id'));

        if($contact_comms){

            $this->response($contact_comms, 200);

        }
        else{

            $this->response(null, 404);

        }

    }

    /**
     * Get a contacts comm details
     */
    public function contact_comm_get(){

        $contact_comm = $this->contact_model->get_contact_comm($this->get('contact_comm_id'));

        if($contact_comm){

            $this->response($contact_comm, 200);

        }
        else{

            $this->response(null, 404);

        }

    }

    /**
     * Add a contacts comm details
     */
    public function add_contact_comm_post(){

        $contact_comm_id = $this->contact_model->add_contact_comm($this->request->body['contact_id']); // Todo Need to work out why we cannot do it the normal way

        if($contact_comm_id){

            $this->response($contact_comm_id, 200);

        }
        else{

            $this->response(null, 404);

        }

    }

    /**
     * Remove a contacts comm details
     */
    public function delete_contact_comm_post(){

        $contact_comm_id = $this->contact_model->delete_contact_comm($this->request->body['contact_comm_id']); // Todo Need to work out why we cannot do it the normal way

        if($contact_comm_id){

            $this->response($contact_comm_id, 200);

        }
        else{

            $this->response(null, 404);

        }

    }

    /**
     * Make a contacts comm details the primary comm
     */
    public function make_primary_contact_comm_post(){

        $contact_comm_id = $this->contact_model->make_primary_contact_comm($this->request->body['contact_comm_id']); // Todo Need to work out why we cannot do it the normal way

        if($contact_comm_id){

            $this->response($contact_comm_id, 200);

        }
        else{

            $this->response(null, 404);

        }

    }

    /**
     * Changes the contacts comm type ID to the next in the list
     */
    public function change_contact_comm_type_post(){

        $next_contact_comm_type_id = null;

        $comm_types = $this->contact_model->get_comm_types();

        foreach($comm_types as $key => $comm_type){

            if($this->request->body['contact_comm_type_id'] == $comm_type->contact_comm_type_id){

                $next_contact_comm_type_id = $comm_types[array_key_exists($key + 1, $comm_types) ? $key + 1 : 0]->contact_comm_type_id;

            }

        }

        if(!$this->request->body['contact_comm_type_id']){

            $next_contact_comm_type_id = $comm_types[0]->contact_comm_type_id;

        }

        $contact_comm_id = $this->contact_model->change_contact_comm_type_id($this->request->body['contact_comm_id'], $next_contact_comm_type_id);

        if($contact_comm_id){

            $this->response($contact_comm_id, 200);

        }
        else{

            $this->response(null, 404);

        }

    }

    /**
     * Get a contacts relating contacts by type
     */
    public function contact_contacts_get(){

        $contacts = $this->contact_model->get_contacts_contacts($this->get('contact_id'), $this->get('contact_type_id'));

        if($contacts){

            $this->response($contacts, 200);

        }
        else{

            $this->response(null, 404);

        }

    }

    /**
     * Add a contacts comm details
     */
    public function update_contact_comm_post(){

        // Todo: Need to work out why we cannot do it the normal way of using $this->post() or $this->get()

        $contact_comm_id = $this->contact_model->update_contact_comm($this->request->body['contact_comm']);

        if($contact_comm_id){

            $this->response($contact_comm_id, 200);

        }
        else{

            $this->response(null, 404);

        }

    }

}
