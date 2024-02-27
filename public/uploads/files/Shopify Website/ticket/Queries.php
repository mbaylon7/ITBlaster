<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Queries extends CI_Model {
    
     public function __construct() 
     {
            parent::__construct();
            $this->db = $this->load->database("default",true);
                   
     }
    function select_no_where($fields, $table_name, $single = false) {
        
        $query = $this->db->select($fields)
                          ->from($table_name)
                          ->get();
                          
        if ($query->num_rows() > 0 ):
            return ($single == true) ? $query->row()->$fields : $query->result_array();
        endif;
        
        return false;
    }
    
    function select_where ($fields, $table_name, $where, $boolean = false, $single = false) {
        
        $query = $this->db->select($fields)
                          ->from($table_name)
                          ->where($where)
                          ->get();
                      
        if ($query->num_rows() > 0 ):
            if ($boolean == true) :
                return true;
            else:
                if ($single == true) :
                    return $query->row()->$fields;
                else:
                    return $query->result_array();
                endif;
            endif;
        endif;
        
        return false;
    }
    
    function select_where_orderby ($fields, $table_name, $where, $order_by, $order_type = 'asc', $boolean = false, $single = false) {
        
        $query = $this->db->select($fields)
                          ->from($table_name)
                          ->where($where)
                          ->order_by($order_by, $order_type)
                          ->get();
                      
        if ($query->num_rows() > 0 ):
            if ($boolean == true) :
                return true;
            else:
                if ($single == true) :
                    return $query->row()->$fields;
                else:
                    return $query->result_array();
                endif;
            endif;
        endif;
        
        return false;
    }
    
    function select_order_by($fields, $table_name, $order_field, $order_by = 'asc', $limit = 1, $offset = 0)
    {
        $query = $this->db->select($fields)
                          ->from($table_name)
                          ->order_by($order_field, $order_by)
                          ->limit($limit, $offset)
                          ->get();
        if ($query->num_rows() > 0):
            return ($limit == 1) ? $query->row()->$fields : $query->result_array();
        endif;
        
        return false;
    }
    
    function insert($values, $table_name, $getLastId = false) {
        
        $query = $this->db->insert($table_name, $values);
        
        if ($getLastId == true) {
            return $this->db->insert_id();
        }
        
    }
    
    function insert_batch($values, $table_name)
    {
        $this->db->insert_batch($table_name, $values);
    }
    
    
    function query($query) {
        
        $_query = $this->db->query($query);
        
        if($_query->num_rows() > 0) {
            return $_query->result_array();
        }
    }
    
    function update_where($values, $table_name, $where)
    {
        $query = $this->db->where($where)
                          ->update($table_name, $values);
                 
        return $this->db->affected_rows(); 
    }
    
    function update_batch($values, $table_name, $where)
    {
        $this->db->update_batch($table_name, $values, $where);
    }
    
    function delete($table_name, $where) {
        $this->db->where($where)
        ->delete($table_name);   
        return true;
    }
    
    function truncate($table_name){
        $this->db->truncate($table_name);
        return true;
    }
    /** ken queries start here **/
    
    function select_where_like ($fields, $table_name, $like_field, $like_key, $boolean = false, $single = false) {
        
        $query = $this->db->select($fields)
                          ->from($table_name)
                          ->like($like_field, $like_key, "both")
                          ->get();
                      
        if ($query->num_rows() > 0 ):
            if ($boolean == true) :
                return true;
            else:
                if ($single == true) :
                    return $query->row()->$fields;
                else:
                    return $query->result_array();
                endif;
            endif;
        endif;
        
        return false;
    }
    
    function check_table($form, $initials){
        
        $this->load->dbforge();
        $code = strtolower($this->session->userdata("client_code"));
        $table = $code."_".$form;
        
        if(!$this->db->table_exists($table)){
            
            $fields = Array("PK_{$code}{$initials}_id" => Array(
                                                            "type"              => "INT",
                                                            "constraint"        => 11,
                                                            "unsigned"          => TRUE,
                                                            "auto_increment"    => TRUE
                            ),
                            "{$code}{$initials}_lastupdated_by_id" => Array(
                                                            "type"          => "INT",
                                                            "constraint"    => 11,
                                                            "unsigned"      => TRUE
                            ),
                            "{$code}{$initials}_lastupdated_by_name" => Array(
                                                            "type"          => "TEXT",
                                                            "unsigned"      => TRUE
                            ),
                            "{$code}{$initials}_datetime_lastupdated datetime default current_timestamp on update current_timestamp"
                            );
                            
            $this->dbforge->add_field($fields);
            $this->dbforge->add_key("PK_{$code}{$initials}_id", TRUE);
            $this->dbforge->create_table($table, true);
            
            return true;
        }
        return false;
    }
    
    function add_column($table, $structure){
        
        $this->dbforge->add_column($table, $structure);
    }
    
    function alter_table($old_name, $new_name){
        
        $this->dbforge->rename_table($old_name, $new_name);
    }
    
    function alter_column($table, $structure){
        
        $this->dbforge->modify_column($table, $structure);
    }
    
    function drop_table($table){
        
        $this->dbforge->drop_table($table,TRUE);
    }
    
    function drop_column($table, $column){
        
        $this->dbforge->drop_column($table, $column);
    }
    
    /** ken queries end here **/
    


    /* Emjay queries start*/
    function get_records_array($table_name,$where)
    {
        
       $this->db->select("*");
       $this->db->from($table_name);
       $this->db->where($where);
       $query = $this->db->get();

       if($query->num_rows() != 0)
       {
           return $query->result();
       }
       else
       {
           return false;
       }

    }

 
    function insert_review($values, $table_name,$data_array) {
        $parent_id = $data_array['trap_no'];

        $query = $this->db->insert($table_name, $values);
        
        $last_id = $this->db->insert_id();
         
        if($query)
        {
            $this->update_row($last_id,$parent_id);
        }
         
    }
    
    

     function update_row($last_id,$parent_id){

        $count = count($parent_id); 

         foreach($parent_id as $key => $value)
         {
             $menuData = array(
                'fk_gpc_id' => $last_id
             );
             $this->db->where('trap_no', $value);
             $this->db->update('tbl_afia_gmp_pest_control', $menuData);
         }
        
	}	

    public function delete_record($table_name,$param,$user_data_table)
    {
        $this->db->where($user_data_table, $param);
        $this->db->delete($table_name);
        return true;
    }

    //changes 4-01-22
    function insert_exterior_reviewer($values, $table_name,$data_array) {
      
        $query = $this->db->insert($table_name, $values);
        
        $last_id = $this->db->insert_id();
         
        if($query)
        {
            $this->insert_exterior($last_id,$data_array);
        }
         
    }

    function insert_exterior($last_id,$data_array)
    {
        $count = $data_array['counter'];

        for($i = 1; $i <= count($count); $i++)
            {
               $data_array1['eglr_flag']=$this->input->post('yesno'.$i.'');
               $data_array1['fk_egl_id']=$this->input->post('fk_egl_id'.$i.'');
               $data_array1['fk_egr_id']= $last_id;
               $data_array1['comment']=$this->input->post('comments'.$i.'');
                $this->queries->insert($data_array1,$table = "tbl_fwcc_gmp_exterior_ground_list_records");
            }
    }
    
  function get_record_join($table_name,$param)
    {
        
        $this->db->select("*,tbl_fwcc_gmp_exterior_ground_list_records.id as PK_id");
        //$this->db->distinct();
        $this->db->from($table_name);
        $this->db->where('fk_egr_id = '.$param.'');
        $this->db->join('tbl_fwcc_gmp_exterior_ground_list','tbl_fwcc_gmp_exterior_ground_list.id = '.$table_name.'.fk_egl_id');
        //table name users
        $result = $this->db->get();

        if($result->num_rows() > 0)
        {
            return $result->result();
        }
        return array();
        
    }

    
    
    function get_record_progress_join()
    {
        
        $this->db->select("*");
        //$this->db->distinct();
        $this->db->from("tbl_afia_gmp_progress_trace_log_product_orders");
        $array = array('flag' => 0, 'user_name' => $_COOKIE['first_name']);
        $this->db->where($array); 
        $this->db->join('tbl_afia_gmp_progress_trace_log_product_ingredients','tbl_afia_gmp_progress_trace_log_product_ingredients.fk_ptlp_id = tbl_afia_gmp_progress_trace_log_product_orders.product_id');
        $this->db->join('tbl_afia_gmp_progress_trace_log_product','tbl_afia_gmp_progress_trace_log_product.id = tbl_afia_gmp_progress_trace_log_product_orders.product_id');
        $this->db->join('tbl_afia_gmp_progress_trace_log_product_units','tbl_afia_gmp_progress_trace_log_product_units.id = tbl_afia_gmp_progress_trace_log_product_ingredients.unit_id');
        //table name users
        $result = $this->db->get();

        if($result->num_rows() > 0)
        {
            return $result->result();
        }
        return array();
        
    }

    function get_record_progress_single_join()
    {
        $this->db->select("*");
        //$this->db->distinct();
        $this->db->from("tbl_afia_gmp_progress_trace_log_product_orders");
        $array = array('flag' => 0, 'user_name' => $_COOKIE['first_name']);
        $this->db->where($array); 
        $this->db->join('tbl_afia_gmp_progress_trace_log_product','tbl_afia_gmp_progress_trace_log_product.id = tbl_afia_gmp_progress_trace_log_product_orders.product_id');

               //table name users
        $result = $this->db->get();

        if($result->num_rows() > 0)
        {
            return $result->result();
        }
        return array();
    }


    function get_record_progress_product_list()
    {
        $this->db->select("*");
        //$this->db->distinct();
        $this->db->from("tbl_afia_gmp_progress_trace_log_records");
        $this->db->where('flag = 1');
        $this->db->join('tbl_afia_gmp_progress_trace_log_product','tbl_afia_gmp_progress_trace_log_product.id = tbl_afia_gmp_progress_trace_log_records.product_id');
        $this->db->join('tbl_afia_gmp_progress_trace_log_product_orders','tbl_afia_gmp_progress_trace_log_product_orders.order_id = tbl_afia_gmp_progress_trace_log_records.fk_wptl_order_id');
        $this->db->distinct('fk_wptl_order_id');
        $this->db->order_by('tbl_afia_gmp_progress_trace_log_records.production_date','desc');
               //table name users
        $result = $this->db->get();

        if($result->num_rows() > 0)
        {
            return $result->result();
        }
        return array();
    }
    
    function get_record_progress_product_list_pending()
    {
        $this->db->select("*");
        //$this->db->distinct();
        $this->db->from("tbl_afia_gmp_progress_trace_log_records");
        $this->db->where('flag = 1');
        $this->db->join('tbl_afia_gmp_progress_trace_log_product','tbl_afia_gmp_progress_trace_log_product.id = tbl_afia_gmp_progress_trace_log_records.product_id');
        $this->db->join('tbl_afia_gmp_progress_trace_log_product_orders','tbl_afia_gmp_progress_trace_log_product_orders.order_id = tbl_afia_gmp_progress_trace_log_records.fk_wptl_order_id');
        $this->db->join('tbl_afia_gmp_progress_trace_log_review','tbl_afia_gmp_progress_trace_log_review.id = tbl_afia_gmp_progress_trace_log_product_orders.review_PK_id');
        $this->db->where('tbl_afia_gmp_progress_trace_log_review.approved_status != 2');
        $this->db->distinct('tbl_afia_gmp_progress_trace_log_records.fk_wptl_order_id');

               //table name users
        $result = $this->db->get();

        if($result->num_rows() > 0)
        {
            return $result->result();
        }
        return array();
    }


     public function get_user_single($param,$table_name,$user_data_table)
        {
      
            $this->db->where($user_data_table, $param);
    
            $result = $this->db->get($table_name);
    
            return $result->row_array();
        }
    
    // ADDITIONAL FUNCTION
    function query_get_affected($query){
       $this->db->query($query);
       return $this->db->affected_rows();
    }
    
    function query_result($query){

       $res = $this->db->query($query);
       return $res->result_array();
    }


      /* Emjay queries ends here*/
      
}