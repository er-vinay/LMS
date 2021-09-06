<?php $this->load->view('Layouts/header') ?>
<?php $url =  $this->uri->segment(1); ?>
<div class="width-my">
    <div class="container-fluid">
        <div class="taskPageSize taskPageSizeDashboard" style="border: 1px solid #ddd;height:auto !important;">
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
                <div class="col-md-8 col-sm-offset-2">
                    <div class="tab" role="tabpanel">
                        <input type="hidden" name="lead_id" id="lead_id" value="<?= $leadDetails->lead_id ?>" readonly>
                        <input type="hidden" name="user_id" id="user_id" value="<?= $_SESSION['isUserSession']['user_id'] ?>" readonly>
                        <ul class="nav nav-tabs" role="tablist">
                            <li role="presentation" class="borderList "><a href="#LeadSaction" onclick="getLeadDetails()" aria-controls="lead" role="tab" data-toggle="tab">Lead</a></li>
                            <?php if($_SESSION['isUserSession']['labels'] == "CR2" 
                                || $_SESSION['isUserSession']['labels'] == "CR3"
                                || $_SESSION['isUserSession']['labels'] == "CA"
                                || $_SESSION['isUserSession']['labels'] == "SA"
                                || $_SESSION['isUserSession']['labels'] == "DS1" 
                                || $url == "search"){ ?>
                            <li role="presentation" class="borderList"><a href="#DocumentSaction" aria-controls="Document" role="tab" data-toggle="tab">Documents</a></li>
                            
                            <li role="presentation" class="borderList"><a href="#Verification" aria-controls="Verification" role="tab" data-toggle="tab" >Verification</a></li>

                            <li role="presentation" class="borderList"><a href="#PersonalDetailSaction" onclick="getPersonalDetails(<?= $leadDetails->lead_id ?>)" aria-controls="Personal" role="tab" data-toggle="tab">Personal</a></li>
                            
                            <li role="presentation" class="borderList "><a href="#CAMSheetSaction" onclick="getCam(<?= $leadDetails->lead_id ?>)" aria-controls="messages" role="tab" data-toggle="tab">CAM</a></li>
                            
                            <?php } if($_SESSION['isUserSession']['labels'] == "DS1" 
                                || $_SESSION['isUserSession']['labels'] == "CA" 
                                || $_SESSION['isUserSession']['labels'] == "SA" 
                                || $url == "search"){ ?>
                            <li role="presentation" class="borderList"><a href="#DisbursalSaction" onclick="disbursalDetails()" aria-controls="messages" role="tab" data-toggle="tab">Disbursal</a></li>
                            
                            <?php } if($_SESSION['isUserSession']['labels'] == "AC1" 
                                || $_SESSION['isUserSession']['labels'] == "CA" 
                                || $_SESSION['isUserSession']['labels'] == "SA" 
                                || $url == "search"){ ?>
                            <li role="presentation" class="borderList"><a href="#CollectionSaction" onclick="collectionDetails()" aria-controls="messages" role="tab" data-toggle="tab">Collection</a></li>
                            <?php } ?>
                        </ul><hr> 
                        <div class="tab-content tabs">
                            <div role="tabpanel" class="tab-pane fade in active" id="LeadSaction">
                                <div id="LeadDetails">
                                    <?php $this->load->view('Tasks/leadsDetails'); ?>
                                </div>
                                
                                <div class="footer-support">
                                    <h2 class="footer-support"><button type="button" class="btn btn-info collapse" data-toggle="collapse" data-target="#old_leads" onclick="viewOldHistory(<?= $leadDetails->lead_id ?>)">INTERNAL DEDUPE&nbsp;<i class="fa fa-angle-double-down"></i></button></h2>
                                </div>
                                <div id="old_leads" class="collapse"> 
                                    <div id="oldTaskHistory"></div>
                                </div>
                                
                                <div class="footer-support">
                                    <h2 class="footer-support"><button type="button" class="btn btn-info collapse" data-toggle="collapse" data-target="#cibil_details" onclick="ViewCibilStatement(<?= $leadDetails->lead_id ?>)">CREDIT BUREAU&nbsp;<i class="fa fa-angle-double-down"></i></button></h2>
                                </div>
                                <div id="bankStatement"></div>
                                
                                <div id="cibil_details" class="collapse">
                                    <?php if($_SESSION['isUserSession']['labels'] == "CR1" 
                                        || $_SESSION['isUserSession']['labels'] == "CR2"
                                        || $_SESSION['isUserSession']['labels'] == "CA"
                                        || $_SESSION['isUserSession']['labels'] == "SA") : ?>
                                    <div id="btndivCheckCibil">
                                        <div id="checkCustomerCibil" style="background:#fff !important;">
                                            <a href="#" class="btn btn-primary" id="btnCheckCibil" onclick="checkCustomerCibil()">Check CIBIL</a>
                                        </div>
                                    </div>
                                    <?php endif; ?>
                                    <div id="cibilStatement"></div>
                                </div>
                                <?php if(($_SESSION['isUserSession']['labels'] == "CR1" 
                                        || $_SESSION['isUserSession']['labels'] == "CA"
                                        || $_SESSION['isUserSession']['labels'] == "SA") && $leadDetails->stage != "S9") { ?>
                                <div id="btndivReject">  
                                    <div calss="row" style="border-top: solid 1px #ddd;text-align: center; padding-top : 20px; padding-bottom: 20px; background: #f3f3f3; overflow: auto;">
                                        <div class="col-md-12 text-center">
                                            <button class="btn btn-success reject-button" onclick="RejectedLoan()">Reject</button>
                                            <button class="btn btn-success lead-hold-button" onclick="holdLeadsRemark()">Hold</button>
                                            <button class="btn btn-success lead-sanction-button" onclick="sanctionleads()">Recommend</button>
                                        </div>
                                    </div>
                                </div>
                                
                                <div id="divExpendReason" class="marging-footer-verifa">
                                    <div style="margin-top: 15px">
                                        <div class="col-md-3 text-center">&nbsp;</div>
                                        <div class="col-md-4 text-center">
                                            <select class="js-select2 form-control inputField" name="resonForReject" id="resonForReject" autocomplete="off" style="float: right;width: 100% !important;height: 43px !important;">  
                                            </select>
                                        </div>
                                        <div class="col-md-2 text-left">
                                         <button class="btn btn-primary" id="btnRejectApplication" onclick="ResonForRejectLoan()">Reject Application</button>
                                        </div>
                                        <div class="col-md-3 text-center">
                                          &nbsp;
                                        </div>
                                    </div>
                                </div>
                                
                                <div id="divExpendReason2" class="marging-footer-verifa">
                                    <div style="margin-top: 15px">
                                         <div class="col-md-3 text-left">&nbsp;</div>
                                        <div class="col-md-2 text-left">
                                          <input type="text" class="form-control inputField" name="remark" id="hold_remark" placeholder="Enter Remarks" style="width:100% !important;">
                                        </div> 
                                        
                                        <div class="col-md-2 text-left">
                                          <input type="date" class="form-control inputField" name="holdDurationDate" id="holdDurationDate" placeholder="Enter Remarks" style="width:100% !important;">
                                        </div>
                                        
                                        <div class="col-md-2 text-left">
                                            <button class="btn btn-primary" id="btnRejectApplication" onclick="holdleads()">Lead Hold</button>
                                        </div>
                                    </div>
                                </div>
                                <?php } ?>
                            </div> 
                            
                            <div role="tabpanel" class="tab-pane fade" id="DocumentSaction"> 
                                <input type="hidden" name="leadIdForDocs" id="leadIdForDocs"> 
                                <div id="documents" class="show">
                                <?php if($_SESSION['isUserSession']['labels'] == "CR2" 
                                    || $_SESSION['isUserSession']['labels'] == "CA") : ?>
                                    <div id="btndivUploadDocs">
                                        <div style="background:#fff !important;">
                                            <button class="btn btn-primary" style="background:#ddd !important; color: #000 !important; border: none;" id="sendRequestToCustomerForUploadDocs" onclick="sendRequestToCustomerForUploadDocs()" disabled>Send Request For Upload Docs</button>
                                            <p id="selectDocsTypes" style="text-transform:uppercase; margin-top:20px;padding-left: 10px;padding-bottom: 15px;">
                                                <?php $i = 1; foreach ($docs_master->result() as $row) : ?>
                                                <label class="radio-inline">
                                                    <input type="radio" name="selectdocradio" id="selectdocradio<?= $i ?>" value="<?= $row->docs_type ?>">&nbsp;<?= $row->docs_type ?>  
                                                </label>
                                                <?php $i++; endforeach; ?>
                                            </p>
                                        </div>   
                                        <div class="row" id="docsform">
                                            <?php $this->load->view('Document/docs'); ?>
                                        </div> 
                                        <div class="footer-support">
                                            <h2 class="footer-support" style="margin-top: 0px;">
                                                <button type="button" class="btn btn-info collapse" onclick="getCustomerDocs(<?= $leadDetails->lead_id ?>)" data-toggle="collapse" data-target="#Uploaded-Documents">Uploaded Documents&nbsp;<i class="fa fa-angle-double-down"></i></button>
                                            </h2>
                                        </div>
                                        <div id="Uploaded-Documents" class="collapse" style="background: #fff !important;">
                                            <div id="docsHistory"></div>
                                        </div> 
                                    </div> 
                                    <?php endif; ?>
                                </div>  
                            </div>
                        
                            <div role="tabpanel" class="tab-pane fade" id="Verification">
                                <div id="divVerification">
                                    <?php $this->load->view('Verification/verification'); ?>
                                </div>
                            </div>
                                 
                            <div role="tabpanel" class="tab-pane fade" id="PersonalDetailSaction">
                                <div style="border : solid 1px #ddd;margin-bottom: 20px; background: #fff;">
                                    <?php if($_SESSION['isUserSession']['labels'] == "CR2" 
                                            || $_SESSION['isUserSession']['labels'] == "CA"
                                            || $_SESSION['isUserSession']['labels'] == "SA"){ ?>

                                        <?php $this->load->view('Personal/personal'); ?>
                                    <?php } ?>
                                    <div id="ViewPersonalDetails"></div>
                                </div>
                            </div>

                            <div role="tabpanel" class="tab-pane fade" id="CAMSheetSaction">
                                <a class="btn btn-primary" href="#" id="urlViewCAM" target="_blank" title="View" style="width: 30px;height: 30px;padding: 5px 0px 0px 0px;">
                                    <i class="fa fa-eye"> 
                                    </i>
                                </a>
                                <a class="btn btn-primary" href="#" id="urlDownloadCAM" style="width: 30px;height: 30px;padding: 5px 0px 0px 0px;">
                                    <i class="fa fa-download"></i>
                                </a>
                                <div class="camBorder">
                                    <div id="divCamDetails">
                                        <?php if(company_id == 1 && product_id == 1){ ?>
                                    <?php if($_SESSION['isUserSession']['labels'] == "CR2" 
                                            || $_SESSION['isUserSession']['labels'] == "CA"
                                            || $_SESSION['isUserSession']['labels'] == "SA"){ ?>
                                                <?php $this->load->view('CAM/camPayday'); ?>
                                            <?php } ?>
                                        <?php } if(company_id == 2 && product_id == 2){ ?>
                                            <?php $this->load->view('CAM/camLAC'); ?>
                                        <?php } ?>
                                        
                                        <div calss="row" style="border-top: solid 1px #ddd;text-align: center; padding-top : 20px; padding-bottom: 20px; background: #f3f3f3;">
                                            <div calss="col-md-12 text-center">
                                                <button class="btn btn-primary" id="btnFormSaveCAM" style="text-align: center; padding-left: 50px; padding-right: 50px; font-weight: bold;height: 42px;">Save</button>
                                                <button class="btn btn-success reject-button" onclick="RejectedLoan()">Reject</button>
                                                <button class="btn btn-success lead-hold-button" onclick="holdLeadsRemark()">Hold</button>
                                                <button class="btn btn-success lead-sanction-button" onclick="LeadRecommendation()">Recommend</button>
                                            </div>  
                                        </div>
                                        <?php if($_SESSION['isUserSession']['role'] == creditManager){ ?>
                                            <div id="divExpendReason" class="marging-footer-verifa">
                                                <div style="margin-top: 15px">
                                                    <div class="col-md-3 text-center">&nbsp;</div>
                                                    <div class="col-md-4 text-center">
                                                        <select class="js-select2 form-control inputField" name="resonForReject" id="resonForReject" autocomplete="off" style="float: right;width: 100% !important;height: 43px !important;">  
                                                        </select>
                                                    </div>
                                                    <div class="col-md-2 text-left">
                                                     <button class="btn btn-primary" id="btnRejectApplication" onclick="ResonForRejectLoan()">Reject Application</button>
                                                    </div>
                                                    <div class="col-md-3 text-center">
                                                      &nbsp;
                                                    </div>
                                                </div>
                                            </div>
                                            
                                            <div id="divExpendReason2" class="marging-footer-verifa">
                                                <div style="margin-top: 15px">
                                                     <div class="col-md-3 text-left">&nbsp;</div>
                                                    <div class="col-md-2 text-left">
                                                      <input type="text" class="form-control inputField" name="remark" id="hold_remark" placeholder="Enter Remarks" style="width:100% !important;">
                                                    </div> 
                                                    
                                                    <div class="col-md-2 text-left">
                                                      <input type="date" class="form-control inputField" name="holdDurationDate" id="holdDurationDate" placeholder="Enter Remarks" style="width:100% !important;">
                                                    </div>
                                                    
                                                    <div class="col-md-2 text-left">
                                                        <button class="btn btn-primary" id="btnRejectApplication" onclick="holdleads()">Hold Application</button>
                                                    </div>
                                                </div>
                                            </div>
                                        <?php } ?>
                                        <span id="ResonBoxForHold"></span>
                                    </div>
                                    <?php //endif; ?>
                                    <div id="ViewCAMDetails"></div>

                                    <?php if($_SESSION['isUserSession']['role'] == headCreditManager): ?>
                                    <div id="btndivCamDetails">
                                        <div calss="row" style="border-top: solid 1px #ddd;text-align: center; padding-top : 20px; padding-bottom: 20px; background: #f3f3f3;">
                                            <div calss="col-md-12 text-center">
                                                <button class="btn btn-success reject-button" onclick="RejectedLoan()" style="text-align: center; padding-left: 25px; padding-right: 25px; font-weight: bold;">Reject</button>
                                                <button class="btn btn-primary" id="btnSendBack" style="text-align: center; padding-left: 25px; padding-right: 25px; font-weight: bold;">Send Back</button>
                                                <button class="btn btn-success" id="btnCAM_Approve" style="background: #7cb342 !important; text-align: center; padding-left: 25px; padding-right: 25px; font-weight: bold;">Sanction</button>
                                            </div>
                                        </div>
                                    </div>
                                    <div id="divExpendReason" class="marging-footer-verifa">
                                        <div style="margin-top: 15px">
                                            <div class="col-md-3 text-center">&nbsp;</div>
                                            <div class="col-md-4 text-center">
                                                <select class="js-select2 form-control inputField" name="resonForReject" id="resonForReject" autocomplete="off" style="float: right;width: 100% !important;height: 43px !important;">  
                                                </select>
                                            </div>
                                            <div class="col-md-2 text-left">
                                             <button class="btn btn-primary" id="btnRejectApplication" onclick="ResonForRejectLoan()">Reject Application</button>
                                            </div>
                                            <div class="col-md-3 text-center">
                                              &nbsp;
                                            </div>
                                        </div>
                                    </div>
                                    <?php endif; ?>
                                </div>
                            </div>
                            
                            <div role="tabpanel" class="tab-pane fade" id="DisbursalSaction">
                                <div class="camBorder" style="float : left;">
                                    <div id="disbursalData"></div>
                                    <div id="ViewDisbursalDetails"></div>
                                    <div id="ViewAgreementDetails"></div>
                                    <div id="ViewDisbursalBankDetails"></div>
                                    <?php //if($user->permission_user_disburse == 1): ?>
                                        <div id="formDisbursalOtherDetails">
                                            <div class="col-md-12" style="padding: 0px 0px; border-bottom:1px solid #ddd; margin-bottom : 15px;">
                                                <p class="headingForm">Disbursal Bank</p>
                                            </div>
                                            <div class="form-group">
                                                <form id="disbursalPayableDetails" class="form-inline" method="post" enctype="multipart/form-data">
                                                    <input type="hidden" class="form-control" name="lead_id" id="lead_id" readonly>
                                                    <input type="hidden" class="form-control" name="company_id" id="company_id" value="<?= company_id ?>" readonly>
                                                    <input type="hidden" class="form-control" name="product_id" id="product_id" value="<?= product_id ?>" readonly>
                                                    <input type="hidden" class="form-control" name="user_id" id="user_id" value="<?= user_id ?>" readonly>
                                                    <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>" />
                                                    <div class="col-sm-6">
                                                        <label class="labelField">Payable Account&nbsp;<strong class="required_Fields">*</strong></label>
                                                        <select class="form-control inputField" name="payableAccount" id="payableAccount" required autocomplete="off">
                                                            <option value="">Select</option>
                                                            <option value="084305001370">Icici Bank/ 084305001370</option>
                                                            <option value="920020009314172">Axis Bank/ 920020009314172</option>
                                                            <option value="201002831962">Indus Bank/ 201002831962</option>
                                                        </select>
                                                    </div>

                                                    <div class="col-md-6">
                                                        <label class="labelField">Channel&nbsp;<strong class="required_Fields">*</strong></label>
                                                        <select class="form-control inputField" style="width:100%;" name="channel" id="channel" required>
                                                            <option value="">Select</option>
                                                            <option value="IMPS">IMPS</option>
                                                            <option value="NEFT">NEFT</option>
                                                        </select>
                                                    </div>

                                                    <div class="col-md-6">
                                                        <label class="labelField">Disbursal Amount&nbsp;<strong class="required_Fields">*</strong></label>
                                                        <input type="text" class="form-control inputField" name="payable_amount" id="payable_amount" readonly required>
                                                    </div>
                                                </form>
                                            </div>

                                            <div class="form-group" id="divbtnDisburse" style="float:left; width:100%; margin-bottom: 0px;">
                                                <div calss="row" style="border-top: solid 1px #ddd;text-align: center; padding-top : 20px; padding-bottom: 20px; background: #f3f3f3;">
                                                    <div calss="col-md-12 text-center">
                                                        <button class="btn btn-primary" id="updateDisbursalApprove" style="text-align: center; padding-left: 50px; padding-right: 50px; font-weight: bold;">Disburse</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div id="divUpdateReferenceNo">
                                            <div class="col-md-12" style="padding: 0px 0px; border-bottom:1px solid #ddd; margin-bottom : 15px;">
                                                <p class="headingForm">Update Reference</p>
                                            </div>
                                            <div class="form-group">
                                                <form id="formUpdateReferenceNo" method="post" enctype="multipart/form-data">
                                                    <input type="hidden" class="form-control" name="lead_id" id="lead_id" readonly>
                                                    <input type="hidden" class="form-control" name="company_id" id="company_id" value="<?= company_id ?>" readonly>
                                                    <input type="hidden" class="form-control" name="product_id" id="product_id" value="<?= product_id ?>" readonly>
                                                    <input type="hidden" class="form-control" name="user_id" id="user_id" value="<?= user_id ?>" readonly>
                                                    <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>" />

                                                    <div class="col-md-6">
                                                        <label class="labelField1">Reference no&nbsp;<strong class="required_Fields">*</strong></label>
                                                        <input type="text" class="form-control inputField1" name="loan_reference_no" id="loan_reference_no" required>
                                                    </div>
                                                
                                                    <div class="col-md-6">
                                                        <label class="labelField1">Screenshot&nbsp;<strong class="required_Fields">*</strong></label>
                                                        <input type="file" class="form-control inputField" id="file" name="file" accept=".png, .jpg, .jpeg" autocomplete="off" required>
                                                    </div>

                                                    <div class="form-group" style="float:left; width:100%; margin-bottom: 0px;margin-top: 15px;">
                                                        <div calss="row" style="border-top: solid 1px #ddd;text-align: center; padding-top : 20px; padding-bottom: 20px; background: #f3f3f3;">
                                                            <div calss="col-md-12 text-center">
                                                                <button class="btn btn-primary" id="updateReferenceNo" style="text-align: center; font-weight: bold;">Update Reference</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>

                                        </div>
                                        <?php //$this->view->load('Disbursal/tab_disburse_form'); ?>
                                    <?php //endif; ?>
                                </div>
                            </div>
                            
                            <div role="tabpanel" class="tab-pane fade" id="CollectionSaction">
                                <div id="collection">
                                    <?php $this->load->view('Collection/collection'); ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div> 
            </div>
        </div>
    </div>
</div>

<?php $this->load->view('Layouts/footer') ?>
<?php $this->load->view('Tasks/main_js.php') ?>
<input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>" />
<script> 
    var csrf_token = $("input[name=csrf_token]").val();
</script>