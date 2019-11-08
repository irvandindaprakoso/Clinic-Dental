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
  include_once "../includes/Users-class.php";

  $dateforNow      = new DateTime();
  $NowDate         = $dateforNow->format('d-m-Y');
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
        @page {margin :10px;}
            body {
                padding:10px!important;
                -webkit-print-color-adjust: exact!important;
                /*page-break-before: auto;*/
            }
            #top_nav, .no-print, .dataTables_filter, .dataTables_length, .dataTables_info, #datatable_paginate, .panel_toolbox, #section-status { display: none; }
            .kop-surat{ display: block!important; margin-top: 0px;}
            #ttt{width: 100%!important; height: 100%!important;}
            #invoice-footer{display:block!important;}
        
      }
    </style>
  </head>

  <body class="nav-md">
    <div class="container body">
      <div class="main_container">
        <div class="col-md-3 left_col">
          <div style="position: fixed;" class="left_col scroll-view">
            <div class="navbar nav_title" style="border: 0;">
              <a href="index.php" class="site_title"><i class="fa fa-ban"></i> <span>VOZZ dental</span></a>
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
            case 'data-pasien'      : require ('page-pasien.php'); break;
            case 'pasien-baru'      : require ('page-pasien-baru.php'); break;
            case 'pasien-edit'      : require ('page-pasien-baru.php'); break;
            case 'pembayaran'       : require ('page-pembayaran.php'); break;
            case 'detail-pembayaran': require ('page-pembayaran-detail.php'); break;
            case 'detail-pasien'    : require ('page-pasien-detail.php'); break;
            case 'data-users'       : require ('page-data-users.php'); break;
            case 'user-add'         : require ('page-users-add.php'); break;
            case 'user-edit'        : require ('page-users-add.php'); break;
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