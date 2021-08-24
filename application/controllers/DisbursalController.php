<?php
	defined('BASEPATH') OR exit('No direct script access allowed');
	class DisbursalController extends CI_Controller
	{
		public function __construct()
		{
			parent::__construct();
            $this->load->model('Task_Model');
            $this->load->model('Disburse_Model', 'DM');
            $this->load->model('Product_Model', 'PM');
            $this->load->model('CAM_Model', 'CAM');
            $this->load->model('Emails_Model');

	    	$login = new IsLogin();
	    	$login->index();
		}
        
        public function generateLoanNo()
        {
        	$company_id = $_SESSION['isUserSession']['company_id'];
        	$fetchProductData = 'product_code, product_name';

        	$selectProduct = $this->PM->select($company_id, $fetchProductData);
        	$product = $selectProduct->row();
        	$PDCode = $product->product_code;

        	$fetchDisburseData = 'loan_no';
        	$disbursalDetails = $this->DM->selectDisbursalDetails($fetchDisburseData);
        	$Disbursal = $disbursalDetails->row();
        	$lastLoanNO = $Disbursal->loan_no;

        	$CITYCode = "MUM";
        	// $lastLoanNO = 'NFPDMUM0009';
        	$number = preg_replace("/[a-zA-Z]/", '', $lastLoanNO); // only 0-9
        	$number1 = preg_replace("/[a-zA-Z0]/", '', $lastLoanNO); // only 1-9
        	$number2 = preg_replace("/[a-zA-Z1-9]/", '', $lastLoanNO); // only 0000
        	

	        $counting = ++$number;
	        $numOfZeros = 0;
	        if(strlen($lastLoanNO) > 4){
	        	for($i = 0; $i < (strlen($number2) - 1); $i++){
	        		$numOfZeros .= "0";
	        	}
	        }else{
	        	$numOfZeros = $number2;
	        }

	        echo $loanNo = "NF". $PDCode ."". $CITYCode ."". $numOfZeros ."". $counting; // NFPDMUM00000003;
        }
		
		public function getCustomerBankDetails()
		{  
		  //  echo "test test"; exit;
			if(!isset($_REQUEST['searchTerm'])){ 
		        $json = [];
		    }else{
		        $search = $_REQUEST['searchTerm'];
		        $sql = "SELECT bank.bank_id, bank.bank_ifsc FROM tbl_bank_details as bank
		                WHERE bank_ifsc LIKE '%".$search."%' LIMIT 10"; 
		        $result = $this->db->query($sql);
		        $bankData = $result->result_array(); 
				foreach($bankData as $row){
		            $json[] = ['bank_id'=>$row['bank_id'], 'bank_ifsc'=>$row['bank_ifsc']];
		        } 
		    }
		    echo json_encode($json);
		}

		public function getBankNameByIfscCode()
		{
			if(!empty($this->input->post('ifsc_code')))
			{ 
		        $ifsc_code = $this->input->post('ifsc_code');
		        $result = $this->db->select('bank.bank_name, bank.bank_branch')->where('bank_ifsc', $ifsc_code)->from('tbl_bank_details as bank')->get()->row();
		    	echo json_encode($result);
		    }
		}
		
		public function loanAgreementLetterResponse($lead_id, $response)
		{
        	$data = [
                "loanAgreementResponse" 	=>$response,
                "agrementUserIP" 			=>ip,
                "agrementResponseDate" 		=>updated_at,
        	];
        	$result = $this->db->where('tbl_disburse.lead_id', $lead_id)->update('tbl_disburse', $data);
        	if($result == 1){
        	    echo '<p style="text-align : center;"><img src="https://www.loanwalle.com/public/front/images/thumb.PNG" style=" width: 400px; height: 300px;" alt=""></p>
        	        <p style="text-align : center;">Thanks For Your Response.</p>
        	    ';
        	}
		}

		public function updateDisbursalData()
		{ 
			if ($this->input->server('REQUEST_METHOD') == 'POST') 
	        {
	        	$this->form_validation->set_rules('company_id', 'Session Expired', 'required|trim');
	        	$this->form_validation->set_rules('product_id', 'Session Expired', 'required|trim');
	        	$this->form_validation->set_rules('user_id', 'Session Expired', 'required|trim');
	        	$this->form_validation->set_rules('payableAccount', 'Payable Account', 'required|trim');
	        	$this->form_validation->set_rules('channel', 'Channel', 'required|trim');
	        	$this->form_validation->set_rules('payable_amount', 'Payable Amount', 'required|trim');
	        	if($this->form_validation->run() == FALSE) {
	        		$json['err'] = validation_errors();
	        		echo json_encode($json);
	        	}
	        	else
	        	{
	        	    $status = 'DISBURSE';
	        		$lead_id = $this->input->post('lead_id');
	        		$data = [
	        			'company_id' 			=> $this->input->post('company_id'),
	        			'company_account_no' 	=> $this->input->post('payableAccount'),
	        			'channel' 				=> $this->input->post('channel'),
	        			'payable_amount' 		=> $this->input->post('payable_amount'),
	        			'status' 				=> $status,
	        			'updated_by' 			=> $this->input->post('user_id'),
	        			'updated_on' 			=> updated_at,
	        		];
	        		
	        		$result = $this->DM->updateDisburse($lead_id, $data);
	        		if($result == 1){
		        		$json['msg'] = 'Disbursed Successfully.';
		        	}else{
		        		$json['err'] = 'Disbursed Failed. try again';
		        	}
	        		echo json_encode($json);
	        	}
	        }
		}

		public function PayAmountToCustomer($lead_id)
		{
			if(!empty($lead_id)) {
				$data = array(
	          		'status' 		=>"DISBURSED",
	          	);
	    		$result = $this->db->where('lead_id', $lead_id)->update('leads', $data);
	    		$json = "Paid Successfully";
	    		echo json_encode($json);
	    	}
		}

        public function UpdateDisburseReferenceNo()
		{
			if(isset($_FILES["file"]["name"]))  
			{
            	$config['upload_path'] = realpath(FCPATH.'upload');
                $config['allowed_types'] = 'jpg|png|jpeg';  
				$this->upload->initialize($config);
				if(!$this->upload->do_upload('file'))
				{
					$json['err'] = $this->upload->display_errors(); 
		        	echo json_encode($json);
				}
				else
				{
					$data = array('upload_data' => $this->upload->data());
        			$lead_id = $this->input->post('lead_id');
        			$company_id = $this->input->post('company_id');
        			$product_id = $this->input->post('product_id');
        			$user_id = $this->input->post('user_id');
        			$loan_reference_no = $this->input->post('loan_reference_no');
					$image = $data['upload_data']['file_name'];

	                $status = "DISBURSED";

		            $data = array (
		              //  'loan_no'       		=> $loan_no,
		                'disburse_refrence_no' 	=> $loan_reference_no,
		                'screenshot'        	=> $image,
		                'status'        	    => $status,
		                'updated_by'        	=> $user_id,
		                'updated_on'    		=> updated_at
		            );
	        		
					$result1 = $this->Task_Model->updateLeads($lead_id, ['status' => $status]);
    			    $result2 = $this->CAM->updateCAM($lead_id, ['status' => $status]);
	        		$result3 = $this->DM->updateDisburse($lead_id, $data);
	        		
	        		
	        		if($result1 == 1 && $result2 == 1 && $result3 == 1){
		        		$json['msg'] = 'Loan Disbursed Successfully.';
		        	}else{
		        		$json['err'] = 'Failed to update Reference no, try again';
		        	}
		        	echo json_encode($json);
				}   
	        }
		}
        
        public function getAgreementFile($lead_id)
        {
            if(!empty($lead_id))
            {
                $fetchDisburse = 'D.customer_name, D.status, D.loanAgreementLetter';
    			$queryDisburse = $this->Task_Model->getAgreementDetails($lead_id, $fetchDisburse);
    			$data = $queryDisburse->row();
                return $data;
            }
        }
        
        public function viewAgreementLetter($lead_id)
        {
            $data = $this->getAgreementFile($lead_id);
            echo $data->loanAgreementLetter;
        }
        
        public function addBankDetails()
        {
            $this->load->view('Disbursal/addBankDetails');
        }
        
		
	}

?>