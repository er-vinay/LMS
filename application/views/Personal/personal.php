
<?php $getVerificationdata=getVerificationdata('tbl_verification',$leadDetails->lead_id); 
//echo "<pre>";print_r($getVerificationdata);
//"user_id" 	    => $user_id,
//echo $_SESSION['isUserSession']['user_id'];

?>
<!------- table structure for varification form ----------->


<div class="table-responsive">
<form id="insertPersonal1" method="post" >
<input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>" />
        <table class="table table-hover table-striped table-bordered">
            <tr>
                <th>First Name &nbsp;<strong class="required_Fields">*</strong></th>
                <td><input type="text" value="<?php  if( isset($getVerificationdata[0]['mobile_verified'])=='' || isset($getVerificationdata[0]['mobile_verified'])=='-' )  { echo "NO"; } else { echo "YES"; }?>" readonly class="form-control inputField" id="firstname" name="firstname" autocomplete="off"></td>
                <th>Middle Name</th>
                <td><input type="text" readonly class="form-control inputField" id="middleName" name="middleName" value="<?php  if(isset($getVerificationdata[0]['alternate_mobile_verified'])=='' || isset($getVerificationdata[0]['alternate_mobile_verified'])=='-' )  { echo "NO"; } else { echo "YES"; }?>" autocomplete="off"></td>
            </tr>
            <tr>
                <th>Surname</th>
                <td><input type="datetime-local" readonly class="form-control inputField" id="surname" name="surname"  value="<?php if(isset($getVerificationdata[0]['office_email_verification_send_on'])=='' ||  isset($getVerificationdata[0]['office_email_verification_send_on'])=='-' )  { echo "NO"; } else { echo "YES"; } ?>" autocomplete="off"></td>
                <th>Gender &nbsp;<strong class="required_Fields">*</strong></th>
                <td><input readonly type="datetime-local" value="<?php if(isset($getVerificationdata[0]['office_email_verified_on'])=='' ||  isset($getVerificationdata[0]['office_email_verified_on'])=='-' )  { echo "NO"; } else { echo "YES"; }   ?>" class="form-control inputField" id="OfficeEmailverifiedOn" name="OfficeEmailverifiedOn" autocomplete="off"></td>
            </tr>
            <tr>

            <tr>
                <th>DOB&nbsp;<strong class="required_Fields">*</strong></th>
                <td>
              
                <input readonly type="date" value="<?php if(isset($getVerificationdata[0]['office_email_verified_on'])=='' ||  isset($getVerificationdata[0]['office_email_verified_on'])=='-' )  { echo "NO"; } else { echo "YES"; }   ?>" class="form-control inputField" id="dob" name="dob" autocomplete="off">

                <span id="pan_msg" style="color: red;"></span></td>
                <th>PAN&nbsp;<strong class="required_Fields">*</strong></th>
                <td><input readonly type="text" class="form-control inputField" id="pannumber" value="<?php  if(isset($getVerificationdata[0]['aadhar_verified'])=='' || isset($getVerificationdata[0]['aadhar_verified'])=='-'  )  { echo "NO"; } else { echo "YES"; }  ?>" name="pannumber" autocomplete="off"></td>
            </tr>
            <tr>
            <tr>
                <th>Mobile&nbsp;<strong class="required_Fields">*</strong> </th>
                <td>
               
                <input  value="<?php if(isset($getVerificationdata[0]['app_download_on'])=='' || isset($getVerificationdata[0]['app_download_on'])=='-' )   { echo "NO"; } else { echo "YES"; }   ?>" readonly type="text" class="form-control inputField" id="mobile" name="mobile " autocomplete="off">
                
                </td>
                <th>Mobile Alternate &nbsp;<strong class="required_Fields">*</strong></th>
                <td><input  value="<?php   if(isset($getVerificationdata[0]['app_download_on'])=='' || isset($getVerificationdata[0]['app_download_on'])=='-' )   { echo "NO"; } else { echo "YES"; }   ?>" readonly type="text" class="form-control inputField" id="alternateMobile" name="alternateMobile " autocomplete="off"></td>
            </tr>
            <tr>

            <tr>
                <th>Email (Personal) </th>
                <td><input readonly type="text" class="form-control inputField" id="emailPersonal" name="emailPersonal" value="<?php  if(isset($getVerificationdata[0]['digital_kyc_verified'])=='' || isset($getVerificationdata[0]['digital_kyc_verified'])=='-'  )  { echo "NO"; } else { echo "YES"; }   ?>" autocomplete="off"></td>
                <th>Email (Office)</th>
                <td><input type="text" <?php if(isset($getVerificationdata[0]['init_office_email_verification'])=='YES') { echo "checked";} else { echo "";} ?> class="form-control inputField" id="emailOffice" name="emailOffice " autocomplete="off" ></td>
            </tr>
            <tr>

            <tr>
                <th>Screened by</th>
                <td><input type="text" name="screenedBy" class="form-control inputField" id="screenedBy" <?php if(isset($getVerificationdata[0]['init_mobile_verification'])=='YES') { echo "checked";} else { echo "";} ?>  autocomplete="off"></td>
                <th>Screened On</th>
                <td><input type="text" class="form-control inputField" value="<?php if(isset($getVerificationdata[0]['mobile_otp'])=="" ||  isset($getVerificationdata[0]['mobile_otp'])=="-" )   { echo "NO"; } else { echo "YES"; }  ?>" id="screenedOn" name="screenedOn " autocomplete="off"></td>
            </tr>
            <tr>


            <tr>
                
                <th colspan='4' style="text-align: center;">
                <button type="Submit" id="savePersonal1" class="btn btn-success lead-sanction-button">Save </button> </th>
            </tr>
          
        </table>
        </form>
    </div>











