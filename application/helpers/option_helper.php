<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


if ( ! function_exists('test_method'))
{
    
    
    

     if ( ! function_exists('getVerificationdata')){
        function getVerificationdata($table,$id){
            $ci =& get_instance();
            $ci->load->database();
           // echo "SELECT *   FROM $table where lead_id='$id'   ";
            $query = $ci->db->query("SELECT *   FROM $table where lead_id='$id'   ");
            
             if($query->num_rows() > 0){
               return $query->result_array();
              }else{
               return "No";
            }
        }
     }


     if ( ! function_exists('getUserData')){
      function getUserData($table,$id,$colmn){
          $ci =& get_instance();
          $ci->load->database();
      //echo "SELECT leads.screener_id,leads.screenin_time,$table.borrower_name ,$table.middle_name , $table.surname, $table.gender, $table.dob,users.name as screenername,users.user_id as screenerid,$table.pancard,$table.mobile,$table.alternate_no,$table.email,$table.alternateEmail FROM $table INNER JOIN leads on $table.$colmn=leads.$colmn   inner join users on users.user_id=leads.screener_id where $table.$colmn='5358' ";

    
          $query = $ci->db->query("SELECT tbl_cam.borrower_name ,tbl_cam.middle_name , tbl_cam.surname, tbl_cam.gender, tbl_cam.dob,users.name as screenername,users.user_id as screenerid,tbl_cam.pancard,tbl_cam.mobile,tbl_cam.alternate_no,tbl_cam.email,tbl_cam.alternateEmail  FROM $table inner join users on users.user_id=$table.usr_created_by where $table.$colmn='$id'   "); 
          
           if($query->num_rows() > 0){
             return $query->result_array();
            }else{
             return "No";
          }
      }
   }

   //function to get lead_id from table_cam
   if ( ! function_exists('getLeadIdstatus')){
      function getLeadIdstatus($table,$id){
          $ci =& get_instance();
          $ci->load->database();
                          //   echo "SELECT count(*) as total from $table where lead_id='$id'  ";
          $query = $ci->db->query("SELECT count(*) as total from $table where lead_id='$id'  "); 
          
           if($query->num_rows() > 0){
            foreach ($query->result_array() as $row)  {
               if($row['total']!='0')
               {
                  return '1';
               }
               else {
                  return '0';
               }
               
              }
            }else{
             return "0";
          }
      }
   }

}

?>