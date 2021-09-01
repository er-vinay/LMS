<?php 
    if(empty($_SESSION['isUserSession']['user_id'])){ 
        $this->session->set_flashdata('err', "Session Expired, Try once more.");
        return redirect(base_url());
    } else { 
        $where = ['company_id' => company_id, 'product_id' => product_id];
        $logo = $this->db->select('link, url')->where($where)->from('logo')->get()->row();
        $userDetails = $this->db->select('users.*')->where('users.user_id', $_SESSION['isUserSession']['user_id'])->from('users')->get()->row();
?>
<!DOCTYPE html>
    <html>
        <head>
            <title><?= "Naman" ?></title>
            <meta charset="utf-8">
            <meta http-equiv="X-UA-Compatible" content="IE=edge">
            <meta name="viewport" content="width=device-width, initial-scale=1">
            <link rel="icon" href="<?= base_url('public/front'); ?>/images/fav.png" type="image/*" />
            <link rel="stylesheet" href="<?= base_url('public/front'); ?>/css/bootstrap.css" type="text/css">
            <link rel="stylesheet" href="<?= base_url('public'); ?>/css/font-awesome.css" type="text/css">
            <link rel="stylesheet" href="<?= base_url('public/front'); ?>/css/layout.css" type="text/css">
            <link rel="stylesheet" href="<?= base_url('public/front'); ?>/css/components.css" type="text/css">
            <link rel="stylesheet" href="<?= base_url('public/front'); ?>/css/common-styles.css" type="text/css">
            <link rel="stylesheet" href="<?= base_url('public/front'); ?>/css/plugins.css" type="text/css"> 
            <link rel="stylesheet" href="<?= base_url('public/front'); ?>/css/datepicker.min.css" rel="stylesheet">
            <link rel="stylesheet" href="<?= base_url('public/front'); ?>/css/style.css">
            <link rel="stylesheet" href="<?= base_url('public/front'); ?>/css/ace-responsive-menu.css">
            
            <link rel="stylesheet" href="<?= base_url('public/front'); ?>/css/pages.css" type="text/css">
            <link rel="stylesheet" href="<?= base_url('public/front'); ?>/css/responsive.css" type="text/css">
            <link rel="stylesheet" href="<?= base_url('public/front'); ?>/css/matmix-iconfont.css" type="text/css">
            <link rel="stylesheet" href="<?= base_url('public/front'); ?>/css/roboto_font.css" type="text/css"> 
            <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
            <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css"/>
            <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.11/summernote.css">
            <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/summernote/0.8.7/summernote.css">
            
            <link rel="stylesheet" href="<?= base_url('public/front/css/dataTable/dataTables_1.10.25.min.css') ?>"> <!-- datatable -->
        
        </head>
    <body>
        <div id="cover"> 
            <div class="loader">
                <div class="loader_inner">L</div>
                <div class="circle_1">
                    <div class="circle_2"></div>
                </div>
                <div class="loader_inner_1">ANWALLE</div>
            </div>
        </div>
    
        <div class="navbar-wrapper navbar-fixed-top" style="background: #fff; box-shadow: 0 0 7px #c7c7c7;">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-2 col-xs-5 top_naman">
                        <a>
                            <img src="https://fintechcloud.in/lac/public/img/namanfinlease.png" alt="logo" class="img-responsive" style="margin-top: -10px;">
                        </a>
                    </div>
                    <div class="col-md-5">
                        <nav>
                            <div class="menu-toggle">
                                <button type="button" id="menu-btn">
                                    <span class="icon-bar"></span>
                                    <span class="icon-bar"></span>
                                    <span class="icon-bar"></span>
                                </button>
                            </div>
                            <ul id="respMenu" class="ace-responsive-menu" data-menu-style="horizontal">
            
                                <?php if($_SESSION['isUserSession']['labels'] == "SA" ) { ?>
                                    <li><a href="#" class="dropdown-toggle active" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Setting<span class="caret"></span></a>
                                        <ul>
                                            <li><a href="<?= base_url('adminPermission') ?>"><i class="fa fa-angle-right"></i> Permissions</a></li>
                                        </ul>
                                    </li>
                                <?php } ?>
                            </ul>
                        </nav>
                    </div>
        
                    <div class="col-md-3 top-welcome">    
                        <a href="<?= base_url('dashboard') ?>" class="logout-lac" title="Dashboard"><i class="fa fa-home"></i></a>  
                        <a href="<?= base_url('search') ?>" class="logout-lac" title="Search"><i class="fa fa-search"></i> </a>
                        <a href="<?= base_url('search') ?>" class="logout-lac" title="Notification"><i class="fa fa-bell"></i><span style="display: table-caption;">10</span></a>  
                        <a href="<?= base_url('logout'); ?>" class="logout-lac" title="Logout"><i class="fa fa-sign-out"></i></a>  
                         
                        <a href="<?= base_url('myProfile') ?>" class="logout-lac" title="<?= $userDetails->user_id ?>"><?= $_SESSION['isUserSession']['name'] ?></a>
                    </div>
                    <div class="col-md-2 top_lac">
                        <a href="<?= $logo->link ?>" target="_blank">
                            <img class="img-rounded" src="<?= base_url('public/front/images/'. $logo->url) ?>" alt="logo" class="img-responsive">
                            <!-- <img src="<?= $logo->url ?>" alt="logo" class="img-responsive"> -->
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <!-- end header -->
    <?php } ?>