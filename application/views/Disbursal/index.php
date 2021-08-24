<?php $this->load->view('Layouts/header') ?>
<!-- section start -->
<section>
    <div class="container-fluid">
        <div class="taskPageSize taskPageSizeDashboard">
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
                                        <div class="login-formmea">
                                            <div class="box-widget widget-module">
                                                <div class="widget-head clearfix">
                                                    <span class="h-icon"><i class="fa fa-th"></i></span>
                                                    <h4>Task Lists</h4>
                                                    <div class="head">LEAD DISBURSAL 
                                                        <span><?= $taskCount; ?></span>
                                                    </div>
                                                    <div class="download">
                                                        <a href="<?= base_url('Export/DisbursalData') ?>">EXCEL</a>
                                                         <!--<a href="<?= base_url('addBankDetails') ?>">Add Bank Details</a>-->
                                                        <!--<a href="#">SELECT</a>-->
                                                        <!--<a href="#">SHOW</a>-->
                                                    </div>
                                                </div>
                                                <div class="widget-container">
                                                    <div class=" widget-block">
                                                        <div class="row">
                                                            <div class="scroll_on_x_axis">
                                                                <table class="table dt-table table-striped table-bordered table-responsive table-hover" data-order='[[ 0, "desc" ]]' style="border: 1px solid #dde2eb">
                                                                    <thead>
                                                                        <tr>
                                                                            <th><b>#</b></th>
                                                                            <th><b>Borrower</b></th>
                                                                            <th><b>Email</b></th>
                                                                            <th><b>Branch</b></th>
                                                                            <th><b>Center</b></th>
                                                                            <th><b>Initiated On</b></th>
                                                                            <th><b>Lead Source</b></th>
                                                                            <th><b>Lead Status</b></th>
                                                                            <th><b>Proceed by</b></th>
                                                                            <th><b>Action</b></th>
                                                                        </tr>
                                                                    </thead>
                                                                    <tbody>
                                                                        <?php foreach($listTask as $row) : ?>
                                                                        <tr>
                                                                            <td style="width : auto;">
                                                                                <?= $row->lead_id; ?>

                                                                                <?php if($row->partPayment > 0){ ?>
                                                                                    <div class="animateWarning"></div>
                                                                                <?php } ?>
                                                                            </td>
                                                                            <td><?= $row->name; ?></td>
                                                                            <td><?= $row->email; ?></td>
                                                                            <td><?= $row->state; ?></td>
                                                                            <td><?= $row->state; ?></td>
                                                                            <td><?= $row->created_on; ?></td>
                                                                            <td><?= $row->source; ?></td>
                                                                            <td><?= $row->status; ?></td>
                                                                            
                                                                            <td>
                                                                                <?php if($row->userChecked > 0){ 
                                                                                    $query = $this->db->select('users.name')->where('user_id', $row->userChecked)->get('users')->row();
                                                                                ?>
                                                                                
                                                                                    <p class="text-success" title="<?= $query->name; ?>"><?= $query->name; ?></p>
                                                                                <?php }else{ echo "Pending";} ?>
                                                                            </td>
                                                                            <td>
                                                                                <a href="#" onclick="viewLeadsDetails('<?= $row->lead_id; ?>')" data-toggle="modal" data-target="#myModal"><i class="fa fa-pencil-square-o" title="View Costomer Details"></i></a>
                                                                            </td>
                                                                        </tr>
                                                                        <?php endforeach; ?>
                                                                    </tbody>
                                                                </table>
                                                            </div>
                                                        </div>
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
<?php $this->load->view('Tasks/task_js.php') ?>
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>
<script>
    $(document).ready(function(){
        $("#customer_account_no, #customer_confirm_account_no, #disburse_amount").keypress(function (e) {
            if (e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57)) {
               return false;
            }
        });
    });
</script>

<!-- fetch ifsc code and bank name -->

