
    <div class="table-responsive">
        <table class="table table-hover table-striped table-bordered">
            <tr>
                <th>Application No.</th>
                <td><?= ($leadDetails->application_no) ? $leadDetails->application_no :'-' ?></td>
                <th>CIF No.</th>
                <td><?= ($leadDetails->customer_id) ? $leadDetails->customer_id :'-' ?></td>
            </tr>
            <tr>
                <th>Borrower Type</th>
                <td>-</td>
                <th>Loan Applied</th>
                <td><?= ($leadDetails->loan_amount) ? round($leadDetails->loan_amount) :'-' ?></td>
            </tr>
            <tr>
                <th>First Name</th>
                <td><?= strtoupper($leadDetails->name) ?></td>
                <th>Middle Name</th>
                <td><?= ($leadDetails->middle_name) ? strtoupper($leadDetails->middle_name) :'-' ?></td>
            </tr>
            <tr>
                <th>Surname</th>
                <td><?= ($leadDetails->sur_name) ? strtoupper($leadDetails->sur_name) :'-' ?></td>
                <th>Gender</th>
                <td><?= ($leadDetails->gender) ? strtoupper($leadDetails->gender) :'-' ?></td>
            </tr>
            <tr>
                <th>DOB</th>
                <td><?= ($leadDetails->dob) ? date('d-m-Y', strtotime($leadDetails->dob)) :'-' ?></td>
                <th>PAN</th>
                <td><?= ($leadDetails->pancard) ? strtoupper($leadDetails->pancard) :'-' ?></td>
            </tr>
            <tr>
                <th>Mobile</th>
                <td><?= ($leadDetails->mobile) ? $leadDetails->mobile :'-' ?></td>
                <th>Mobile Alternate</th>
                <td><?= ($leadDetails->alternateMobileNo) ? $leadDetails->alternateMobileNo :'-' ?></td>
            </tr>
            <tr>
                <th>Email (Personal)</th>
                <td><?= ($leadDetails->email) ? strtoupper($leadDetails->email) :'-' ?></td>
                <th>Email (Office)</th>
                <td><?= ($leadDetails->alternateEmailAddress) ? strtoupper($leadDetails->alternateEmailAddress) :'-' ?></td>
            </tr>
            <tr>
                <th>Salary</th>
                <td><?= ($leadDetails->monthly_income) ? round($leadDetails->monthly_income) :'-' ?></td>
                <th>Obligations</th>
                <td><?= ($leadDetails->obligations) ? strtoupper($leadDetails->obligations) :'-' ?></td>
            </tr>
            <tr>
                <th>State</th>
                <td><?= ($leadDetails->state) ? strtoupper($leadDetails->state) :'-' ?></td>
                <th>City</th>
                <td><?= ($leadDetails->city) ? strtoupper($leadDetails->city) :'-' ?></td>
            </tr>
            <tr>
                <th>Pincode</th>
                <td><?= ($leadDetails->pincode) ? $leadDetails->pincode :'-' ?></td>
                <th style="background: #ddd;">Post Office</th>
                <td style="background: #ddd;">-</td>
            </tr>
            <tr>
                <th>Selfie Vedio</th>
                <td style="background: #ddd;">-</td>
                <th>Status</th>
                <td><?= ($leadDetails->status) ? $leadDetails->status :'-' ?></td>
            </tr>
            <tr>
                <th>Lead Source</th>
                <td><?= ($leadDetails->source) ? strtoupper($leadDetails->source) :'-' ?></td>
                <th>Applied On</th>
                <td><?= ($leadDetails->created_on) ? date('d-m-Y h:i:s', strtotime($leadDetails->created_on)) :'-' ?></td>
            </tr>
            <tr>
                <th>IP Address</th>
                <td><?= ($leadDetails->ip) ? $leadDetails->ip :'-' ?></td>
                <th>Geo Coordinates</th>
                <td><?= ($leadDetails->coordinates) ? $leadDetails->coordinates :'-' ?></td>
            </tr>
            <tr>
                <th colspan="4">
                    <input type="checkbox" id="tnc1" name="t&c" class="lead-checkbox2"<?= ($leadDetails->term_and_condition == "YES") ? "checked" :'unchecked' ?> disabled>&nbsp;
                    I agree to Loanwalle's Terrms and Conditions and Privacy Policy and receive communication from Loanwalle via SMS, Email and Whatsapp.
                </th>
            </tr>
        </table>
    </div>