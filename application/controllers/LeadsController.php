<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class LeadsController extends CI_Controller {  

    // function for upding the varification table 
    public function add_action()
    {


            $data = array(
                'pan_verified'            => $_POST['data']['PANverified'],
                'bank_statement_verified'    => $_POST['data']['BankStatementSVerified'],
                'init_office_email_verification'    => $_POST['data']['officeEmailVerification'],
                'init_mobile_verification'            => $_POST['data']['initiateMobileVerification'],
                'mobile_otp'            =>$_POST['data']['enterOTPMobile'],
                'init_residence_cpv'             => $_POST['data']['residenceCPV'],
                'init_office_cpv'             => $_POST['data']['officeCPV']
            );
            $table='tbl_verification';
            $upd_id=$_POST['data']['lead_id'];
            $colm='lead_id';
            $res = $this->Leadmod->globel_update($table,$data,$upd_id,$colm);

            echo json_encode(['status' => TRUE]);
            
      }




}
?>
