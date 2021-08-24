<?php $this->load->view('Layouts/header') ?>
<!-- section start -->
<section>
    <div class="container-fluid"  style="height:740px;">
        <div class="taskPageSize">
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
                                                    <div class="row">
                                                        
                                                    <div class="head">LEAD APPROVALS 
                                                        <span class="price-counter"><?= $taskCount; ?></span>
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
                                                                            <th><b>Action</b></th>
                                                                        </tr>
                                                                    </thead>
                                                                    <tbody>
                                                                        <?php $i = 1; foreach($listTask as $row) : ?>
                                                                        <tr class="table-default">
                                                                            <td><?= $row->lead_id; ?></td>
                                                                            <td><?= $row->name; ?></td>
                                                                            <td><?= $row->email; ?></td>
                                                                            <td><?= $row->state; ?></td>
                                                                            <td><?= $row->state; ?></td>
                                                                            <td><?= $row->created_on; ?></td>
                                                                            <td><?= $row->source; ?></td>
                                                                            <td><?= $row->status; ?></td>
                                                                            <td><a href="#" onclick="viewLeadsDuplicateDetails('<?= $row->lead_id; ?>')" data-toggle="modal" data-target="#myModal"><i class="fa fa-pencil-square-o"></i></a></td>
                                                                        </tr>
                                                                        <?php $i++; endforeach; ?>
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

<div id="myModal" class="modal fade" tabindex="-1" data-backdrop="static" data-keyboard="false" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document" style="margin-top : 20px; background: #fff;">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">...</h5><hr>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <input type="hidden" class="form-control" name="lead_id" id="lead_id" readonly>
                <table id="modelTable" class="table table-borderless footer-support" style="border : 0;"></table>
            </div>
            <div class="modal-footer">
                <!-- <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Save changes</button> -->
            </div>
        </div>
    </div>
</div>

<!-- footer -->
<?php $this->load->view('Layouts/footer') ?>
<script>
    function viewLeadsDuplicateDetails(lead_id){
        $.ajax({
            url : '<?= base_url("duplicateLeadDetails/") ?>'+lead_id,
            type : 'POST',
            dataType : "json",
            async: false,
            success : function(response){
                $('#exampleModalLongTitle').html('&nbsp;&nbsp; Duplicate Lead Check #'+lead_id);
                $('#modelTable').html(response);
            },
            error: function(XMLHttpRequest, textStatus, errorThrown) { 
                $("#exampleModalLongTitle").html(textStatus +" : "+ errorThrown);
                return false;
            }
        });
    }
</script>