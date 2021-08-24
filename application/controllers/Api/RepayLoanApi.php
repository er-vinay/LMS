<?php
	defined('BASEPATH') OR exit('No direct script access allowed');

	require APPPATH . 'libraries/REST_Controller.php';
	class RepayLoanApi extends REST_Controller
	{
		public function __construct()
		{
			parent::__construct();
		}

		public function index_get($pancard = "")
		{
			if(!empty($pancard)){
            	$data = $this->db->get_where("leads", ['pancard' => $pancard])->row_array();
	        } else {
	            $data = $this->db->get("leads")->result();
	        }
	     
	        $this->response($data, REST_Controller::HTTP_OK);
		}
		
		public function getDataByPancard_post()
		{	
	        if($_SERVER['REQUEST_METHOD'] == 'POST')
            {
                $this->form_validation->set_rules("pancard", "Pancard", "trim|required|min_length[10]|max_length[10]|regex_match[/[a-zA-z]{5}\d{4}[a-zA-Z]{1}/]");
                if($this->form_validation->run() == FALSE)
                {
        	        $this->response(validation_errors(), REST_Controller::HTTP_INTERNAL_SERVER_ERROR);
                }
                else
                {
        	        $pancard = $this->input->post('pancard');
        	        
                    $query = $this->db->select('loan.*, credit.mobile, credit.email, credit.pancard, leads.status')
                        ->where('leads.pancard', $pancard)
                        ->where('leads.loan_approved', 3)
                        ->from("leads")
                        ->join('tb_states', 'leads.state_id = tb_states.id')
                        ->join('credit', 'leads.lead_id = credit.lead_id')
                        ->join('loan', 'leads.lead_id = loan.lead_id');
        			$effected_rows = $query->get()->result();
        			if($effected_rows > 0)
        			{
    	    	        $result = json_encode($effected_rows);
            	        $this->response($result, REST_Controller::HTTP_OK);
        			} else {
    	                $this->response(['No Record found.'], REST_Controller::HTTP_INTERNAL_SERVER_ERROR);
        			}
                }
            } else {
    	        $this->response(['Request Method Post Failed.'], REST_Controller::HTTP_INTERNAL_SERVER_ERROR);
            }
		}
	    
	    public function getProductDetails_post()
	    {
	       // echo "<pre>"; print_r($_POST); exit;
	        if($_SERVER['REQUEST_METHOD'] == 'POST')
            {
                $this->form_validation->set_rules("lead_id", "Lead Id", "trim|required");
                if($this->form_validation->run() == FALSE)
                {
        	        $this->response(validation_errors(), REST_Controller::HTTP_INTERNAL_SERVER_ERROR);
                }
                else
                {
        	        $lead_id = $this->input->post('lead_id');
        	        $getProductDetails = $this->db->query("SELECT L.branch, L.lead_id, L.loan_no, L.lan, L.customer_name, L.email, C.mobile, C.pancard, 
        	                    L.loan_amount, L.loan_intrest, L.loan_disburse_date, L.loan_repay_date, LL.status 
        	                    FROM loan L 
        	                    INNER JOIN credit C ON L.lead_id=C.lead_id 
        	                    INNER JOIN leads LL ON L.lead_id=LL.lead_id 
        	                        AND LL.status IN('Disbursed', 'Part Payment') 
        	                        AND C.status LIKE'%Sanction%' 
        	                        AND L.loan_status LIKE'%Disbursed%' 
        	                        AND L.lead_id=".$lead_id);
                    
        	        $data['itemInfo'] = $getProductDetails->result();
        		    $data['lead_id'] = $lead_id;
        
        		    $sql = $this->db->query("SELECT IFNULL(SUM(`payment_amount`), 0) as payment_amount FROM recovery WHERE status NOT IN ('Bouncing Charges') AND lead_id = ".$lead_id);
        
        			$query = $this->db->query("SELECT IFNULL(SUM(`payment_amount`), 0) as bouncing_charge FROM recovery WHERE status  IN ('Bouncing Charges') AND lead_id = ".$lead_id);
        
        			$data['payment_amount'] = $sql->result();
        			$data['bouncing_charge'] = $query->result();
        	        $data['currency_code'] = 'INR';
        	        
	    	      //  $result = json_encode($data);
	    	        $result = $data;
        	        $this->response($result, REST_Controller::HTTP_OK);
                }
            } else {
    	        $this->response(['Request Method Post Failed.'], REST_Controller::HTTP_INTERNAL_SERVER_ERROR);
            }
	    }
	    
	   // public function index_put($id)
	   // {
	   //     $input = $this->put();
	   //     $this->db->update('leads', $input, array('id'=>$id));
	     
	   //     $this->response(['Item updated successfully.'], REST_Controller::HTTP_OK);
	   // }
	     
	   // public function index_delete($id)
	   // {
	   //     $this->db->delete('leads', array('id'=>$id));
	       
	   //     $this->response(['Item deleted successfully.'], REST_Controller::HTTP_OK);
	   // }

	}

?>