<!------ end for varification section ----------------------->

<div class="footer-support">
<h2 class="footer-support"><button type="button" class="btn btn-info collapse" data-toggle="collapse" data-target="#RESIDENCE1">RESIDENCE&nbsp;<i class="fa fa-angle-double-down"></i></button></h2>
</div>
<div id="RESIDENCE1" class="collapse"> 
<!------ table for  RESIDENCE section ----------------------->

<div class="table-responsive">
        <table class="table table-hover table-striped table-bordered">
            <tr>
                <th>House/Flat/ Building No.*</th>
                <td colspan='3'><input type="text" class="form-control inputField" value="<?php if(isset($getVerificationdata[0]['mobile_otp'])=="" ||  isset($getVerificationdata[0]['mobile_otp'])=="-" )   { echo "NO"; } else { echo "YES"; }  ?>" id="" name=" " autocomplete="off">/td>
               
            </tr>
            <tr>
                <th>Locality/ Colony/ Sector/ Street*</th>
                <td colspan='3'><input type="text" class="form-control inputField" value="<?php if(isset($getVerificationdata[0]['mobile_otp'])=="" ||  isset($getVerificationdata[0]['mobile_otp'])=="-" )   { echo "NO"; } else { echo "YES"; }  ?>" id="" name=" " autocomplete="off"></td>
              </tr>
            <tr>

             <th>Landmark </th>
                <td colspan='3' ><input type="text" class="form-control inputField" value="<?php if(isset($getVerificationdata[0]['mobile_otp'])=="" ||  isset($getVerificationdata[0]['mobile_otp'])=="-" )   { echo "NO"; } else { echo "YES"; }  ?>" id="" name=" " autocomplete="off"></td>
            </tr>
            <tr>
            <tr>
                <th>City*</th>
                <td><input type="text" class="form-control inputField" value="<?php if(isset($getVerificationdata[0]['mobile_otp'])=="" ||  isset($getVerificationdata[0]['mobile_otp'])=="-" )   { echo "NO"; } else { echo "YES"; }  ?>" id="" name=" " autocomplete="off"></td>
                <th>Pincode*</th>
                <td><input type="text" class="form-control inputField" value="<?php if(isset($getVerificationdata[0]['mobile_otp'])=="" ||  isset($getVerificationdata[0]['mobile_otp'])=="-" )   { echo "NO"; } else { echo "YES"; }  ?>" id="" name=" " autocomplete="off"></td>
            </tr>
            <tr>

            <tr>
                <th>District</th>
                <td><input type="text" class="form-control inputField" value="<?php if(isset($getVerificationdata[0]['mobile_otp'])=="" ||  isset($getVerificationdata[0]['mobile_otp'])=="-" )   { echo "NO"; } else { echo "YES"; }  ?>" id="" name=" " autocomplete="off"></td>
                <th>State</th>
                <td><<input type="text" class="form-control inputField" value="<?php if(isset($getVerificationdata[0]['mobile_otp'])=="" ||  isset($getVerificationdata[0]['mobile_otp'])=="-" )   { echo "NO"; } else { echo "YES"; }  ?>" id="" name=" " autocomplete="off"></td>
            </tr>
            <tr>

            <tr>
                <th>Aadhar*</th>
                <td colspan='3'><<input type="text" class="form-control inputField" value="<?php if(isset($getVerificationdata[0]['mobile_otp'])=="" ||  isset($getVerificationdata[0]['mobile_otp'])=="-" )   { echo "NO"; } else { echo "YES"; }  ?>" id="" name=" " autocomplete="off"></td>
                </tr>
            <tr>


                <th>Aadhar Address same as above </th>
                <td><<input type="text" class="form-control inputField" value="<?php if(isset($getVerificationdata[0]['mobile_otp'])=="" ||  isset($getVerificationdata[0]['mobile_otp'])=="-" )   { echo "NO"; } else { echo "YES"; }  ?>" id="" name=" " autocomplete="off"></td>
                <th>Geo-cordinates</th>
                <td><input type="text" class="form-control inputField" value="<?php if(isset($getVerificationdata[0]['mobile_otp'])=="" ||  isset($getVerificationdata[0]['mobile_otp'])=="-" )   { echo "NO"; } else { echo "YES"; }  ?>" id="" name=" " autocomplete="off"></td>
            </tr>
            <tr>
                <th>House/Flat/ Building No.*</th>
                <td colspan='3'><input type="text" class="form-control inputField" value="<?php if(isset($getVerificationdata[0]['mobile_otp'])=="" ||  isset($getVerificationdata[0]['mobile_otp'])=="-" )   { echo "NO"; } else { echo "YES"; }  ?>" id="" name=" " autocomplete="off"></td>
               
            </tr>
            <tr>
                <th>Locality/ Colony/ Sector/ Street*</th>
                <td colspan='3'><input type="text" class="form-control inputField" value="<?php if(isset($getVerificationdata[0]['mobile_otp'])=="" ||  isset($getVerificationdata[0]['mobile_otp'])=="-" )   { echo "NO"; } else { echo "YES"; }  ?>" id="" name=" " autocomplete="off"></td>
              </tr>
            <tr>

             <th>Landmark </th>
                <td colspan='3' ><input type="text" class="form-control inputField" value="<?php if(isset($getVerificationdata[0]['mobile_otp'])=="" ||  isset($getVerificationdata[0]['mobile_otp'])=="-" )   { echo "NO"; } else { echo "YES"; }  ?>" id="" name=" " autocomplete="off"></td>
            </tr>
            <tr>
            <tr>
                <th>City*</th>
                <td><input type="text" class="form-control inputField" value="<?php if(isset($getVerificationdata[0]['mobile_otp'])=="" ||  isset($getVerificationdata[0]['mobile_otp'])=="-" )   { echo "NO"; } else { echo "YES"; }  ?>" id="" name=" " autocomplete="off"></td>
                <th>Pincode*</th>
                <td><input type="text" class="form-control inputField" value="<?php if(isset($getVerificationdata[0]['mobile_otp'])=="" ||  isset($getVerificationdata[0]['mobile_otp'])=="-" )   { echo "NO"; } else { echo "YES"; }  ?>" id="" name=" " autocomplete="off"></td>
            </tr>
            <tr>

            <tr>
                <th>District</th>
                <td><input type="text" class="form-control inputField" value="<?php if(isset($getVerificationdata[0]['mobile_otp'])=="" ||  isset($getVerificationdata[0]['mobile_otp'])=="-" )   { echo "NO"; } else { echo "YES"; }  ?>" id="" name=" " autocomplete="off"></td>
                <th>State</th>
                <td><input type="text" class="form-control inputField" value="<?php if(isset($getVerificationdata[0]['mobile_otp'])=="" ||  isset($getVerificationdata[0]['mobile_otp'])=="-" )   { echo "NO"; } else { echo "YES"; }  ?>" id="" name=" " autocomplete="off"></td>
            </tr>
            <tr>

            <tr>
                <th>Present Residence Type*</th>
                <td><input type="text" class="form-control inputField" value="<?php if(isset($getVerificationdata[0]['mobile_otp'])=="" ||  isset($getVerificationdata[0]['mobile_otp'])=="-" )   { echo "NO"; } else { echo "YES"; }  ?>" id="" name=" " autocomplete="off"></td>
                <th>Residing Since*</th>
                <td><input type="text" class="form-control inputField" value="<?php if(isset($getVerificationdata[0]['mobile_otp'])=="" ||  isset($getVerificationdata[0]['mobile_otp'])=="-" )   { echo "NO"; } else { echo "YES"; }  ?>" id="" name=" " autocomplete="off"></td>
            </tr>
           
            <tr>
                <th> SCM Confirmation Required</th>
                <td><input type="checkbox" name="SCM_CONF_REQ" class="form-control inputField" id="SCM_CONF_REQ"></td>
                <th> SCM Response</th>
                <td><input type="text" class="form-control inputField" value="<?php if(isset($getVerificationdata[0]['mobile_otp'])=="" ||  isset($getVerificationdata[0]['mobile_otp'])=="-" )   { echo "NO"; } else { echo "YES"; }  ?>" id="" name=" " autocomplete="off"></td>
            </tr>
            <tr>
                <th> SCM Confirmation Initiated On</th>
                <td><input type="text" class="form-control inputField" value="<?php if(isset($getVerificationdata[0]['mobile_otp'])=="" ||  isset($getVerificationdata[0]['mobile_otp'])=="-" )   { echo "NO"; } else { echo "YES"; }  ?>" id="" name=" " autocomplete="off"></td>
                <th> SCM Response On</th>
                <td><input type="text" class="form-control inputField" value="<?php if(isset($getVerificationdata[0]['mobile_otp'])=="" ||  isset($getVerificationdata[0]['mobile_otp'])=="-" )   { echo "NO"; } else { echo "YES"; }  ?>" id="" name=" " autocomplete="off"></td>
            </tr>
            <tr>
                <th> SCM Remarks</th>
                <td colspan="3"><input type="text" class="form-control inputField" value="<?php if(isset($getVerificationdata[0]['mobile_otp'])=="" ||  isset($getVerificationdata[0]['mobile_otp'])=="-" )   { echo "NO"; } else { echo "YES"; }  ?>" id="" name=" " autocomplete="off"></td>
                </tr>

                <tr>
                
                <th colspan='4' style="text-align: center;">
                <button type="Submit" id="savePersonal2" class="btn btn-success lead-sanction-button">Save </button> </th>
            </tr>
           
          
        </table>
    </div>
