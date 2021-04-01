<?php

class Training_model extends CI_Model {

    public function get_last_ten_entries()
    {
        $query = $this->db->get('trainings', 10);
        return $query->result();
    }

    public function insert_training($data){
        // create a new trainings
        $this->db->insert("trainings", $data);
    }

    public function get_training_by_id($training_id){
        // get a trainings by ID
        $this->db->where('t_id', $training_id);
        return $this->db->get('trainings')->row_array();
    }

        public function get_active_training(){
        // get a trainings by true status
        $this->db->where('t_status', 1);
        return $this->db->get('trainings')->row_array();
    }

    public function update_training_by_id($training_id, $form_array){
        // update a trainings object
        $this->db->where('t_id', $training_id);
        $this->db->update('trainings', $form_array);
    }

    public function delete_training_by_id($training_id){
        // delete user by ID but not root user
        $this->db->select('*');
        $this->db->from('trainings');
        $this->db->where('t_id', $training_id);
        $result=$this->db->get();
        if ($result->num_rows()) {
            $fetched_training = $result->row();
            if($fetched_training){
                $this->db->delete('trainings', array('t_id' => $training_id));
                return true;
            }else{
                return false;
            }
        } else {
            return false;
        }
    }

    public function get_speakers_of_training(){

    }

}