<script type="text/javascript">
    $(document).ready(function(){
        $('#customer_ifsc_code').select2({
            placeholder: 'Select IFSC Code',
            minimumInputlength: 2,
            allowClear: true,
            ajax: {
                url: '<?= base_url('getCustomerBankDetails') ?>',
                dataType: 'json',
                delay: 250,
                data: function (data) {
                    return {
                        searchTerm: data.term // search term
                    };
                },
                processResults: function (response) {
                    return {
                        results: $.map(response, function (item) {
                            return {
                                id: item.bank_ifsc,
                                text: item.bank_ifsc,
                            }
                        })
                    };
                },
                cache: true
            }
        });

        $("#customer_ifsc_code").change(function(){
            var ifsc_code = $(this).val();
            $.ajax({
                url : '<?= base_url("getBankNameByIfscCode") ?>',
                type : 'POST',
                data : {ifsc_code : ifsc_code},
                dataType : "json",
                async: false,
                success : function(response){
                    $('#customer_bank_name').val(response.bank_name);
                },
                error: function(XMLHttpRequest, textStatus, errorThrown) { 
                    $("#exampleModalLongTitle").html(textStatus +" : "+ errorThrown);
                    return false;
                }
            });
        });
    });
    
    function customer_confirm_acc_no(acc_no2)
    {
        var acc1 = $("#customer_account_no").val();
        var acc2 = $(acc_no2).val();

        if(acc1 === acc2){
            $("#customer_account_no, #customer_confirm_account_no").css('border-color', '#aaa');
            return true;
        }else{
            $("#customer_account_no, #customer_confirm_account_no").val('').css('border-color', 'red');
            $("#customer_account_no").focus();
            
            catchError('Invalid A/C no.');
        }
    }
    
    $(document).ready(function(){
        $('#disbursalApprove').on('click', function(){
            var formData = $('#FormDisbursal').serialize();
            $.ajax({
                url : '<?= base_url("saveDisbursalData") ?>',
                type : 'POST',
                data : formData,
                dataType : "json",
                // async: false,
                success: function(response) {
                    if(response.err) {
                        catchError(response.err);
                    }else{
                        catchSuccess(response.msg);
                        $('#customer_bank_name, #customer_account_no, #customer_confirm_account_no, #customer_name, #account_type').attr("readonly", "true");
                        $('#customer_ifsc_code, #disbursalApprove').addClass("disabled", true);
                        // window.location.reload();
                        disbursalDetails();
                    }
                }
            });
        });
    
        $('#updateDisbursalApprove').click(function(){
            var formData = $('#disbursalPayableDetails').serialize();
            $.ajax({
                url : '<?= base_url("updateDisbursalData") ?>',
                type : 'POST',
                data : formData,
                dataType : "json",
                // async: false,
                success: function(response) {
                    if(response.err){
                        catchError(response.err);
                    }else{
                        catchSuccess("Payable A/C Saved!");
                        $('#modeOfPayment, #payableAccount, #channel, #payable_amount, #updateDisbursalApprove').prop("disabled", true);
                        disbursalDetails();
                    }
                }
            });
        });
    });  
        // $("#updatePaymentReference, #updatePaymentReference").AddClass("disabled");
        
    function UpdateDisburseReferenceNo()
    {
        var formData = $('#FormPaymentReference').serialize();
        $.ajax({
            url : '<?= base_url("UpdateDisburseReferenceNo") ?>',
            type : 'POST',
            data : formData,
            dataType : "json",
            // async: false,
            success: function(response) {
                if(response.err){
                    catchError(response.err);
                }else{
                    catchSuccess("Reference No updated successfully!");
                    $('#updatePaymentReference, #updatePaymentReference').prop("disabled", true);
                    window.location.reload();
                }
            }
        });
    }

    function PayAmountToCustomer()
    {
        var lead_id = $("#lead_id").val();
        if (confirm('Are you sure to pay.')) {
            $.ajax({
                url : '<?= base_url("PayAmountToCustomer/") ?>'+lead_id,
                type : 'POST',
                dataType : "json",
                // async: false,
                beforeSend: function() {
                    $('#PayAmountToCustomer').html('<span class="spinner-border spinner-border-sm" role="status"></span>Processing...').addClass('disabled');
                },
                success: function(response) {
                    catchSuccess(response);
                    $("#PayAmountToCustomer").addClass("disabled", true);
                    // $("#updatePaymentReference, #updatePaymentReference").removeClass("disabled");
                    // window.location.reload();
                    disbursalDetails();
                },
                complete: function() {
                    $('#PayAmountToCustomer').html('Pay To Customer').removeClass('disabled');
                }
            });
        }
    }
    
             /////////////////////////////////update bank Details////////////////////////////////
        
            $('#UpdateBankDetails').on('click', function(){  
            var lead_id  = $('#leadIdForDocs').val();
            var formData = $('#UpdateBankDetailsDisbursal').serialize();
            $.ajax({
                url  : '<?= base_url("updateBankDetails/"); ?>'+lead_id,
                type : 'POST',
                data : formData,
                dataType : "json",
                success: function(response){
                    if(response.error){
                        catchError(response.error);
                    }else{
                        catchSuccess("Bank Details Updated Successfully.");
                        $('#customer_ifsc_code_edit, #customer_bank_name_edit, #customer_account_no_edit, #customer_confirm_account_no_edit, #customer_name_edit,#account_type_edit, .UpdateBankDetails').prop('disabled', true);
                    }
                }
            });
        });

</script>