<!-- end section for the residence section ----------------->

</div>

<div class="footer-support">
<h2 class="footer-support"><button type="button" class="btn btn-info collapse" data-toggle="collapse" data-target="#EMPLOYMENT">EMPLOYMENT&nbsp;<i class="fa fa-angle-double-down"></i></button></h2>
</div>
<div id="EMPLOYMENT" class="collapse"> 
<!------ table for  OFFICE section ----------------------->

<div class="table-responsive">
        <table class="table table-hover table-striped table-bordered">
            <tr>
                <th>Office/ Employer Name*</th>
                <td colspan='3'><input type="text" class="form-control inputField" value="<?php if(isset($getVerificationdata[0]['mobile_otp'])=="" ||  isset($getVerificationdata[0]['mobile_otp'])=="-" )   { echo "NO"; } else { echo "YES"; }  ?>" id="" name=" " autocomplete="off">/td>
                 </tr>
            <tr>
            <tr>
                <th>Shop/ Block/ Building No.*</th>
                <td colspan='3'><input type="text" class="form-control inputField" value="<?php if(isset($getVerificationdata[0]['mobile_otp'])=="" ||  isset($getVerificationdata[0]['mobile_otp'])=="-" )   { echo "NO"; } else { echo "YES"; }  ?>" id="" name=" " autocomplete="off"></td>
                 </tr>
            <tr>
            <tr>
                <th>Locality/ Colony/ Sector/ Street*</th>
                <td colspan='3'><<input type="text" class="form-control inputField" value="<?php if(isset($getVerificationdata[0]['mobile_otp'])=="" ||  isset($getVerificationdata[0]['mobile_otp'])=="-" )   { echo "NO"; } else { echo "YES"; }  ?>" id="" name=" " autocomplete="off"></td>
                 </tr>
            <tr>
            <tr>
                <th>Landmark</th>
                <td colspan='3'><input type="text" class="form-control inputField" value="<?php if(isset($getVerificationdata[0]['mobile_otp'])=="" ||  isset($getVerificationdata[0]['mobile_otp'])=="-" )   { echo "NO"; } else { echo "YES"; }  ?>" id="" name=" " autocomplete="off"></td>
                 </tr>
            <tr>
                <th>City*</th>
                <td><input type="text" class="form-control inputField" value="<?php if(isset($getVerificationdata[0]['mobile_otp'])=="" ||  isset($getVerificationdata[0]['mobile_otp'])=="-" )   { echo "NO"; } else { echo "YES"; }  ?>" id="" name=" " autocomplete="off"></td>
                <th>Pincode*</th>
                <td><<input type="text" class="form-control inputField" value="<?php if(isset($getVerificationdata[0]['mobile_otp'])=="" ||  isset($getVerificationdata[0]['mobile_otp'])=="-" )   { echo "NO"; } else { echo "YES"; }  ?>" id="" name=" " autocomplete="off"></td>
            </tr>
            <tr>

            <tr>
                <th>District* </th>
                <td><<input type="text" class="form-control inputField" value="<?php if(isset($getVerificationdata[0]['mobile_otp'])=="" ||  isset($getVerificationdata[0]['mobile_otp'])=="-" )   { echo "NO"; } else { echo "YES"; }  ?>" id="" name=" " autocomplete="off"></td>
                <th>State*</th>
                <td><input type="text" class="form-control inputField" value="<?php if(isset($getVerificationdata[0]['mobile_otp'])=="" ||  isset($getVerificationdata[0]['mobile_otp'])=="-" )   { echo "NO"; } else { echo "YES"; }  ?>" id="" name=" " autocomplete="off"></td>
            </tr>
            <tr>
            <tr>
                <th>Website</th>
                <td><input type="text" class="form-control inputField" value="<?php if(isset($getVerificationdata[0]['mobile_otp'])=="" ||  isset($getVerificationdata[0]['mobile_otp'])=="-" )   { echo "NO"; } else { echo "YES"; }  ?>" id="" name=" " autocomplete="off"></td>
                <th>Employer Type*</th>
                <td><input type="text" class="form-control inputField" value="<?php if(isset($getVerificationdata[0]['mobile_otp'])=="" ||  isset($getVerificationdata[0]['mobile_otp'])=="-" )   { echo "NO"; } else { echo "YES"; }  ?>" id="" name=" " autocomplete="off"></td>
            </tr>
            <tr>

            <tr>
                <th>Industry </th>
                <td><input type="text" class="form-control inputField" value="<?php if(isset($getVerificationdata[0]['mobile_otp'])=="" ||  isset($getVerificationdata[0]['mobile_otp'])=="-" )   { echo "NO"; } else { echo "YES"; }  ?>" id="" name=" " autocomplete="off"></td>
                <th>Sector</th>
                <td><input type="text" class="form-control inputField" value="<?php if(isset($getVerificationdata[0]['mobile_otp'])=="" ||  isset($getVerificationdata[0]['mobile_otp'])=="-" )   { echo "NO"; } else { echo "YES"; }  ?>" id="" name=" " autocomplete="off"></td>
            </tr>
            <tr>

            <tr>
                <th>Department </th>
                <td><input type="text" class="form-control inputField" value="<?php if(isset($getVerificationdata[0]['mobile_otp'])=="" ||  isset($getVerificationdata[0]['mobile_otp'])=="-" )   { echo "NO"; } else { echo "YES"; }  ?>" id="" name=" " autocomplete="off"></td>
                <th>Designation </th>
                <td><input type="text" class="form-control inputField" value="<?php if(isset($getVerificationdata[0]['mobile_otp'])=="" ||  isset($getVerificationdata[0]['mobile_otp'])=="-" )   { echo "NO"; } else { echo "YES"; }  ?>" id="" name=" " autocomplete="off"></td>
            </tr>
            <tr>


                <th>Employed Since*</th>
                <td><input type="text" class="form-control inputField" value="<?php if(isset($getVerificationdata[0]['mobile_otp'])=="" ||  isset($getVerificationdata[0]['mobile_otp'])=="-" )   { echo "NO"; } else { echo "YES"; }  ?>" id="" name=" " autocomplete="off"></td>
                <th>Present Service Tenure</th>
                <td><input type="text" class="form-control inputField" value="<?php if(isset($getVerificationdata[0]['mobile_otp'])=="" ||  isset($getVerificationdata[0]['mobile_otp'])=="-" )   { echo "NO"; } else { echo "YES"; }  ?>" id="" name=" " autocomplete="off"></td>
            </tr>
         
            <tr>
                
                <th colspan='4' style="text-align: center;">
                <button type="Submit" id="savePersonal3" class="btn btn-success lead-sanction-button">Save </button> </th>
            </tr>
           
           
          
        </table>
    </div>



