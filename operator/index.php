<?php 
  ob_start();
  ini_set('display_errors', 1);
  error_reporting(E_ERROR | E_WARNING | E_PARSE); 
  include "../includes/db_connect.php";


  session_start();
  require"../includes/database.php";
  if($_SESSION['login'] != "login"){
    header("location:../index.php");
  }
  if(isset($_GET['page'])){
    $page = $_GET['page'];
  }
  include_once "../includes/Pelanggar-class.php";
  include_once "../includes/Admin-class.php";
  include_once "../includes/Users-class.php";

  $dateforNow      = new DateTime();
  $NowDate         = $dateforNow->format('Y-m-d');
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>DASHBOARD - ADMIN</title>
    <link rel="icon" type="image/png" href="../assets/images/logo-app.png" />
    <?php include "libraryHeader.php";?> 
    <style type="text/css">
      @media print{
        @page {margin :0px;}
            body {
                padding:0px!important;
                -webkit-print-color-adjust: exact!important;
                /*page-break-before: auto;*/
            }
            #top_nav, .no-print, .dataTables_filter, .dataTables_length, .dataTables_info, #datatable_paginate, .panel_toolbox, #section-status { display: none; }
            .kop-surat{ display: block!important; margin-top: 0px;}
            #form-tilang-left {width: 60%;}
            #form-tilang-right {width:40%;}
        
      }
    </style>
  </head>

  <body class="nav-md">
    <div class="container body">
      <div class="main_container">
        <div class="col-md-3 left_col">
          <div style="position: fixed;" class="left_col scroll-view">
            <div class="navbar nav_title" style="border: 0;">
              <a href="index.php" class="site_title"><i class="fa fa-ban"></i> <span>SIPELAPAR</span></a>
            </div>

            <div class="clearfix"></div>

            <?php include "../includes/profile.php"; ?>
            <!-- <div class="clearfix"></div> -->

            <br />

            <!-- sidebar menu -->
            <?php include "../includes/sidebar.php"; ?>
            <!-- /sidebar menu -->
            <?php include "menu-footer.php";?>
            <!-- /menu footer buttons -->
            
          </div>
        </div>

        <!-- top navigation -->
        <?php  include "top-navigation.php"; ?>
        <!-- /top navigation -->

        <!-- page content -->
        <?php 
          switch ($page){
            case 'profile'          : require ('page-profile.php'); break;
            case 'laporan'          : require ('page-laporan.php'); break;
            case 'monitoring'       : require ('page-monitoring.php'); break;
            case 'detail-pelanggar' : require ('page-monitoring-detail.php'); break;
            case 'print-laporan'    : require ('page-monitoring-print.php'); break;
            case 'data-users'       : require ('page-data-users.php'); break;
            case 'admin-add'        : require ('page-users-add.php'); break;
            case 'admin-edit'       : require ('page-users-add.php'); break;
            case 'kontak-pengguna'  : require ('page-kontak.php'); break;
            default : require('dashboard.php');
          }
        ?>
        <!-- /page content -->

        <!-- footer content -->
        <?php include "../includes/footer.php"; ?>
        <!-- /footer content -->
      </div>
    </div>
    <?php include "libraryFooter.php"; ?> 
  </body>
</html>
<?php ob_end_flush(); ?>