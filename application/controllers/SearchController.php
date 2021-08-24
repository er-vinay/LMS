<?php
	defined('BASEPATH') OR exit('No direct script access allowed');
	class SearchController extends CI_Controller
	{
		public function __construct()
		{
			parent::__construct();
            $this->load->model('Task_Model');
            $this->load->model('Admin_Model');

	    	$login = new IsLogin();
	    	$login->index();
		}
	    
	    public function index() 
	    {
	    	$this->load->view('Search/index');
	    }

		public function filter()
		{ 
		   // echo "<pre>"; print_r($_POST); exit;
			$loan_no = $this->input->post('loan_no');
			$pancard = $this->input->post('pancard');
			$name = $this->input->post('name');
			$mobile = $this->input->post('mobile');
			$application_no = $this->input->post('application_no'); 
			$aadhar = $this->input->post('aadhar');
			$cif = $this->input->post('cif');
     
      		$querySearch = "SELECT L.lead_id, C.customer_id, C.borrower_name as name, C.email, C.mobile, C.pancard, C.loan_recomended as loan_amount_approved, C.status as credit_status, L.status, C.cam_created_date as credit_date, 
      		L.created_on as lead_date, L.city  
      		FROM tbl_cam C 
      		JOIN leads L ON C.lead_id = L.lead_id ";
			
			if(!empty($loan_no)){
				$querySearch .= "INNER JOIN loan LL ON C.lead_id=LL.lead_id AND LL.loan_no LIKE'".$loan_no."%'" ;
			} if(!empty($pancard)){
				$querySearch .= " AND C.pancard LIKE'".$pancard."%'";
			} if(!empty($name)){
				$querySearch .= " AND C.borrower_name LIKE '".$name."%'";
			} if(!empty($mobile)){
				$querySearch .= " AND C.mobile LIKE'".$mobile."%'";
			} if(!empty($application_no)){
				$querySearch .= " AND L.application_no LIKE'".$application_no."%'"; 
			} if(!empty($aadhar)){
				$querySearch .= " AND C.aadhar LIKE'".$aadhar."%'";
			} if(!empty($cif)){
				$querySearch .= " AND C.customer_id LIKE'".$cif."%'";
			}
      		$querySearch .= " ORDER BY C.lead_id DESC";

			$query = $this->db->query($querySearch);
			
			//echo $this->db->last_query(); exit;
			if($this->session->userdata['isUserSession']['role'] == 'Recovery' || 
				$this->session->userdata['isUserSession']['role'] == 'MIS' || 
				$this->session->userdata['isUserSession']['role'] == 'Admin') {
				$url = 'leads';
			}else{
				$url = 'leadDetails';
			}
		//	echo "<pre>"; print_r($query->result()); exit;
			$datatable = '<table class="table dt-table table-striped table-bordered table-responsive table-hover" style="border: 1px solid #dde2eb">
					<thead>
						<tr>
							<th>#</th>
							<th>Lead Id</th>
							<th>Customer Id</th>
							<th>Borrower Name</th>
							<th>Email</th>
							<th>Mobile</th>
							<th>Pancard</th>
							<th>Branch</th>
							<th>Loan Amount</th>
							<th>Status</th>
							<th>Initiated Date</th>
							<th>Credit Date</th>
							<th>Action</th>
						</tr>
					</thead>
					<tbody>';
		    $i = 1;
		    if($query->num_rows() > 0) {
		      	foreach($query->result() as $r) 
		      	{
	            	$datatable .='<tr>
            			<td>'.$i++.'</td>
            			<td class="text-center">'.$r->lead_id.'</td>
            			<td>'.$r->customer_id.'</td>
            			<td>'.$r->name.'</td>
            			<td>'.$r->email.'</td>
            			<td>'.$r->mobile.'</td>
            			<td>'.$r->pancard.'</td>
            			<td>'.$r->city.'</td>
            			<td>'.$r->loan_amount_approved.'</td>
            			<td>'.$r->status.'</td>
            			<td>'.$r->lead_date.'</td>
            			<td>'.$r->credit_date.'</td>
            			<td><a onclick="viewLeadsDetails('.$r->lead_id.')" data-toggle="modal" data-target="#myModal"><i class="fa fa-pencil-square-o" title="View Costomer Details"></i></a></td></tr>';
	           	}
	       	} else { 
	            $datatable .='<tr><td colspan="13" style="text-align: center;color : red;">No Record Found...</td></tr>';
	        }
            $datatable .='</tbody></table>';
			echo json_encode($datatable);
	 	}

	 	public function exportData()
	 	{
	 	    $data['filterMenu'] = $this->db->select('m.filter_id, m.sub_menu_id, m.name')->from('tbl_filter_sub_menu  m')->get();
	    	$this->load->view('Export/export', $data);
	 	}

	 	public function exportReport()
	 	{
	 		$exportUrl = $this->input->post('exportUrl');
	 		$exportReport = $this->input->post('exportReport');

	 		if ($this->input->server('REQUEST_METHOD') == 'POST') 
	        {
		    	$this->form_validation->set_rules('toDate', 'To Date', 'trim|required');
		    	$this->form_validation->set_rules('fromDate', 'From Date', 'trim|required');
	            if ($this->form_validation->run() == FALSE) 
	            {
	        		$this->session->set_flashdata('err', validation_errors());
		            return redirect(base_url('exportData/'.$exportReport), 'refresh');
	            }
	            else
	            {
 					$toDate = $this->input->post('toDate');
 					$fromDate = $this->input->post('fromDate');
	 				echo "<pre>"; print_r($_POST); exit;

	            }
	        }
	 	}
	}

?>