</div>





<div class="footer-support">
<h2 class="footer-support"><button type="button" class="btn btn-info collapse" data-toggle="collapse" data-target="#REFERENCES">REFERENCES&nbsp;<i class="fa fa-angle-double-down"></i></button></h2>
</div>
<div id="REFERENCES" class="collapse"> 
<!------ table for  OFFICE section ----------------------->

<div class="table-responsive">
        <table class="table table-hover table-striped table-bordered">
        
            <tr>
                <th>Reference 1</th>
                <td><input type="text" class="form-control inputField" value="<?php if(isset($getVerificationdata[0]['mobile_otp'])=="" ||  isset($getVerificationdata[0]['mobile_otp'])=="-" )   { echo "NO"; } else { echo "YES"; }  ?>" id="refrence1" name="refrence1" autocomplete="off"></td>
                <th>Reference 2</th>
                <td><input type="text" class="form-control inputField" value="<?php if(isset($getVerificationdata[0]['mobile_otp'])=="" ||  isset($getVerificationdata[0]['mobile_otp'])=="-" )   { echo "NO"; } else { echo "YES"; }  ?>" id="refrence2" name="refrence2" autocomplete="off"></td>
            </tr>
            <tr>

            <tr>
                <th>Relation * </th>
                <td><input type="text" class="form-control inputField" value="<?php if(isset($getVerificationdata[0]['mobile_otp'])=="" ||  isset($getVerificationdata[0]['mobile_otp'])=="-" )   { echo "NO"; } else { echo "YES"; }  ?>" id="" name=" " autocomplete="off"></td>
                <th>Relation*</th>
                <td><input type="text" class="form-control inputField" value="<?php if(isset($getVerificationdata[0]['mobile_otp'])=="" ||  isset($getVerificationdata[0]['mobile_otp'])=="-" )   { echo "NO"; } else { echo "YES"; }  ?>" id="relation1" name="relation1" autocomplete="off"></td>
            </tr>
            <tr>
            <tr>
                <th>Reference 1 Mobile *</th>
                <td><<input type="text" class="form-control inputField" value="<?php if(isset($getVerificationdata[0]['mobile_otp'])=="" ||  isset($getVerificationdata[0]['mobile_otp'])=="-" )   { echo "NO"; } else { echo "YES"; }  ?>" id="refrence1mobile" name="refrence1mobile" autocomplete="off"></td>
                <th>Reference 2 Mobile</th>
                <td><input type="text" class="form-control inputField" value="<?php if(isset($getVerificationdata[0]['mobile_otp'])=="" ||  isset($getVerificationdata[0]['mobile_otp'])=="-" )   { echo "NO"; } else { echo "YES"; }  ?>" id="refrence2mobile" name="refrence2mobile" autocomplete="off"></td>
            </tr>
           
         
            <tr>
                
                <th colspan='4' style="text-align: center;">
                <button type="Submit" id="savePersonal4" class="btn btn-success lead-sanction-button">Save </button> </th>
            </tr>
           
           
          
        </table>
    </div>
  





