<?php $this->load->view('Layouts/header') ?>
<?php $url =  $this->uri->segment(1); ?>
<?php $state =  $this->uri->segment(2); ?>
<span id="response" style="width: 100%;float: left;text-align: center;padding-top:-20%;"></span>
<section>
    <div class="width-my">
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
                <div class="col-md-12" style="padding: 0px !important;">
                    <div class="page-container list-menu-view">
                        <div class="page-content">
                            <div class="main-container">
                                <div class="container-fluid">
                                    <div class="col-md-12">
                                        <div class="login-formmea">
                                            <div class="box-widget widget-module">
                                                <div class="widget-head clearfix">
                                                    <span class="h-icon"><i class="fa fa-th"></i></span>
                                                    <span class="inner-page-tag">Leads</span> 
                                                    <span class="counter inner-page-box"><?= $leadDetails->num_rows(); ?></span>
                                                    <?php if($state == "S1" || $state == "S4" ){ ?>
                                                    <a  class="btn inner-page-box checkDuplicateItem" id="checkDuplicateItem" style="background: #0d7ec0 !important;">Duplicate</a>
                                                    <a  class="btn inner-page-box" id="allocate" style="background: #0d7ec0 !important;">Allocate</a> 
                                                    <?php } ?>
                                                </div>
                                                <div class="widget-container">
                                                    <div class=" widget-block">
                                                        <div class="row">
                                                            <div class="scroll_on_x_axis table-responsive">
                                                                <!-- data-order='[[ 0, "desc" ]]' -->
                                                                <table class="table dt-table table-striped table-bordered table-hover"  style="border: 1px solid #dde2eb">
                                                                    <thead>
                                                                        <tr>
                                                                            <th><b>Sr.&nbsp;No</b></th>
                                                                            <th><b>Action</b></th>
                                                                            <th><b>CIF&nbsp;No.</b></th>
                                                                            <th><b>Application&nbsp;No.</b></th>
                                                                            <th><b>Loan&nbsp;No.</b></th>
                                                                            <th><b>Borrower</b></th>
                                                                            <th><b>State</b></th>
                                                                            <th><b>City</b></th>
                                                                            <th><b>Mobile</b></th>
                                                                            <!-- <th><b>Email</b></th> -->
                                                                            <th><b>PAN</b></th>
                                                                            <th><b>Source</b></th>
                                                                            <th><b>Status</b></th>
                                                                            <th><b>Applied&nbsp;On</b></th>
                                                                            
                                                                        </tr>
                                                                    </thead>
                                                                    <tbody>
                                                                        <?php $sn=1; foreach($leadDetails->result() as $row) : ?>
                                                                        <tr>
                                                                            <td><?= $sn++; ?></td>
                                                                            <td>
                                                                            <?php if($row->status == "LEAD-NEW" || $row->status == "APPLICATION-NEW"){ ?>
                                                                                <input type="checkbox" name="duplicate_id[]" class="duplicate_id" id="duplicate_id" value="<?= $row->lead_id; ?>">&nbsp;</br>
                                                                            <?php }else{ ?>
                                                                                <a href="<?= base_url("getleadDetails/". $this->encrypt->encode($row->lead_id)) ?>" class="" id="viewLeadsDetails">
                                                                                    <span class="glyphicon glyphicon-edit" style="    font-size: 20px;"></span>
                                                                                </a>
                                                                            <?php } ?>
                                                                            </td>
                                                                            <td><?= $row->customer_id; ?></td> 
                                                                            <td><?= ($row->application_no) ? strtoupper($row->application_no) : "-" ?></td>
                                                                            <td><?= $row->customer_id; ?></td>
                                                                            <td><?= strtoupper($row->name ." ". $row->middle_name ." ". $row->sur_name) ?></td>
                                                                            <td><?= strtoupper($row->state) ?></td>
                                                                            <td><?= strtoupper($row->city) ?></td>
                                                                            <td><?= ($row->mobile) ? $row->mobile : '-' ?></td>
                                                                            <td><?= ($row->pancard) ? strtoupper($row->pancard) : '-' ?></td>
                                                                            <td><?= ($row->source) ? strtoupper($row->source) : '-' ?></td>
                                                                            <td><?= ($row->status) ? strtoupper($row->status) : '-' ?></td>
                                                                            <td><?= date('d-m-Y h:i', strtotime($row->created_on)) ?></td> 
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
</div>
</section>
<?php $this->load->view('Layouts/footer') ?>
<?php $this->load->view('Tasks/main_js.php') ?>