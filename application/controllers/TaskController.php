<?php
	defined('BASEPATH') OR exit('No direct script access allowed');
	class TaskController extends CI_Controller
	{
		public function __construct()
		{
			parent::__construct();
            $this->load->model('Task_Model', 'Tasks');
            $this->load->model('Admin_Model', 'Admin');
            $this->load->model('Status_Model', 'Status');
            $this->load->model('CAM_Model', 'CAM');
            $this->load->model('Docs_Model', 'Docs');
            $this->load->model('Users/Email_Model', 'Email');
            $this->load->model('Users/SMS_Model', 'SMS');
	        $this->load->library('encrypt');

            date_default_timezone_set('Asia/Kolkata');
            $timestamp = date("Y-m-d H:i:s");
            
	    	$login = new IsLogin();
	    	$login->index();
		}

		// public function index()
	 //    {
	 //    	$data['leadDetails'] = $this->Tasks->getLeadDetails(); 
	 //    	$user = $this->Admin->getUser(user_id);
	 //    	$data['user'] = $user->row();
	 //    	$data['title'] = "Applications New";
  //       	$this->load->view('Screener/applicationNew', $data);
	 //    }
	    
	    public function index($stage)
	    {
			$conditions = "company_id='". company_id ."' AND product_id='". product_id ."' AND stage='". $stage ."'";
	        $data['leadDetails'] = $this->Tasks->index($conditions); 
	    	$user = $this->Admin->getUser(user_id);
	    	$data['user'] = $user->row();
        	$this->load->view('Tasks/GetLeadTaskList', $data);
	    }
	    
	  //   public function screeninLeads()
	  //   {
	  //       // $data['leadDetails'] = $this->Tasks->getleadsforSanction();
			// $conditions = "company_id='". company_id ."' AND product_id='". product_id ."' AND stage='S1'";
	  //       $data['leadDetails'] = $this->Tasks->index($conditions); 
	  //   	$user = $this->Admin->getUser(user_id);
	  //   	$data['user'] = $user->row();
   //      	$this->load->view('Tasks/GetLeadTaskList', $data);
	  //   }
	    
	    public function applicationinprocess()
	    {
	    	$data['leadDetails'] = $this->Tasks->applicationinprocess(); 
	    	$user = $this->Admin->getUser(user_id);
	    	$data['user'] = $user->row();
        	$this->load->view('Screener/applicationInProcess', $data);
	    }
	    
	     public function applicationHold()
	    {
	        $data['title'] = "Applications Hold";
	    	$data['leadDetails'] = $this->Tasks->applicationHold(); 
	    	$user = $this->Admin->getUser(user_id);
	    	$data['user'] = $user->row();
	    	
        	$this->load->view('Screener/applicationHold', $data);
	    }

		public function getCity($state_id)
	    {
	    	$cityArr = $this->Tasks->getCity($state_id);
	    	$json['city'] = $cityArr->result();
        	echo json_encode($json);
	    }
	    
	    public function inProcess($stage)
	    {
			$conditions = "company_id='". company_id ."' AND product_id='". product_id ."' AND stage='". $stage ."'";
	        $data['leadDetails'] = $this->Tasks->index($conditions); 
	    	$user = $this->Admin->getUser(user_id);
	    	$data['user'] = $user->row();
        	$this->load->view('Tasks/GetLeadTaskList', $data);
	    }
	    
	    public function leadRecommend()
	    {
	    	$data['recommend'] = $this->Tasks->recommend();
	    	$user = $this->Admin->getUser(user_id);
	    	$data['user'] = $user->row();
        	$this->load->view('Tasks/recommend', $data);
	    }
	    
	    public function leadSendBack()
	    {
	    	$data['sendBack'] = $this->Tasks->leadSendBack();
	    	$user = $this->Admin->getUser(user_id);
	    	$data['user'] = $user->row();
        	$this->load->view('Tasks/leadSendBack', $data);
	    }
	    
	    public function leadSanctioned()
	    {
	    	$data['leadSanctioned'] = $this->Tasks->leadSanctioned();
	    	$user = $this->Admin->getUser(user_id);
	    	$data['user'] = $user->row();
        	$this->load->view('Tasks/leadSanctioned', $data);
	    }
	    
	    public function leadDisbursed()
	    {
	    	$data['leadDisbursed'] = $this->Tasks->leadDisbursed();
	    	$user = $this->Admin->getUser(user_id);
	    	$data['user'] = $user->row();
        	$this->load->view('Tasks/leadDisbursed', $data);
	    }
	    
	    public function getLeadDisbursed1()
	    {
	        $limit = $this->input->post('limit');
	        $start = $this->input->post('start');
	    	$data = $this->Tasks->leadDisbursed1($limit, $start);
            $output = '
                <table class="table dt-tables table-striped table-bordered table-responsive table-hover" style="border: 1px solid #dde2eb">
                    <thead>
                        <tr>
                            <th><b>Sr. No</b></th>
                            <th><b>Action</b></th>
                            <th><b>Application No</b></th>
                            <th><b>Borrower</b></th>
                            <th><b>State</b></th>
                            <th><b>City</b></th>
                            <th><b>Mobile</b></th>
                            <th><b>Email</b></th>
                            <th><b>PAN</b></th>
                            <th><b>Source</b></th>
                            <th><b>Status</b></th>
                            <th><b>Initiated On</b></th>
                        </tr>
                    </thead>
                    <tbody>
            ';
	    	if($data->num_rows() > 0)
            {
                $i = $start++;
                foreach($data->result() as $row)
                {
                    $output .= '
                    <div class="post_data">
                            <tr class="table-default">
                                <td>'. $start++ .'</td>
                                <td>
                                    <a href="#" onclick="viewLeadsDetails('. $row->lead_id .')" id="viewLeadsDetails" data-toggle="modal" data-target="#myModal"><i class="fa fa-pencil-square-o" title="View Costomer Details"></i></a>
                                </td>
                                <td></td>
                                <td>'. strtoupper($row->name ." ". $row->middle_name ." ". $row->sur_name) .'</td>
                                <td>'. strtoupper($row->state) .'</td>
                                <td>'. strtoupper($row->city) .'</td>
                                <td>'. $row->mobile .'</td>
                                <td>'. $row->email .'</td>
                                <td>'. strtoupper($row->pancard) .'</td>
                                <td>'. $row->source .'</td>
                                <td>'. strtoupper($row->status) .'</td>
                                <td>'. date('d-m-Y', strtotime($row->created_on)) .'</td>
                            </tr>
                    </div>
                    ';
                }
                $output .= '</tbody></table>';
            }
            echo $output;
	    }
	    
	    public function agentToDoTask()
	    {
	        $this->db->select('leads.lead_id, leads.name, leads.email, tb_states.state, leads.created_on, leads.source, leads.status, leads.credit_manager_id, leads.partPayment')
				// ->where('date(leads.created_on) BETWEEN "'. date('Y-m-d', strtotime("2020-12-25")). '" and "'. date('Y-m-d', strtotime(todayDate)).'"')
                ->where('leads.utm_source', "LoanAgainstCard")
                ->where('leads.leads_duplicate', 0)
                ->where('leads.lead_rejected', 0)
                ->where('leads.loan_approved',0)
                ->where('leads.lead_status !=', "Hold")
                ->from('leads')
                ->join('tb_states', 'leads.state_id = tb_states.id');
            $query = $this->db->order_by('leads.lead_id', 'desc')->get();
			$data['taskCount'] = $query->num_rows();
			$data['listTask'] = $query->result(); 
        	$this->load->view('Tasks/GetLeadTaskList', $data);
	    }
	    
	    public function sanctionHold()
	    { 
	       	$query = $this->Tasks->sanctionHold();
	        $data['sanctionHold'] = $query->result();   
	        $data['taskCount'] = $query->num_rows();
	        $user = $this->Admin->getUser($_SESSION['isUserSession']['user_id']);
	    	$data['user'] = $user->row();
        	$this->load->view('Tasks/sanctionHold', $data); 
	    }

		public function rejectApproval()
	    {
            $this->db->select('leads.lead_id, leads.name, leads.email, tb_states.state, leads.created_on, leads.source, leads.status, leads.credit_manager_id, leads.partPayment')
                ->where('date(leads.created_on) BETWEEN "'. date('Y-m-d', strtotime("2020-12-06")). '" and "'. date('Y-m-d', strtotime(todayDate)).'"')
                // ->where('date(leads.created_on)', todayDate)
                ->where('leads.loan_approved', 2)
                ->from(tableLeads)
                ->join('tb_states', 'leads.state_id = tb_states.id');
            $query = $this->db->order_by('leads.lead_id', 'desc')->get();
			$data['taskCount'] = $query->num_rows();
			$data['listTask'] = $query->result();
            
        	$this->load->view('Tasks/GetLeadTaskList', $data);
	    }

		public function getLeadDetails($lead_id)
	    {
    		$lead_id = $this->encrypt->decode($lead_id);
	        $conditions = ['LD.company_id' => company_id, 'LD.product_id' => product_id, 'LD.lead_id' => $lead_id];
            $select = 'LD.lead_id, LD.customer_id, LD.application_no, LD.state_id, LD.gender, LD.city, LD.name, LD.middle_name, LD.sur_name, LD.email, LD.alternateEmailAddress, LD.mobile, LD.alternateMobileNo, LD.addressLine1, LD.area, LD.landmark, LD.purpose, LD.type, LD.user_type, LD.pancard, LD.monthly_income, LD.loan_amount, LD.tenure, LD.interest, LD.cibil, LD.source, LD.dob, LD.gender, LD.city, ST.state, LD.pincode, LD.status, LD.schedule_time, LD.created_on, LD.coordinates, LD.salary_mode, LD.credit_manager_id, LD.partPayment, LD.loan_approved, LD.is_Disbursed, LD.employeeDetailsAdded, LD.ip, LD.check_cibil_status, LD.term_and_condition, LD.terms_and_condition_2';
	        $leadData = $this->Tasks->join_table($conditions, $select);
	        $sql = $leadData->row();


			// $data['leadDetails'] = [
			// 	'name' 				=> strtoupper($sql->name),
			// 	'middle_name' 		=> strtoupper($sql->middle_name),
			// 	'sur_name' 			=> strtoupper($sql->sur_name),
			// 	'gender' 			=> strtoupper($sql->gender),
			// 	'dob' 				=> date('d-m-Y', strtotime($sql->dob)),
			// 	'pancard' 			=> strtoupper($sql->pancard),
			// 	'mobile' 			=> $sql->mobile,
			// 	'alternateMobileNo' => $sql->alternateMobileNo,
			// 	'email' 			=> $sql->email,
			// 	'loan_amount' 		=> number_format($sql->loan_amount, 2),
			// 	'state' 			=> strtoupper($sql->state),
			// 	'city' 				=> strtoupper($sql->city),
			// 	'pincode' 			=> $sql->pincode,
			// 	'created_on' 		=> date('d-m-Y h:i:s', strtotime($sql->created_on)),
			// 	'source' 			=> $sql->source,
			// 	'coordinates' 		=> $sql->coordinates,
			// 	'ip' 				=> $sql->ip,
			// ];

            $data['leadDetails'] = $sql;
            // echo "<pre>"; print_r($sql); exit;
            // $data['tbl_cibil'] = $cibilRecord; 
            // $data['creditCount'] = $creditDetails->num_rows();
            // $data['loanStatus'] = $loan_status;
            // $data['leadStatus'] = $leadStatus;
            // $data['recovery'] = $rec;
            // echo 'else called : <pre>'; print_r($data); exit;
    		// echo json_encode($data);
    		// echo "<pre>"; print_r($data['leadDetails']);exit;
    		$this->load->view('Tasks/task_js.php', $data);
	    }

	    public function getLWHistory($pancard)
	    {
            $db_LW = $this->load->database('LWDatabase', TRUE);
            // $pancard = "avxpm1125g";

			$query = $db_LW->query('SELECT L.*, LL.name, LL.state_id, LL.city, LL.source, C.mobile, C.email, C.pancard, LL.status from loan L 
						INNER JOIN credit C ON L.lead_id=C.lead_id 
						INNER JOIN leads LL ON L.lead_id=LL.lead_id 
							AND L.loan_status LIKE"%DISBURSED%" 
							AND C.status LIKE"%Approved%" 
							AND LL.status IN("DISBURSED", "CLOSED", "Part Payment", "Settelment") 
							AND C.pancard LIKE"%'.$pancard.'%" 
							ORDER BY L.loan_id DESC');
            
		    return $query; 
	    }
	    
	    public function getFTCHistory($pancard)
	    {
            $db_FTC = $this->load->database('FTCDatabase', TRUE);  
		    $db_FTC->select('leads.lead_id, c.residential_no, leads.name, leads.email, leads.mobile, leads.pancard, tb_states.state, leads.city, leads.created_on, leads.source, 
		    leads.status, leads.credit_manager_id, leads.partPayment, loan.loan_amount, loan.loan_no, loan.loan_tenure, loan.loan_intrest, loan.loan_repay_amount,
		    loan.loan_repay_date, loan.loan_disburse_date, loan.loan_admin_fee, loan.updated_on')
                ->where('leads.pancard', $pancard)
                ->where('leads.loan_approved', 3)
                ->from('leads')
                ->join('tb_states', 'leads.state_id = tb_states.id')
                ->join('loan', 'leads.lead_id = loan.lead_id')
                ->join('credit as c', 'c.lead_id = loan.lead_id'); 
            $ftcResult = $db_FTC->get(); 
		    return $ftcResult; 
	    }


		public function viewOldHistory($lead_id)
	    {
		    $row = $this->Tasks->select('lead_id='. $lead_id, 'pancard');
		    $row = $row->row();
	    	// $LWRecords = $this->getLWHistory($pancard);
	    	// $ftcRecords = $this->getFTCHistory($pancard);

      		$i = 1; 
      		$fetch = 'LD.lead_id, LD.application_no, LD.name, LD.email, LD.mobile, LD.aadhar, LD.pancard, ST.state, LD.city, LD.created_on, LD.source, LD.status, LD.credit_manager_id, LD.partPayment';
      		$conditions = 'LD.pancard = "'.$row->pancard.'" AND LD.stage="S10"';
      		$joinTable2 = 'tbl_disburse DS';
      		$joinTable3 = 'tbl_state ST';
		    $effected_rows = $this->Tasks->three_join_table($conditions, $fetch, $joinTable2, $joinTable3);

			$data = '<div class="table-responsive">
		        <table class="table table-hover table-striped table-bordered">
                  <thead>
                    <tr class="table-primary">
                        <th>Sr. No</th>
                        <th>Status</th>
						<th>Application No</th>
                        <th>Loan No</th>
                        <th>Borrower</th>
                        <th>PAN</th>
                        <th>Aadhar</th>
                        <th>Email</th>
                        <th>Mobile</th>
                        <th>State</th>
                        <th>City</th>
                        <th>Loan Amount</th>
                        <th>Open Date</th>
                        <th>Product</th>
                    </tr>
                  </thead>';
   //          if($LWRecords->num_rows() > 0)
   //          {
			// 	foreach($LWRecords->result() as $colum)
			// 	{
				   
			// 		if( $colum->source == 'LAC')
			// 		{
			// 			$source='LAC';
			// 		}else{
			// 			$source='PAYDAY';
			// 		}
			// 	    $bg = 'default';
			// 	    if($column->status == 'Closed' || $column->status == 'Settelment')
			// 	    {
			// 	        $optn = '<i class="fa fa-check-circle" style="font-size:24px;color:green"></i>';
			// 	        $status = 'CLOSED';
			// 	    }else{
			// 	        $optn = '<a href="'.base_url('repay-loan-details')."/".$column->lead_id.'" title="SHOW DETAILS"><i class="fa fa-eye btn btn-info"></i></a>';
			// 	        $status='ACTIVE';
			// 	    }
			// 	    $data .='<tbody>
   //              		<tr>
			// 				<td>'. $i .'</th>
   //                          <td>'. $status .'</td>
			// 				<td><a href="#">'. $colum->application_no .'</a></td>
   //                          <td><a href="#">'. $colum->loan_no .'</a></td>
			// 				<td>'. $colum->name .'</td>
   //                          <td>'. $colum->pancard .'</td>
   //                          <td>'. $colum->aadhar .'</td>
   //                          <td>'. $colum->email .'</td>
   //                          <td>'. $colum->mobile .'</td>
   //                          <td>'. $colum->state .'</td>
   //                          <td>'. $colum->city .'</td>
   //                          <td>'. $colum->loan_amount .'</td>
   //                          <td>'. $colum->loan_disburse_date .'</td> 
                           
   //                          <td>'. $source .'</td>
			// 			</tr>';
			// 		$i++;
			// 	}
				
			// 	//$data .='</tbody></table></div>';
			// }
            if($effected_rows->num_rows() > 0)
            {
				foreach($effected_rows->result() as $colum)
				{
				    if($colum->status == 'Full Payment' || $colum->status == 'Settelment')
				    {
				        $optn = '<i class="fa fa-check" style="font-size:24px;color:green"></i>';
				        $status = 'Full Payment';
				    }else{
				        // $optn = '<a href="'.base_url('oldUserHistory')."/".$colum->lead_id.'" title="SHOW DETAILS" target="_blank"><i class="fa fa-eye btn btn-info"></i></a>';
				        $status='ACTIVE';
				    }
				    $data .='<tbody>
                		<tr>
							<td>'. $i .'</th>
                            <td>'. $status .'</td>
							<td><a href="#">'. $colum->application_no .'</a></td>
                            <td><a href="#">'. $colum->loan_no .'</a></td>
							<td>'. $colum->name.''.$colum->middle_name.''.$colum->sur_name .'</td>
                            <td>'. $colum->pancard .'</td>
                            <td>'. $colum->aadhar .'</td>
                            <td>'. $colum->email .'</td>
                            <td>'. $colum->mobile .'</td>
                            <td>'. $colum->state .'</td>
                            <td>'. $colum->city .'</td>
                            <td>'. $colum->loan_amount .'</td>
                            <td>'. $colum->loan_disburse_date .'</td> 
                           
                            <td>'. $source .'</td>
						</tr>';
					$i++;
				}
				
				//$data .='</tbody></table></div>';
			}
			
			// if($ftcRecords->num_rows() > 0)
   //          {
			// 	foreach($ftcRecords->result() as $colum)
			// 	{
			// 	    if($colum->status == 'Full Payment' || $colum->status == 'Settelment')
			// 	    {
			// 	        $optn = '<i class="fa fa-check" style="font-size:24px;color:green"></i>';
			// 	        $status = 'Full Payment';
			// 	    }else{
			// 	        // $optn = '<a href="'.base_url('oldUserHistory')."/".$colum->lead_id.'" title="SHOW DETAILS" target="_blank"><i class="fa fa-eye btn btn-info"></i></a>';
			// 	        $status='ACTIVE';
			// 	    }
			// 	    $data .='<tbody>
   //              		<tr>
			// 				<td>'. $i .'</th>
   //                          <td>'. $status .'</td>
			// 				<td><a href="#">'. $colum->application_no .'</a></td>
   //                          <td><a href="#">'. $colum->loan_no .'</a></td>
			// 				<td>'. $colum->name.''.$colum->middle_name.''.$colum->sur_name .'</td>
   //                          <td>'. $colum->pancard .'</td>
   //                          <td>'. $colum->residential_no .'</td>
   //                          <td>'. $colum->email .'</td>
   //                          <td>'. $colum->mobile .'</td>
   //                          <td>'. $colum->state .'</td>
   //                          <td>'. $colum->city .'</td>
   //                          <td>'. $colum->loan_amount .'</td>
   //                          <td>'. $colum->loan_disburse_date .'</td> 
                            
   //                          <td>'. $source .'</td>
			// 			</tr>';
			// 		$i++;
			// 	}
				
			// 	$data .='</tbody></table></div>';
			// }
			// if($effected_rows || $LWRecords->num_rows() == 0){

			// }else{
		    	$data .='<tbody><tr><td colspan="16" style="text-align: -webkit-center;color:red;">Record Not Found...</td></tr></tbody></table></div>';
			// }
			echo json_encode($data);
	    }

		public function oldUserHistory($lead_id)
		{
		    $sql = $this->db->select('pancard, mobile')->where('lead_id', $lead_id)->from('leads')->get();
		    $result = $sql->row();
		    $pancard = $result->pancard;
		    if(empty($pancard)) {
		        $result = $sql->result();
		        foreach($result as $row){
		            if(!empty($row->pancard)){
		                $pancard = $row->pancard;
		                break;
		            }
		        }
		    }
		    $this->db->select('leads.lead_id, leads.name, leads.email, leads.pancard, tb_states.state, leads.created_on, leads.source, leads.status, leads.credit_manager_id, leads.partPayment,
		            loan.loan_amount, loan.loan_tenure, loan.loan_intrest, loan.loan_repay_amount, loan.loan_repay_date, loan.loan_disburse_date, loan.loan_admin_fee')
                ->where('leads.pancard', $pancard)
                ->where('leads.loan_approved', 3)
                ->from(tableLeads)
                ->join('tb_states', 'leads.state_id = tb_states.id')
                ->join('loan', 'leads.lead_id = loan.lead_id');
            $query = $this->db->order_by('leads.lead_id', 'desc')->get();
			$data['taskCount'] = $query->num_rows();
			$data['listTask'] = $query->result();
			
			$data = '<div class="table-responsive">
		        <table class="table table-hover table-striped">
                  <thead>
                    <tr class="table-primary">
                      <th><b>Sr. No</b></th>
                        <th><b>Action</b></th>
                        <th><b>Borrower Name</b></th>
                        <th><b>Email</b></th>
                        <th><b>Pancard</b></th>
                        <th><b>Loan Amount</b></th>
                        <th><b>Loan Tenure</b></th>
                        <th><b>Loan Interest</b></th>
                        <th><b>Loan Repay Amount</b></th>
                        <th><b>Loan Repay Date</b></th>
                        <th><b>Loan Disbursed Date</b></th>
                        <th><b>Loan Admin Fee</b></th>
                        <th><b>Center</b></th>
                        <th><b>Initiated On</b></th>
                        <th><b>Lead Source</b></th>
                        <th><b>Lead Status</b></th>
                    </tr>
                  </thead>';
            if($effected_rows)
            {
          		$i = 1;
				foreach($effected_rows as $column)
				{
				    if($column->status == 'Full Payment' || $column->status == 'Settelment')
				    {
				        $optn = '<i class="fa fa-check" style="font-size:24px;color:green"></i>';
				        $status = 'Full Payment';
				    }else{
				        $status='ACTIVE';
				    }
				    $data .='<tbody>
                		<tr>
							<td>'. $i .'</th>
							<td>'. $optn .'</td>
							<td>'. $colum->name .'</td>
                            <td>'. $colum->email .'</td>
                            <td>'. $colum->pancard .'</td>
                            <td>'. $colum->loan_amount .'</td>
                            <td>'. $colum->loan_tenure .'</td>
                            <td>'. $colum->loan_intrest .'</td>
                            <td>'. $colum->loan_repay_amount .'</td>
                            <td>'. $colum->loan_repay_date .'</td>
                            <td>'. $colum->loan_disburse_date .'</td>
                            <td>'. $colum->loan_admin_fee .'</td>
                            <td>'. $colum->state .'</td>
                            <td>'. $colum->created_on .'</td>
                            <td>'. $colum->source .'</td>
						</tr>';
				}
				
				$data .='</tbody></table></div>';
			}else{
		    	$data .='<tbody><tr><td colspan="8" style="text-align: -webkit-center;color:red;">Record Not Found...</td></tr></tbody></table></div>';
			}
			echo json_encode($data);
			
			$this->load->view('Tasks/oldHistory', $data);
		}
		
		public function TaskList()
	    {
	    	$this->index();
	    }

		public function getDocsUsingAjax($lead_id)
	    {
	        $type = "";
	    	$docsDetails = $this->Tasks->getCustomerDocs($lead_id, $type);

			$data = '<div class="table-responsive">
		        <table class="table table-hover table-striped table-bordered" style="margin-top: 10px;">
                  <thead>
                    <tr class="table-primary">
                      <th scope="col"><b>#</b></th>
                      <th scope="col"><b>Document Type</b></th>
                      <th scope="col"><b>Document Name</b></th>
                      <th scope="col"><b>File Name</b></th>
                      <th scope="col"><b>Password</b></th>
                      <th scope="col"><b>Initiated On</b></th>
                      <th scope="col"><b>View</b></th>
                    </tr>
                </thead>';
	        if($docsDetails->num_rows() > 0)
			{
				// onclick="viewCustomerDocs('.$column->docs_id.')"
				$i = 1;
				foreach($docsDetails->result() as $column)
				{
			        $pwd = '-';
				    if($column->pwd){
				        $pwd = $column->pwd;
				    } 
				    $date = $column->created_on;
				    $newDate = date("d-m-Y", strtotime($date));
				    $data.='<tbody>
                		<tr>
							<td>'.$i++.'</td>
							<td>'.$column->docs.'</td>
							<td>'.$column->type.'</td>
							<td>'.$column->file.'</td>  
							<td>'.$pwd.'</td>   
							<td>'.$newDate.'</td>  
							<td> 
							 	<a onclick="viewCustomerDocs('.$column->docs_id.')"><i class="fa fa-eye" style="padding : 3px; color : #35b7c4; border : 1px solid #35b7c4;"></i></a>
							    <a onclick="deleteCustomerDocs('.$column->docs_id.')"><i class="fa fa-trash" style="padding : 3px; color : #35b7c4; border : 1px solid #35b7c4;"></i></a>
								<a href="'.base_url("upload/".$column->file).'" download><i class="fa fa-download" style="padding : 3px; color : #35b7c4; border : 1px solid #35b7c4;"></i></a>
							</td> 
						</tr>';
				}
				// 	<a onclick="editCustomerDocs('.$column->docs_id.')"><i class="fa fa-pencil" style="padding : 3px; color : #35b7c4; border : 1px solid #35b7c4;"></i></a>
				 	$data .='</tbody></table></div>';
			} else {
		    	$data .='<tbody><tr><td colspan="6" style="text-align: -webkit-center;color:red;">Record Not Found...</td></tr></tbody></table></div>';
	        }	
	        echo json_encode($data);
	    }
	    
	    public function deleteCustomerDocsById($docs_id)
	    { 
	        $docs_row = $this->db->select("*")->from("docs")->where("docs_id", $docs_id)->get()->row();
	        $lead_id = $docs_row->lead_id;
	        if(!empty($docs_id))
	    	{
		    	$query = $this->db->where("docs_id", $docs_id)->delete('docs');
		    	$response = ['result' => $query, "lead_id" =>$lead_id];
		    	echo json_encode($response); 
		    }
	    }
 
	    public function viewCustomerDocs($docs_id)
        {
            if(!empty($docs_id))
            {
                $query = $this->db->where("docs_id", $docs_id)->get('docs')->row_array();
                $img = $query['file'];
                $match_http = substr($img, 0, 4);
                if($match_http == "http")
                {
                    echo json_encode($img);
                }else{
                    echo json_encode(base_url().'upload/'.$img);
                }
            }
        }

	    public function viewCustomerDocsById($docs_id)
	    {
	    	if(!empty($docs_id))
	    	{
		    	$query = $this->db->select('*')->where("docs_id", $docs_id)->get('docs')->row_array();
		    	echo json_encode($query); 
		    }
	    }

	    public function viewCustomerPaidSlip($recovery_id)
	    {
	    	if(!empty($recovery_id))
	    	{
		    	$query = $this->db->where("recovery_id", $recovery_id)->get('recovery')->row_array();
		    	$img = $query['docs'];
		    	$match_http = substr($img, 0, 4);
		    	if($match_http == "http")
		    	{
		    		echo json_encode($img);
		    	}else{
		    		echo json_encode(base_url().'public/images/'.$img);
		    	}
		    }
	    }

	    public function downloadCustomerdocs($docs_id)
	    {
	    	if(!empty($docs_id))
	    	{
		    	$query = $this->db->where("docs_id", $docs_id)->get('docs')->row_array();
		    	$img = $query['file'];
		    	$match_http = substr($img, 0, 4);
		    	if($match_http == "http")
		    	{
		    		// echo json_encode($img);
	        		force_download($img, live.$img);
		    	}else{
		    		if(server == "localhost"){
		        		force_download($img, base_url().localhost.$img);
		        	}else{
		        		force_download($img, live.$img);
		        	}
		    	}
		    }
	    }

		public function sendRequestToCustomerForUploadDocs()
	    {
            $lead_id = $this->input->post('lead_id');
	    	if(isset($lead_id))
	    	{
	    		$leadDetails = $this->db->select("leads.name, leads.mobile")->where('lead_id', $lead_id)->get('leads')->row_array();
	    		$name = $leadDetails['name'];
	    		$mobile = $leadDetails['mobile'];

	        	$msg = "Dear ".ucfirst($name).",\nYour documentation process is incomplete.\nPlease click on the below link to upload the required documents.\n.https://www.loanwalle.com/re-upload-docs/\nThank you";

	    		$this->notification($mobile, $msg);
		        echo json_encode("true");
	    	}
	    }

	    public function notification($mobile, $msg)
		{
			$username = urlencode("namanfinl");
			$password = urlencode("6I1c0TdZ");
			$message = urlencode($msg);
			$destination = $mobile;
			// 	$destination = "8887877098";
			$source = "LOANPL";
			$type = "0";
			$dlr = "1";
			
			$data = "username=$username&password=$password&type=$type&dlr=$dlr&destination=$destination&source=$source&message=$message";
			$url = "http://sms6.rmlconnect.net/bulksms/bulksms";
			
			$ch = curl_init();
			curl_setopt_array($ch, array(
							CURLOPT_URL => $url,
							CURLOPT_RETURNTRANSFER => true,
							CURLOPT_POST => true,
							CURLOPT_POSTFIELDS => $data
							));
			$output = curl_exec($ch);
            //  echo "<pre>"; print_r($data); exit;

			curl_close($ch);
		} 

		public function saveCustomerDocs()
		{ 
			if(isset($_FILES['file_name']['name']))  
			{ 
            	$config['upload_path'] = 'upload/';
                $config['allowed_types'] = 'pdf|jpg|png|jpeg';  
				$this->upload->initialize($config);
				if(!$this->upload->do_upload('file_name'))
				{ 
					echo $this->upload->display_errors(); 
				}
				else
				{  
					$data = array('upload_data' => $this->upload->data());
        			$lead_id     = $this->input->post('lead_id');
        			$user_id     = $this->input->post('user_id');
        			$company_id  = $this->input->post('company_id'); 
        			$docs_id     = $this->input->post('docs_id');
					$docsType    = $this->input->post('docuemnt_type');
					$docsname    = $this->input->post('document_name');
					$password    = $this->input->post('password');
					$image       = $data['upload_data']['file_name'];  
                    if(empty($company_id)){
                        $company_id = $_SESSION['isUserSession']['company_id'];
                    }
                    if(empty($user_id)){
                        $user_id = $_SESSION['isUserSession']['user_id'];
                    }
            		if(empty($docs_id) && !empty($lead_id))
            		{
            		    $fetch = 'LD.pancard, LD.mobile';
            		    $getLeads = $this->Tasks->select($lead_id, $fetch);
            		    $lead = $getLeads->row();
    		            $data = array (
    		                'lead_id'       => $lead_id,
    		                'company_id'    => company_id,
    		                'product_id'    => product_id, 
    		                'pancard'       => $lead->pancard,
    		                'mobile'        => $lead->mobile,
    		                'docs'          => $docsType,
    		                'type'          => $docsname,
    		                'file'          => $image,
    		                'pwd'           => $password,
    		                'ip'            => ip,
    		                'upload_by'     => $user_id,
    		                'created_on'    => updated_at
    		            );
    		            $this->db->insert('docs', $data);
    		            echo "true";
            		}else{
    		            $data = array (
    		                'pwd'           => $password,
    		                'docs'          => $docsType,
    		                'type'          => $docsname,
    		                'file'          => $image,
    		                'ip'            => ip,
    		                'upload_by'     => 1,
    		                'created_on'    => updated_at
    		            );
    		            
                        $where = ['company_id' => company_id, 'product_id' => product_id];
    		            $this->db->where($where)->where('lead_id', $lead_id)->where('docs_id', $docs_id)->update('docs', $data);
    		            echo "true";
            		}
				}   
	        }
		}

        public function allocateLeads()
        { 
            if(isset($_POST["checkList"]) && !empty(user_id))  
			{
                foreach($_POST["checkList"] as $lead_id)
			    {
			    	$newStatus = $this->Status->getNewStatus($lead_id, 'new_status');
			    	$label = $_SESSION['isUserSession']['labels'];
                    if($label == 'CR1' || $label == 'CA' || $label == 'SA') {
			            $data = [
			            	'screener_id'		=> user_id, 
			            	'screenin_time'		=> created_at, 
			            	'status' 			=> 'LEAD-INPROCESS', 
			            	'stage' 			=> 'S2'
			            ];
			        }
                    else if($label == 'CR2' || $label == 'CA' || $label == 'SA') {
			            $data = [
			            	'credit_manager_id'		=> user_id, 
			            	'credit_manager_time'	=> created_at, 
			            	'status' 				=> 'APPLICATION-INPROCESS', 
			            	'stage' 				=> 'S5'
			            ];
                    }
                    $this->Tasks->update(['lead_id' => $lead_id], $data);
			    }
	            echo "true";  
			}else{
	            echo "false"; 
			}  
            
        }
        
        public function reallocate()
        {
            
         echo "<pre>"; print_r($_POST); exit;   
            
        }

		public function resonForDuplicateLeads()
		{
			if(isset($_POST["checkList"]))  
			{
			    foreach($_POST["checkList"] as $item)
			    {
        			$lead_id = $item;
                    $this->Tasks->update(['lead_id' => $lead_id], ['status' => 'DUPLICATE', 'stage' => 'S14']);
			    }
	            echo "true";
	        } else {
	        	echo "false";
	        }
		}
	    
		public function duplicateTaskList()
	    {
	        $taskLists = $this->Tasks->duplicateTask();
    		$data['taskCount'] = $taskLists->num_rows();
    		$data['listTask'] = $taskLists->result();
    		
	        $this->load->view('Tasks/DuplicateTaskList', $data);
	    }
	    
		public function duplicateLeadDetails($lead_id)
	    {
	        $taskLists = $this->Tasks->duplicateTaskList($lead_id);
	        echo json_encode($taskLists);
	    }
	    
	    public function holdleads()
	    { 
	        $where = ['company_id' => company_id, 'product_id' => product_id];
	        $lead_id        = $this->input->post('lead_id');
	        $hold_remark    = $this->input->post('hold_remark');
	        $data = [
	            'status'            => 'HOLD', 
	            'screener_remarks'  => $hold_remark, 
	            'screener_id'       => user_id,
	            'screener_status'   =>1
	        ];
            $this->db->where('lead_id', $lead_id)->update('leads', $data);    
	        $data['msg'] = 'Application Hold Successfuly.';
	        echo json_encode($data);
	    }

        public function sanctionleads()
        { 
            $lead_id = $this->input->post('lead_id');
            $this->db->where('lead_id', $lead_id)->update('leads', ['screener_status' =>2]);    
            $data['msg'] = 'Application forwarded for sanction.';
            echo json_encode($data);
        }

		public function reCreditLoan()
		{
			if(isset($_POST["lead_id"]))  
			{
				$lead_id = $this->input->post('lead_id');
	            $this->db->where('lead_id', $lead_id)->update('leads', ['loan_approved' => 2, 'credit_added'=>0]);
	            echo "true";
	        }
		}

		public function AddContactDetails($lead_id)
		{
			if ($this->input->server('REQUEST_METHOD') == 'POST') 
	        {
	        	$this->form_validation->set_rules('mobile', 'Mobile', 'required|trim');
	        	$this->form_validation->set_rules('alternateMobileNo', 'Alternate Mobile No', 'required|trim');
	        	$this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email');
	        	$this->form_validation->set_rules('alternateEmailAddress', 'Alternate Email Address', 'required|trim|valid_email');
	        	$this->form_validation->set_rules('gender', 'Gender', 'required|trim');
	        	$this->form_validation->set_rules('pancard', 'Pancard', 'required|trim|regex_match[/^([a-zA-Z]){5}([0-9]){4}([a-zA-Z]){1}?$/]');
	        	$this->form_validation->set_rules('addressLine1', 'Address Line1', 'required|trim');
	        	$this->form_validation->set_rules('area', 'Area', 'required|trim');
	        	$this->form_validation->set_rules('pincode', 'Pincode', 'required|trim');
	        	$this->form_validation->set_rules('landmark', 'Landmark', 'required|trim');

	        	if($this->form_validation->run() == FALSE) {
	        		$json['error'] = validation_errors();
		            echo json_encode($json);
	        	} else {
					$alternateMobileNo = $this->input->post('alternateMobileNo');
					$alternateEmailAddress = $this->input->post('alternateEmailAddress');
					$addressLine1 = $this->input->post('addressLine1');
					$area = $this->input->post('area');
					$landmark = $this->input->post('landmark');
					$mobile = $this->input->post('mobile');
					$email = $this->input->post('email');
					$gender = ucfirst($this->input->post('gender'));
					$pincode = $this->input->post('pincode');
					$pancard = $this->input->post('pancard');
					$dob     = $this->input->post('dob');

		            $data = array (
		                'pancard'       			=> $pancard,
		                'mobile'       				=> $mobile,
		                'alternateMobileNo'       	=> $alternateMobileNo,
		                'email'   					=> $email,
		                'alternateEmailAddress'   	=> $alternateEmailAddress,
		                'gender'   					=> $gender,
		                'pincode'   				=> $pincode,
		                'addressLine1'       		=> $addressLine1,
		                'area'       				=> $area,
		                'landmark'       			=> $landmark,
		                'dob'       		    	=> $dob,
		                'contactUpdatedBy'       	=> 1,
		            );

		            $this->db->where('lead_id', $lead_id)->update('leads', $data);
		            $result = "true";
		            echo json_encode($result);
		        }
	        }
		}

		public function saveCustomerEmployeeDetails($lead_id)
		{
			if ($this->input->server('REQUEST_METHOD') == 'POST') 
	        {
	        	$this->form_validation->set_rules('employeeType', 'Employee Type', 'required|trim');
	        	$this->form_validation->set_rules('dateOfJoining', 'Date Of Joining', 'required|trim');
	        	$this->form_validation->set_rules('designation', 'Designation', 'required|trim');
	        	$this->form_validation->set_rules('currentEmployer', 'Current Employer', 'required|trim');
	        	$this->form_validation->set_rules('companyAddress', 'Company Address', 'required|trim');
	        	$this->form_validation->set_rules('otherDetails', 'Other Details', 'required|trim');

	        	if($this->form_validation->run() == FALSE) {
	        		$json['error'] = validation_errors();
		            echo json_encode($json);
	        	} else {
		            $data = array (
						'lead_id'		 	 => $lead_id,
						'employeeType'		 => $this->input->post('employeeType'),
						'dateOfJoining'		 => $this->input->post('dateOfJoining'),
						'designation'		 => $this->input->post('designation'),
						'currentEmployer'	 => $this->input->post('currentEmployer'),
						'companyAddress'	 => $this->input->post('companyAddress'),
						'otherDetails'		 => $this->input->post('otherDetails'),
						'updated_by'		 => $_SESSION['isUserSession']['user_id'],
		            );
		            $result = $this->db->insert('tbl_customerEmployeeDetails', $data);
		            $this->db->where('lead_id', $lead_id)->update('leads', ['employeeDetailsAdded' => 1]);
		            echo json_encode($result);
		        }
	        }
		}

		public function ShowCustomerEmploymentDetails($lead_id)
		{
	    	if(!empty($lead_id))
	    	{
	    		$result = $this->Tasks->ShowCustomerEmploymentDetails($lead_id);
		        echo json_encode($result);
	    	}
		}

		public function RequestForApproveLoan()
		{
			if(isset($_POST["lead_id"]))  
			{
				$lead_id = $this->input->post('lead_id');
	            $query = $this->db->select('leads.contactUpdatedBy, leads.employeeDetailsAdded, leads.credit_added')
	            ->where('leads.created_on BETWEEN "'. date('Y-m-d', strtotime("2020-12-06")). '" and "'. date('Y-m-d', strtotime(todayDate)).'"')
	            
                //->where('date(leads.created_on)', todayDate)
	            ->where('lead_id', $lead_id)->get('leads')->row();
				$contactUpdatedBy = $query->contactUpdatedBy;
				$employeeDetailsAdded = $query->employeeDetailsAdded;
				$credit_added = $query->credit_added;
				// if($contactUpdatedBy == 0) {
				// 	$json["err"] = "Contact Details Required.";
				// } else if($employeeDetailsAdded == 0) {
				// 	$json["err"] = "Employee Details Required.";
				// } else if($credit_added == 0) {
				// 	$json["err"] = "Credit Details Required.";
				// } else {
					$data = [
							'loan_approved'     => 1,
							'status' 	 	    => "Credit",
							'credit_manager_id' 	 	=> $_SESSION['isUserSession']['user_id']
						];
		            $this->db->where('lead_id', $lead_id)->update('leads', $data);
					$json["msg"] = "Request Send to Head.";
				// }
			    echo json_encode($json);
	        }
		}

		public function taskRequestForApprove()
	    {
            $this->db->select('leads.lead_id, leads.name, leads.email, tb_states.state, leads.created_on, leads.source, leads.status, leads.credit_manager_id, leads.partPayment')
                ->where('leads.loan_approved', 1)
                ->from(tableLeads)
                ->join('tb_states', 'leads.state_id = tb_states.id');
            $query = $this->db->order_by('leads.lead_id', 'desc')->get();
			$data['taskCount'] = $query->num_rows();
			$data['listTask'] = $query->result();
            
        	$this->load->view('Tasks/taskRequestForApprove', $data);
	    }
	    
		public function ApproveSenctionLoan()
		{
			if(isset($_POST["lead_id"]))  
			{
				$lead_id = $this->input->post('lead_id');

				$this->db->select('leads.lead_id, leads.name, leads.email, leads.mobile, leads.source, leads.status, leads.credit_manager_id, leads.partPayment, credit.loan_amount_approved, credit.tenure, credit.roi, credit.repay_amount, credit.repayment_date, credit.updated_on, credit.processing_fee')
	               // ->where('leads.created_on BETWEEN "'. date('Y-m-d', strtotime("2020-12-01")). '" and "'. date('Y-m-d', strtotime("2020-12-03")).'"')
	                ->where('leads.lead_id', $lead_id)
	                ->from('leads')
	                ->join('credit', 'credit.lead_id = leads.lead_id')
	                ->join('tb_states', 'leads.state_id = tb_states.id');
	            $query = $this->db->get()->row();

				$name = $query->name;
				$mobile = $query->mobile;

				$msg = "Dear ".$name .",\nYour loan amount of \nRs. ".$query->loan_amount_approved."\nis sanctioned of ROI ".$query->roi."/ day \nIf you fail to pay \nRepay amount : ".$query->repay_amount." \non Repayment date : ".$query->repayment_date." \nthen the interest rate will be double of interest \nThanks & Regards \nLoanwalle";

	            $this->notification($mobile, $msg); 
                $loan_approved = 3;
                if($_SESSION['isUserSession']['role'] == "Client Admin"){
                	$loan_approved = 0;
                }
	            $data = array (
	            	'loan_approved' => $loan_approved, 
	            	'status' 		=> "Sanction", 
	            	'is_Disbursed' 	=> 1
	            );
	            $this->db->where('lead_id', $lead_id)->update('leads', $data);
	            $this->db->where('lead_id', $lead_id)->update('credit', ['is_Senctioned' => 3]);
	            echo "true";
	        }
		}

		public function getReasonList()
		{
			$data = $this->db->get('tbl_rejected_reson')->result();
			echo "<pre>"; print_r($data); exit;
		} 
		
		public function followUp()
	    { 
	        $lead_id = $this->input->post('lead_id');
	        $remark = $this->input->post('reson');
	        $data = array (
	            	'lead_status'   => "Hold", 
	            	'status' 		=> "Hold", 
	            	'remark' 		=> $remark, 
	            	'updated_on' 	=> date('Y-m-d H:i:s'),
	            );
	       if($this->db->where('lead_id', $lead_id)->update('leads', $data))
	       {
	          echo "true"; 
	       } 
	    }
		
		public function sanctionLetter($lead_id)
	    { 
	        $data = array (
	            	'lead_status'   => "Hold", 
	            	'status' 		=> "Hold", 
	            	'updated_on' 	=> date('Y-m-d H:i:s'),
	            );
            $this->db->where('lead_id', $lead_id)->update('leads', $data); 
            
            $this->db->select('leads.lead_id, leads.name, leads.email, leads.mobile, leads.loan_amount, leads.created_on, leads.updated_on') 
                    ->where('leads.lead_id', $lead_id)
                    ->from('leads');
            $query = $this->db->get()->row(); 
            $loan_amount = $query->loan_amount;
            $proccessingfee = ($loan_amount * 2 /100); 
	            
            $date = strtotime($query->updated_on);
            $new_date = date('d-m-Y', $date);
	            
		    $config['protocol']    = 'ssmtp';
            $config['smtp_host']    = 'loanagainstcard.com';
            $config['smtp_port']    = '465';
            $config['smtp_timeout'] = '7';
            $config['smtp_user']    = 'docs@loanagainstcard.com';
            $config['smtp_pass']    = 'R{vo&!f=RU]5';
            $config['charset']    	= 'utf-8';
            $config['newline']    	= "\r\n";
            $config['mailtype'] 	= 'html'; // or html
            $config['validation'] 	= TRUE; // bool whether to validate email 
            $config['newline'] 		= "\r\n";
            $config['newline'] 		= "\r\n";  
              
            $message = '<table width="668" border="0" align="center" cellpadding="0" cellspacing="0" style="padding:20px; border:solid 1px #ddd; font-family:Arial, Helvetica, sans-serif; font-size:14px; line-height:25px;">
                              <tr>
                                <td colspan="3" style="border-bottom:1px #ddd solid; padding-bottom:20px; line-height:0px;"><img src="'.base_url("public/mailer_image/").'logo.png" width="250" height="70" /></td>
                              </tr>
                              <tr>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                              </tr>
                              <tr>
                                <td width="365"><strong id="docs-internal-guid-d40fae2e-7fff-359a-3929-25076e5203fb">Dear Sir,</strong></td>
                                <td width="11">&nbsp;</td>
                                <td width="290" rowspan="2"><img src="'.base_url("public/mailer_image/").'sanction-images-mailer.jpg" width="279" height="205" style="border: solid 4px #e28b45;
                                border-radius: 5px;" /></td>
                              </tr>
                              <tr>
                                <td valign="top">Congratulations! Your loan has been successfully sanctioned. You are just one step away from the disbursal of your loan.<br />
                                  <br />
                                For a quick disbursal, go through the below-mentioned terms and conditions of the loan. Kindly accept the conditions and revert back with the required documents.</td>
                                <td valign="top">&nbsp;</td>
                              </tr>
                              <tr>
                                <td valign="top">&nbsp;</td>
                                <td valign="top">&nbsp;</td>
                                <td>&nbsp;</td>
                              </tr>
                              <tr>
                                <td colspan="3"><table width="100%" border="0" cellpadding="3" cellspacing="1" bgcolor="#dddddd">
                                  <tr>
                                    <td width="47%" bgcolor="#FFFFFF" style="padding:10px;"><strong>Name</strong></td>
                                    <td width="4%" align="center" valign="middle" bgcolor="#FFFFFF" style="padding:10px;"><strong>:</strong></td>
                                    <td width="49%" bgcolor="#FFFFFF" style="padding:10px;">'.$query->name.'</td>
                                  </tr>
                                  <tr>
                                    <td bgcolor="#FFFFFF" style="padding:10px;"><strong>Loan Amount</strong></td>
                                    <td align="center" valign="middle" bgcolor="#FFFFFF" style="padding:10px;"><strong>:</strong></td>
                                    <td bgcolor="#FFFFFF">'.$query->loan_amount.'</td>
                                  </tr>
                                  <tr>
                                    <td bgcolor="#FFFFFF" style="padding:10px;"><strong id="docs-internal-guid-81302841-7fff-d67e-afb5-3794704879ca">Rate of Interest</strong></td>
                                    <td align="center" valign="middle" bgcolor="#FFFFFF" style="padding:10px;"><strong>:</strong></td>
                                    <td bgcolor="#FFFFFF" style="padding:10px;">1% /Day</td>
                                  </tr>
                                  <tr>
                                    <td bgcolor="#FFFFFF" style="padding:10px;"><strong id="docs-internal-guid-812ef595-7fff-f93d-6228-79a9ef54e56d">Processing fee</strong></td>
                                    <td align="center" valign="middle" bgcolor="#FFFFFF" style="padding:10px;"><strong>:</strong></td>
                                    <td bgcolor="#FFFFFF" style="padding:10px;">'.$proccessingfee.'</td>
                                  </tr>
                                  <tr>
                                    <td bgcolor="#FFFFFF" style="padding:10px;"><strong id="docs-internal-guid-6cfc4d8a-7fff-22ce-a262-a90cab84fac7">Sanction Date</strong></td>
                                    <td align="center" valign="middle" bgcolor="#FFFFFF" style="padding:10px;"><strong>:</strong></td>
                                    <td bgcolor="#FFFFFF" style="padding:10px;">'.$new_date.'</td>
                                  </tr>
                                </table></td>
                              </tr>
                              <tr>
                                <td colspan="3">&nbsp;</td>
                              </tr>
                              <tr>
                                <td colspan="3"><strong id="docs-internal-guid-5e8941b7-7fff-41ae-b25d-b8a499450e3d">The documents required are:</strong></td>
                              </tr>
                              <tr>
                                <td colspan="3">■ PAN Card</td>
                              </tr>
                              <tr>
                                <td colspan="3">■ Aadhar Card</td>
                              </tr>
                              <tr>
                                <td colspan="3">■ Canceled Cheque</td>
                              </tr>
                              <tr>
                                <td colspan="3">■ Latest Credit Card statement</td>
                              </tr>
                              <tr>
                                <td colspan="3">&nbsp;</td>
                              </tr>
                              <tr>
                                <td colspan="3"><strong style="color:red;">Note- </strong>The validity of this letter is one month from the sanction date</td>
                              </tr>
                              <tr>
                                <td colspan="3">&nbsp;</td>
                              </tr>
                              <tr>
                                <td colspan="3"><strong id="docs-internal-guid-970d1140-7fff-4671-039b-fb260d16cb46">Warm Regards,</strong></td>
                              </tr>
                              <tr>
                                <td colspan="3"><a href="https://loanagainstcard.com/" target="_blank" style="text-decoration:blink;">Loanagainstcard.com</a></td>
                              </tr>
                              <tr>
                                <td colspan="3">Powered by Naman Finlease Pvt. Ltd. (RBI approved NBFC)</td>
                              </tr>
                              <tr>
                                <td colspan="3">Tower 12-102, Sunworld Vanalika Noida-201304</td>
                              </tr>
                            </table>'; 
    
            $this->load->library('email');
            $this->email->initialize($config);
            $this->email->set_newline("\r\n");
            $this->email->from('docs@loanagainstcard.com');
            $this->email->to($query->email);
            $this->email->bcc('docs@loanagainstcard.com'); 
            $this->email->subject("Loan Sanctioned From Loanagainstcard");
            $this->email->message($message);
            if($this->email->send())
            {
                echo "true"; 
            }else{
                echo "Sanctioned mail Not send !"; 
            }
		}

		public function getPersonalDetails($lead_id)
		{
			$data = $this->Tasks->getPersonalDetails($lead_id);
			echo json_encode($data);
		}

		public function saveCustomerPersonalDetails()
		{  
			if ($this->input->server('REQUEST_METHOD') == 'POST') 
	        {
	        	$this->form_validation->set_rules('borrower_name', 'Borrower Name', 'required|trim');
	        	$this->form_validation->set_rules('gender', 'Gender', 'required|trim');
	        	$this->form_validation->set_rules('dob', 'DOB', 'required|trim');
	        	$this->form_validation->set_rules('pancard', 'PAN', 'required|trim');
	        	$this->form_validation->set_rules('mobile', 'Mobile', 'required|trim');
	        	$this->form_validation->set_rules('alternate_no', 'Alternate Mobile', 'required|trim');
	        	// $this->form_validation->set_rules('alternateEmail', 'Alternate Email Id', 'required|trim');
	        	$this->form_validation->set_rules('state', 'State', 'required|trim');
	        	$this->form_validation->set_rules('city', 'City', 'required|trim');
	        	$this->form_validation->set_rules('pincode', 'Pincode', 'required|trim');
	        	$this->form_validation->set_rules('aadhar', 'Aadhar', 'required|trim');
	        	$this->form_validation->set_rules('residentialType', 'Residence Type', 'required|trim');
	        	// $this->form_validation->set_rules('residential_proof', 'Residential Proof', 'required|trim');
	        	$this->form_validation->set_rules('residence_address_line1', 'Recidence Address Line 1', 'required|trim');
	        	$this->form_validation->set_rules('residence_address_line2', 'Recidence Address Line 2', 'required|trim');

	        	if($this->form_validation->run() == FALSE) {
	        		$json['err'] = validation_errors();
		            echo json_encode($json);
	        	} else {
					$lead_id = $this->input->post('leadID');
					$company_id = $this->input->post('company_id');
					$product_id = $this->input->post('product_id');
					$user_id = $this->input->post('user_id');
					$borrower_name = $this->input->post('borrower_name');
					$borrower_mname = $this->input->post('borrower_mname');
					$borrower_lname = $this->input->post('borrower_lname');
					$gender = $this->input->post('gender');
					$dob = $this->input->post('dob');
					$pancard = $this->input->post('pancard');
					$mobile = $this->input->post('mobile');
					$alternate_no = $this->input->post('alternate_no');
					$email = $this->input->post('email');
					$state = $this->input->post('state');
					$city = $this->input->post('city');
					$pincode = $this->input->post('pincode');
					$lead_initiated_date = $this->input->post('lead_initiated_date');
					$post_office = $this->input->post('post_office');
					$alternateEmail = $this->input->post('alternateEmail');
					$aadhar = $this->input->post('aadhar');
					$residentialType = $this->input->post('residentialType');
					
					$other_address_proof = $this->input->post('other_add_proof');
					$residential_proof = $this->input->post('residential_proof');
					$residence_address_line1 = $this->input->post('residence_address_line1');
					$residence_address_line2 = $this->input->post('residence_address_line2');
					
					$isPresentAddress = "NO";
					if($this->input->post('isPresentAddress') == "YES"){
						$isPresentAddress = $this->input->post('isPresentAddress');
					}

					$presentAddressType = $this->input->post('presentAddressType');
					$present_address_line1 = $this->input->post('present_address_line1');
					$present_address_line2 = $this->input->post('present_address_line2');
					$employer_business = $this->input->post('employer_business');
					$office_address = $this->input->post('office_address');
					$office_website = $this->input->post('office_website');

				 	$data = [
					    'company_id' 				=> $company_id,
					    'product_id' 				=> $product_id,
					    'lead_id' 					=> $lead_id,
					    'borrower_name' 			=> $borrower_name,
						'middle_name' 				=> $borrower_mname,
						'surname' 					=> $borrower_lname,
					    'gender' 					=> $gender,
					    'dob' 						=> $dob,
					    'pancard' 					=> $pancard,
					    'mobile' 					=> $mobile,
					    'alternate_no' 				=> $alternate_no,
					    'email' 					=> $email,
					    'alternateEmail' 			=> $alternateEmail,
					    'state' 					=> $state,
					    'city' 						=> $city,
					    'pincode' 					=> $pincode,
					    'lead_initiated_date' 		=> $lead_initiated_date,
					    'post_office' 				=> $post_office,
					    'aadhar' 					=> $aadhar,
					    'residentialType' 			=> $residentialType,
						'other_address_proof' 		=> $other_address_proof,
					    'residential_proof' 		=> $residential_proof,
					    'residence_address_line1' 	=> $residence_address_line1,
					    'residence_address_line2' 	=> $residence_address_line2,
					    'isPresentAddress' 			=> $isPresentAddress,
					   // 'presentAddressType' 		=> $presentAddressType,
					    'present_address_line1' 	=> $present_address_line1,
					    'present_address_line2' 	=> $present_address_line2,
					    'employer_business' 		=> $employer_business,
					    'office_address' 			=> $office_address,
					    'office_website' 			=> $office_website,
					];
					
					$status = ['status' => "IN PROCESS"];
					$updateLead = ['status' => "IN PROCESS", 'state_id' =>$state, 'city' =>$city];

				// 	$query1 = $this->db->select('count(customer_id) as total, customer_id')->where('pancard', $pancard)->from('customer')->get()->result();

				// 	if($result1[0]->total > 0) {
				// 	  	$customer_id = $result1[0]->customer_id;
				// 	}
				// 	else
				// 	{
				// 		$last_row = $this->db->select('customer.customer_id')->from('customer')->order_by('customer_id', 'desc')->limit(1)->get()->row();
                        
				// 		$str = preg_replace('/\D/', '', $last_row->customer_id);
				// 		$customer_id= "FTC". str_pad(($str + 1), 6, "0", STR_PAD_LEFT);

				// 		$dataCustomer = array(
				// 			'customer_id'	=> $customer_id,
				// 			'name'			=> $borrower_name,
				// 			'email'			=> $email,
				// 			'alternateEmail'=> $alternateEmail,
				// 			'mobile'		=> $mobile,
				// 			'alternate_no'	=> $alternate_no,
				// 			'pancard'		=> $pancard,
				// 			'aadhar_no'		=> $aadhar,
				// 			'created_date'	=> updated_at
				// 		);
				// 		$this->db->insert('customer', $dataCustomer);
				// 	}
                    
                    $where = ['company_id' => $company_id, 'product_id' => $product_id];
					$sql = $this->db->where($where)->where('lead_id', $lead_id)->from('tbl_cam')->order_by('tbl_cam.cam_id', 'desc')->get();
					
					$row = $sql->row();
				// 	echo "<pre>"; print_r($sql->num_rows()); exit;
        			if($sql->num_rows() > 0)
        			{
						$insertDate = [
    					    'usr_updated_by' 			=> $user_id,
    					    'usr_updated_at' 			=> created_at,
						];
						$data = array_merge($insertDate, $data);
						$cam_id = $row->cam_id;
						$result = $this->db->where('cam_id', $cam_id)->update('tbl_cam', $data);
						$updateleads = $this->db->where($where)->where('lead_id', $lead_id)->update('leads',["state_id" =>$state, "city" =>$city]);

						$this->CAM->updateCAM($lead_id, $status);
					} else {
						$insertDate = [
							'lead_id' 					=> $lead_id,
				 			// 'customer_id' 				=> $customer_id,
						    'usr_created_by' 			=> user_id,
						    'usr_created_at' 			=> created_at,
						];
						$data = array_merge($insertDate, $data);
						$result = $this->db->insert('tbl_cam', $data);
						$cam_id = $this->db->insert_id();

						$this->Tasks->updateLeads($lead_id, $updateLead);
						$this->CAM->updateCAM($lead_id, $status);
					}

					if($result == 1){
						$json['msg'] = "Personal Details Updated Successfully.";
						echo json_encode($json);
					}else{
						$json['err'] = "Personal Details failed to Update.";
						echo json_encode($json);
					}
				}
			}
		}

		public function LACLeadRecommendation()
		{
			if ($this->input->server('REQUEST_METHOD') == 'POST')
		    {
		    	$this->form_validation->set_rules('Active_CC', 'Active CC', 'required|trim');
	        	$this->form_validation->set_rules('cc_statementDate', 'CC Statement Date', 'required|trim');
	        	$this->form_validation->set_rules('cc_paymentDueDate', 'CC Payment Date', 'required|trim');
	        	$this->form_validation->set_rules('cc_paymentDueDate', 'CC Payment Date', 'required|trim');
	        	$this->form_validation->set_rules('customer_bank_name', 'CC Bank', 'required|trim');
	        	$this->form_validation->set_rules('account_type', 'CC Type', 'required|trim');
	        	$this->form_validation->set_rules('customer_account_no', 'CC No', 'required|trim');
	        	$this->form_validation->set_rules('customer_confirm_account_no', 'CC Confirm No', 'required|trim');
	        	$this->form_validation->set_rules('customer_name', 'CC User Name', 'required|trim');
	        	$this->form_validation->set_rules('cc_limit', 'CC Limit', 'required|trim');
	        	$this->form_validation->set_rules('cc_outstanding', 'CC Outstanding', 'required|trim');
	        	$this->form_validation->set_rules('cc_name_Match_borrower_name', 'CC Name Match Borrower Name', 'required|trim');
	        	$this->form_validation->set_rules('emiOnCard', 'EMI On Card', 'required|trim');
	        	$this->form_validation->set_rules('DPD30Plus', '30+ DPD In Last 3 Month', 'required|trim');
	        	$this->form_validation->set_rules('cc_statementAddress', 'CC Statement Address', 'required|trim');
	        	$this->form_validation->set_rules('last3monthDPD', 'Last 3 Month DPD', 'required|trim');
	        	$this->form_validation->set_rules('loan_recomended', 'Loan Recomended', 'required|trim');
	        	$this->form_validation->set_rules('processing_fee', 'Admin Fee', 'required|trim');
	        	$this->form_validation->set_rules('roi', 'ROI', 'required|trim');
	        	$this->form_validation->set_rules('disbursal_date', 'Disbursal Date', 'required|trim');
	        	$this->form_validation->set_rules('repayment_date', 'Repayment Date', 'required|trim');

				if($this->input->post('isDisburseBankAC') == "YES"){
	        		$this->form_validation->set_rules('bankIFSC_Code', 'Bank IFSC Code', 'required|trim');
	        		$this->form_validation->set_rules('bank_name', 'Bank Name', 'required|trim');
	        		$this->form_validation->set_rules('bank_branch', 'Bank Branch', 'required|trim');
	        		$this->form_validation->set_rules('bankA_C_No', 'Bank A/C No', 'required|trim');
	        		$this->form_validation->set_rules('confBankA_C_No', 'Conf Bank A/C No', 'required|trim');
	        		$this->form_validation->set_rules('bankHolder_name', 'Bank Holder Name', 'required|trim');
	        		$this->form_validation->set_rules('bank_account_type', 'Bank A/C Type', 'required|trim');
				}

	        	if($this->form_validation->run() == FALSE) {
	        		$json['err'] = validation_errors();
		            echo json_encode($json);
	        	} else {
	        		$lead_id = $this->input->post('leadID');
					$statusCam = ['status' => "RECOMMEND"];
					$statusLeads = ['status' => "RECOMMEND", "screener_status" => 4];
					$this->Tasks->updateLeads($lead_id, $statusLeads);
					$this->CAM->updateCAM($lead_id, $statusCam);
	        		$json['msg'] = "Lead Recomendation Done.";
		            echo json_encode($json);
	        	}
	        }
		}

		public function PaydayLeadRecommendation()
		{
			if ($this->input->server('REQUEST_METHOD') == 'POST')
		    {
	        	$this->form_validation->set_rules('loan_recomended', 'Loan Recomended', 'required|trim');
	        	$this->form_validation->set_rules('processing_fee', 'Admin Fee', 'required|trim');
	        	$this->form_validation->set_rules('roi', 'ROI', 'required|trim');
	        	$this->form_validation->set_rules('disbursal_date', 'Disbursal Date', 'required|trim');
	        	$this->form_validation->set_rules('repayment_date', 'Repayment Date', 'required|trim');

        		$this->form_validation->set_rules('bankIFSC_Code', 'Bank IFSC Code', 'required|trim');
        		$this->form_validation->set_rules('bank_name', 'Bank Name', 'required|trim');
        		$this->form_validation->set_rules('bank_branch', 'Bank Branch', 'required|trim');
        		$this->form_validation->set_rules('bankA_C_No', 'Bank A/C No', 'required|trim');
        		$this->form_validation->set_rules('confBankA_C_No', 'Conf Bank A/C No', 'required|trim');
        		$this->form_validation->set_rules('bankHolder_name', 'Bank Holder Name', 'required|trim');
        		$this->form_validation->set_rules('bank_account_type', 'Bank A/C Type', 'required|trim');

	        	if($this->form_validation->run() == FALSE) {
	        		$json['err'] = validation_errors();
		            echo json_encode($json);
	        	} else {
	        		$lead_id = $this->input->post('leadID');
					$statusCam = ['status' => "RECOMMEND"];
					$statusLeads = ['status' => "RECOMMEND", "screener_status" => 4];
					$this->Tasks->updateLeads($lead_id, $statusLeads);
					$this->CAM->updateCAM($lead_id, $statusCam);
	        		$json['msg'] = "Lead Recomendation Done.";
		            echo json_encode($json);
	        	}
	        }
		}

		public function getSanctionDetails($lead_id)
		{
// 			$fetch = 'CAM.company_id, CAM.customer_id, CAM.borrower_name, CAM.gender, CAM.dob, CAM.pancard, CAM.mobile, CAM.alternate_no, CAM.email, CAM.alternateEmail, 
//                 CAM.usr_created_by, CAM.usr_created_at, CAM.usr_updated_by, CAM.usr_updated_at, CAM.customer_bank_name, CAM.account_type, CAM.customer_account_no, 
//                 CAM.customer_name, 
// 				CAM.isDisburseBankAC,
// 				CAM.bankIFSC_Code,	
// 				CAM.bank_name,		
// 				CAM.bank_branch,	
// 				CAM.bankA_C_No,	
// 				CAM.bankHolder_name,
// 				CAM.bank_account_type, CAM.loan_applied, CAM.loan_recomended, CAM.processing_fee, CAM.roi, CAM.net_disbursal_amount, CAM.disbursal_date, CAM.repayment_date,
// 				CAM.tenure, CAM.repayment_amount, CAM.special_approval, CAM.cam_created_by, CAM.cam_created_date, CAM.cam_updated_by, CAM.cam_updated_date';
// 			$query = $this->Tasks->getCAM($lead_id, $fetch);
// 			$data['CAM'] = $query->row();
            $data = $this->Tasks->getCAMDetails($lead_id);
			
			$fetchDisburse = 'D.customer_name, D.loanAgreementRequest, D.agrementRequestedDate, D.loanAgreementResponse, D.agrementUserIP, D.agrementResponseDate, 
			    D.status, D.company_account_no, D.channel, D.disburse_refrence_no, D.screenshot, D.payable_amount, D.loanAgreementLetter';
			$queryDisburse = $this->Tasks->getAgreementDetails($lead_id, $fetchDisburse);
			$disburse = $queryDisburse->row();
			
    		$personalDetails = $this->Tasks->getPersonalDetails($lead_id);

			$loanAgreementRequest = "FAILURE";
			$loanAgreementRequest2 = "Pending";
			$loanAgreementResponse = "PENDING";
			$responseEmail = "PENDING";
			$disburse_refrence_no = $disburse->disburse_refrence_no;
			if($disburse->loanAgreementRequest == "1"){
				$loanAgreementRequest = "SUCCESS";
			}
			if(empty($data['CAM']->alternateEmail) || $data['CAM']->alternateEmail == "-"){
				$loanAgreementRequest2 = "-";
			}else{
			   $loanAgreementRequest2 = "SUCCESS"; 
			}
			
			if($disburse->loanAgreementResponse == 1) {
				$loanAgreementResponse = "APPROVED";
				$responseEmail = $personalDetails['leadDetails']['email'];
			}
			if($disburse->loanAgreementResponse == 2) {
				$loanAgreementResponse = "APPROVED";
				$responseEmail = $personalDetails['leadDetails']['alternateEmail'];
			}
			if($disburse->disburse_refrence_no == null){
				$disburse_refrence_no = "";
			}
			
			$data['Disburse'] = [
				'loanAgreementRequest' 		=> strtoupper($loanAgreementRequest),
				'loanAgreementRequest2' 	=> strtoupper($loanAgreementRequest2),
				'agrementRequestedDate' 	=> date('d-m-Y h:i:s', strtotime($disburse->agrementRequestedDate)),
				'loanAgreementResponse' 	=> strtoupper($loanAgreementResponse),
				'agrementResponseDate' 		=> $disburse->agrementResponseDate ? date('d-m-Y h:i:s', strtotime($disburse->agrementResponseDate)) : '-',
				'responseEmail' 		    => $responseEmail,
				'agrementUserIP' 			=> $disburse->agrementUserIP,
				'loan_status' 				=> $disburse->status,
				'company_account_no' 		=> $disburse->company_account_no,
				'channel' 					=> $disburse->channel,
				'disburse_refrence_no' 		=> $disburse_refrence_no,
				'screenshot' 				=> $disburse->screenshot,
				'loanAgreementLetter' 		=> $disburse->loanAgreementLetter,
			];
			$result = array_merge($data['Disburse'], $data);

            echo json_encode($result);
		}

		public function validateCustomerPersonalDetails()
		{
			if ($this->input->server('REQUEST_METHOD') == 'POST') 
	        {
	        	$this->form_validation->set_rules('employeeType', 'Employee Type', 'required|trim');
	        	$this->form_validation->set_rules('dateOfJoining', 'Date Of Joining', 'required|trim');
	        	$this->form_validation->set_rules('designation', 'Designation', 'required|trim');
	        	$this->form_validation->set_rules('currentEmployer', 'Current Employer', 'required|trim');
	        	$this->form_validation->set_rules('companyAddress', 'Company Address', 'required|trim');
	        	$this->form_validation->set_rules('otherDetails', 'Other Details', 'required|trim');

	        	if($this->form_validation->run() == FALSE) {
	        		$json['error'] = validation_errors();
		            echo json_encode($json);
	        	} else {
		            $data = array (
						'lead_id'		 	 => $lead_id,
						'employeeType'		 => $this->input->post('employeeType'),
						'dateOfJoining'		 => $this->input->post('dateOfJoining'),
						'designation'		 => $this->input->post('designation'),
						'currentEmployer'	 => $this->input->post('currentEmployer'),
						'companyAddress'	 => $this->input->post('companyAddress'),
						'otherDetails'		 => $this->input->post('otherDetails'),
						'updated_by'		 => $_SESSION['isUserSession']['user_id'],
		            );
		            $result = $this->db->insert('tbl_customerEmployeeDetails', $data);
		            $this->db->where('lead_id', $lead_id)->update('leads', ['employeeDetailsAdded' => 1]);
		            echo json_encode($result);
		        }
	        }
		}

        //************** function for genereate the application number on behalf of user id ***************//
		function applicationNo()
		{
			$lead_id='5358';
			$totalLeadsCount = $this->Tasks->gettotalleadsCount('leads'); 
			$data = $this->Tasks->generateApplicationNo($lead_id); 
			$str=str_pad($totalLeadsCount, 9, '0', STR_PAD_LEFT);
			echo $applicationNo='AP'.$data[0]['product_code'].$data[0]['city_code'].$str; echo "</br>";

			echo $getBorrowerType = $this->Tasks->getBorrowerType('leads',$data[0]['pancard']); 


		}


	}

?>