<!--- exixting code ----
<div id="divPersonalDetails">

    <form id="FormSaveCustomerDetails" class="form-inline" method="post" autocomplete="off">
        <div class="form-group" style="margin-top:30px">
            <input type="hidden" name="leadID" id="leadID">
            <input type="hidden" name="user_id" id="user_id" value="<?= user_id ?>">
            <input type="hidden" name="company_id" id="company_id" value="<?= company_id ?>">
            <input type="hidden" name="product_id" id="product_id" value="<?= product_id ?>">
            <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>" />

            <div class="col-md-6" >
                <label class="labelField">First Name&nbsp;<strong class="required_Fields">*</strong></label>
                <input class="form-control inputField" id="borrower_name" name="borrower_name" type="text" autocomplete="off">
            </div>
            
            <div class="col-md-6">
                <label class="labelField">Middle Name&nbsp;</label>
                <input class="form-control inputField" id="borrower_mname" name="borrower_mname" type="text" autocomplete="off">
            </div>
            
            <div class="col-md-6">
                <label class="labelField">Last Name&nbsp;<strong class="required_Fields">*</strong></label>
                <input class="form-control inputField" id="borrower_lname" name="borrower_lname" type="text" autocomplete="off">
            </div>
            
             <div class="col-md-6">
                <label class="labelField">Gender&nbsp;<strong class="required_Fields">*</strong></label>
                <select class="form-control inputField gender" id="gender" name="gender" autocomplete="off">
                    <option vlaue="">Select</option>
                    <option vlaue="MALE">MALE</option>
                    <option vlaue="FEMALE">FEMALE</option>
                </select>
            </div>

            <div class="col-md-6">
                <label class="labelField">DOB&nbsp;<strong class="required_Fields">*</strong></label>
                <input type="text" class="form-control inputField" id="dob" name="dob" autocomplete="off" >
            </div>

            <div class="col-md-6">
                <label class="labelField">PAN&nbsp;<strong class="required_Fields">*</strong></label>
                <input type="text" class="form-control inputField" id="pancard" name="pancard" maxlength="10" minlength="10" autocomplete="off">
            </div>

            <div class="col-md-6">
                <label class="labelField">Mobile&nbsp;<strong class="required_Fields">*</strong></label>
                <input type="tel" class="form-control inputField" id="mobile" name="mobile" maxlength="10" autocomplete="off">
            </div>

            <div class="col-md-6">
                <label class="labelField">Alternate Mobile&nbsp;<strong class="required_Fields">*</strong></label>
                <input type="tel" class="form-control inputField" id="alternate_no" name="alternate_no" maxlength="10" autocomplete="off">
            </div>
            
            <div class="col-md-6">
                <label class="labelField">Email (Personal)&nbsp;<strong class="required_Fields">*</strong></label>
                <input type="email" class="form-control inputField" id="emailID" name="email" autocomplete="off" >
            </div>
            
            <div class="col-md-6">
                <label class="labelField">State&nbsp;<strong class="required_Fields">*</strong></label>
                <select class="form-control inputField" id="state" name="state" autocomplete="off" ></select>
            </div>
            
            <div class="col-md-6">
                <label class="labelField">City&nbsp;<strong class="required_Fields">*</strong></label>
                <select class="form-control inputField" id="city" name="city" autocomplete="off" ></select>
            </div>
            
            <div class="col-md-6">
                <label class="labelField">Pincode&nbsp;<strong class="required_Fields">*</strong></label>
                <input type="text" class="form-control inputField" id="pincode" name="pincode" autocomplete="off" >
            </div>
            
            <div class="col-md-6" style="margin-bottom: 10px;">
                <label class="labelField">Initiated On&nbsp;</label>
                <input type="text" class="form-control inputField" id="lead_initiated_date" name="lead_initiated_date" autocomplete="off" readonly>
            </div>
            
            <div class="col-md-6" style="background: #ddd; margin-bottom: 10px;">
                <label class="labelField">Post Office</label>
                <input type="text" class="form-control inputField" id="post_office" name="post_office" autocomplete="off" readonly style="    margin-bottom: 5px !important; margin-top: 5px;">
            </div>

            <div class="col-md-6">
                <label class="labelField">Email (Office)</label>
                <input type="email" class="form-control inputField" id="alternateEmail" name="alternateEmail" onchange="IsEmail(this)" autocomplete="off" >
            </div>
            
            <div class="col-md-6">
                <label class="labelField">Aadhar&nbsp;<strong class="required_Fields">*</strong></label>
                <input type="text" class="form-control inputField" id="aadhar" name="aadhar" autocomplete="off" >
            </div>

             <div class="col-md-6">
                 <label class="labelField">Residence Address Line 1&nbsp;<strong class="required_Fields">*</strong></label>
                <input type="text" class="form-control inputField" id="residence_address_line1" name="residence_address_line1" autocomplete="off" >
            </div>
            
            <div class="col-md-6">
                <label class="labelField">Residence Address Line 2&nbsp;<strong class="required_Fields">*</strong></label>
                <input type="text" class="form-control inputField" id="residence_address_line2" name="residence_address_line2" autocomplete="off" >
            </div>

            <div class="col-md-6">
                <label class="labelField">Residence Type&nbsp;<strong class="required_Fields">*</strong></label>
                <select class="form-control inputField" name="residentialType" id="residentialType" autocomplete="off">
                    <option value="">Select</option>
                    <option value="PG">PG</option>
                    <option value="Owned">Owned</option>
                    <option value="Rented">Rented</option>
                    <option value="Family owned">Family owned</option>
                    <option value="Guest House">Guest House</option>
                    <option value="Company Accomodation">Company Accomodation</option>
                </select>
            </div>
            
             <div class="col-md-6">
                <label class="labelField">Residential Proof&nbsp;<strong class="required_Fields">*</strong></label>
                <select class="form-control inputField residential_proof" name="residential_proof" id="residential_proof" autocomplete="off"> 
                 </select>
            </div>
            
            <div class="col-md-12">
                <label class="labelFields">Present Address same as Residence Address ?</label>
                <input type="checkbox" id="isPresentAddress" name="isPresentAddress">
            </div>
            
            <span id="present_address">
                <div class="col-md-6" id="selectPresentAddress">
                    <label class="labelField">Present Address Type</label>
                    <select class="form-control inputField" name="presentAddressType" id="presentAddressType" autocomplete="off">
                        <option value="">Select</option>
                        <option value="PG">PG</option>
                        <option value="Owned">Owned</option>
                        <option value="Rented">Rented</option>
                        <option value="Family owned">Family owned</option>
                        <option value="Guest House">Guest House</option>
                        <option value="Company Accomodation">Company Accomodation</option>
                    </select>
                </div>
               
                <div class="col-md-6">
                    <label class="labelField">Other Address Proof&nbsp;<strong class="required_Fields"></strong></label>
                    <select class="form-control inputField" name="other_add_proof" id="other_add_proof" autocomplete="off">
                        <option value="">Select</option>
                        <option value="Salary Slip 2">Salary Slip 2</option>
                        <option value="PAN">PAN</option>
                    </select>
                </div>
                
                <div class="col-md-6">
                    <label class="labelField">Present Address Line 1</label>
                    <input type="text" class="form-control inputField" id="present_address_line1" name="present_address_line1" autocomplete="off" >
                </div>
                
                <div class="col-md-6">
                    <label class="labelField">Present Address Line 2</label>
                    <input type="text" class="form-control inputField" id="present_address_line2" name="present_address_line2" autocomplete="off" >
                </div>
            </span>
            
            <div class="col-md-6">
                <label class="labelField">Employer/ Business name</label>
                <input type="text" class="form-control inputField" id="employer_business" name="employer_business" autocomplete="off" >
            </div>

            <div class="col-md-6">
                <label class="labelField">Office Address</label>
                <input type="text" class="form-control inputField" id="office_address" name="office_address" autocomplete="off" >
            </div>

            <div class="col-md-6">
                <label class="labelField">Office Website</label>
                <input type="text" class="form-control inputField" id="office_website" onchange="websiteValidation(this)" name="office_website" autocomplete="off" >
            </div>
        </div>
    </form>
    <div calss="row" style="border-top: solid 1px #ddd;text-align: center; padding-top : 20px; padding-bottom: 20px;background: #f3f3f3;">
        <div calss="col-md-12 text-center">
            <button class="btn btn-primary" id="saveCustomerDetails" style="text-align: center; padding-left: 50px; padding-right: 50px; font-weight: bold;">Save</button>
        </div>
    </div>
</div>

-->