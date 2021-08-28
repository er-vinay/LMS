<?php $getVerificationdata=getVerificationdata('tbl_verification',$leadDetails->lead_id); 
//echo "<pre>";print_r($getVerificationdata);

?>
<!------- table structure for varification form ----------->


<div class="table-responsive">
<form id="insertVerification" method="post" >
<input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>" />
        <table class="table table-hover table-striped table-bordered">
            <tr>
                <th>Mobile verified &nbsp;<strong class="required_Fields">*</strong></th>
                <td><input type="text" value="<?php  if( $getVerificationdata[0]['mobile_verified']=='' || $getVerificationdata[0]['mobile_verified']=='-' )  { echo "NO"; } else { echo "YES"; }?>" readonly class="form-control inputField" id="mobileVerified" name="mobileVerified" autocomplete="off"></td>
                <th>Alternate Mobile verified</th>
                <td><input type="text" readonly class="form-control inputField" id="alternateMobileVarification" name="alternateMobileVarification" value="<?php  if($getVerificationdata[0]['alternate_mobile_verified']=='' || $getVerificationdata[0]['alternate_mobile_verified']=='-' )  { echo "NO"; } else { echo "YES"; }?>" autocomplete="off"></td>
            </tr>
            <tr>
                <th>Office Email Verification Sent On</th>
                <td><input type="datetime-local" readonly class="form-control inputField" id="OfficeEmailVerificationSentOn" name="OfficeEmailVerificationSentOn"  value="<?php if($getVerificationdata[0]['office_email_verification_send_on']=='' ||  $getVerificationdata[0]['office_email_verification_send_on']=='-' )  { echo "NO"; } else { echo "YES"; } ?>" autocomplete="off"></td>
                <th>Office Email Verified On &nbsp;<strong class="required_Fields">*</strong></th>
                <td><input readonly type="datetime-local" value="<?php if($getVerificationdata[0]['office_email_verified_on']=='' ||  $getVerificationdata[0]['office_email_verified_on']=='-' )  { echo "NO"; } else { echo "YES"; }   ?>" class="form-control inputField" id="OfficeEmailverifiedOn" name="OfficeEmailverifiedOn" autocomplete="off"></td>
            </tr>
            <tr>

            <tr>
                <th>PAN verified &nbsp;<strong class="required_Fields">*</strong></th>
                <td>
              
                <select class="form-control inputField" id="PANverified" name="PANverified">
                <option value="NO" <?php  if($getVerificationdata[0]['pan_verified']=='NO') { echo "selected";} ?> >NO</option>
                <option value="YES" <?php  if($getVerificationdata[0]['pan_verified']=='YES') { echo "selected";} ?>>YES</option>
                </select>

                <span id="pan_msg" style="color: red;"></span></td>
                <th>Aadhar Verified&nbsp;<strong class="required_Fields">*</strong></th>
                <td><input readonly type="text" class="form-control inputField" id="aadharVerified" value="<?php  if($getVerificationdata[0]['aadhar_verified']=='' || $getVerificationdata[0]['aadhar_verified']=='-'  )  { echo "NO"; } else { echo "YES"; }  ?>" name="aadharVerified" autocomplete="off"></td>
            </tr>
            <tr>
            <tr>
                <th>Bank Statement Verified&nbsp;<strong class="required_Fields">*</strong> </th>
                <td>
               
                <select class="form-control inputField" id="BankStatementSVerified" name="BankStatementSVerified">
                <option value="NO"  <?php if($getVerificationdata[0]['bank_statement_verified']=='NO') { echo "selected";} ?>>NO</option>
                <option value="YES" <?php if($getVerificationdata[0]['bank_statement_verified']=='YES') { echo "selected";} ?>>YES</option>
                </select>
                
                </td>
                <th>App Downloaded On &nbsp;<strong class="required_Fields">*</strong></th>
                <td><input  value="<?php   if($getVerificationdata[0]['app_download_on']=='' || $getVerificationdata[0]['app_download_on']=='-' )   { echo "NO"; } else { echo "YES"; }   ?>" readonly type="datetime-local" class="form-control inputField" id="appDownloadedOn" name="appDownloadedOn " autocomplete="off"></td>
            </tr>
            <tr>

            <tr>
                <th>Digital KYC Verified </th>
                <td><input readonly type="text" class="form-control inputField" id="DigitalKYCVerified" name="DigitalKYCVerified" value="<?php  if($getVerificationdata[0]['digital_kyc_verified']=='' || $getVerificationdata[0]['digital_kyc_verified']=='-'  )  { echo "NO"; } else { echo "YES"; }   ?>" autocomplete="off"></td>
                <th>Initiate Office Email Verification</th>
                <td><input type="checkbox" <?php if($getVerificationdata[0]['init_office_email_verification']=='YES') { echo "checked";} else { echo "";} ?> class="checkbox-verif" id="officeEmailVerification" name="officeEmailVerification " autocomplete="off" ></td>
            </tr>
            <tr>

            <tr>
                <th>Initiate Mobile Verification</th>
                <td><input type="checkbox" name="initiateMobileVerification" class="checkbox-verif" id="initiateMobileVerification" <?php if($getVerificationdata[0]['init_mobile_verification']=='YES') { echo "checked";} else { echo "";} ?> name="initiateMobileVerification" autocomplete="off"></td>
                <th>Enter OTP for Mobile</th>
                <td><input type="text" class="form-control inputField" value="<?php if($getVerificationdata[0]['mobile_otp']=="" ||  $getVerificationdata[0]['mobile_otp']=="-" )   { echo "NO"; } else { echo "YES"; }  ?>" id="enterOTPMobile" name="enterOTPMobile " autocomplete="off"></td>
            </tr>
            <tr>


                <th>Initiate Residence CPV</th>
                <td><input type="checkbox"  <?php if($getVerificationdata[0]['init_residence_cpv']=='YES') { echo "checked";} else { echo "";} ?>  name="residenceCPV" id="residenceCPV" class="checkbox-verif" value=""  ></td>
                <th>Initiate Office CPV</th>
                <td><input type="checkbox"  <?php if($getVerificationdata[0]['init_office_cpv']=='YES') { echo "checked";} else { echo "";} ?>  name="officeCPV" id="officeCPV" class="checkbox-verif" value=""  ></td>
            </tr>
            <tr>
                <th>Residence CPV Allocated To</th>
                <td><input  value="<?php  if($getVerificationdata[0]['residece_cpv_allocated_to']=='' || $getVerificationdata[0]['residece_cpv_allocated_to']=='-') { echo "NO"; } else { echo "YES"; } ?>" readonly type="text" class="form-control inputField" id="residenceCPVAllocatedTo" name="residenceCPVAllocatedTo" autocomplete="off"></td>
                <th>Office CPV Allocated To</th>
                <td><input readonly  value="<?php  if($getVerificationdata[0]['office_cpv_allocated_to']=='' || $getVerificationdata[0]['office_cpv_allocated_to']=='-' ) { echo "NO"; } else { echo "YES"; } ?>" type="text" class="form-control inputField" id="officeCPVAllocatedTo" name="officeCPVAllocatedTo" autocomplete="off"></td>
            </tr>

            <tr>
                <th>Residence CPV Allocated On</th>
                <td><input readonly value="<?php  if($getVerificationdata[0]['residence_cpv_allocated_on']=='' || $getVerificationdata[0]['residence_cpv_allocated_on']=='-' ) { echo "NO"; } else { echo "YES"; } ?>" type="datetime-local" class="form-control inputField" id="residenceCPVAllocatedOn" name="residenceCPVAllocatedOn" autocomplete="off"></td>
                <th>Office CPV Allocated On</th>
                <td><input readonly value="<?php  if($getVerificationdata[0]['office_cvp_allocated_on']=='' || $getVerificationdata[0]['office_cvp_allocated_on']=='-' ) { echo "NO"; } else { echo "YES"; } ?>" type="datetime-local" class="form-control inputField" id="officeCPVAllocatedOn" name="officeCPVAllocatedOn" autocomplete="off"></td>
            </tr>
            <tr>
                
                <th colspan='4' style="text-align: center;">
                <button type="Submit" id="saveVarifivation" class="btn btn-success lead-sanction-button">Save </button> </th>
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
                <th>Initiated On</th>
                <td><?php if($getVerificationdata[0]['initiiated_on']=='' || $getVerificationdata[0]['initiiated_on']=='-' )  { echo "NO"; } else { echo "YES"; } ?></td>
                <th>Received On</th>
                <td><?php  if($getVerificationdata[0]['received_on']=='' || $getVerificationdata[0]['received_on']=='-' ) { echo "NO"; } else { echo "YES"; } ?></td>
            </tr>
            <tr>
                <th>Met with</th>
                <td><?php if($getVerificationdata[0]['met_with']=='' || $getVerificationdata[0]['met_with']=='-' ) { echo "NO"; } else { echo "YES"; }  ?></td>
                <th>Relation</th>
                <td><?php if($getVerificationdata[0]['relation']=='' || $getVerificationdata[0]['relation']=='-' ) { echo "NO"; } else { echo "YES"; } ?></td>
            </tr>
            <tr>

            <tr>
                <th>Residence Type </th>
                <td><?php  if($getVerificationdata[0]['residence_type']=='' || $getVerificationdata[0]['residence_type']=='-'    ) { echo "NO"; } else { echo "YES"; } ?></td>
                <th>House Type</th>
                <td><?php if($getVerificationdata[0]['fi_residence_house_type']=='' || $getVerificationdata[0]['fi_residence_house_type']=='-'  ) { echo "NO"; } else { echo "YES"; } ?></td>
            </tr>
            <tr>
            <tr>
                <th>Ease of Identification</th>
                <td><?php if($getVerificationdata[0]['fi_residence_ease_of_identification']=='' || $getVerificationdata[0]['fi_residence_ease_of_identification']=='-' ) { echo "NO"; } else { echo "YES"; }  ?></td>
                <th>Locality</th>
                <td><?php if($getVerificationdata[0]['fi_residence_locality']=='' || $getVerificationdata[0]['fi_residence_locality']=='-') { echo "NO"; } else { echo "YES"; }  ?></td>
            </tr>
            <tr>

            <tr>
                <th>Residing since</th>
                <td><?php if($getVerificationdata[0]['fi_residence_residing_since']=='' || $getVerificationdata[0]['fi_residence_residing_since']=='-' ) { echo "NO"; } else { echo "YES"; } ?></td>
                <th>Total members in family</th>
                <td><?php if($getVerificationdata[0]['fi_residence_total_members_in_family']=='' || $getVerificationdata[0]['fi_residence_total_members_in_family']=='-' ) { echo "NO"; } else { echo "YES"; } ?></td>
            </tr>
            <tr>

            <tr>
                <th>Earning members in family</th>
                <td><?php if($getVerificationdata[0]['fi_residence_earn_ng_members_in_family']=='' || $getVerificationdata[0]['fi_residence_earn_ng_members_in_family']=='-'  ) { echo "NO"; } else { echo "YES"; } ?></td>
                <th>Living standard</th>
                <td><?php if($getVerificationdata[0]['fi_residence_living_standard']=='' || $getVerificationdata[0]['fi_residence_living_standard']=='-'   ) { echo "NO"; } else { echo "YES"; } ?></td>
            </tr>
            <tr>


                <th>Neighbour check</th>
                <td><?php  if($getVerificationdata[0]['fi_residence_neighbour_check']=='' || $getVerificationdata[0]['fi_residence_neighbour_check']=='-') { echo "NO"; } else { echo "YES"; }  ?></td>
                <th>Geo-cordinates</th>
                <td><?php if($getVerificationdata[0]['fi_residence_geo_cordinates']=='' || $getVerificationdata[0]['fi_residence_geo_cordinates']=='-'   ) { echo "NO"; } else { echo "YES"; }  ?></td>
            </tr>
            <tr>
                <th>Visit On</th>
                <td><?php  if($getVerificationdata[0]['fi_residence_visit_on']=='' || $getVerificationdata[0]['fi_residence_visit_on']=='-' ) { echo "NO"; } else { echo "YES"; }  ?></td>
                <th>Remarks</th>
                <td><?php  if($getVerificationdata[0]['fi_residence_remarks']=='' || $getVerificationdata[0]['fi_residence_remarks']=='-' ) { echo "NO"; } else { echo "YES"; }  ?></td>
            </tr>

            <tr>
                <th>Document verified</th>
                <td><?php if($getVerificationdata[0]['fi_residence_document_verified']=='' || $getVerificationdata[0]['fi_residence_document_verified']=='-' ) { echo "NO"; } else { echo "YES"; }  ?></td>
                <th>Photo of Residence</th>
                <td><?php if($getVerificationdata[0]['fi_residence_photo']=='' ||  $getVerificationdata[0]['fi_residence_photo']=='-')  { echo "NO"; } else { echo "YES"; }  ?></td>
            </tr>
           
            <tr>
                <th></th>
                <td></td>
                <th> Report Status</th>
                <td><?php  if($getVerificationdata[0]['fi_residence_status']=='' || $getVerificationdata[0]['fi_residence_status']=='-'  )   { echo "NO"; } else { echo "YES"; }  ?></td>
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
                <th>Initiated On</th>
                <td><?php if( $getVerificationdata[0]['fi_initiated_on']=='' || $getVerificationdata[0]['fi_initiated_on']=='-'  )   { echo "NO"; } else { echo "YES"; }?></td>
                <th>Received On</th>
                <td><?php if( $getVerificationdata[0]['fi_received_on']=='' || $getVerificationdata[0]['fi_received_on']=='-'  )   { echo "NO"; } else { echo "YES"; }?></td>
            </tr>
            <tr>
                <th>Met with</th>
                <td><?php if( $getVerificationdata[0]['fi_met_with']=='' || $getVerificationdata[0]['fi_met_with']=='-'  )   { echo "NO"; } else { echo "YES"; }?></td>
                <th>Relation</th>
                <td><?php if( $getVerificationdata[0]['fi_relation']=='' || $getVerificationdata[0]['fi_relation']=='-'  )   { echo "NO"; } else { echo "YES"; }?></td>
            </tr>
            <tr>

            <tr>
                <th>Entry Allowed </th>
                <td><?php if( $getVerificationdata[0]['fi_entry_allowed']=='' || $getVerificationdata[0]['fi_entry_allowed']=='-'  )   { echo "NO"; } else { echo "YES"; }?></td>
                <th>Employer Name</th>
                <td><?php if( $getVerificationdata[0]['fi_employer_name']=='' || $getVerificationdata[0]['fi_employer_name']=='-'  )   { echo "NO"; } else { echo "YES"; }?></td>
            </tr>
            <tr>
            <tr>
                <th>Company Signboard sighted</th>
                <td><?php if( $getVerificationdata[0]['fi_company_signboard_sighted']=='' || $getVerificationdata[0]['fi_company_signboard_sighted']=='-'  )   { echo "NO"; } else { echo "YES"; }?></td>
                <th>Locality</th>
                <td><?php if( $getVerificationdata[0]['fi_locality']='=' || $getVerificationdata[0]['fi_locality']=='-'  )   { echo "NO"; } else { echo "YES"; }?></td>
            </tr>
            <tr>

            <tr>
                <th>No. of staff sighted</th>
                <td><?php if( $getVerificationdata[0]['fi_no_of_staff_sighted']=='' || $getVerificationdata[0]['fi_no_of_staff_sighted']=='-'  )   { echo "NO"; } else { echo "YES"; }?></td>
                <th>Employee strength</th>
                <td><?php if( $getVerificationdata[0]['fi_employee_strength']=='' || $getVerificationdata[0]['fi_employee_strength']=='-'  )   { echo "NO"; } else { echo "YES"; }?></td>
            </tr>
            <tr>

            <tr>
                <th>Employed since</th>
                <td><?php if( $getVerificationdata[0]['fi_employed_since']=='' || $getVerificationdata[0]['fi_employed_since']=='-'  )   { echo "NO"; } else { echo "YES"; }?></td>
                <th>Geo-cordinates</th>
                <td><?php if( $getVerificationdata[0]['fi_geo_cordinates']=='' || $getVerificationdata[0]['fi_geo_cordinates']=='-'  )   { echo "NO"; } else { echo "YES"; }?></td>
            </tr>
            <tr>


                <th>Visit On</th>
                <td><?php if( $getVerificationdata[0]['fi_visit_on']=='' || $getVerificationdata[0]['fi_visit_on']=='-'  )   { echo "NO"; } else { echo "YES"; }?></td>
                <th>Remarks</th>
                <td><?php if( $getVerificationdata[0]['fi_remarks']=='' || $getVerificationdata[0]['fi_remarks']=='-'  )   { echo "NO"; } else { echo "YES"; }?></td>
            </tr>
         
            <tr>
                <th>Document verified</th>
                <td><?php if( $getVerificationdata[0]['fi_document_verified']=='' || $getVerificationdata[0]['fi_document_verified']=='-'  )   { echo "NO"; } else { echo "YES"; }?></td>
                <th>Photo of Office</th>
                <td><?php if( $getVerificationdata[0]['fi_photo_of_office']=='' || $getVerificationdata[0]['fi_photo_of_office']=='-'  )   { echo "NO"; } else { echo "YES"; }?></td>
            </tr>
           
            <tr>
                <th></th>
                <td></td>
                <th>Report Status</th>
                <td><?php if( $getVerificationdata[0]['fi_report_status']=='' || $getVerificationdata[0]['fi_report_status']=='-'  )   { echo "NO"; } else { echo "YES"; }?></td>
            </tr>
           
          
        </table>
    </div>
<!----- end section for the OFFICE section ----------------->
</div>





  
