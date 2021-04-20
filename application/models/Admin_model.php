<?php

class Admin_model extends CI_Model
{


    function get_all_trainings()
    {
        // Return all trainings with their partners

        $this->db->select('trainings.*, COUNT(trainings_partners.tp_t_id) as partners_count');
        $this->db->from('trainings');
        $this->db->join('trainings_partners', 'trainings.t_id = trainings_partners.tp_t_id', 'left');
        $this->db->join('partners', 'trainings_partners.tp_p_id  = partners.p_id', 'left');
        $this->db->group_by('trainings.t_id');

        $query = $this->db->get();

        return $query->result_array();
    }

    function get_training_by_id($training_id)
    {
        // return a training by id

        $this->db->where('t_id', $training_id);
        return $this->db->get('trainings')->row_array();
    }

    /*************** PARTNERS **************/

    function get_partners_of_training($training_id)
    {
        // get partners of a specific training

        $sql = "select partners.p_id, partners.p_name, partners.p_website, trainings_partners.tp_status  from partners 
                inner join trainings_partners ON trainings_partners.tp_t_id = $training_id
                where partners.p_id = trainings_partners.tp_p_id";
        $query = $this->db->query($sql);

//        $this->db->select('partners.*');
//        $this->db->from('partners');
//        $this->db->join('trainings_partners', 'trainings_partners.tp_t_id = '.$training_id.'', 'inner');
        //$this->db->where('partners.p_id', 'trainings_partners.tp_p_id' );
        //$query = $this->db->get();

        return $query->result_array();
    }

    function delete_partner_by_id_from_training($partner_id, $training_id)
    {
        // delete a partner of a specific training by p_id

        $this->db->select('*');
        $this->db->from('trainings_partners');
        $this->db->where('tp_p_id', $partner_id);
        $result = $this->db->get();

        if ($result->num_rows()) {
            $fetched_partner = $result->row();
            if ($fetched_partner) {
                $this->db->delete('trainings_partners', array('tp_p_id' => $partner_id, 'tp_t_id' => $training_id));
                return true;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

    public function delete_all_partners_of_training($training_id){

        // delete all partners of a training

        $this->db->select('*');
        $this->db->from('trainings_partners');
        $this->db->where('tp_t_id', $training_id);
        $result = $this->db->get();

        if ($result->num_rows()) {
            $fetched_training = $result->row();
            if ($fetched_training) {
                $this->db->delete('trainings_partners', array('tp_t_id' => $training_id));
                return true;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

    public function add_partners_to_training($training_id, $list_of_partners){
        $this->delete_all_partners_of_training($training_id); // delete all partners and replace with the new ones from dropdown

        foreach ($list_of_partners as $partner){
            $this->db->insert('trainings_partners', array('tp_t_id' => $training_id, 'tp_p_id' => $partner));
        }
    }


    public function get_all_partners_for_dropdown()
    {
        // return partners in the for of
        // id => name
        // for dropdown
        $query = $this->db->query('SELECT p_id, p_name FROM partners');
        return $query->result_array();
    }

    public function get_all_partners()
    {

        $sql = "select * from partners";
        $query = $this->db->query($sql);
        return $query->result_array();
    }


    public function delete_partner_by_id($partner_id)
    {
        $this->db->select('*');
        $this->db->from('partners');
        $this->db->where('p_id', $partner_id);
        $result = $this->db->get();
        if ($result->num_rows()) {
            $fetched_user = $result->row();
            $this->db->delete('partners', array('p_id' => $partner_id));
            return true;
        } else {
            return false;
        }
    }

    public function get_partner_by_id($partner_id){
        $this->db->where('p_id', $partner_id);
        return $this->db->get('partners')->row_array();
    }

    public function update_partner_by_id($partner_id, $form_array){
        $this->db->where('p_id', $partner_id);
        $this->db->update('partners', $form_array);
    }

    public function add_partner($partner_data){
        $data = array(
            'p_name' => $partner_data['p_name'],
            'p_image' => $partner_data['p_image'],
            'p_website' => $partner_data['p_website'],
        );
        $this->db->insert('partners', $data);
    }

    function insert_data($path_name){
        $data = array(
            'p_image'    => $path_name,
        );

        $this->db->insert('partners', $data);

        return $this->db->insert_id();
    }


    public function change_partner_status($partner_id){
        //Change status of a partner from 1 to 0 and opposite

        $partner = $this->get_partner_by_id($partner_id);
        if($partner['p_status'] == 0){
            $partner['p_status'] = 1;
        }elseif ($partner['p_status'] == 1){
            $partner['p_status'] = 0;
        }
        $this->update_partner_by_id($partner_id, $partner);
    }

    public function update_traninigs_partner_by_id($training_id, $partner_id, $form_array){
        $this->db->where('tp_p_id', $partner_id);
        $this->db->where('tp_t_id', $training_id);
        $this->db->update('trainings_partners', $form_array);
    }

    public function change_training_partner_status($training_id, $partner_id){
        // Change status of training's partner from 1 to 0 and opposite

        $sql = "select * from trainings_partners 
                where trainings_partners.tp_p_id = $partner_id and trainings_partners.tp_t_id = $training_id";
        $query = $this->db->query($sql);

        $training_partner =  $query->row_array();

        if($training_partner['tp_status'] == 0){
            $training_partner['tp_status'] = 1;
        }elseif ($training_partner['tp_status'] == 1){
            $training_partner['tp_status'] = 0;
        }
        $this->update_traninigs_partner_by_id($training_id, $partner_id, $training_partner);

    }

}


