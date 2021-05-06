<?php

class Admin_model extends CI_Model
{
    function get_all_trainings()
    {
        // Return all trainings with their partners

        $this->db->select(
            'trainings.*,
            (SELECT COUNT(trainings_partners.tp_t_id) FROM trainings_partners) as partners_count,
            (SELECT COUNT(trainings_speakers.ts_t_id) from trainings_speakers) as speakers_count');
            $this->db->from('trainings');
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

    public function delete_training_by_id($training_id)
    {
        // delete training by id
        if(is_numeric($training_id)){
            $sql = "delete from trainings where t_id = $training_id";
            $query = $this->db->query($sql);
            if($query){
                return true;
            }else{
                return false;
            }
        }
        return false;
    }

    public function update_training_by_id($training_id, $form_array){
        $this->db->where('t_id', $training_id);
        $this->db->update('trainings', $form_array);
    }

    public function change_training_status($training_id){
        //Change status of a partner from 1 to 0 and opposite

        $training = $this->get_training_by_id($training_id);
        if($training['t_status'] == 0){
            $training['t_status'] = 1;
        }elseif ($training['t_status'] == 1){
            $training['t_status'] = 0;
        }
        $this->update_training_by_id($training_id, $training);
    }



    /************** SPEAKERS ***************/

    public function get_all_speakers_for_dropdown()
    {
        // return speakers in the for of
        // id => name
        // for dropdown
        $query = $this->db->query('SELECT s_id, s_name FROM speakers');
        return $query->result_array();
    }

    public function get_all_speakers()
    {
        $sql = "select * from speakers";
        $query = $this->db->query($sql);
        return $query->result_array();
    }

    public function get_speaker_by_id($speaker_id){
        $this->db->where('s_id', $speaker_id);
        return $this->db->get('speakers')->row_array();
    }

    public function update_speaker_by_id($speaker_id, $form_array){
        $this->db->where('s_id', $speaker_id);
        $this->db->update('speakers', $form_array);
    }

    public function delete_speaker_by_id($speaker_id)
    {
        $this->db->select('*');
        $this->db->from('speakers');
        $this->db->where('s_id', $speaker_id);
        $result = $this->db->get();
        if ($result->num_rows()) {
            $fetched_user = $result->row();
            $this->db->delete('speakers', array('s_id' => $speaker_id));
            return true;
        } else {
            return false;
        }
    }

    public function add_speaker($speaker_data){
        $data = array(
            's_name' => $speaker_data['s_name'],
            's_image' => $speaker_data['s_image'],
            's_company' => $speaker_data['s_company'],
        );
        $this->db->insert('speakers', $data);
    }

    function get_speakers_of_training($training_id)
    {
        // get speakers of a specific training

        $sql = "select speakers.s_id, speakers.s_name, speakers.s_company, trainings_speakers.ts_status from speakers 
                inner join trainings_speakers ON trainings_speakers.ts_t_id = $training_id
                where speakers.s_id = trainings_speakers.ts_s_id";
        $query = $this->db->query($sql);
        return $query->result_array();
    }

    public function delete_all_speakers_of_training($training_id){

        // delete all speakers of a training

        $this->db->select('*');
        $this->db->from('trainings_speakers');
        $this->db->where('ts_t_id', $training_id);
        $result = $this->db->get();

        if ($result->num_rows()) {
            $fetched_training = $result->row();
            if ($fetched_training) {
                $this->db->delete('trainings_speakers', array('ts_t_id' => $training_id));
                return true;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

    public function add_speakers_to_training($training_id, $list_of_speakers){
        $this->delete_all_speakers_of_training($training_id); // delete all speakers and replace with the new ones from dropdown

        foreach ($list_of_speakers as $speaker){
            $this->db->insert('trainings_speakers', array('ts_t_id' => $training_id, 'ts_s_id' => $speaker));
        }
    }

    function delete_speaker_by_id_from_training($speaker_id, $training_id)
    {
        // delete a partner of a specific training by p_id

        $this->db->select('*');
        $this->db->from('trainings_speakers');
        $this->db->where('ts_s_id', $speaker_id);
        $result = $this->db->get();

        if ($result->num_rows()) {
            $fetched_speaker = $result->row();
            if ($fetched_speaker) {
                $this->db->delete('trainings_speakers', array('ts_s_id' => $speaker_id, 'ts_t_id' => $training_id));
                return true;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }


}


