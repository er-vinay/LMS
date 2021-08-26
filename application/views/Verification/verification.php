
<!------- table structure for varification form ----------->


<div class="table-responsive">
<form id="insertVerification" method="post" >
<input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>" />
        <table class="table table-hover table-striped table-bordered">
            <tr>
                <th>Mobile verified &nbsp;<strong class="required_Fields">*</strong></th>
                <td><input type="text" readonly class="form-control inputField" id="mobileVerified" name="mobileVerified" autocomplete="off"></td>
                <th>Alternate Mobile verified</th>
                <td><input type="text" readonly class="form-control inputField" id="alternateMobileVarification" name="alternateMobileVarification" autocomplete="off"></td>
            </tr>
            <tr>
                <th>Office Email Verification Sent On</th>
                <td><input type="datetime-local" readonly class="form-control inputField" id="OfficeEmailVerificationSentOn" name="OfficeEmailVerificationSentOn" autocomplete="off"></td>
                <th>Office Email Verified On &nbsp;<strong class="required_Fields">*</strong></th>
                <td><input readonly type="datetime-local" class="form-control inputField" id="OfficeEmailverifiedOn" name="OfficeEmailverifiedOn" autocomplete="off"></td>
            </tr>
            <tr>

            <tr>
                <th>PAN verified &nbsp;<strong class="required_Fields">*</strong></th>
                <td>
              
                <select class="form-control inputField" id="PANverified" name="PANverified">
                <option value="NO">NO</option>
                <option value="YES">YES</option>
                </select>

                <span id="pan_msg" style="color: red;"></span></td>
                <th>Aadhar Verified&nbsp;<strong class="required_Fields">*</strong></th>
                <td><input readonly type="text" class="form-control inputField" id="aadharVerified" name="aadharVerified" autocomplete="off"></td>
            </tr>
            <tr>
            <tr>
                <th>Bank Statement Verified&nbsp;<strong class="required_Fields">*</strong> </th>
                <td>
               
                <select class="form-control inputField" id="BankStatementSVerified" name="BankStatementSVerified">
                <option value="NO">NO</option>
                <option value="YES">YES</option>
                </select>
                
                </td>
                <th>App Downloaded On &nbsp;<strong class="required_Fields">*</strong></th>
                <td><input  readonly type="datetime-local" class="form-control inputField" id="appDownloadedOn" name="appDownloadedOn " autocomplete="off"></td>
            </tr>
            <tr>

            <tr>
                <th>Digital KYC Verified </th>
                <td><input readonly type="text" class="form-control inputField" id="DigitalKYCVerified" name="DigitalKYCVerified" autocomplete="off"></td>
                <th>Initiate Office Email Verification</th>
                <td><input type="checkbox" class="checkbox-verif" id="officeEmailVerification" name="officeEmailVerification " autocomplete="off" checked></td>
            </tr>
            <tr>

            <tr>
                <th>Initiate Mobile Verification</th>
                <td><input type="checkbox" name="initiateMobileVerification" class="checkbox-verif" value="" checked id="initiateMobileVerification" name="initiateMobileVerification" autocomplete="off"></td>
                <th>Enter OTP for Mobile</th>
                <td><input type="text" class="form-control inputField" id="enterOTPMobile" name="enterOTPMobile " autocomplete="off"></td>
            </tr>
            <tr>


                <th>Initiate Residence CPV</th>
                <td><input type="checkbox" name="residenceCPV" id="residenceCPV" class="checkbox-verif" value="" checked ></td>
                <th>Initiate Office CPV</th>
                <td><input type="checkbox" name="officeCPV" id="officeCPV" class="checkbox-verif" value="" checked ></td>
            </tr>
            <tr>
                <th>Residence CPV Allocated To</th>
                <td><input  readonly type="text" class="form-control inputField" id="residenceCPVAllocatedTo" name="residenceCPVAllocatedTo" autocomplete="off"></td>
                <th>Office CPV Allocated To</th>
                <td><input readonly  type="text" class="form-control inputField" id="officeCPVAllocatedTo" name="officeCPVAllocatedTo" autocomplete="off"></td>
            </tr>

            <tr>
                <th>Residence CPV Allocated On</th>
                <td><input readonly type="datetime-local" class="form-control inputField" id="residenceCPVAllocatedOn" name="residenceCPVAllocatedOn" autocomplete="off"></td>
                <th>Office CPV Allocated On</th>
                <td><input readonly type="datetime-local" class="form-control inputField" id="officeCPVAllocatedOn" name="officeCPVAllocatedOn" autocomplete="off"></td>
            </tr>
            <tr>
                
                <th colspan='4'>
                <button type="Submit" id="saveVarifivation" class="btn btn-primary">Save </button> </th>
            </tr>
          
        </table>
        </form>
    </div>











