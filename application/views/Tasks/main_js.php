
<script>
    var csrf_token = $("input[name=csrf_token]").val();
    // $(document)
    	$(".js-select2").select2({
			closeOnSelect : false,
			placeholder : "SELECT",
// 			allowHtml: true,
			allowClear: true,
			tags: true
		}).css("float", 'left');
</script>
<script>
    $(function(){
        $('#checkDuplicateItem').click(function() {
            var checkList = [];
            $('.duplicate_id:checked').each(function () {
              checkList.push($(this).val());
            });
            if(checkList.length > 0)
            {
                $.ajax({
                    url : '<?= base_url("resonForDuplicateLeads") ?>',
                    type : 'POST',
                    dataType : "json",
                    async : false,
                    data : {checkList : checkList, csrf_token},
                    success : function(response) {
                        if(response.err){
                            catchError(response.err);
                        }else{
                            catchSuccess("Leads added in duplicate List.");
                            window.location.reload();
                        }
                    }
                });
            }else{
                catchError("Please select Leads to mark Duplicates .");
            }
        });
    });
    
    ////////////////////////////////////////// Allocate Leads ////////////////////////////////////////
    
    $(function(){
        $('#allocate').click(function () {
            var checkList = [];
            $('.duplicate_id:checked').each(function () {
               checkList.push($(this).val());
            });
            if(checkList.length > 0)
            {
                $.ajax({
                    url : '<?= base_url("allocateLeads") ?>',
                    type : 'POST',
                    dataType : "json",
                    data : {checkList : checkList, csrf_token},
                    success : function(response) {
                        if(response.err){
                            catchError(response.err);
                        }else{
                            catchSuccess("Leads added in Your Bucket.");
                            window.location.reload();
                        }
                    }
                });
            }else{
                catchError("Please select Leads to Assign Yourself.");
            }
        });
    });
    
    ////////////////////////////////////////// Re-Allocate Leads ////////////////////////////////////////
    
    $(function(){
        $('#reallocate').click(function () {
            var telecaller = $('#telecaller-name').val();
            var checkList = [];
            $('.duplicate_id:checked').each(function () {
               checkList.push($(this).val());
            });
            if(checkList.length > 0)
            {
                $.ajax({
                    url : '<?= base_url("reallocate") ?>',
                    type : 'POST',
                    dataType : "json",
                    data : {checkList : checkList, csrf_token},
                    success : function(response) {
                        if(response.err){
                            catchError(response.err);
                        }else{
                            catchSuccess("Leads Reallocated Successfully.");
                            window.location.reload();
                        }
                    }
                });
            }else{
                catchError("Please select leads for Re-Allocate.");
            }
        });
    });
    
    //////////////////////////// get old loan History ////////////////////////////////////////////////
    
    function viewOldHistory(lead_id)
    {
        $.ajax({
            url : '<?= base_url("viewOldHistory/") ?>'+lead_id,
            type : 'POST',
            dataType : "json",
            data : {csrf_token},
            beforeSend: function() {
                $("#cover").show();
            },
            success : function(response){
                $('#oldTaskHistory').empty();
                $('#oldTaskHistory').html(response);
            },
            complete: function() {
                $("#cover").fadeOut(1750)
            }
        });
    }
    
    function ViewCibilStatement(lead_id)
    {
        $.ajax({
            url : '<?= base_url("cibilStatement"); ?>',
            type : 'POST',
            data : {lead_id : lead_id, csrf_token},
            dataType : "json",
            beforeSend: function() {
                $("#cover").show();
            },
            success : function(response){
                $('#cibilStatement').html("");
                $('#cibilStatement').html(response);
            },
            complete: function() {
                $("#cover").fadeOut(1750)
            }
        });
    }
    
	function checkCustomerCibil()
	{
	    var lead_id = $('#lead_id').val();
	    autoCheckCustomerCibil(lead_id);
	}
	
	function autoCheckCustomerCibil(lead_id)
	{
	    if(lead_id != '')
        {
	        $.ajax({
                url : '<?= base_url("cibil") ?>',
                type : 'POST',
                data:{lead_id : lead_id, csrf_token},
                dataType: 'json',
                beforeSend: function() {
                    $('#checkCustomerCibil a').html('<span class="spinner-border spinner-border-sm" role="status"></span>Processing...').addClass('disabled');
                },
                success : function(response) {
                    if(response.err){
                        catchError(response.err);
                    }else{
                        catchSuccess(response);
                        ViewCibilStatement(lead_id);
                    }
                },
                complete: function() {
                    $('#checkCustomerCibil a').html('Check Cibil').removeClass('disabled');
                }
            });
	    } else {
            catchError("No record found.");
	    }
	}
    
    $('#divExpendReason').hide();
    
    function RejectedLoan() 
    {
        $('#divExpendReason2').hide();
        $('#divExpendReason').toggle();
        
        <?php if($_SESSION['isUserSession']['role'] == "Disbursal"){ ?>
        // $("#ResonBoxForRejectDisbursalLoan").html(prependFormDuplicateLead);
        <?php } else{ ?>
        // $("#ResonBoxForrejectLoan").html(prependFormDuplicateLead);
        <?php }  ?>
        
        $.ajax({
            url : '<?= base_url("getRejectionReasonMaster") ?>',
            type : 'POST',
            data : {csrf_token},
            dataType : 'json',
            beforeSend: function() {
                $('.reject-button').html('<span class="spinner-border spinner-border-sm" role="status"></span>Processing...').addClass('disabled');
            },
            success : function(response) {
                $("#resonForReject").empty();
                $("#resonForReject").append('<option value="">Select Reason</option>');
                $.each(response.rejectionLists, function(index, myarr){
                    $("#resonForReject").append('<option value="'+ myarr.reason +'">'+ myarr.reason +'</option>');
                });
            },
            complete: function() {
                $('.reject-button').html('REJECT').removeClass('disabled');
            }
        });
    }

    function ResonForRejectLoan()
    {
        var user_id = $("#user_id").val();
        var lead_id = $("#lead_id").val();
        var reason = $("#resonForReject").val();
        if(lead_id == ""){
            catchError("Lead ID is required.");
            return false;
        } else if(user_id == ""){
            catchError("Session Expore. Please re-login.");
            return false;
        } else if(reason == ""){
            catchError("Reason is required.");
            return false;
        }else{
            $.ajax({
                url : '<?= base_url("resonForRejectLoan") ?>',
                type : 'POST',
                data:{user_id : user_id, lead_id : lead_id, reason : reason, csrf_token},
                dataType : 'json',
                beforeSend: function() {
                    $("#btnRejectApplication").html('<span class="spinner-border spinner-border-sm" role="status"></span>Processing...').addClass('disabled');
                },
                success : function(response) {
                    if(response.msg){
                        $('#reson').empty();
                        catchSuccess(response.msg);
                        window.location.reload();
                    }else{
                        catchError(response.err);
                    }
                },
                complete: function() {
                    $("#btnRejectApplication").html('REJECT APPLICATION').removeClass('disabled');
                }
            });
        }
    }
    
    $("#divExpendReason2").hide();
    function holdLeadsRemark()
    {
        $("#divExpendReason").hide();
        $("#divExpendReason2").toggle();
    }
    function holdleads()
    {
        var lead_id = $("#lead_id").val();
        var holdremark = $("#hold_remark").val();

        if(lead_id == ""){
            catchError("Lead ID is required.");
            return false; 
        }else{
            $.ajax({
                url : '<?= base_url("holdleads") ?>',
                type : 'POST',
                data:{lead_id : lead_id, hold_remark : holdremark, csrf_token},
                dataType : 'json', 
                success : function(response) {
                    if(response.msg){
                        $('#reson').empty();
                        catchSuccess(response.msg);
                        window.location.reload();
                    }else{
                        catchError(response.err);
                    }
                } 
            });
        }
    }
	
    //////////////////////////////////////////////////////////////// Document Section /////////////////////////////////////////////////////////////////////////////////
    
    function sendRequestToCustomerForUploadDocs()
    {
        if (confirm("Are you sure to send request to the customer for upload docs!")) {
            var lead_id = $('#leadIdForDocs').val();
            $.ajax({
                url : '<?= base_url("sendRequestToCustomerForUploadDocs") ?>',
                type : 'POST',
                dataType : "json",
                data : {lead_id : lead_id, csrf_token},
                async: false,
                success : function(response) {
                    if(response == "true"){
                        $(".msg").show().fadeOut(2000);
                        $(".msg a").html("Request Send Successfully.");
                    }
                },
                error: function(XMLHttpRequest, textStatus, errorThrown) { 
                    $("#exampleModalLongTitle").html(textStatus +" : "+ errorThrown);
                    return false;
                }
            });
        }else{
            catchSuccess("Network Error, Try Again");
        }
    }

    function viewCustomerDocs(docs_id) {
        $.ajax({
            url : '<?= base_url("viewCustomerDocs/") ?>'+docs_id,
            type : 'POST',
            data : {csrf_token},
            dataType : "json",
            async: false,
            success : function(response) { 
                window.open(response, "_blank", "toolbar=yes,scrollbars=yes,resizable=yes,top=50,left=50,width=400,height=400");  
            },
            error: function(XMLHttpRequest, textStatus, errorThrown) { 
                $("#exampleModalLongTitle").html(textStatus +" : "+ errorThrown);
                return false;
            }
        });
    }

    function editCustomerDocs(docs_id) 
    {
        $('#formUploadDocs').show();
        $.ajax({
            url : '<?= base_url("viewCustomerDocsById/") ?>'+docs_id,  /*selectDocsTypes   editCustomerDocs*/
            type : 'POST',
            data : {csrf_token},
            dataType : "json",
            success : function(response) {
                $('#getDocId').html('<input type="hidden" name="docs_id" id="docs_id" value="'+ response.docs_id +'">');
                $("#btnSaveDocs").html("Update Docs");
                $("#docuemnt_type").val(response.docs);
                $("#document_name").val(response.type); 
                $("#password").val(response.pwd); 
            }
        });
    }
    
    function deleteCustomerDocs(docs_id) 
    { 
        $.ajax({
            url : '<?= base_url("deleteCustomerDocsById/") ?>'+docs_id,  /*selectDocsTypes   editCustomerDocs*/
            type : 'POST',
            data : {csrf_token},
            dataType : "json",
            success : function(response) {
                if(response['result'] == true){ 
                    catchSuccess("Document Deleted Successfully."); 
                    $('#formUserDocsData').trigger("reset");
                    $('#selectDocsTypes').trigger("reset");
                }else{ 
                    catchError("Process Failed, Try Again");
                }
                getDocs(response['lead_id']);
            }
            
        });
    }

    function viewCustomerPaidSlip(docs_id) 
    {
        $.ajax({
            url : '<?= base_url("viewCustomerPaidSlip/") ?>'+docs_id,
            type : 'POST',
            data : {csrf_token},
            dataType : "json",
            async: false,
            success : function(response) {
                window.open(response, "_blank", "toolbar=yes,scrollbars=yes,resizable=yes,top=50,left=50,width=400,height=400");
            },
            error: function(XMLHttpRequest, textStatus, errorThrown) { 
                $("#exampleModalLongTitle").html(textStatus +" : "+ errorThrown);
                return false;
            }
        });
    }

    function downloadCustomerdocs(docs_id) 
    {
        $.ajax({
            url : '<?= base_url("downloadCustomerdocs/") ?>'+docs_id,
            type : 'POST',
            data : {csrf_token},
            dataType : "json",
            async: false,
            success : function(response) {
                    window.location.href = response;
            },
            error: function(XMLHttpRequest, textStatus, errorThrown) { 
                $("#exampleModalLongTitle").html(textStatus +" : "+ errorThrown);
                return false;
            }
        });
    }
    
    function getCustomerDocs(lead_id)
    {
        getDocs(lead_id);
    }

    function getDocs(lead_id)
    {
        $.ajax({
            url : '<?= base_url("getDocsUsingAjax/") ?>' +lead_id,
            type : 'POST',
            data : {csrf_token},
            dataType : "json",
            // async: false,
            beforeSend: function() {
                $("#cover").show();
            },
            success : function(response) { 
                $('#docsHistory').html(response);
            },
            complete: function() {
                $("#cover").fadeOut(1750)
            }
        });
    }
    
    function sanctionleads()
    {
        var lead_id = $("#lead_id").val(); 

        if(lead_id == ""){
            catchError("Lead ID is required.");
            return false;
        }else{
            $.ajax({
                url : '<?= base_url("sanctionleads") ?>',
                type : 'POST',
                data:{lead_id : lead_id, csrf_token},
                dataType : 'json', 
                beforeSend: function() {
                    $('.lead-sanction-button').html('<span class="spinner-border spinner-border-sm" role="status"></span>Processing...').addClass('disabled');
                },
                success : function(response) {
                    if(response.msg){
                        $('#reson').empty();
                        catchSuccess(response.msg);
                        window.location.href='<?= base_url("dashboard") ?>';
                    }else{
                        catchError(response.err);
                    }
                },
                complete: function() {
                    $('.lead-sanction-button').html('RECOMMEND').removeClass('disabled');
                   
                }
            });
        }
    }
    
    function disbursalDetails()
    {
        $('#updateDisbursalApprove').prop('disabled', true);
        $('#divUpdateReferenceNo').hide();
        $('#formDisbursalOtherDetails').show();
        var lead_id = $("#lead_id").val();
        $.ajax({
            url : '<?= base_url("getSanctionDetails/") ?>'+lead_id,
            type : 'POST',
            data : {csrf_token},
            dataType : "json",
            success : function(response){
                var IFSC = "";
                var Branch = "";
                var accountNo = "CC Account Number";
                var holderName = "CC Holder Name";
                var bankName = "CC Bank Name";
                var accountType = "CC Type";
                var customer_account_no = response['CAM']['customer_account_no'];
                var customer_name = response['CAM']['customer_name'];
                var customer_bank = response['CAM']['customer_bank_name'];
                var account_type = response['CAM']['account_type'];

                if(response['CAM']['isDisburseBankAC'] == "YES"){
                    IFSC = "IFSC Code";
                    Branch = "Bank Branch";
                    accountNo = "Bank Account Number";
                    holderName = "Bank Holder Name";
                    bankName = "Bank Name";
                    accountType = "Account Type";

                    customer_account_no = response['CAM']['bankA_C_No'];
                    customer_name = response['CAM']['bankHolder_name'];
                    customer_bank = response['CAM']['bank_name'].toUpperCase();
                    account_type = response['CAM']['bank_account_type'].toUpperCase();
                }
                var viewScreenshort ="";
                if(response['Disburse']['screenshot'] != "" && response['Disburse']['screenshot'] != null){
                    viewScreenshort = ' | <a target="_blank" href="<?= base_url('upload/'); ?>'+ response['Disburse']['screenshot'] +'"><fa class="fa fa-picture-o"></fa></a>';
                }

                var html = '<table class="table table-bordered table-striped">';
                    html += '<tbody>';  
                    html += '<tr><th class="thbg">Application No</th><td>-</td><th class="thbg">Loan No</th><td>-</td></tr>';
                    html += '<tr><th class="thbg">'+ bankName +'</th><td class="tdbg">'+ ((customer_bank=='')?'-':customer_bank) +'</td><th class="thbg">'+ accountType +'</th><td class="tdbg">'+ ((account_type=='')?'-':account_type) +'</td></tr>';
                    html += '<tr><th class="thbg">'+ accountNo +'</th><td class="tdbg">'+ ((customer_account_no=='')?'-':customer_account_no) +'</td><th class="thbg">'+ holderName +'</th><td class="tdbg">'+ ((customer_name=='')?'-':customer_name) +'</td></tr>';
                    html += '<tr><th class="thbg">ROI (%)</th><td class="tdbg">'+ ((response['CAM']['roi']=='')?'-':Math.round(response['CAM']['roi'])) +'</td><th class="thbg">Sanctioned Amount (Rs.)</th><td class="tdbg">'+ Math.round(response['CAM']['loan_recomended']) +'</td></tr>';
                    html += '<tr><th class="thbg">Tenure (Days)</th><td class="tdbg">'+ ((response['CAM']['tenure']=='')?'-':response['CAM']['tenure']) +'</td><th class="thbg">Repayment Amount (Rs.)</th><td class="tdbg">'+ ((response['CAM']['repayment_amount']=='')?'-':Math.round(response['CAM']['repayment_amount'])) +'</td></tr>';
                    html += '<tr><th class="thbg">Admin Fee (Rs.)</th><td class="tdbg">'+ ((response['CAM']['processing_fee']=='')?'-':Math.round(response['CAM']['processing_fee'])) +'</td><th class="thbg">Admin Fee with GST (18 %) (Rs.)</th><td class="tdbg">'+ ((response['CAM']['adminFeeWithGST']=='')?'-':Math.round(response['CAM']['adminFeeWithGST'])) +'</td></tr>';
                    html += '<tr><th class="thbg">Net Disbursal Amount (Rs.)</th><td class="tdbg" colspan="3">'+ ((response['CAM']['net_disbursal_amount']=='')?'-':Math.round(response['CAM']['net_disbursal_amount'])) +'</td></tr>';
                    html += '<tr><th class="thbg">Disbursal Date</th><td class="tdbg">'+ ((response['CAM']['disbursal_date']=='')?'-':response['CAM']['disbursal_date']) +'</td><th class="thbg">Repayment Date</th><td class="tdbg">'+ ((response['CAM']['repayment_date']=='')?'-':response['CAM']['repayment_date']) +'</td></tr>';
                    html += '</tbody>';
                    html += '</table>';

                var html2 = '<table class="table table-bordered table-striped">';
                    html2 += '<tbody>';
                    html2 += '<tr><th class="thbg">Sent to Email</th><td class="tdbg">'+ ((response['CAM']['email']=='')?'-':response['CAM']['email']) +'</td><td class="tdbg">'+ ((response['Disburse']['loanAgreementRequest']=='')?'-':response['Disburse']['loanAgreementRequest']) +'</td><td class="tdbg"><a href="#" id="agreementLetter" target="_blank"><i class="fa fa-envelope-o" aria-hidden="true"></i></a></td></tr>';

                    html2 += '<tr><th class="thbg">Sent to Alternate Email</th><td class="tdbg">'+ ((response['CAM']['alternateEmail']=='')?'-':response['CAM']['alternateEmail']) +'</td><td colspan="2">'+ ((response['Disburse']['loanAgreementRequest2']=='')?'-':response['Disburse']['loanAgreementRequest2']) +'</td></tr>';
                    html2 += '<tr><th class="thbg">Email Sent Date</th><td class="tdbg">'+ ((response['Disburse']['agrementRequestedDate']=='')?'-':response['Disburse']['agrementRequestedDate']) +'</td><th class="thbg">Email Response</th><td class="tdbg">'+ ((response['Disburse']['loanAgreementResponse']=='')?'-':response['Disburse']['loanAgreementResponse']) +'</td></tr>';
                    html2 += '<tr><th class="thbg">Response Email Date</th><td class="tdbg">'+ ((response['Disburse']['agrementResponseDate']=='')?'-':response['Disburse']['agrementResponseDate']) +'</td><th class="thbg">Response Email</th><td class="tdbg">'+ ((response['Disburse']['responseEmail']=='')?'-':response['Disburse']['responseEmail']) +'</td></tr>';
                    html2 += '<tr><th class="thbg">Response Email IP</th><td colspan="3" >'+ ((response['Disburse']['agrementUserIP']=='' || response['Disburse']['agrementUserIP']==null)?'-':response['Disburse']['agrementUserIP']) +'</td></tr>';
                    html2 += '</tbody>';
                    html2 += '</table>';

                var html3 = '<table class="table table-bordered table-striped">';
                    html3 += '<tbody>';
                    html3 += '<tr><th class="thbg">Disbursal Bank</th><td class="tdbg">'+ ((response['Disburse']['company_account_no']=='' || response['Disburse']['company_account_no']==null)?'-':response['Disburse']['company_account_no']) +'</td><th>Channel</th><td class="tdbg">'+ ((response['Disburse']['channel']=='' || response['Disburse']['channel']==null)?'-':response['Disburse']['channel']) +'</td></tr>';
                    html3 += '<tr><th class="thbg">Disbursed Amount (Rs.)</th><td colspan="3">'+ ((response['CAM']['net_disbursal_amount']=='')?'-':response['CAM']['net_disbursal_amount']) +'</td></tr>';
                    html3 += '<tr><th class="thbg">Disbursal Referance no</th><td colspan="3">'+ ((response['Disburse']['disburse_refrence_no']=='')?'-':response['Disburse']['disburse_refrence_no']) +' '+ viewScreenshort +'</td></tr>';
                    html3 += '</tbody>';
                    html3 += '</table>';

                $("#payable_amount").val(response['CAM']['net_disbursal_amount']);
                $('#updateDisbursalApprove').prop('disabled', false);

                if(response['Disburse']['loanAgreementResponse'] == "APPROVED"){
                    $('#formDisbursalOtherDetails').show();
                }
                if(response['Disburse']['loan_status'] == "DISBURSE"){
                    $('#formDisbursalOtherDetails, #updateDisbursalApprove').hide();
                    $('#updateDisbursalApprove').prop('disabled', true);
                    $('#divUpdateReferenceNo').show();
                }
                
                // $('#formDisbursalOtherDetails').show(); 
                if(response['Disburse']['disburse_refrence_no'] != ""){
                    $('#formDisbursalOtherDetails').hide(); 
                }
                
                if(response['Disburse']['loan_status'] == "DISBURSED"){
                    $('#formDisbursalOtherDetails').hide();
                }

                $('#ViewDisbursalDetails').html(html);
                $('#ViewAgreementDetails').html(html2);
                $('#ViewDisbursalBankDetails').html(html3);
                $("#agreementLetter").attr("href", "<?= base_url('viewAgreementLetter/') ?>"+ lead_id);
            }
        });
    }
    
    
    function LeadRecommendation()
    {
        var formDataLeadRecommend = $('#FormSaveCAM').serialize();
        
        <?php if(company_id == 2 && product_id == 1){ ?>
            var url = "PaydayLeadRecommendation";
        <?php } if(company_id == 2 && product_id == 2){ ?>
            var url = "LACLeadRecommendation";
        <?php } ?>
        $.ajax({
            url : '<?= base_url() ?>' + url,
            type : 'POST',
            dataType : "json",
            data : formDataLeadRecommend,
            beforeSend: function() {
                $('#LeadRecommend').html('<span class="spinner-border spinner-border-sm mr-2" role="status"></span>Processing...').prop('disabled', true);
            },
            success : function(response){
                if(response.msg){
                    catchSuccess(response.msg);
                    window.location.reload();
                }else{
                    catchError(response.err);
                }
            },
            complete: function() {
                $('#LeadRecommend').html('Recomend').prop('disabled', false);
            },
        });
    }
    
    function getPersonalDetails(lead_id)
    {
        if(lead_id != "") {
            $.ajax({
                url : '<?= base_url("getPersonalDetails/") ?>'+lead_id,
                type : 'POST',
                data : {csrf_token},
                dataType : "json",
                success : function(response){ 
                    $("#leadID").val(lead_id);
                    $("#borrower_name").val((response['leadDetails'].name=='')?'-':response['leadDetails'].name);
                    $("#borrower_mname").val((response['leadDetails'].middle_name=='')?'-':response['leadDetails'].middle_name);
                    $("#borrower_lname").val((response['leadDetails'].surname=='')?'-':response['leadDetails'].surname);
                    $(".gender").val((response['leadDetails'].gender=='')?'-':response['leadDetails'].gender).prop("selected", "selected");
                    $("#dob").val((response['leadDetails'].dob=='')?'-':response['leadDetails'].dob);
                    $("#pancard").val((response['leadDetails'].pancard=='')?'-':response['leadDetails'].pancard);
                    $("#mobile").val((response['leadDetails'].mobile=='')?'-':response['leadDetails'].mobile); 
                    $("#alternate_no").val((response['leadDetails'].alternateMobileNo=='')?'-':response['leadDetails'].alternateMobileNo);
                    $("#emailID").val((response['leadDetails'].email=='')?'-':response['leadDetails'].email);

                    $("#state, #city").empty();
                    $.each(response.state, function(index, myarr){
                        if(myarr.state_id == undefined){
                            $("#state").append('<option value="" >Select</option>'); 
                        }else{
                            $("#state").append('<option value="'+ myarr.state_id +'" '+ myarr.s +'>'+ myarr.state_name +'</option>');
                        }
                    });
                    
                    $.each(response.city, function(index, myarr){
                        if(myarr.city_id == undefined){
                            $("#city").append('<option value="" >Select</option>'); 
                        }else{
                            $("#city").append('<option value="'+ myarr.city_name +'" '+ myarr.s +'>'+ myarr.city_name +'</option>');
                        }
                    });

                    $("#pincode").val((response['leadDetails'].pincode=='')?'-':response['leadDetails'].pincode);
                    $("#lead_initiated_date").val(response['leadDetails'].created_on);
                    $("#alternateEmail").val((response['leadDetails'].alternateEmail=='')?'-':response['leadDetails'].alternateEmail);
                    $("#aadhar").val((response['leadDetails'].aadhar=='')?'-':response['leadDetails'].aadhar);
                    $("#residentialType").val((response['leadDetails'].residentialType=='')?'-':response['leadDetails'].residentialType);
                    
                    $("#residence_address_line1").val((response['leadDetails'].residence_address_line1=='')?'-':response['leadDetails'].residence_address_line1);
                    $("#residence_address_line2").val((response['leadDetails'].residence_address_line2=='')?'-':response['leadDetails'].residence_address_line2);
                    
                    $("#presentAddressType").val((response['leadDetails'].residentialType=='')?'-':response['leadDetails'].residentialType);
                    $("#present_address_line1").val((response['leadDetails'].residence_address_line1=='')?'-':response['leadDetails'].residence_address_line1);
                    $("#present_address_line2").val((response['leadDetails'].residence_address_line2=='')?'-':response['leadDetails'].residence_address_line2);
                    
                    $("#employer_business").val((response['leadDetails'].employer_business=='')?'-':response['leadDetails'].employer_business);
                    $("#office_address").val((response['leadDetails'].office_address=='')?'-':response['leadDetails'].office_address);
                    $("#office_website").val((response['leadDetails'].office_website=='')?'-':response['leadDetails'].office_website);
                    $('#residential_proof').empty();
                    $('#residential_proof').append(response['residential_proof']); 

                    var html = '<table class="table table-bordered">';
                        html += '<tbody>';
                        html += '<tr><th>Borrower Name</th><td>'+ response['leadDetails'].name +'</td><th>Middle Name</th><td>'+ ((response['leadDetails'].middle_name=='')?'-':response['leadDetails'].middle_name) +'</td></tr>';
                        html += '<tr><th>Surname</th><td>'+ ((response['leadDetails'].surname=='')?'-':response['leadDetails'].surname) +'</td><th>Gender</th><td>'+ ((response['leadDetails'].gender=='')?'-':response['leadDetails'].gender) +'</td></tr>';
                        html += '<tr><th>DOB</th><td>'+ ((response['leadDetails'].dob=='')?'-':response['leadDetails'].dob) +'</td><th>PAN</th><td>'+ ((response['leadDetails'].pancard=='')?'-':response['leadDetails'].pancard) +'</td></tr>';
                        html += '<tr><th>Mobile</th><td>'+ ((response['leadDetails'].mobile=='')?'-':response['leadDetails'].mobile) +'</td><th>Alternate Mobile</th><td>'+ ((response['leadDetails'].alternateMobileNo=='')?'-':response['leadDetails'].alternateMobileNo) +'</td></tr>';
                        html += '<tr><th>Email Id</th><td>'+ ((response['leadDetails'].email=='')?'-':response['leadDetails'].email) +'</td><th>State</th><td>'+ response['stateName'].state.toUpperCase() +'</td></tr>';
                        html += '<tr><th>City</th><td>'+response['cityName'] +'</td><th>Pincode</th><td>'+ ((response['leadDetails'].pincode=='')?'-':response['leadDetails'].pincode) +'</td></tr>';
                        html += '<tr><th>Initiated On</th><td>'+ response['leadDetails'].created_on +'</td><th>Post Office</th><td>-</td></tr>';
                        html += '<tr><th>Alternate Email Id</th><td>'+ ((response['leadDetails'].alternateEmail=='')?'-':response['leadDetails'].alternateEmail) +'</td><th>Aadhar</th><td>'+((response['leadDetails'].aadhar=='')?'-':response['leadDetails'].aadhar) +'</td></tr>';
                        html += '<tr><th>Residence Type</th><td>'+ ((response['leadDetails'].residentialType.toUpperCase()=='')?'-':response['leadDetails'].residentialType.toUpperCase()) +'</td><th>Residential Proof</th><td>'+ ((response['leadDetails'].residential_proof.toUpperCase()=='')?'-':response['leadDetails'].residential_proof.toUpperCase()) +'</td></tr>';
                        html += '<tr><th>Residence Address Line 1</th><td>'+ ((response['leadDetails'].residence_address_line1.toUpperCase()=='')?'-':response['leadDetails'].residence_address_line1.toUpperCase()) +'</td><th>Residence Address Line 2</th><td>'+ ((response['leadDetails'].residence_address_line2.toUpperCase()=='')?'-':response['leadDetails'].residence_address_line2.toUpperCase()) +'</td></tr>';
                        html += '<tr><th>Present Address different from Residence Address ?</th><td colspan="3">'+ ((response['leadDetails'].isPresentAddress=='')?'-':response['leadDetails'].isPresentAddress) +'</td></tr>';
                        html += '<tr><th>Present Address</th><td>'+ ((response['leadDetails'].presentAddressType.toUpperCase()=='')?'-':response['leadDetails'].presentAddressType.toUpperCase()) +'</td><th></th><td></td></tr>';
                        html += '<tr><th>Present Address Line 1</th><td>'+ ((response['leadDetails'].present_address_line1.toUpperCase()=='')?'-':response['leadDetails'].present_address_line1) +'</td><th>Present Address Line 2</th><td>'+ ((response['leadDetails'].present_address_line2.toUpperCase()=='')?'-':response['leadDetails'].present_address_line2.toUpperCase()) +'</td></tr>';
                        html += '<tr><th>Employer/ Business name</th><td>'+ ((response['leadDetails'].employer_business.toUpperCase()=='')?'-':response['leadDetails'].employer_business.toUpperCase()) +'</td><th>Office Address</th><td>'+ ((response['leadDetails'].office_address.toUpperCase()=='')?'-':response['leadDetails'].office_address.toUpperCase()) +'</td></tr>';
                        html += '<tr><th>Office Website</th><td>'+ ((response['leadDetails'].office_website.toUpperCase()=='')?'-':response['leadDetails'].office_website.toUpperCase()) +'</td><th></th><td></td></tr>';
                        html += '</tbody>';
                        html += '</table>';

                    $('#ViewPersonalDetails').html(html);
                }
            });
        } else {
            catchError("Lead Id Not Found.");
        }
    }
    
    function getCam()
    {
        var lead_id = $('#lead_id').val();
        if(lead_id != "") {
            $.ajax({
                url : '<?= base_url("getCAMDetails/") ?>'+lead_id,
                type : 'POST',
                data : {csrf_token},
                dataType : "json",
                success : function(response){
                    $(".leadID").val(lead_id);
                    <?php if(company_id == 2 && product_id == 1){ ?>
                        getPaydayCAM(response);
                    <?php } if(company_id == 2 && product_id == 2){ ?>
                        getLACCAM(response);
                    <?php } ?>
                }
            });
        } else {
            catchError("Lead Id Not Found.");
        }
    }

    function getLACCAM(response)
    {
        $('#userType').val(response['camDetails'].userType);
        $('#status').val(response['camDetails'].status);
        $('#cibil').val(response['camDetails'].cibil);
        $('#Active_CC').val(response['camDetails'].Active_CC);
        $('#cc_statementDate').val(response['camDetails'].cc_statementDate);
        $('#cc_paymentDueDate').val(response['camDetails'].cc_paymentDueDate);
        $('#customer_bank_name').val(response['camDetails'].customer_bank_name);
        // $('#account_type').val(response['camDetails'].account_type);
        $('#account_type').empty();
        var s = "";
        if(response['camDetails'].account_type == "AMEX"){
            s = 'selected';
            $('#account_type').html('<option value="'+response['camDetails'].account_type+'" '+ s +'>'+response['camDetails'].account_type+'</option>');
        }else{
            var accountTypeArr = ['MASTER', 'VISA'];
            $.each(accountTypeArr, function(index, arr){
                s = "";
                if(response['camDetails'].account_type == arr){
                    s = 'selected';
                }
                $('#account_type').append('<option value="'+arr+'" '+ s +'>'+arr+'</option>');
            });
        }

        $('#customer_account_no').val(response['camDetails'].customer_account_no);
        $('#customer_confirm_account_no').val(response['camDetails'].customer_confirm_account_no);
        $('#customer_name').val(response['camDetails'].customer_name);
        $('#cc_limit').val(response['camDetails'].cc_limit);
        $('#cc_outstanding').val(response['camDetails'].cc_outstanding);
        $('#max_eligibility').val(response['camDetails'].max_eligibility);

        if(response['camDetails'].cc_name_Match_borrower_name == "YES"){
            $('#cc_name_Match_borrower_name_YES').prop('checked', true);
            $('#cc_name_Match_borrower_name_NO').prop('checked', false);
        }else{
            $('#cc_name_Match_borrower_name_YES').prop('checked', false);
            $('#cc_name_Match_borrower_name_NO').prop('checked', true);
        }

        if(response['camDetails'].emiOnCard == "YES"){
            $('#emiOnCard_YES').prop('checked', true);
            $('#emiOnCard_NO').prop('checked', false);
        }else{
            $('#emiOnCard_YES').prop('checked', false);
            $('#emiOnCard_NO').prop('checked', true);
        }
        
        if(response['camDetails'].DPD30Plus == "YES"){
            $('#DPD30Plus_YES').prop('checked', true);
            $('#DPD30Plus_NO').prop('checked', false);
        }else{
            $('#DPD30Plus_YES').prop('checked', false);
            $('#DPD30Plus_NO').prop('checked', true);
        }

        if(response['camDetails'].cc_statementAddress == "YES"){
            $('#cc_statementAddress_YES').prop('checked', true);
            $('#cc_statementAddress_NO').prop('checked', false);
        }else{
            $('#cc_statementAddress_YES').prop('checked', false);
            $('#cc_statementAddress_NO').prop('checked', true);
        }

        if(response['camDetails'].last3monthDPD == "YES"){
            $('#last3monthDPD_YES').prop('checked', true);
            $('#last3monthDPD_NO').prop('checked', false);
            $('#divhigherDPDLast3month').show();
        }else{
            $('#divhigherDPDLast3month').hide();
            $('#last3monthDPD_YES').prop('checked', false);
            $('#last3monthDPD_NO').prop('checked', true);
        }

        $('#higherDPDLast3month').val(response['camDetails'].higherDPDLast3month);


        if(response['camDetails'].isDisburseBankAC == "YES"){
            $('#isDisburseBankAC').prop('checked', true);
            $('#customer_ifsc_code').html('<option value="'+ response['camDetails'].bankIFSC_Code +'">'+ response['camDetails'].bankIFSC_Code +'</option>');
            $('#bank_name').val(response['camDetails'].bank_name);
            $('#bank_branch').val(response['camDetails'].bank_branch);
            $('#bankA_C_No').val(response['camDetails'].bankA_C_No);
            $('#confBankA_C_No').val(response['camDetails'].confBankA_C_No);
            $('#bankHolder_name').val(response['camDetails'].bankHolder_name);
            $('#bank_account_type').val(response['camDetails'].bank_account_type);

            $('#disbursalBankDetails').show();
        }else{
            $('#disbursalBankDetails').hide();
            $('#isDisburseBankAC').prop('uncheck', false);
            $('#bankIFSC_Code', '#bank_name', '#bank_branch', '#bankA_C_No', '#confBankA_C_No', '#bankHolder_name', '#bank_account_type').val('');
        } 
        $('#loan_applied').val(response['leadDetails'].loan_amount);
        $('#loan_recomended').val(Math.round(response['camDetails'].loan_recomended));
        $('#processing_fee').val(Math.round(response['camDetails'].processing_fee));
        $('#roi').val(response['camDetails'].roi);
        $('#adminFeeWithGST').val(Math.round(response['camDetails'].adminFeeWithGST));
        $('#net_disbursal_amount').val(Math.round(response['camDetails'].net_disbursal_amount));
        $('#disbursal_date').val(response['camDetails'].disbursal_date);
        $('#repayment_date').val(response['camDetails'].repayment_date);
        $('#tenure').val(response['camDetails'].tenure);
        $('#repayment_amount').val(Math.round(response['camDetails'].repayment_amount));
        $('#special_approval').val(response['camDetails'].special_approval);
        $('#deviationsApprovedBy').val(response['camDetails'].deviationsApprovedBy);
        $('#changeROI').val(response['camDetails'].changeROI);
        $('#changeFee').val(response['camDetails'].changeFee);
        $('#changeLoanAmount').val(response['camDetails'].changeLoanAmount);
        $('#changeTenure').val(response['camDetails'].changeTenure);
        $('#changeRTR').val(response['camDetails'].changeRTR);
        $('#remark').val(response['camDetails'].remark);
        var status = $('#status').val();

        var html = '<table class="table table-bordered">';
            html += '<tbody>';
            html += '<tr><th>User Type</th><td>'+ response['camDetails'].userType +'</td><th>Status</th><td>'+ response['camDetails'].status +'</td></tr>';
            html += '<tr><th>CIBIL Score</th><td>'+ response['camDetails'].cibil +'</td><th>No of Active CC</th><td>'+ response['camDetails'].Active_CC +'</td></tr>';
            html += '<tr><th>CC Bank</th><td>'+ response['camDetails'].customer_bank_name.toUpperCase() +'</td><th>CC Type</th><td>'+ response['camDetails'].account_type.toUpperCase() +'</td></tr>';
            html += '<tr><th>CC No.</th><td>'+ response['camDetails'].customer_account_no +'</td><th>Confirm CC No.</th><td>'+ response['camDetails'].customer_confirm_account_no +'</td></tr>';
            html += '<tr><th>CC Statement Date.</th><td>'+response['camDetails'].cc_statementDate +'</td><th>CC Payment Due Date.</th><td>'+ response['camDetails'].cc_paymentDueDate +'</td></tr>';
            html += '<tr><th>CC Limit</th><td>'+ response['camDetails'].cc_limit +'</td><th>CC Outstanding</th><td>'+ response['camDetails'].cc_outstanding +'</td></tr>';
            html += '<tr><th>Name As on Card</th><td>'+ response['camDetails'].customer_name +'</td><th>Max Eligibility</th><td>'+ response['camDetails'].max_eligibility +'</td></tr>';
            html += '<tr><th>CC Name matches with Borrower Name ?</th><td colspan="3">'+ response['camDetails'].cc_name_Match_borrower_name +'</td></tr>';
            html += '<tr><th>EMI on Card ?</th><td colspan="3">'+ response['camDetails'].emiOnCard +'</td></tr>';
            html += '<tr><th>30+ DPD in last 3 mths in any CC ?</th><td colspan="3">'+ response['camDetails'].DPD30Plus +'</td></tr>';
            html += '<tr><th>CC Statement Address same as Present address ?</th><td colspan="3">'+ response['camDetails'].cc_statementAddress +'</td></tr>';
            html += '<tr><th>DPD On CC in Last 3 months</th><td colspan="3">'+ response['camDetails'].last3monthDPD +'</td></tr>';
            // html += '<tr><th>Disburse to Bank Account ?</th><td colspan="3">'+ response['camDetails'].higherDPDLast3month +'</td></tr>';
            html += '<tr><th>Is Disburse to Bank Account ?</th><td colspan="3">'+ response['camDetails'].isDisburseBankAC +'</td></tr>';
            html += '<tr><th>IFSC Code</th><td colspan="3">'+ response['camDetails'].bankIFSC_Code +'</td></tr>';
            html += '<tr><th>Bank Name</th><td>'+ response['camDetails'].bank_name +'</td><th>Bank Branch</th><td>'+ response['camDetails'].bank_branch +'</td></tr>';
            html += '<tr><th>A/C No.</th><td>'+ response['camDetails'].bankA_C_No +'</td><th>Confirm A/C No.</th><td>'+ response['camDetails'].confBankA_C_No +'</td></tr>';
            html += '<tr><th>A/C Holder Name</th><td>'+ response['camDetails'].bankHolder_name +'</td><th>Account Type</th><td>'+ response['camDetails'].bank_account_type +'</td></tr>';
            html += '<tr><th>Loan Applied (Rs.)</th><td>'+ response['camDetails'].loan_applied +'</td><th>Loan Recommended (Rs.)</th><td>'+ response['camDetails'].loan_recomended +'</td></tr>';
            html += '<tr><th>Admin Fee (Rs.)</th><td>'+ response['camDetails'].processing_fee +'</td><th>ROI (%)</th><td>'+ response['camDetails'].roi +'</td></tr>';
            html += '<tr><th>Admin Fee with GST (18 %) (Rs.)</th><td>'+ response['camDetails'].adminFeeWithGST +'</td><th>Net Disbursal Amount (Rs.)</th><td>'+ response['camDetails'].net_disbursal_amount +'</td></tr>';
            html += '<tr><th>Disbursal Date</th><td>'+ response['camDetails'].disbursal_date +'</td><th>Repayment Date</th><td>'+ response['camDetails'].repayment_date +'</td></tr>';
            html += '<tr><th>Tenure (days)</th><td>'+ response['camDetails'].tenure +'</td><th>Repayment Amount (Rs.)</th><td>'+ response['camDetails'].repayment_amount +'</td></tr>';
            html += '<tr><th>Reference</th><td>'+ response['camDetails'].special_approval +'</td><th>Deviations Approved By</th><td>'+ response['camDetails'].deviationsApprovedBy +'</td></tr>';
            html += '<tr><th>Change in ROI : </th><td>'+ response['camDetails'].changeROI +'</td><th>Change in Fees : </th><td>'+ response['camDetails'].changeFee +'</td></tr>';
            html += '<tr><th>Higher Loan amount : </th><td>'+ response['camDetails'].changeLoanAmount +'</td><th>Tenor more than norms : </th><td>'+ response['camDetails'].changeTenure +'</td></tr>';
            html += '<tr><th>Note</th><td colspan="3">'+ response['camDetails'].remark +'</td></tr>';

            html += '</tbody>';
            html += '</table>';
        $('#ViewCAMDetails').html(html);
    }
    
    function getPaydayCAM(response)
    {
        $('#userType').val(response['camDetails'].userType);
        $('#status').val(response['camDetails'].status);
        $('#cibil').val(response['camDetails'].cibil);
        if(response['camDetails'].isDisburseBankAC == "YES"){
            $('#isDisburseBankAC').prop('checked', true);
            $('#customer_ifsc_code').html('<option value="'+ response['camDetails'].bankIFSC_Code +'">'+ response['camDetails'].bankIFSC_Code +'</option>');
            $('#bank_name').val(response['camDetails'].bank_name);
            $('#bank_branch').val(response['camDetails'].bank_branch);
            $('#bankA_C_No').val(response['camDetails'].bankA_C_No);
            $('#confBankA_C_No').val(response['camDetails'].confBankA_C_No);
            $('#bankHolder_name').val(response['camDetails'].bankHolder_name);
            $('#bank_account_type').val(response['camDetails'].bank_account_type);

            $('#disbursalBankDetails').show();
        }else{
            $('#disbursalBankDetails').hide();
            $('#isDisburseBankAC').prop('uncheck', false);
            $('#bankIFSC_Code', '#bank_name', '#bank_branch', '#bankA_C_No', '#confBankA_C_No', '#bankHolder_name', '#bank_account_type').val('');
        } 
        $('#loan_applied').val(response['leadDetails'].loan_amount);
        $('#loan_recomended').val(Math.round(response['camDetails'].loan_recomended));
        $('#processing_fee').val(Math.round(response['camDetails'].processing_fee));
        $('#roi').val(response['camDetails'].roi);
        $('#adminFeeWithGST').val(Math.round(response['camDetails'].adminFeeWithGST));
        $('#net_disbursal_amount').val(Math.round(response['camDetails'].net_disbursal_amount));
        $('#disbursal_date').val(response['camDetails'].disbursal_date);
        $('#repayment_date').val(response['camDetails'].repayment_date);
        $('#tenure').val(response['camDetails'].tenure);
        $('#repayment_amount').val(Math.round(response['camDetails'].repayment_amount));
        $('#special_approval').val(response['camDetails'].special_approval);
        $('#deviationsApprovedBy').val(response['camDetails'].deviationsApprovedBy);
        $('#changeROI').val(response['camDetails'].changeROI);
        $('#changeFee').val(response['camDetails'].changeFee);
        $('#changeLoanAmount').val(response['camDetails'].changeLoanAmount);
        $('#changeTenure').val(response['camDetails'].changeTenure);
        $('#changeRTR').val(response['camDetails'].changeRTR);
        $('#remark').val(response['camDetails'].remark);
        var status = $('#status').val();

        var html = '<table class="table table-bordered">';
            html += '<tbody>';
            html += '<tr><th>User Type</th><td>'+ response['camDetails'].userType +'</td><th>Status</th><td>'+ response['camDetails'].status +'</td></tr>';
            html += '<tr><th>CIBIL Score</th><td>'+ response['camDetails'].cibil +'</td><th>IFSC Code</th><td colspan="3">'+ response['camDetails'].bankIFSC_Code +'</td></tr>';
            html += '<tr><th>Bank Name</th><td>'+ response['camDetails'].bank_name +'</td><th>Bank Branch</th><td>'+ response['camDetails'].bank_branch +'</td></tr>';
            html += '<tr><th>A/C No.</th><td>'+ response['camDetails'].bankA_C_No +'</td><th>Confirm A/C No.</th><td>'+ response['camDetails'].confBankA_C_No +'</td></tr>';
            html += '<tr><th>A/C Holder Name</th><td>'+ response['camDetails'].bankHolder_name +'</td><th>Account Type</th><td>'+ response['camDetails'].bank_account_type +'</td></tr>';
            html += '<tr><th>Loan Applied (Rs.)</th><td>'+ response['camDetails'].loan_applied +'</td><th>Loan Recommended (Rs.)</th><td>'+ response['camDetails'].loan_recomended +'</td></tr>';
            html += '<tr><th>Admin Fee (Rs.)</th><td>'+ response['camDetails'].processing_fee +'</td><th>ROI (%)</th><td>'+ response['camDetails'].roi +'</td></tr>';
            html += '<tr><th>Admin Fee with GST (18 %) (Rs.)</th><td>'+ response['camDetails'].adminFeeWithGST +'</td><th>Net Disbursal Amount (Rs.)</th><td>'+ response['camDetails'].net_disbursal_amount +'</td></tr>';
            html += '<tr><th>Disbursal Date</th><td>'+ response['camDetails'].disbursal_date +'</td><th>Repayment Date</th><td>'+ response['camDetails'].repayment_date +'</td></tr>';
            html += '<tr><th>Tenure (days)</th><td>'+ response['camDetails'].tenure +'</td><th>Repayment Amount (Rs.)</th><td>'+ response['camDetails'].repayment_amount +'</td></tr>';
            html += '<tr><th>Reference</th><td>'+ response['camDetails'].special_approval +'</td><th>Deviations Approved By</th><td>'+ response['camDetails'].deviationsApprovedBy +'</td></tr>';
            html += '<tr><th>Change in ROI : </th><td>'+ response['camDetails'].changeROI +'</td><th>Change in Fees : </th><td>'+ response['camDetails'].changeFee +'</td></tr>';
            html += '<tr><th>Higher Loan amount : </th><td>'+ response['camDetails'].changeLoanAmount +'</td><th>Tenor more than norms : </th><td>'+ response['camDetails'].changeTenure +'</td></tr>';
            html += '<tr><th>Note</th><td colspan="3">'+ response['camDetails'].remark +'</td></tr>';

            html += '</tbody>';
            html += '</table>';
        $('#ViewCAMDetails').html(html);
    }
    
    $(document).ready(function(){

        $('#state').change(function() {
            var state_id = $(this).val();
            if (state_id != '') {
                $.ajax({
                    url: "<?= base_url('getCity/'); ?>" +state_id,
                    type: "POST",
                    dataType : "json",
                    success: function(response) {
                        $("#city").empty();
                        $("#city").append('<option value="">Select</option>');
                        $.each(response.city, function(index, myarr) { 
                            $("#city").append('<option value="'+ myarr.city +'">'+ myarr.city +'</option>');
                        });
                    }
                });
            } else {
                $('#city').html('<option value="">Select City</option>');
            }
        });

        $('#roi').change(function(){
            var roi = $(this).val();
            if(roi == 1){
                $(this).val(1);
                $("#changeROI").val('NO').css('color', '#000');
            }else if(roi <= 0){
                $(this).val(1);
                $("#changeROI").val('NO').css('color', '#000');
            }else{
                $("#changeROI").val('YES').css('color', 'red');
            }
        });
   
        $('#loan_recomended').change(function(){
            var loan_applied = $("#loan_applied").val();
            var loan_recomended = $(this).val();
            
            if(loan_recomended <= loan_applied)
            {
                var processing_fee = ((loan_recomended * 2) / 100);
                $("#processing_fee").val(Math.round(processing_fee));
                var gst = ((processing_fee * 100) / 118);
                var newGST = (processing_fee + (processing_fee - gst));
                var adminfeegst = parseFloat(newGST).toFixed(2);
                $("#adminFeeWithGST").val(Math.round(adminfeegst));


                if(loan_recomended == loan_applied){
                    $(this).val(loan_applied);
                    $("#changeLoanAmount").val('NO').css('color', '#000');
                }else if(loan_recomended > loan_applied){
                    $(this).val(loan_applied);
                    $("#changeLoanAmount").val('NO').css('color', '#000');
                }else if(loan_recomended <= 0){
                    $(this).val(loan_applied);
                    $("#changeLoanAmount").val('NO').css('color', '#000');
                }else{
                    $("#changeLoanAmount").val('YES').css('color', 'red');
                }
                net_disbursal_amount(loan_recomended, adminfeegst);
            }else{
                
                $("#loan_recomended").val(Math.round(loan_applied));
            }
        }); 
        
        $('#processing_fee_percent').change(function(){
            var admin_fee_percent = $(this).val();
            var loan_applied = $("#loan_applied").val();
            var loan_recomended = $('#loan_recomended').val();    
            
            var admin_fee = ((loan_recomended*admin_fee_percent)/100).toFixed(2);
            var gst = ((admin_fee * 100) / 118);
            var newGST = parseFloat(admin_fee) + parseFloat(admin_fee - gst);
            var disubrsal_amnt = loan_recomended-newGST;
            
            $("#processing_fee").val(Math.round(admin_fee));
            var amountwithgst = parseFloat(newGST).toFixed(2);
            $("#adminFeeWithGST").val(Math.round(amountwithgst));
            $("#net_disbursal_amount").val(Math.round(disubrsal_amnt)); 
        }); 

        $('#processing_fee').change(function(){
            var processing_fee = $(this).val();
            var loan_recomended = $('#loan_recomended').val();

            var gst = ((processing_fee * 100) / 118);
            var newGST = parseFloat(processing_fee) + parseFloat(processing_fee - gst);
            $("#adminFeeWithGST").val('');
            var adminfeewithGst = parseFloat(newGST).toFixed(2);
            $("#adminFeeWithGST").val(Math.round(adminfeewithGst));
            
            var adminfeePer = ((processing_fee * 100) / loan_recomended); //processing_fee_percent
            $("#processing_fee_percent").val(adminfeePer.toFixed(2));

            if(processing_fee <= 0){
                $(this).val(processing_fee);
                $("#changeFee").val('NO').css('color', '#000');
            }else{
                $("#changeFee").val('YES').css('color', 'red');
            }
            net_disbursal_amount(loan_recomended, newGST);
        });
        
        $('#aadhar').keyup(function() {
            $(this).attr("maxLength", "14");
            var value = $(this).val();
            value = value.replace(/\D/g, "").split(/(?:([\d]{4}))/g).filter(s => s.length > 0).join(" ");
            $(this).val(value);
        });
            
        $('#sameResidenceAddress').click(function(){
            var sameAddress = $(this).val();
            var residence_address = $("#residence_address").val();
            if($(this).is(":checked")){
                $('#office_address').val(residence_address);
            }else{
                $('#office_address').val('');
            }
        });

        $('#isPresentAddress').click(function(){
            if($(this).is(":checked")){
                $('#present_address').hide();
                var residence_address_line1 = $("#residence_address_line1").val();
                var residence_address_line2 = $("#residence_address_line2").val();
                //isAddressLine_1_or_2(residence_address_line1, residence_address_line2);
            }else{
                $('#present_address').show();
            }
            
        });

        $("input[name=last3monthDPD]").click(function(){
            var selValueByClass = $(".last3monthDPD:checked").val();
            if(selValueByClass == "YES"){
                $('#divhigherDPDLast3month').show().attr('margin-top', '0px');
            }else{
                $('#divhigherDPDLast3month').hide().attr('margin-top', '10px');
            }
        });

        $('#isDisburseBankAC').attr('unchecked', true);
        $('#disbursalBankDetails').hide();
        $("#isDisburseBankAC").click(function(){
            var isDisburseBankAC = $("#isDisburseBankAC:checked").val();
            if(isDisburseBankAC == "YES"){
                $('#disbursalBankDetails').show();
            }else{
                $('#disbursalBankDetails').hide();
            }
        });

        $('#residence_address_line1').on('change', function(){
            var residence_address_line1 = $(this).val();
            var residence_address_line2 = $("#residence_address_line2").val();
            isAddressLine_1_or_2(residence_address_line1, residence_address_line2);
        });

        $('#residence_address_line2').on('change', function(){
            var residence_address_line1 = $("#residence_address_line1").val();
            var residence_address_line2 = $(this).val();
            isAddressLine_1_or_2(residence_address_line1, residence_address_line2);
        });

        $('#cc_limit').keyup(function(e){
            if (/\D/g.test(this.value))
            {
                this.value = this.value.replace(/\D/g, '');
            }
        });

        $('#cc_outstanding').val(0);
        $('#cc_limit').val(0);
        $('#max_eligibility').val(0);

        $('#cc_limit').on('change', function(){
            var cc_limit = $(this).val();
            var cc_outstanding = $('#cc_outstanding').val();
            max_eligibility(cc_limit, cc_outstanding);
        });

        $('#cc_outstanding').on('change', function(){
            var cc_outstanding = $(this).val();
            var cc_limit = $('#cc_limit').val();
            max_eligibility(cc_limit, cc_outstanding);
        });

        $('#disbursal_date').on('change', function(){
            var disbursal_date = $(this).val();
            var roi = $('#roi').val();
            var repayment_date = $('#repayment_date').val();
            tenureAndRepaymentAmount(disbursal_date, repayment_date, roi);
        });

        $('#repayment_date').on('change', function(){
            var repayment_date = $(this).val();
            var disbursal_date = $('#disbursal_date').val();
            var roi = $('#roi').val();
            tenureAndRepaymentAmount(disbursal_date, repayment_date, roi);
        });

        $('#roi').on('change', function(){
            var repayment_date = $("#repayment_date").val();
            var disbursal_date = $('#disbursal_date').val();
            var roi = $(this).val();
            tenureAndRepaymentAmount(disbursal_date, repayment_date, roi);
        });

        var lengthCount = 0;
        $('#customer_account_no, #customer_confirm_account_no').keyup(function() {
            
            var account_type = $('#account_type').val();
            if(lengthCount == 0){
                catchError('Please select CC Bank Name.');
                $(this).val('');
            }else if(account_type == ""){
                catchError('Please select CC Type.');
                $(this).val('');
            }else{
                if(lengthCount == 19){
                    $(this).attr("maxLength", lengthCount);
                    var value = $(this).val();
                    value = value.replace(/\D/g, "").split(/(?:([\d]{4}))/g).filter(s => s.length > 0).join(" ");
                    $(this).val(value);
                }else{
                    $(this).attr("maxLength", lengthCount);
                    var value = $(this).val();
                    value = value.replace(/^(.{4})(.{6})(.{4})$/, "$1 $2 $3");
                    $(this).val(value);
                }
            }
        });

        $('#customer_bank_name').on('change', function(){
            lengthCount = 0;
            $('#customer_account_no, #customer_confirm_account_no').val('');
            var customer_bank_name = $(this).val();
            if(customer_bank_name == "American Express"){
                var account_type = $('#account_type').val();
                if(account_type != "AMEX"){
                    lengthCount = 17;
                    $('#account_type').html('<option value="AMEX">AMEX</option>');
                }
            }else{
                lengthCount = 19;
                $('#account_type').html('<option value="">Select</option><option value="Master">Master</option><option value="Visa">Visa</option>');
            }
            var disbursal_date = $('#disbursal_date').val();
            var roi = $('#roi').val();
            tenureAndRepaymentAmount(disbursal_date, repayment_date, roi);
        });

        $('#customer_name').on('change', function(){
            var customer_name = $(this).val();
            var borrower_name = $("#borrower_name").val();
            if(customer_name == borrower_name){
                var account_type = $('#account_type').val();
                $('#cc_name_Match_borrower_name_YES').prop('checked', true);
                $('#cc_name_Match_borrower_name_NO').prop('unchecked', false);
                $('#thumb_cc_name_Match_borrower_name').html('<i class="fa fa-thumbs-o-up" style="color : green; font-size : 18px;"></i>');
            }else{
                $('#cc_name_Match_borrower_name_YES').prop('unchecked', false);
                $('#cc_name_Match_borrower_name_NO').prop('checked', true);
                $('#thumb_cc_name_Match_borrower_name').html('<i class="fa fa-thumbs-o-down" style="color : red; font-size : 18px;"></i>');
            }
            var disbursal_date = $('#disbursal_date').val();
            var roi = $('#roi').val();
            tenureAndRepaymentAmount(disbursal_date, repayment_date, roi);
        });

        $('#bankA_C_No, #confBankA_C_No').keyup(function() {
            $(this).attr("maxLength", "19");
            var value = $(this).val();
            value = value.replace(/\D/g, "").split(/(?:([\d]{4}))/g).filter(s => s.length > 0).join(" ");
            $(this).val(value);
        });

    });

    function net_disbursal_amount(loan_recomended, processing_feeWithGST) {
        return $('#net_disbursal_amount').val(Math.round(loan_recomended - processing_feeWithGST));
    }

    function tenureAndRepaymentAmount(disbursal_date, repayment_date, roi)
    {
        if(disbursal_date != "" && repayment_date != "") 
        {
            var start = moment(disbursal_date, "DD-MM-YYYY");
            var future = moment(repayment_date, "DD-MM-YYYY");
            var tenure = future.diff(start, 'days'); // 9

            var loan_recomended = $('#loan_recomended').val();
            var repayment_amount = parseFloat(loan_recomended) + parseFloat((loan_recomended * roi * tenure) / 100);

            $('#tenure').val(tenure);
            $('#repayment_amount').val(Math.round(repayment_amount));
        }
    }

    function max_eligibility(cc_limit, cc_outstanding)
    {
        if(parseInt(cc_limit) > parseInt(cc_outstanding)){
            $('#max_eligibility').val(cc_outstanding);
        }else{
            $('#max_eligibility').val(cc_limit);
        }
    }

    function isAddressLine_1_or_2(residence_address_line1, residence_address_line2)
    {
        if($("#isPresentAddress").is(":checked")){
            $("#isPresentAddress").val('YES');
            $('#selectPresentAddress').hide();
            $("#present_address_line1").val(residence_address_line1);
            $("#present_address_line2").val(residence_address_line2);
        } else {
            $("#isPresentAddress").val('NO');
            $('#selectPresentAddress').show();
            $("#present_address_line1").val('');
            $("#present_address_line2").val('');
        }
    }
    
    function customer_confirm_bank_ac_no(acc_no2)
    {
        var acc1 = $("#bankA_C_No").val();
        var acc2 = $(acc_no2).val();

        if(acc1 === acc2){
            $("#bankA_C_No, #confBankA_C_No").css('border-color', '#aaa');
            return true;
        }else{
            $("#bankA_C_No, #confBankA_C_No").val('').css('border-color', 'red');
            $("#bankA_C_No").focus();
            
            catchError('Invalid Bank A/C no.');
        }
    }

