<?php $this->load->view('Layouts/header') ?>
<!-- section start -->
<section>
    <div class="container-fluid">
        <div class="taskPageSize">
            <div class="alertMessage">
                <div class="alert alert-dismissible alert-success msg">
                    <button type="button" class="close" data-dismiss="alert">&times;</button>
                    <strong>Thanks!</strong>
                    <a href="#" class="alert-link">Add Successfully</a>
                </div>
                <div class="alert alert-dismissible alert-danger err">
                    <button type="button" class="close" data-dismiss="alert">&times;</button>
                    <strong>Failed!</strong>
                    <a href="#" class="alert-link">Try Again.</a>
                </div>
            </div>
            
            <div class="row">
                <div class="col-md-12">
                    <div class="page-container list-menu-view">
                        <div class="page-content">
                            <div class="main-container">
                                <div class="container-fluid">
                                    <div class="col-md-12">
                                        <ol class="breadcrumb">
                                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                                            <li class="breadcrumb-item active">Credit</li>
                                        </ol>
                                        <div class="login-formmea">
                                            <div class="box-widget widget-module">
                                                <div class="widget-head clearfix">
                                                    <span class="h-icon"><i class="fa fa-th"></i></span>
                                                    <h4>Edit Credit History</h4>
                                                </div>
                                                <div class="widget-container">
                                                    <div class=" widget-block">
                                                        <?php 
                                                            if($this->session->flashdata('msg')!=''){
                                                                echo '<div class="alert alert-success alert-dismissible">
                                                                      <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                                                      <strong>'.$this->session->flashdata('msg').'</strong> 
                                                                    </div>';
                                                            }
                                                            if($this->session->flashdata('err')!=''){
                                                                echo '<div class="alert alert-danger alert-dismissible">
                                                                      <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                                                      <strong>'.$this->session->flashdata('err').'</strong> 
                                                                    </div>';
                                                            }
                                                        ?>
                                                        
                                                        <form action="<?= base_url('updateCreditDetails/'.$leadDetails->lead_id) ?>" id="CreditStatus" method="post" autocomplete="off">

                                                            <p style="color : #009fb3; font-size: 17px;">
                                                            Customer Details</label>
                                                            <div class="form-group row">
                                                                <input type="hidden" name="lead_id" value="<?= $leadDetails->lead_id ?>">
                                                                <input type="hidden" class="form-control rounded-0" id="sms" name="sms" value="Yes"/>
                                                                <input type="hidden" class="form-control rounded-0" id="alternate_no" name="alternate_no" value="<?= $leadDetails->alternate_no ?>"/>

                                                                 <div class="col-md-4">
                                                                    <label for="inputLastname">Customer Name<strong style="font-size : 18px;color : red"></strong></label>
                                                                    <input class="form-control rounded-0" id="name" name="name" type="text" value="<?= $leadDetails->name ?>" autocomplete="off" required>
                                                                </div>
                                                                
                                                                <div class="col-md-4">
                                                                    <label for="inputLastname">Email Id (For Sanction)<strong style="font-size : 18px;color : red"></strong></label>
                                                                    <input class="form-control rounded-0" id="email" name="email" value="<?= $leadDetails->email ?>" type="email" autocomplete="off" required>
                                                                </div>

                                                                <div class="col-md-4">
                                                                    <label for="inputLastname">Mobile<strong style="font-size : 18px;color : red"></strong></label>
                                                                    <input class="form-control rounded-0" id="mobile" name="mobile" value="<?= $leadDetails->mobile ?>" type="tel" maxlength="10" autocomplete="off" required>
                                                                </div>

                                                                <div class="col-md-4">
                                                                    <label for="inputLastname">Pancard<strong style="font-size : 18px;color : red"></strong></label>
                                                                    <input class="form-control rounded-0" id="pancard" name="pancard" type="text" value="<?= $leadDetails->pancard ?>" maxlength="10" minlength="10" autocomplete="off" required>
                                                                </div>

                                                                <div class="col-md-4">
                                                                    <label for="inputLastname">Salary<strong style="font-size : 18px;color : red"></strong></label>
                                                                    <input class="form-control rounded-0" id="salary" name="salary" value="<?= $leadDetails->monthly_income ?>" type="number" autocomplete="off" required>
                                                                </div>

                                                                <div class="col-md-4">
                                                                    <label for="inputLastname">Salary Date<strong style="font-size : 18px;color : red">*</strong></label>
                                                                    <input class="form-control rounded-0" id="salary_date" name="salary_date" value="<?= $leadDetails->salary_date ?>" type="date" autocomplete="off" required>
                                                                </div>

                                                                <div class="col-md-4">
                                                                    <label for="inputLastname">DOB<strong style="font-size : 18px;color : red">*</strong></label>
                                                                    <input class="form-control rounded-0" id="dob" name="dob" type="date" value="<?= $leadDetails->dob ?>" autocomplete="off" min="<?php echo date('Y-m-d', strtotime(' - 60 years')); ?>"  max="<?php echo date('Y-m-d', strtotime(' - 20 years')); ?>" required>
                                                                </div>

                                                                <div class="col-sm-4">
                                                                    <label for="inputFirstname">Marital Status<strong style="font-size : 18px;color : red">*</strong></label>
                                                                    <select class="form-control" name="marital_status" id="marital_status" autocomplete="off" required>
                                                                        <option value="">Select Marital Status</option>
                                                                        <option <?php if($leadDetails->marital_status == "Married"){ echo "selected";} ?>>Married</option>
                                                                        <option <?php if($leadDetails->marital_status == "Single"){ echo "selected";} ?>>Single</option>
                                                                        <option <?php if($leadDetails->marital_status == "Divorced"){ echo "selected";} ?>>Divorced</option>
                                                                        <option <?php if($leadDetails->marital_status == "Widowed"){ echo "selected";} ?>>Widowed</option>
                                                                      </select>
                                                                </div>

                                                                 <div class="col-md-4">
                                                                    <label for="inputLastname">Father's Name<strong style="font-size : 18px;color : red">*</strong></label>
                                                                    <input class="form-control rounded-0" id="father_name" name="father_name" value="<?= $leadDetails->father_name; ?>" type="text" maxlength="30" style="text-transform:capitalize;" autocomplete="off"/>
                                                                </div>
                                                            </div>

                                                            <p style="color : #009fb3; font-size: 17px;">
                                                            Other Details</p>

                                                            <div class="form-group row">
                                                                <div class="col-md-3">
                                                                    <label for="inputLastname">Branch<strong style="font-size : 18px;color : red">*</strong></label>
                                                                    <select class="form-control" name="branch" id="branch" autocomplete="off"> 
                                                                        <option value="">Select branch</option>
                                                                        <?php foreach($branch as $branchs): ?>
                                                                            <option <?php if($leadDetails->branch == $branchs->code){echo "selected";} ?>><?= $branchs->state ?></option>';
                                                                        <?php endforeach; ?>
                                                                    </select>
                                                                </div>

                                                                <div class="col-md-3">
                                                                    <label for="inputLastname">Loan amount approved<strong style="font-size : 18px;color : red">*</strong></label>
                                                                    <input class="form-control rounded-0" id="loanapproved" name="loanapproved" value="<?= $leadDetails->loan_amount_approved ?>" type="number" autocomplete="off" required>
                                                                </div>

                                                                <div class="col-md-3">
                                                                    <label for="inputLastname">ROI(Example : 1.5)<strong style="font-size : 18px;color : red">*</strong></label>
                                                                    <input class="form-control rounded-0" id="roi" name="roi" type="text" value="<?= $leadDetails->roi ?>" maxlength="4" minlength="3" autocomplete="off" required>
                                                                </div>

                                                                <div class="col-md-3">
                                                                    <label for="inputLastname">Processing Fee<strong style="font-size : 18px;color : red">*</strong></label>
                                                                    <input class="form-control rounded-0" id="processing_fee" name="processing_fee" type="number" value="<?= $leadDetails->processing_fee; ?>" maxlength="5" minlength="3" autocomplete="off" required>
                                                                </div>

                                                                <div class="col-md-3">
                                                                    <label for="inputLastname">Repayment Date<strong style="font-size : 18px;color : red">*</strong></label>
                                                                    <input type="date" class="form-control rounded-0" id="repayment_date" name="repayment_date" value="<?= $leadDetails->repayment_date ?>" min="<?php echo date("Y-m-d"); ?>" max="<?php echo date('Y-m-d', strtotime(' + 33 days')); ?>" autocomplete="off" required>
                                                                </div>

                                                                <!-- <div class="col-md-3">
                                                                    <label for="inputWebsite">Mail Send<strong style="font-size : 18px;color : red">*</strong></label>
                                                                    <select class="form-control" name="mail" id="mail" autocomplete="off">
                                                                        <option value="">Select Mail Send</option>
                                                                        <option <?php if($leadDetails->mail == "Yes"){ echo "selected";} ?>>Yes</option>
                                                                        <option <?php if($leadDetails->mail == "No"){ echo "selected";} ?>>No</option>
                                                                      </select>
                                                                </div> -->

                                                                <div class="col-md-3">
                                                                    <label for="inputWebsite">Residential Type<strong style="font-size : 18px;color : red">*</strong></label>
                                                                    <select class="form-control" name="residential" id="residential" autocomplete="off">
                                                                        <option value="">Select Residential Type</option>
                                                                        <option <?php if($leadDetails->residential == "Rented"){ echo "selected";} ?>>Rented</option>
                                                                        <option <?php if($leadDetails->residential == "Owned House"){ echo "selected";} ?>>Owned House</option>
                                                                        <option <?php if($leadDetails->residential == "Parental Home"){ echo "selected";} ?>>Parental Home</option>
                                                                        <option <?php if($leadDetails->residential == "Guest House"){ echo "selected";} ?>>Guest House</option>
                                                                        <option <?php if($leadDetails->residential == "PG"){ echo "selected";} ?>>PG</option>
                                                                        <option <?php if($leadDetails->residential == "Company Leased"){ echo "selected";} ?>>Company Leased</option>
                                                                    </select>
                                                                </div>
                                                                
                                                                 <div class="col-md-3">
                                                                    <label for="inputWebsite">Residential Proof<strong style="font-size : 18px;color : red">*</strong></label>
                                                                    <select class="form-control" name="residential_proof" id="residential_proof" autocomplete="off">
                                                                        <option value="">Select Residential Proof</option>
                                                                        <option <?php if($leadDetails->residential_proof == "Aadhar Card"){ echo "selected";} ?>>Aadhar Card</option>
                                                                        <option <?php if($leadDetails->residential_proof == "Voter ID"){ echo "selected";} ?>>Voter ID</option>
                                                                        <option <?php if($leadDetails->residential_proof == "Passport"){ echo "selected";} ?>>Passport</option>
                                                                        <option <?php if($leadDetails->residential_proof == "Driving Licence"){ echo "selected";} ?>>Driving Licence</option>
                                                                        <option <?php if($leadDetails->residential_proof == "Other"){ echo "selected";} ?>>Other</option>
                                                                    </select>
                                                                </div>

                                                                <div class="col-md-3">
                                                                    <label for="inputLastname">Residential Proof No.<strong style="font-size : 18px;color : red">*</strong></label>
                                                                    <input class="form-control rounded-0" id="residential_no" name="residential_no" value="<?= $leadDetails->residential_no ?>" type="text" autocomplete="off" required>
                                                                </div>
                                                                
                                                                 <div class="col-md-3">
                                                                    <label for="inputWebsite">Special Approval<strong style="font-size : 18px;color : red">*</strong></label>
                                                                    <select class="form-control" name="special_approval" id="special_approval" autocomplete="off">
                                                                        <option value="">Select Special Approval</option>
                                                                        <option <?php if($leadDetails->special_approval == "Self"){ echo "selected";} ?>>Self</option>
                                                                        <option <?php if($leadDetails->special_approval == "Sachin Sir"){ echo "selected";} ?>>Sachin Sir Personal</option>
                                                                        <option <?php if($leadDetails->special_approval == "Sachin Sir Other"){ echo "selected";} ?>>Sachin Sir Other</option>
                                                                    </select>
                                                                </div>
                                                                <div class="col-md-3">
                                                                    <label for="inputWebsite">CRM Approval<strong style="font-size : 18px;color : red">*</strong></label>
                                                                    <select class="form-control" name="crm_approval" id="crm_approval" autocomplete="off">
                                                                        <option value="">Select CRM Approval</option>
                                                                        <option <?php if($leadDetails->crm_approval == "NA"){ echo "selected";} ?>>NA</option>
                                                                          <option <?php if($leadDetails->crm_approval == "Jnana Marry"){ echo "selected";} ?>>Jnana Marry</option>
                                                                        <option <?php if($leadDetails->crm_approval == "Pushpa Balaji"){ echo "selected";} ?>>Pushpa Balaji</option>
                                                                        <option <?php if($leadDetails->crm_approval == "Disha Sharma"){ echo "selected";} ?>>Disha Sharma</option>
                                                                        <option <?php if($leadDetails->crm_approval == "Payal Das"){ echo "selected";} ?>>Payal Das</option>
                                                                       <option <?php if($leadDetails->crm_approval == "Ganesh"){ echo "selected";} ?>>Ganesh</option>
                                                                       <option <?php if($leadDetails->crm_approval == "Kanchan"){ echo "selected";} ?>>Kanchan</option>
                                                                       <option <?php if($leadDetails->crm_approval == "Satendra Upadhay"){ echo "selected";} ?>>Satendra Upadhay</option>
                                                                       <option <?php if($leadDetails->crm_approval == "Deepak Singh"){ echo "selected";} ?>>Deepak Singh</option>
                                                                        <option <?php if($leadDetails->crm_approval == "Amol Salunkhe"){ echo "selected";} ?>>Amol Salunkhe</option>
                                                                        <option <?php if($leadDetails->crm_approval == "Umesh Narayanan"){ echo "selected";} ?>>Umesh Narayanan</option>
                                                                        <option <?php if($leadDetails->crm_approval == "Sathis Venghatesan"){ echo "selected";} ?>>Sathis Venghatesan</option>
                                                                        <option <?php if($leadDetails->crm_approval == "Amit Kumar Jha"){ echo "selected";} ?>>Amit Kumar Jha</option>
                                                                        <option <?php if($leadDetails->crm_approval == "Mohit Changrani M"){ echo "selected";} ?>>Mohit Changrani M</option>
                                                                        <option <?php if($leadDetails->crm_approval == "vijay korjal"){ echo "selected";} ?>>vijay korjal</option>
                                                                        <option<?php if($leadDetails->crm_approval == "Raghavendra"){ echo "selected";} ?>>Raghavendra</option>
                                                                        <option<?php if($leadDetails->crm_approval == "Yogesh Jaiswal"){ echo "selected";} ?>>Yogesh Jaiswal</option>
                                                                        <option<?php if($leadDetails->crm_approval == "Ranu Bhagel"){ echo "selected";} ?>>Ranu Bhagel</option>
                                                                        <option<?php if($leadDetails->crm_approval == "Deepika Chopra"){ echo "selected";} ?>>Deepika Chopra</option>
                                                                    </select>
                                                                </div>

                                                                <div class="col-md-3">
                                                                    <label for="inputWebsite">Recovery Approval<strong style="font-size : 18px;color : red">*</strong></label>
                                                                    <select class="form-control" name="recovery_approval" id="recovery_approval" autocomplete="off">
                                                                        <option value="">Select Recovery Approval</option>
                                                                        <option <?php if($leadDetails->recovery_approval == "NA"){ echo "selected";} ?>>NA</option>
                                                                        <option <?php if($leadDetails->recovery_approval == "Meena"){ echo "selected";} ?>>Meena</option>
                                                                        <option <?php if($leadDetails->recovery_approval == "Swadesh"){ echo "selected";} ?>>Swadesh</option>
                                                                      </select>
                                                                </div>

                                                                <div class="col-md-3">
                                                                    <label for="inputWebsite">Repeat/Fresh<strong style="font-size : 18px;color : red">*</strong></label>
                                                                    <select class="form-control" name="repeat" id="repeat" autocomplete="off">
                                                                        <option value="">Select Repeat/Fresh</option>
                                                                        <option <?php if($leadDetails->noofdisbursal == "NEW"){ echo "selected";} ?>>Fresh</option>
                                                                        <option <?php if($leadDetails->noofdisbursal == "R1"){ echo "selected";} ?>>Repeat-1</option>
                                                                        <option <?php if($leadDetails->noofdisbursal == "R2"){ echo "selected";} ?>>Repeat-2</option>
                                                                        <option <?php if($leadDetails->noofdisbursal == "R3"){ echo "selected";} ?>>Repeat-3</option>
                                                                        <option <?php if($leadDetails->noofdisbursal == "R4"){ echo "selected";} ?>>Repeat-4</option>
                                                                        <option <?php if($leadDetails->noofdisbursal == "R5"){ echo "selected";} ?>>Repeat-5</option>
                                                                        <option <?php if($leadDetails->noofdisbursal == "R6"){ echo "selected";} ?>>Repeat-6</option>
                                                                        <option <?php if($leadDetails->noofdisbursal == "R7"){ echo "selected";} ?>>Repeat-7</option>
                                                                        <option <?php if($leadDetails->noofdisbursal == "R8"){ echo "selected";} ?>>Repeat-8</option>
                                                                        <option <?php if($leadDetails->noofdisbursal == "R9"){ echo "selected";} ?>>Repeat-9</option>
                                                                        <option <?php if($leadDetails->noofdisbursal == "R10"){ echo "selected";} ?>>Repeat-10</option>
                                                                      </select>
                                                                </div>

                                                                <div class="col-sm-3">
                                                                    <label for="inputLastname">CIBIL Score<strong style="font-size : 18px;color : red">*</strong></label>
                                                                    <input type="number" class="form-control rounded-0" id="cibil" name="cibil" value="<?= $leadDetails->cibil ?>" autocomplete="off" required>
                                                                </div>

                                                                <div class="col-sm-3">
                                                                    <label for="inputFirstname">Status<strong style="font-size : 18px;color : red">*</strong></label>
                                                                    <select class="form-control" name="status" id="status" autocomplete="off" required>
                                                                        <option value="">Select Status</option>
                                                                        <option <?php if($leadDetails->status == "Sanction"){ echo "selected";} ?>>Sanction</option>
                                                                        <option <?php if($leadDetails->status == "Hold"){ echo "Hold";} ?>>Hold</option>
                                                                        <option <?php if($leadDetails->status == "Rejected"){ echo "selected";} ?>>Rejected</option>
                                                                        <option <?php if($leadDetails->status == "Rejected by PD"){ echo "selected";} ?>>Rejected by PD</option>
                                                                        <option <?php if($leadDetails->status == "Rejected by CRM"){ echo "selected";} ?>>Rejected by CRM</option>
                                                                        <option <?php if($leadDetails->status == "Reject from Customer"){ echo "selected";} ?>>Reject from Customer</option>
                                                                      </select>
                                                                </div>

                                                                <div class="col-sm-3">
                                                                    <label for="inputLastname">Obligations<strong style="font-size : 18px;color : red">*</strong></label>
                                                                    <input class="form-control rounded-0" id="obligations" rows="3" cols="30" name="obligations" value="<?= $leadDetails->obligations ?>" required>
                                                                </div>

                                                                <div class="col-sm-12">
                                                                    <label for="inputLastname">Remark<strong style="font-size : 18px;color : red">*</strong></label>
                                                                    <textarea class="form-control rounded-0" id="remark" rows="3" cols="30" name="remark" required><?= $leadDetails->remark ?></textarea>
                                                                </div>
                                                                
                                                            </div>

                                                            <button type="submit" class="button btn btn-primary">Update Credit</button>

                                                            <?php if($leadDetails->status !='Approved' && $leadDetails->status =='Sanction'){ ?>
                                                            <!-- <button type="button" class="button btn btn-success" id="resendSactionMail">RESEND SANCTION MAIL</button> -->
                                                            <?php } ?>

                                                            <?php if($leadDetails->status !='Approved' && $leadDetails->status =='Rejected'){?>
                                                            <!-- <button type="button" class="button btn btn-danger" id="resendRejectedMail">RESEND REJECTED MAIL</button> -->
                                                            <?php } ?>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!--Footer Start Here -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- footer -->
