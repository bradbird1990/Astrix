<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Base_Model extends CI_Model {

    public function __construct(){

        parent::__construct();

    }

    public function remove_non_existing_columns($table_name, $data_items){

        $existing_columns = array();

        $table_columns = $this->db->field_data($table_name);

        foreach($table_columns as $table_column){

            if($table_column->primary_key == 1){

                $existing_columns['meta_data']['primary_key'] = $table_column->name;
                $existing_columns['meta_data']['primary_key_id'] = $data_items[$table_column->name];

            }
            else{

                foreach($data_items as $data_item_key => $data_item){

                    if($table_column->name == $data_item_key){

                        $existing_columns['data'][$data_item_key] = $data_item;

                    }

                }

            }

        }

        return $existing_columns;

    }

}
