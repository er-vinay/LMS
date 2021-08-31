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