<!------ end for varification section ----------------------->







<div class="footer-support">
<h2 class="footer-support"><button type="button" class="btn btn-info collapse" data-toggle="collapse" data-target="#RESIDENCE">FIELD VERIFICATION - RESIDENCE&nbsp;<i class="fa fa-angle-double-down"></i></button></h2>
</div>
<div id="RESIDENCE" class="collapse"> 
<!------ table for  RESIDENCE section ----------------------->

<div class="table-responsive">
        <table class="table table-hover table-striped table-bordered">
            <tr>
                <th>Initiated on</th>
                <td></td>
                <th>Received On</th>
                <td></td>
            </tr>
            <tr>
                <th>Met with</th>
                <td></td>
                <th>Relation</th>
                <td></td>
            </tr>
            <tr>

            <tr>
                <th>Residence Type </th>
                <td></td>
                <th>House Type</th>
                <td></td>
            </tr>
            <tr>
            <tr>
                <th>Ease of Identification</th>
                <td></td>
                <th>Locality</th>
                <td></td>
            </tr>
            <tr>

            <tr>
                <th>Residing since</th>
                <td></td>
                <th>Total members in family</th>
                <td></td>
            </tr>
            <tr>

            <tr>
                <th>Earning members in family</th>
                <td></td>
                <th>Living standard</th>
                <td></td>
            </tr>
            <tr>


                <th>Neighbour check</th>
                <td></td>
                <th>Geo-cordinates</th>
                <td></td>
            </tr>
            <tr>
                <th>Visit On</th>
                <td></td>
                <th>Remarks</th>
                <td></td>
            </tr>

            <tr>
                <th>Document verified</th>
                <td></td>
                <th>Photo of Residence</th>
                <td></td>
            </tr>
           
            <tr>
                <th></th>
                <td></td>
                <th>Status</th>
                <td></td>
            </tr>
           
          
        </table>
    </div>
<!-- end section for the residence section ----------------->

</div>

<div class="footer-support">
<h2 class="footer-support"><button type="button" class="btn btn-info collapse" data-toggle="collapse" data-target="#OFFICE">FIELD VERIFICATION - OFFICE&nbsp;<i class="fa fa-angle-double-down"></i></button></h2>
</div>
<div id="OFFICE" class="collapse"> 
<!------ table for  OFFICE section ----------------------->

<div class="table-responsive">
        <table class="table table-hover table-striped table-bordered">
            <tr>
                <th>Initiated on</th>
                <td></td>
                <th>Received On</th>
                <td></td>
            </tr>
            <tr>
                <th>Met with</th>
                <td></td>
                <th>Relation</th>
                <td></td>
            </tr>
            <tr>

            <tr>
                <th>Entry Allowed </th>
                <td></td>
                <th>Employer Name</th>
                <td></td>
            </tr>
            <tr>
            <tr>
                <th>Company Signboard sighted</th>
                <td></td>
                <th>Locality</th>
                <td></td>
            </tr>
            <tr>

            <tr>
                <th>No. of staff sighted</th>
                <td></td>
                <th>Employee strength</th>
                <td></td>
            </tr>
            <tr>

            <tr>
                <th>Employed since</th>
                <td></td>
                <th>Geo-cordinates</th>
                <td></td>
            </tr>
            <tr>


                <th>Visit On</th>
                <td></td>
                <th>Remarks</th>
                <td></td>
            </tr>
         
            <tr>
                <th>Document verified</th>
                <td></td>
                <th>Photo of Office</th>
                <td></td>
            </tr>
           
            <tr>
                <th></th>
                <td></td>
                <th>Report Status</th>
                <td></td>
            </tr>
           
          
        </table>
    </div>
<!----- end section for the OFFICE section ----------------->
</div>





  
