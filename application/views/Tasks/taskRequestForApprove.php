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
                                                    <h4>Request For Approval</h4>
                                                    <div class="head">Total Tasks 
                                                        <span><?= $taskCount; ?></span>
                                                    </div>
                                                    <div class="download">
                                                        <a href="#">EXCEL</a>
                                                        <a href="#">CSV</a>
                                                        <a href="#">SELECT</a>
                                                        <a href="#">SHOW</a>
                                                    </div>
                                                </div>
                                                <div class="widget-container">
                                                    <div class=" widget-block">
                                                        <div class="row">
                                                            <div class="scroll_on_x_axis">
                                                                <!--<table data-order='[[ 1, "asc" ]]' data-page-length='25'>-->
                                                                <table class="table dt-table table-striped table-bordered table-responsive table-hover" data-order='[[ 0, "desc" ]]' style="border: 1px solid #dde2eb">
                                                                    <thead>
                                                                        <tr>
                                                                            <th><b>#</b></th>
                                                                            <th><b>Borrower Name</b></th>
                                                                            <th><b>Email</b></th>
                                                                            <th><b>Branch</b></th>
                                                                            <th><b>Center</b></th>
                                                                            <th><b>Initiated On</b></th>
                                                                            <th><b>Lead Source</b></th>
                                                                            <th><b>Lead Status</b></th>
                                                                            <th><b>Requested By</b></th>
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
                                                                                <?php } ?>
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
<script>
    function reCreditLoan(){
        var lead_id = $("#lead_id").val();

        $.ajax({
            url : '<?= base_url("reCreditLoan") ?>',
            type : 'POST',
            data:{lead_id : lead_id},
            async:false,
            success : function(response) {
                if(response == "true"){
                    $(".msg").show().fadeOut(2000);
                    $(".msg a").html("Loan Approved Successfully.");
                    window.location.reload();
                }
            }
        });
    }

    function ApproveSenctionLoan(){
        var lead_id = $("#lead_id").val();

        $.ajax({
            url : '<?= base_url("ApproveSenctionLoan") ?>',
            type : 'POST',
            data : {lead_id : lead_id},
            async:false,
            success : function(response) {
                if(response == "true"){
                    $(".msg").show().fadeOut(2000);
                    $(".msg a").html("Loan Approved Successfully.");
                    window.location.reload();
                }
            }
        });
    }
</script>



