<?php
	defined('BASEPATH') OR exit('No direct script access allowed');
	class CollectionController extends CI_Controller
	{
		public function __construct()
		{
			parent::__construct();
            $this->load->model('Task_Model');

	    	$login = new IsLogin();
	    	$login->index();
		}

		public function index()
	    {
	    	$collectionDate = date('Y-m-d', strtotime('+5 days', strtotime(todayDate)));
	    	$todayCollection = $this->db->select('leads.lead_id, leads.name, leads.email, tb_states.state, leads.created_on, leads.source, leads.status, leads.userChecked, leads.partPayment, credit.loan_amount_approved, credit.mobile, credit.customer_id,loan.loan_id, loan.lead_id, loan.loan_no, loan.loan_repay_date, loan.loan_tenure, loan.loan_intrest, loan.loan_repay_amount, loan.loan_repay_date, loan.loan_disburse_date')
				->where('loan.loan_repay_date BETWEEN "'. date('Y-m-d', strtotime(todayDate)). '" and "'. date('Y-m-d', strtotime($collectionDate)).'"')
				->from('loan')
                ->join('credit', 'credit.lead_id = loan.lead_id')
                ->join('leads', 'loan.lead_id = leads.lead_id')
                ->join('tb_states', 'leads.state_id = tb_states.id');
            $todayData = $todayCollection->get();
			$data['taskCount'] = $todayData->num_rows();
			$data['listTask'] = $todayData->result();
            
        	$this->load->view('Collection/index', $data);
	    }

	    public function AddCollectionAmount()
	    {
	    	if ($this->input->server('REQUEST_METHOD') == 'POST') 
	        {
	        	$this->form_validation->set_rules('lead_id', 'Lead Id', 'required|trim');
	        	$this->form_validation->set_rules('payment_amount', 'Payment Amount', 'required|trim');
	        	$this->form_validation->set_rules('refrence_no', 'Refrence No', 'required|trim');
	        	$this->form_validation->set_rules('payment_mode', 'Payment Mode', 'required|trim');
	        	$this->form_validation->set_rules('payment_type', 'Payment Type', 'required|trim');

	        	if($this->form_validation->run() == FALSE) {
	        		$json['err'] = validation_errors();
		            echo json_encode($json);
	        	} else {
	    			$lead_id = $this->input->post('lead_id');
					$payment_amount = $this->input->post('payment_amount');
					$refrence_no = $this->input->post('refrence_no');
					$payment_mode = $this->input->post('payment_mode');
					$payment_type = $this->input->post('payment_type');
					$otherDetails = $this->input->post('otherDetails');
					$discount = $this->input->post('discount');
					$remark = $this->input->post('remark');
					$updated_by = $_SESSION['isUserSession']['user_id'];
					
					$sqlRecovery = $this->db->select('recovery.recovery_id, recovery.recovery_by,')
							->where('refrence_no', $refrence_no)
							->from('recovery')
							->get();
					if($sqlRecovery->num_rows() == 0)
					{
						$query = $this->db->select('loan.loan_no, loan.lan')->where('lead_id', $lead_id)->from('loan')->get()->row();
		    			$loan_no = $query->loan_no;
		    			$lan = $query->lan;
		    			$paymentSlips = "";
		    			$recovery_status = "Pending";

		    			// $config['upload_path'] = 'public/images/';
		    			$config['upload_path'] = 'upload/';
		                $config['allowed_types'] = 'pdf|jpg|png|jpeg';  
						$this->upload->initialize($config);
						if(!$this->upload->do_upload('image'))
						{
							$json['err'] = $this->upload->display_errors();
		            		echo json_encode($json);
						}
						else
						{
							$data = array('upload_data' => $this->upload->data());
							$paymentSlips = $data['upload_data']['file_name'];
						}

			            $data = [
							'lead_id'		 	=> $lead_id,
							'loan_no'		 	=> $loan_no,
							'lan'		 		=> $lan,
							'payment_amount'	=> $payment_amount,
							'refrence_no'		=> $refrence_no,
							'payment_mode'	 	=> $payment_mode,
							'status'	 		=> $payment_type,
							'docs'	 			=> $paymentSlips,
							'discount'	 		=> $discount,
				            'recovery_status'	=> $recovery_status,
							'remarks'	 		=> $remark,
							'date_of_recived'	=> updated_at,
							'recovery_by'		=> $_SESSION['isUserSession']['user_id'],
							'created_on'		=> updated_at,
			            ];

			            $result = $this->db->insert('recovery', $data);
			            $this->db->where('lead_id', $lead_id)->update('leads', ['status' => $payment_type]);
			            echo json_encode($result);
			        } 
			        else 
			        {
			        	$data = $sqlRecovery->row();
			        	$recovery_by = $data->recovery_by;
						$userDetails = $this->db->select('users.name')->where('user_id', $recovery_by)->from('users')->get()->row_array();
			            echo "name";
			        }
		        }
	        }
	    }

	    public function MIS()
	    {
    		$data['MIS'] = $this->Task_Model->getMISData();
	    	$this->load->view('MIS/index', $data);
	    }

	    public function getRecoveryData($lead_id)
	    {
    		$getRecoveryData = $this->Task_Model->getRecoveryData($lead_id);
    		echo json_encode($getRecoveryData);
    	}

	    public function getPaymentVerification($refrence_no)
	    {
	    	$data = $this->db->where('refrence_no', $refrence_no)->get('recovery')->row_array();
    		echo json_encode($data);
    	}

	    public function verifyCustomerPayment()
	    {
			$recovery_id = $this->input->post('recovery_id');
			$lead_id = $this->input->post('lead_id');
			$loan_no = "";
			
			if(empty($recovery_id)){
			    $loanDetails = $this->db->select('loan.loan_no, loan.customer_id')->where('lead_id', $lead_id)->from('loan')->get()->row();
			    $loan_no = $loanDetails->loan_no;
			    $customer_id = $loanDetails->customer_id;
			} else {
			    $recoveryDetails = $this->db->select('recovery.loan_no')->where('recovery_id', $recovery_id)->from('recovery')->get()->row();
			    $loan_no = $recoveryDetails->loan_no;
			}
			
	    	if ($this->input->server('REQUEST_METHOD') == 'POST') 
	        {
	        	$this->form_validation->set_rules('lead_id', 'Lead Id', 'required|trim');
	        	$this->form_validation->set_rules('payment_amount', 'Payment Amount', 'required|trim');
	        	$this->form_validation->set_rules('refrence_no', 'Refrence No', 'required|trim');
	        	$this->form_validation->set_rules('payment_mode', 'Payment Mode', 'required|trim');
	        	$this->form_validation->set_rules('payment_type', 'Payment Type', 'required|trim');
	        	$this->form_validation->set_rules('discount', 'Discount', 'required|trim');
	        	$this->form_validation->set_rules('remark', 'Remarks', 'required|trim');

	        	if($this->form_validation->run() == FALSE) {
	        		$json['err'] = validation_errors();
		            echo json_encode($json);
	        	} else {
					$payment_amount     = $this->input->post('payment_amount');
					$refrence_no        = $this->input->post('refrence_no');
					$payment_mode       = $this->input->post('payment_mode');
					$payment_type       = $this->input->post('payment_type');
					$discount           = $this->input->post('discount');
					$remark             = $this->input->post('remark'); 
					$date_of_recived    = $this->input->post('date_of_recived');
					
					$recovery_status = "Approved";
					$dataInsert = [
						'lead_id' 	        => $lead_id,
					    'customer_id' 	    => $customer_id,
						'loan_no' 	        => $loan_no,
						'payment_amount' 	=> $payment_amount,
						'refrence_no' 		=> $refrence_no,
						'payment_mode' 		=> $payment_mode,
						'status' 			=> $payment_type,
						'discount' 			=> $discount,
						'remarks' 			=> $remark,
						'recovery_status' 	=> $recovery_status,
						'date_of_recived' 	=> $date_of_recived,
						'noc' 	            => "Yes",
						'PaymentVerify' 	=> 1,
						'recovery_by' 		=> $_SESSION['isUserSession']['user_id'],
						'updated_by' 		=> $_SESSION['isUserSession']['user_id'],
					]; 
					$data = [
						'loan_no' 	        => $loan_no,
						'payment_amount' 	=> $payment_amount,
						'refrence_no' 		=> $refrence_no,
						'payment_mode' 		=> $payment_mode,
						'status' 			=> $payment_type,
						'discount' 			=> $discount,
						'remarks' 			=> $remark,
						'recovery_status' 	=> $recovery_status,
						'date_of_recived' 	=> $date_of_recived,
						'PaymentVerify' 	=> 1,
						'updated_by' 		=> $_SESSION['isUserSession']['user_id'],
					]; 
					if(empty($recovery_id)) {
					    $result = $this->db->insert('recovery', $dataInsert);
					    $this->db->where('lead_id', $lead_id)->update('leads', ['status' => $payment_type]);
					    
					    if($payment_type == "Full Payment")
					    {
					        $this->NOC_letter($loan_no);
					        
					    }
					} else {
	    			    $result = $this->db->where('lead_id', $lead_id)->where('recovery_id', $recovery_id)->update('recovery', $data);
	    			    $this->db->where('lead_id', $lead_id)->update('leads', ['status' => $payment_type]); 
					}
	    		
	    			if($result == true){
		        		$json['msg'] = "Payment Approved Successfully.";
			            echo json_encode($json);
	    			}else{
	    				$json['err'] = "Payment Failed to Approved.";
			            echo json_encode($json);
	    			}
				}
			}
    	}
    	
    	public function NOC_letter($loan_no)
    	{
    	    $result =  $this->db->select('l.loan_no, l.loan_amount, l.customer_name, l.email, l.created_on as loaninitiatedDate, r.created_on as recInitiatedDate')
    	            ->where('l.loan_no', $loan_no)
    	            ->where('r.status', "Full Payment")
    	            ->from('loan l')
    	            ->join('recovery r', 'r.loan_no = l.loan_no');
    	    $sql = $result->get()->row();
    	    $query = $this->db->select_sum('payment_amount')->where('loan_no', $loan_no)->from('recovery')->get()->row();
    	    
    	    $loanCloserDate = date('d-M-Y', strtotime(updated_at));
    	   // $to = $sql->email;
    	    $to = "vinaykumarfd@gmail.com";
    	    
	        $loanInitiatedDate = date('d-m-Y', strtotime($sql->loaninitiatedDate));
    	    if(empty($loanInitiatedDate)){
    	        $loanInitiatedDate = date('d-m-Y', strtotime($sql->loaninitiatedDate));
    	    };
    	    
	        $recInitiatedDate = date('d-m-Y', strtotime($sql->recInitiatedDate));
    	    if(empty($recInitiatedDate)){
    	        $recInitiatedDate = date('d-m-Y', strtotime($sql->recInitiatedDate));
    	    };
    	    
    	    $message = '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
				<html xmlns="http://www.w3.org/1999/xhtml">
				<head>
				<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
				<title>Loan Against Card</title>
				</head>
				<body>


				<table width="778" border="0" align="center" cellpadding="0" cellspacing="0" style="padding:10px; border:solid 1px #ccc; font-family:Arial, Helvetica, sans-serif;">
				  <tr>
				    <td align="left"><img src="https://loanagainstcard.com/wp-content/uploads/2020/04/logo-final.png" width="234" height="50" /></td>
				  </tr>
				  <tr>
				    <td><hr style="background:#ddd !important;"></td>
				  </tr>
				  <tr>
				    <td>&nbsp;</td>
				  </tr>
				  <tr>
				    <td align="center" valign="top"><strong>No Objection Certificate</strong></td>
				  </tr>
				  <tr>
				    <td align="center" valign="top">&nbsp;</td>
				  </tr>
				  <tr>
				    <td align="left" valign="top"><strong style="line-height:25px;">Date : '. $loanCloserDate .'</strong></td>
				  </tr>
				  <tr>
				    <td align="left" valign="top"><strong style="line-height:25px;">Loan No. : '. $sql->loan_no .'</strong></td>
				  </tr>
				  <tr>
				    <td align="left" valign="top"><strong style="line-height:25px;">Mr/Ms '. $sql->customer_name .'</strong></td>
				  </tr>
				  <tr>
				    <td align="left" valign="top">&nbsp;</td>
				  </tr>
				  <tr>
				    <td align="left" valign="top"><span style="font-size:17px;
				    line-height: 25px;
				    padding-bottom: 6px; text-align:justify;">This is to certify that Mr/Ms '. $sql->customer_name .' who had taken a short-term loan from 
				    Naman Finlease Pvt. Ltd. for Rs '. $sql->loan_amount .' on '. $loanInitiatedDate .' has repaid Rs '. $query->payment_amount .' on '. $recInitiatedDate .'</span></td>
				  </tr>
				  <tr>
				    <td align="left" valign="top"><span style="font-size:17px;
				    line-height: 25px;
				    padding-bottom: 6px; text-align:justify;">This is the full amount which was due from him/her, including interest.</span> </td>
				  </tr>
				  <tr>
				    <td align="left" valign="top"><span style="font-size:17px;
				    line-height: 25px;
				    padding-bottom: 6px; text-align:justify;">Hence, there are no more dues from Mr/Ms '. $sql->customer_name .' against loan taken by him/her from Naman Finlease Pvt. Ltd.</span><br /><br /> </td>
				  </tr>
				  <tr>
				    <td align="left" valign="top"><span style="font-size:17px;
				    line-height: 25px;
				    padding-bottom: 6px; text-align:justify; margin:10px 0px;"><strong>For Naman Finlease Pvt Ltd </strong></span></td>
				  </tr>
				  <tr>
				    <td align="left" valign="top"><span style="font-size:17px;
				    line-height: 25px;
				    padding-bottom: 6px; text-align:justify; margin:10px 0px;"><strong>Authorised Signatory</strong></span></td>
				  </tr>
				  <tr>
				    <td><img src="'. base_url('public/front/') .'images/Authorised-Signatory.jpg" width="184" height="97" /></td>
				  </tr>
				  <tr>
				    <td style="margin-top:20px;">&nbsp;</td>
				  </tr>
				  <tr>
				    <td style="margin-top:20px;"><span style="font-size:17px;
				    line-height:20px;
				    padding-bottom: 6px; text-align:justify; margin:20px 0px;"><strong>* This is Computer generated document, hence does not require any signature</strong></span></td>
				  </tr>
				  <tr>
				    <td style="margin-top:20px;">&nbsp;</td>
				  </tr>
				  <tr>
				    <td><strong style="color:#2e5f8b;">Naman Finlease Pvt. Ltd. </strong></td>
				  </tr>
				  <tr>
				    <td><span style="font-size:17px;
				    line-height: 25px;
				    padding-bottom: 6px; text-align:justify;">S-370, Basement, Panchsheel Enclave,</span> </td>
				  </tr>
				  <tr>
				    <td><span style="font-size:17px;
				    line-height: 25px;
				    padding-bottom: 6px; text-align:justify;">New Delhi-110017</span></td>
				  </tr>
				  <tr>
				    <td><span style="font-size:17px;
				    line-height: 25px;
				    padding-bottom: 6px; text-align:justify; margin:10px 0px;"><a href="mailto:docs@loanagainstcard.com" style="text-decoration:blink;">docs@loanagainstcard.com</a></span></td>
				  </tr>
				  <tr>
				    <td><span style="font-size:17px;
				    line-height: 25px;
				    padding-bottom: 6px; text-align:justify; margin:10px 0px;"><a href="https://loanagainstcard.com/" target="_blank" style="text-decoration:blink;">www.loanagainstcard.com</a></span></td>
				  </tr>
				  <tr>
				    <td align="left">&nbsp;</td>
				  </tr>
				</table>
				</body>
				</html>
                ';
                
                $config['protocol']    = 'ssmtp';
                $config['smtp_host']    = 'ssl://ssmtp.gmail.com';
                $config['smtp_port']    = '465';
                $config['smtp_timeout'] = '7';
                $config['smtp_user']    = 'info@loanwalle.com';
                // $config['smtp_pass']    = 'password';
                $config['charset']    = 'utf-8';
                $config['newline']    = "\r\n";
                $config['mailtype'] = 'html'; // or html
                $config['validation'] = TRUE; // bool whether to validate email or not 
                
                $this->load->library('email');
                $this->email->initialize($config);
                // $this->email->set_newline("\r\n");
                $this->email->from('info@loanwalle.com');
                $this->email->to($sendData['email_to']); 
                $this->email->bcc("vipin@loanwalle.com, vinaykumarfd@gmail.com, darpanverma72@gmail.com");
                $this->email->subject('NOC Letter');
                $this->email->message($sendData['message']);
                $this->email->send();
		    
    	}
	}

?>