<?php $this->load->view('Layouts/footer') ?>

<script>
    $("#userRole, #restrectedBranchUser").select2({
        placeholder: "Select",
        allowClear: true
    });

    $('#roleTag').multiselect({ // #centerName
        columns: 1,
        placeholder: 'Select',
        search: true,
        selectAll: true,
        allowClear: true
    });
</script>
<script>
    $(document).ready(function () {
        $('#restrectedBranchUser').on('change', function(){
            var state_id = $(this).val();
            if(state_id){
                $.ajax({
                    url: '<?= base_url("AdminController/getUserCenter"); ?>',
                    type : 'POST',
                    data : {state_id : state_id},
                    dataType: 'json',
                    cache : false,
                    success: function(response) {
                        $('#centerName').empty();
                        $.each(response , function(index, item) {
                            $('#centerName').append('<option value="'+item.city_id+'">'+item.city+'</option>').css('height', '100px');
                        });
                    }
                }); 
            } else {
                $('#restrectedBranchUser').html('<option value="">Select state first</option>'); 
            }
        });
    });

    $('#adminSaveUser').click(function(e){
        e.preventDefault();
        $.ajax({
            url : '<?= base_url("adminSaveUser") ?>',
            type : 'POST',
            dataType : "json",
            data : $('#formData').serialize(),
            async: false,
            success : function(response){
                if(response == 1)
                {
                    $('#userRole, #restrectedBranchUser, #centerName').empty();
                    $('#formData')[0].reset();
                    $(".msg").show().fadeOut('slow');
                    $(".msg a").html("Added Successfully.");
                    window.setTimeout(function(){location.reload()}, 0);
                }else{
                    $('#formData')[0].reset();
                    $(".err").show().fadeOut('slow');
                    $(".err a").html("Try Again.");
                }
            },
            error: function(XMLHttpRequest, textStatus, errorThrown) { 
                if(XMLHttpRequest != "")
                {   
                    $(".err").show().fadeOut('slow');
                    $(".err a").html("All Fields required.");
                }
                return false;
            }
        });
    });

</script>