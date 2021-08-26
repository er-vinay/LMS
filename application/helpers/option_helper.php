<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


if ( ! function_exists('test_method'))
{
    
    
    

     if ( ! function_exists('getVerificationdata')){

  
        function getVerificationdata($table,$id){
           
            $ci =& get_instance();
           
            $ci->load->database();
           // echo "SELECT count(*) as total FROM `attendeduserlist` where useremailid='$email'  and event_id='$id'  ";
          
            $query = $ci->db->query("SELECT *   FROM $table where lead_id='$id'   ");
            
             if($query->num_rows() > 0){
               return $query->result_array();
              }else{
               return "No";
            }
        }
     }


}

?>