</script>

<script>
    $(document).ready(function(){
        $('#btnFormSaveCAM').click(function(){
            var camFormData = $('#FormSaveCAM').serialize();
            
            <?php if(company_id == 2 && product_id == 1){ ?>
                var url = 'savePaydayCAMDetails';
            <?php } if(company_id == 2 && product_id == 2){ ?>
                var url = 'saveLACCAMDetails';
            <?php } ?>
            $.ajax({
                url : '<?= base_url() ?>' + url,
                type : 'POST',
                dataType : "json",
                data : camFormData,
                beforeSend: function() {
                    $('#btnFormSaveCAM').html('<span class="spinner-border spinner-border-sm mr-2" role="status"></span>Processing...').prop('disabled', true);
                },
                success : function(response){
                    if(response.msg){
                        catchSuccess(response.msg);
                    }else{
                        catchError(response.err);
                    }
                },
                complete: function() {
                    $('#btnFormSaveCAM').html('Save').prop('disabled', false);
                },
            });
        });

        $('#btnSendBack').on('click', function(){
            var lead_id = $('#lead_id').val();
            $.ajax({
                url : '<?= base_url("reEditCAM/") ?>'+lead_id,
                type : 'POST',
                data : {csrf_token},
                dataType : "json",
                beforeSend: function() {
                    $('#btnSendBack').html('<span class="spinner-border spinner-border-sm mr-2" role="status"></span>Processing...').prop('disabled', true);
                },
                success : function(response){
                    if(response.msg){
                        catchSuccess(response.msg);
                        window.location.reload();
                    }else{
                        catchError(response.err);
                    }
                },
                complete: function() {
                    $('#btnSendBack').html('Send Back').prop('disabled', false);
                }
            });
        });

        $('#btnCAM_Approve').on('click', function(){
            var lead_id = $('#lead_id').val();
            $.ajax({
                url : '<?= base_url("headCAMApproved/") ?>'+lead_id,
                type : 'POST',
                data : {csrf_token},
                dataType : "json",
                beforeSend: function() {
                    $('#btnCAM_Approve').html('<span class="spinner-border spinner-border-sm mr-2" role="status"></span>Processing...').prop('disabled', true);
                },
                success : function(response){
                    if(response.notification){
                        catchNotification(response.notification);
                    } else if(response.msg){
                        catchSuccess(response.msg);
                        window.location.reload();
                    }else{
                        catchError(response.err);
                    }
                },
                complete: function() {
                    $('#btnCAM_Approve').html('Sanction').prop('disabled', false);
                }
            });
        });

        $('#formUpdateReferenceNo').submit(function(e) {
            e.preventDefault();

            $.ajax({
                url : '<?= base_url("UpdateDisburseReferenceNo") ?>',
                type : 'POST',
                data:new FormData(this),
                processData:false,
                contentType:false,
                cache:false,
                dataType : 'json',
                beforeSend: function() {
                    $('#updateReferenceNo').html('<span class="spinner-border spinner-border-sm mr-2" role="status" aria-hidden="true"></span>Processing...');
                },
                success : function(response) {
                    if(response.msg) {
                        catchSuccess(response.msg);
                        window.location.reload();
                    } else {
                        catchError(response.err);
                    }
                },
                complete: function() {
                    $('#updateReferenceNo').html('Update Reference');
                    // .removeClass('disabled'); 
                },
            });
            
        });
    });
    
    $(document).ready(function(){
        $('#saveCustomerDetails').on('click', function(){
            var FormSaveCustomerDetails = $('#FormSaveCustomerDetails').serialize();
            $.ajax({
                url : '<?= base_url("saveCustomerPersonalDetails") ?>',
                type : 'POST',
                data : FormSaveCustomerDetails,
                dataType : "json",
                beforeSend: function() {
                    $('#saveCustomerDetails').html('<span class="spinner-border spinner-border-sm mr-2" role="status"></span>Processing...').prop('disabled', true);
                },
                success : function(response){
                    if(response.msg){
                        catchSuccess(response.msg);
                    }else{
                        catchError(response.err);
                    }
                },
                complete: function() {
                    $('#saveCustomerDetails').html('Save').prop('disabled', false);
                },
            });
        });
    }); 
    
    $('#docsform').hide();
    $(document).ready(function(){
        $('#selectDocsTypes').on('click', function(){
            var radioval = $("input[name='selectdocradio']:checked").val() 
            $("#docuemnt_type").val(radioval);
            console.log(radioval);
            $('#docsform').show();

            const api_url = "<?= base_url('getDocumentSubType/') ?>"+ radioval;
            var field = $('#document_name');
            showLoader(field);
            getDocumentSubType(api_url);
        }) ;  
    }) 
    
    $(document).ready(function(){
        $('#formUserDocsData').submit(function(e){
            var lead_id = $('#leadIdForDocs').val();
            e.preventDefault();
            $.ajax({
                url : '<?= base_url("saveCustomerDocs") ?>',
                type : 'POST',
                data:new FormData(this),
                processData:false,
                contentType:false,
                cache:false,
                async:false,
                success : function(response) {
                    if(response == "true"){
                        if($('#docs_id').val() != ""){  
                            $('#docs_id').val('');
                        } 
                        catchSuccess("Document Uploaded Successfully."); 
                        $('#formUserDocsData').trigger("reset");
                        $('input[name="selectdocradio"]').attr('checked', false);
                        $('#docsform').hide();
                    }else{ 
                        catchError(response);
                    }
                    // getDocs(<?= $leadDetails->lead_id ?>);
                }
            });
        });
    });

    $(document).ready(function(){
		
		$("#insertVerification").on('submit',function(e) {
				e.preventDefault();
             

                if($('#initiateMobileVerification').is(':checked'))
                {
                 var initiateMobileVerification='YES';
                }
                else 
                { 
                    var initiateMobileVerification='NO';
                }

                if($('#residenceCPV').is(':checked'))
                {
                    var residenceCPVuser_id='<?php echo $_SESSION['isUserSession']['user_id'];?>';
                   var residenceCPV='YES';
                   var residenceCPVdate='<?php echo date('Y-m-d h:i:s');?>';
                }
                else 
                { 
                    var residenceCPVuser_id='<?php echo $_SESSION['isUserSession']['user_id'];?>';
                    var residenceCPV='NO';
                    $residenceCPVdate='';
                }

                if($('#officeEmailVerification').is(':checked'))
                {

                 var officeEmailVerification='YES';
                }
                else 
                { 
                    var officeEmailVerification='NO';
                }

                if($('#officeCPV').is(':checked'))
                {
                 var officeCPV='YES';
                 var officeCPVdate='<?php echo date('Y-m-d h:i:s');?>';
                 var officeCPVuser_id='<?php echo $_SESSION['isUserSession']['user_id'];?>';
                }
                else 
                { 
                    var officeCPVuser_id='<?php echo $_SESSION['isUserSession']['user_id'];?>';
                    var officeCPV='NO';
                    var officeCPVdate='';
                }


				
               var params = {
                        PANverified			             :$("#PANverified").val(),
                        BankStatementSVerified	         :$("#BankStatementSVerified").val(),
						enterOTPMobile			         :$("#enterOTPMobile").val(),
                        lead_id			                 :$("#lead_id").val(),
                        initiateMobileVerification		 :initiateMobileVerification,
                        residenceCPV		             :residenceCPV,
                        officeEmailVerification			 :officeEmailVerification,
                        officeCPV			             :officeCPV,
                        residece_cpv_allocated_to        :residenceCPVuser_id,
                        office_cpv_allocated_to          :officeCPVuser_id,
                        residence_cpv_allocated_on       :residenceCPVdate,
                        office_cvp_allocated_on          :officeCPVdate,
        			}

     $.post('<?= base_url("saveVerification"); ?>', {
		data: params,csrf_token
		}, function(data, status) {
            setTimeout(function(){
                location.reload();
            }, 2000);
		});     
	});	
});	
    
</script>
<script> 
    async function getDocumentSubType(url) {
        const response = await fetch(url);
        var data = await response.json();
        var field = $('#document_name');
        console.log(data);
        if (response) {
            hideLoader(field);
        }
        field.empty();
        field.append('<option value="">SELECT</option>');
        data.forEach(function (index) {
            field.append('<option value='+ index.docs_sub_type +'>'+ index.docs_sub_type +'</option>');
        });
    }

    function showLoader(field) {
        field.html('<span class="spinner-border spinner-border-sm mr-2" role="status"></span>Processing...').prop('disabled', true);
    }
    function hideLoader(field) {
        field.prop('disabled', false);
    }
</script>
