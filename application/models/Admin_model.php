<?php

class Admin_model extends CI_Model
{


    function get_all_trainings()
    {
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
        $this->db->where('t_id', $training_id);
        return $this->db->get('trainings')->row_array();
    }

    /*************** PARTNERS **************/

    function get_partners_of_training($training_id)
    {

        $sql = "select partners.* from partners 
                INNER join trainings_partners ON trainings_partners.tp_t_id = $training_id
                where partners.p_id = trainings_partners.tp_p_id";
        $query = $this->db->query($sql);

//        $this->db->select('partners.*');
//        $this->db->from('partners');
//        $this->db->join('trainings_partners', 'trainings_partners.tp_t_id = '.$training_id.'', 'inner');
        //$this->db->where('partners.p_id', 'trainings_partners.tp_p_id' );
        //$query = $this->db->get();

        return $query->result_array();
    }

    function delete_partner_by_id_from_training($partner_id)
    {
        $this->db->select('*');
        $this->db->from('trainings_partners');
        $this->db->where('tp_p_id', $partner_id);
        $result = $this->db->get();

        if ($result->num_rows()) {
            $fetched_partner = $result->row();
            if ($fetched_partner) {
                $this->db->delete('trainings_partners', array('tp_p_id' => $partner_id));
                return true;
            } else {
                return false;
            }
        } else {
            return false;
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


}


