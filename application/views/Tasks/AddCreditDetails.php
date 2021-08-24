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
                                                    <h4>Add Credit History</h4>
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
                                                        
                                                        <form action="<?= base_url('save-credit-details') ?>" id="CreditStatus" method="post" autocomplete="off">

                                                            <p style="color : #009fb3; font-size: 17px;">
                                                            Customer Details</label>
                                                            <div class="form-group row">
                                                                <input type="hidden" name="lead_id" value="<?= $leadDetails->lead_id ?>">
                                                                <input type="hidden" class="form-control rounded-0" id="sms" name="sms" value="Yes"/>
                                                                <input type="hidden" class="form-control rounded-0" id="alternate_no" name="alternate_no" value="<?= $leadDetails->alternateMobileNo ?>"/>

                                                                 <div class="col-md-4">
                                                                    <label for="inputLastname">Customer Name<strong class="required_Fields">*</strong></label>
                                                                    <input class="form-control rounded-0" id="name" name="name" type="text" value="<?= $leadDetails->name ?>" autocomplete="off" required>
                                                                </div>
                                                                
                                                                <div class="col-md-4">
                                                                    <label for="inputLastname">Email Id (For Sanction)<strong class="required_Fields">*</strong></label>
                                                                    <input class="form-control rounded-0" id="email" name="email" value="<?= $leadDetails->email ?>" type="email" autocomplete="off" required>
                                                                </div>

                                                                <div class="col-md-4">
                                                                    <label for="inputLastname">Mobile<strong class="required_Fields">*</strong></label>
                                                                    <input class="form-control rounded-0" id="mobile" name="mobile" value="<?= $leadDetails->mobile ?>" type="tel" maxlength="10" autocomplete="off"  required>
                                                                </div>

                                                                <div class="col-md-4">
                                                                    <label for="inputLastname">Pancard<strong class="required_Fields">*</strong></label>
                                                                    <input class="form-control rounded-0" id="pancard" name="pancard" type="text" value="<?= $leadDetails->pancard ?>" maxlength="10" minlength="10" autocomplete="off" required>
                                                                </div>

                                                                <div class="col-md-4">
                                                                    <label for="inputLastname">Salary<strong class="required_Fields">*</strong></label>
                                                                    <input class="form-control rounded-0" id="salary" name="salary" value="<?= $leadDetails->monthly_income ?>" type="number" autocomplete="off" required>
                                                                </div>

                                                                <div class="col-md-4">
                                                                    <label for="inputLastname">Salary Date<strong class="required_Fields">*</strong></label>
                                                                    <input class="form-control rounded-0" id="salary_date" name="salary_date" type="date" min="" max="" autocomplete="off" required>
                                                                </div>

                                                                <div class="col-md-4">
                                                                    <label for="inputLastname">DOB<strong class="required_Fields">*</strong></label>
                                                                    <input class="form-control rounded-0" id="dob" name="dob" type="date" value="<?= $leadDetails->dob ?>" autocomplete="off" required>
                                                                </div>

                                                                <div class="col-sm-4">
                                                                    <label for="inputFirstname">Marital Status<strong class="required_Fields">*</strong></label>
                                                                    <select class="form-control" name="marital_status" id="marital_status" autocomplete="off" required>
                                                                        <option value="">Select Marital Status</option>
                                                                        <option value="Married">Married</option>
                                                                        <option value="Single">Single</option>
                                                                        <option value="Divorced">Divorced</option>
                                                                        <option value="Widowed">Widowed</option>
                                                                      </select>
                                                                </div>

                                                                 <div class="col-md-4">
                                                                    <label for="inputLastname">Father's Name<strong class="required_Fields">*</strong></label>
                                                                    <input class="form-control rounded-0" id="father_name" name="father_name" type="text" maxlength="30" style="text-transform:capitalize;" autocomplete="off"/>
                                                                </div>
                                                            </div>

                                                            <p style="color : #009fb3; font-size: 17px;">
                                                            Other Details</p>

                                                            <div class="form-group row">
                                                                <div class="col-md-3">
                                                                    <label for="inputLastname">Branch<strong class="required_Fields">*</strong></label>
                                                                     <select class="form-control" name="branch" id="branch" autocomplete="off"> 
                                                                        <option value="">Select branch</option>
                                                                        <?php foreach($branch as $branchs): ?>
                                                                            <option value="<?= $branchs->code ?>"><?= $branchs->state ?></option>';
                                                                        <?php endforeach; ?>
                                                                      </select>
                                                                </div>

                                                                <div class="col-md-3">
                                                                    <label for="inputLastname">Loan amount approved<strong class="required_Fields">*</strong></label>
                                                                    <input class="form-control rounded-0" id="loanapproved" name="loanapproved" value="<?= $leadDetails->loan_amount ?>" type="number" autocomplete="off" required>
                                                                </div>

                                                                <div class="col-md-3">
                                                                    <label for="inputLastname">Repayment Date<strong class="required_Fields">*</strong></label>
                                                                    <input type="date" class="form-control rounded-0" id="repayment_date" name="repayment_date" min="<?php echo date("Y-m-d"); ?>" max="<?php echo date('Y-m-d', strtotime(' + 33 days')); ?>" autocomplete="off" required>
                                                                </div>

                                                                <div class="col-md-3">
                                                                    <label for="inputLastname">Tenure<strong class="required_Fields">*</strong></label>
                                                                    <input class="form-control rounded-0" id="tenure" name="tenure" value="<?= $leadDetails->tenure ?>" type="number" autocomplete="off" required>
                                                                </div>

                                                                <div class="col-md-3">
                                                                    <label for="inputLastname">ROI(Example : 1.5)<strong class="required_Fields">*</strong></label>
                                                                    <input class="form-control rounded-0" id="roi" name="roi" type="text" value="1.5" maxlength="4" minlength="3" autocomplete="off" required>
                                                                </div>

                                                                <div class="col-md-3">
                                                                    <label for="inputLastname">Processing Fee<strong class="required_Fields">*</strong></label>
                                                                    <input class="form-control rounded-0" id="processing_fee" name="processing_fee" type="number" value="1000" maxlength="5" minlength="3" autocomplete="off" required>
                                                                </div>

                                                                <div class="col-md-3">
                                                                    <label for="inputWebsite">Mail Send<strong class="required_Fields">*</strong></label>
                                                                    <select class="form-control" name="mail" id="mail" autocomplete="off">
                                                                        <option value="">Select Mail Send</option>
                                                                        <option value="Yes">Yes</option>
                                                                        <option value="No">No</option>
                                                                      </select>
                                                                </div>

                                                                <div class="col-md-3">
                                                                    <label for="inputWebsite">Residential Type<strong class="required_Fields">*</strong></label>
                                                                    <select class="form-control" name="residential" id="residential" autocomplete="off">
                                                                        <option value="">Select Residential Type</option>
                                                                        <option value="Rented">Rented</option>
                                                                        <option value="Owned House">Owned House</option>
                                                                        <option value="Parental Home">Parental Home</option>
                                                                        <option value="Guest House">Guest House</option>
                                                                        <option value="PG">PG</option>
                                                                        <option value="Company Leased">Company Leased</option>
                                                                      </select>
                                                                </div>
                                                                
                                                                 <div class="col-md-3">
                                                                    <label for="inputWebsite">Residential Proof<strong class="required_Fields">*</strong></label>
                                                                    <select class="form-control" name="residential_proof" id="residential_proof" autocomplete="off">
                                                                        <option value="">Select Residential Proof</option>
                                                                        <option value="Aadhar Card">Aadhar Card</option>
                                                                        <option value="Voter ID">Voter ID</option>
                                                                        <option value="Passport">Passport</option>
                                                                        <option value="Driving Licence">Driving Licence</option>
                                                                        <option value="Other">Other</option>
                                                                      </select>
                                                                </div>

                                                                <div class="col-md-3">
                                                                    <label for="inputLastname">Residential Proof No.<strong class="required_Fields">*</strong></label>
                                                                    <input class="form-control rounded-0" id="residential_no" name="residential_no" type="text" autocomplete="off" required>
                                                                </div>
                                                                
                                                                 <div class="col-md-3">
                                                                    <label for="inputWebsite">Special Approval<strong class="required_Fields">*</strong></label>
                                                                    <select class="form-control" name="special_approval" id="special_approval" autocomplete="off">
                                                                        <option value="">Select Special Approval</option>
                                                                        <option value="Self">Self</option>
                                                                        <option value="Sachin Sir">Sachin Sir</option>
                                                                        <option value="Swadesh Sir">Swadesh Sir</option>
                                                                        <option value="Kamal Sir">Kamal Sir</option>
                                                                        <option value="Meena Mam">Meena Mam</option>
                                                                        <option value="NA">NA</option>
                                                                    </select>
                                                                </div>
                                                                
                                                                 <div class="col-md-3">
                                                                    <label for="inputWebsite">Other Approval<strong class="required_Fields">*</strong></label>
                                                                    <select class="form-control" name="other_approval" id="other_approval" autocomplete="off">
                                                                        <option value="">Select Other Approval</option>
                                                                        <option value="CRM">CRM</option>
                                                                        <option value="C/R Manager">Collection & Recovery Manager</option>
                                                                        <option value="NA">NA</option>
                                                                    </select>
                                                                </div>
                                                                
                                                                <!--<div class="col-md-3">-->
                                                                <!--    <label for="inputWebsite">CRM Approval<strong class="required_Fields">*</strong></label>-->
                                                                <!--    <select class="form-control" name="crm_approval" id="crm_approval" autocomplete="off">-->
                                                                <!--        <option value="">Select CRM Approval</option>-->
                                                                        
                                                                <!--        <?php foreach($crm_Approval  as $row) { ?>-->
                                                                <!--        <option value="<?= $row->user_id ?>"><?= $row->name ?></option>-->
                                                                <!--        <?php } ?>-->
                                                                        <!--<option value="NA">NA</option>-->
                                                                        <!--  <option value="Jnana Marry">Jnana Marry</option>-->
                                                                        <!--<option value="Pushpa Balaji">Pushpa Balaji</option>-->
                                                                        <!--<option value="Disha Sharma">Disha Sharma</option>-->
                                                                        <!--<option value="Payal Das">Payal Das</option>-->
                                                                        <!--   <option value="Ganesh">Ganesh</option>-->
                                                                        <!--   <option value="Kanchan">Kanchan</option>-->
                                                                        <!--   <option value="Satendra Upadhay">Satendra Upadhay</option>-->
                                                                        <!--   <option value="Deepak Singh">Deepak Singh</option>-->
                                                                        <!--    <option value="Amol Salunkhe">Amol Salunkhe</option>-->
                                                                        <!--    <option value="Umesh Narayanan">Umesh Narayanan</option>-->
                                                                        <!--    <option value="Sathis Venghatesan">Sathis Venghatesan</option>-->
                                                                        <!--    <option value="Amit Kumar Jha">Amit Kumar Jha</option>-->
                                                                        <!--    <option value="Mohit Changrani M">Mohit Changrani M</option>-->
                                                                        <!--    <option value="vijay korjal">vijay korjal</option>-->
                                                                        <!--    <option value="Raghavendra">Raghavendra</option>-->
                                                                        <!--    <option value="Yogesh Jaiswal">Yogesh Jaiswal</option>-->
                                                                        <!--    <option value="Ranu Bhagel">Ranu Bhagel</option>-->
                                                                        <!--    <option value="Deepika Chopra">Deepika Chopra</option>-->
                                                                <!--      </select>-->
                                                                <!--</div>-->

                                                                <!--<div class="col-md-3">-->
                                                                <!--    <label for="inputWebsite">Recovery Approval<strong class="required_Fields">*</strong></label>-->
                                                                <!--    <select class="form-control" name="recovery_approval" id="recovery_approval" autocomplete="off">-->
                                                                <!--        <option value="">Select Recovery Approval</option>-->
                                                                <!--        <option value="NA">NA</option>-->
                                                                <!--        <option value="Meena">Meena</option>-->
                                                                <!--        <option value="Swadesh">Swadesh</option>-->
                                                                <!--    </select>-->
                                                                <!--</div>-->

                                                                <div class="col-md-3">
                                                                    <label for="inputWebsite">Repeat/Fresh<strong class="required_Fields">*</strong></label>
                                                                    <select class="form-control" name="repeat" id="repeat" autocomplete="off">
                                                                        <option value="">Select Repeat/Fresh</option>
                                                                        <option value="NEW">Fresh</option>
                                                                        <option value="R1">Repeat-1</option>
                                                                        <option value="R2">Repeat-2</option>
                                                                        <option value="R3">Repeat-3</option>
                                                                        <option value="R4">Repeat-4</option>
                                                                        <option value="R5">Repeat-5</option>
                                                                        <option value="R6">Repeat-6</option>
                                                                        <option value="R7">Repeat-7</option>
                                                                        <option value="R8">Repeat-8</option>
                                                                        <option value="R9">Repeat-9</option>
                                                                        <option value="R10">Repeat-10</option>
                                                                      </select>
                                                                </div>

                                                                <div class="col-sm-3">
                                                                    <label for="inputLastname">Obligations<strong class="required_Fields">*</strong></label>
                                                                    <input type="number" class="form-control rounded-0" id="obligations"  name="obligations" autocomplete="off" required>
                                                                </div>

                                                                <div class="col-sm-3">
                                                                    <label for="inputLastname">CIBIL Score<strong class="required_Fields">*</strong></label>
                                                                    <input type="number" class="form-control rounded-0" id="cibil"  name="cibil" autocomplete="off" required>
                                                                </div>

                                                                <div class="col-sm-3">
                                                                    <label for="inputFirstname">Status<strong class="required_Fields">*</strong></label>
                                                                    <select class="form-control" name="status" id="status" autocomplete="off" required>
                                                                        <option value="">Select Status</option>
                                                                        <option value="Sanction">Sanction</option>
                                                                        <option value="Rejected">Rejected</option>
                                                                        <option value="Hold">Hold</option>
                                                                        <!-- <option value="Rejected by PD">Rejected by PD</option>
                                                                        <option value="Rejected by CRM">Rejected by CRM</option>
                                                                        <option value="Reject from Customer">Reject from Customer</option> -->
                                                                      </select>
                                                                </div>

                                                                <div class="col-sm-9">
                                                                    <label for="inputLastname">Remark<strong class="required_Fields">*</strong></label>
                                                                    <textarea class="form-control rounded-0" id="remark" rows="3" cols="30" name="remark" required></textarea>
                                                                </div>
                                                                
                                                            </div>

                                                            <button type="submit" class="button btn btn-primary">Save Credit</button>

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

    $("#repayment_date").change(function(){
        var repayment_date = $(this).val();

        var start = new Date(repayment_date);
        var end = new Date(fullDate);
        var days = (end - start) / 1000 / 60 / 60 / 24;
        days = days - (end.getTimezoneOffset() - start.getTimezoneOffset()) / (60 * 24);

        var tenure = - days.toString().split(".")[0];
        $("#tenure").val(tenure);
    });
    

    $("#dob, #salary_date, #repayment_date").keypress(function myfunction(event) {
        var regex = new RegExp("^[0-9?=.*!@#$%^&*]+$");               
        var key = String.fromCharCode(event.charCode ? event.which : event.charCode);
         if (!regex.test(key)) {
            event.preventDefault();
            return false;
        }              
        return false; 
    });

</script>