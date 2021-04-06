<?php

class Admin_model extends CI_Model
{


    function get_all_trainings()
    {

        $this->db->select('trainings.*, GROUP_CONCAT(partners.p_name) as partners_name,
                                        GROUP_CONCAT(partners.p_website) as partners_website,
                                        GROUP_CONCAT(partners.p_image) as partners_image');
        $this->db->from('trainings');
        $this->db->join('trainings_partners', 'trainings.t_id = trainings_partners.tp_t_id ', 'inner');
        $this->db->join('partners', 'trainings_partners.tp_p_id  = partners.p_id', 'inner');

        $query = $this->db->get();

        return $query->result_array();
    }

}


