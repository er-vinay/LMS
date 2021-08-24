<?php $this->load->view('Layouts/header') ?>
<!-- section start -->
<section>
    <div class="container-fluid">
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
                                                    <h4>Leads Disbursed</h4>
                                                    <div class="head"> 
                                                        <span class="counter"><?= $leadDisbursed->num_rows(); ?></span>
                                                    </div>
                                                </div>
                                                <div class="widget-container">
                                                    <div class=" widget-block">
                                                        <div class="row">
                                                            <div class="scroll_on_x_axis table-responsive">
                                                                <!--<table class="table dt-tables table-striped table-bordered table-responsive table-hover" style="border: 1px solid #dde2eb">-->
                                                                <!--    <thead>-->
                                                                <!--        <tr>-->
                                                                <!--            <th><b>Sr. No</b></th>-->
                                                                <!--            <th><b>Action</b></th>-->
                                                                <!--            <th><b>Application No</b></th>-->
                                                                <!--            <th><b>Borrower</b></th>-->
                                                                <!--            <th><b>State</b></th>-->
                                                                <!--            <th><b>City</b></th>-->
                                                                <!--            <th><b>Mobile</b></th>-->
                                                                <!--            <th><b>Email</b></th>-->
                                                                <!--            <th><b>PAN</b></th>-->
                                                                <!--            <th><b>Source</b></th>-->
                                                                <!--            <th><b>Status</b></th>-->
                                                                <!--            <th><b>Initiated On</b></th>-->
                                                                <!--        </tr>-->
                                                                <!--    </thead>-->
                                                                <!--    <tbody>-->
                                                                <!--    </tbody>-->
                                                                <!--</table>-->
                                                                
                                                                <div id="load_data"></div>
                                                                <div id="load_data_message"></div>
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
<?php $this->load->view('Tasks/main_js.php') ?>
<script>
  $(document).ready(function(){
    var limit = 7;
    var start = 0;
    var action = 'inactive';

    function lazzy_loader(limit)
    {
      var output = '';
      for(var count=0; count<limit; count++)
      {
        output += '<div class="post_data">';
        output += '<p><span class="content-placeholder" style="width:100%; height: 30px;">&nbsp;</span></p>';
        output += '<p><span class="content-placeholder" style="width:100%; height: 100px;">&nbsp;</span></p>';
        output += '</div>';
      }
      $('#load_data_message').html(output);
    }

    lazzy_loader(limit);

    function load_data(limit, start)
    {
        $.ajax({
            url:"<?php echo base_url(); ?>TaskController/getLeadDisbursed1",
            method:"POST",
            data:{limit:limit, start:start, csrf_token},
            cache: false,
            success:function(response)
            {
                if(response == '')
                {
                    $('#load_data_message').html('<h3>No More Result Found</h3>');
                    action = 'active';
                }
                else
                {
                    $('#load_data').append(response);
                    $('#load_data_message').html("");
                    action = 'inactive';
                }
            }
        });
    }

    if(action == 'inactive')
    {
      action = 'active';
      load_data(limit, start);
    }

    $(window).scroll(function(){
      if($(window).scrollTop() + $(window).height() > $("#load_data").height() && action == 'inactive')
      {
        lazzy_loader(limit);
        action = 'active';
        start = start + limit;
        setTimeout(function(){
          load_data(limit, start);
        }, 1000);
      }
    });

  });
</script>