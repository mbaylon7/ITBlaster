<!DOCTYPE html>
<html lang="en">
<head>
  <style>
    body{
      color: #192F64!important;
    }
    .space{
      padding-bottom: 2rem;
    }
    ::-webkit-scrollbar {
        display: none;
    }
    .custom-container{
      display: flex;
      justify-content: space-between;
      flex-wrap: wrap;
      gap: 1rem;
      margin: 0;
      padding: 0;
    }
    .custom-content{
      padding: 10px;
      background-color: #CACDD9;
      text-transform: uppercase;
      flex-grow: 1;
      flex-shrink: 1;
      display: flex;
      justify-content: space-between;
      align-items: center;
      text-align: center;
    }
    .custom-content i {
      cursor: pointer;
    }
    .card{
      min-height: 300px !important;
    }
    .bi{
      cursor: pointer;
    }
    .text-ellipsis {
      white-space: nowrap; 
      overflow: hidden;
      text-overflow: ellipsis; 
    }

    table .text-ellipsis {
      white-space: nowrap; 
      width: 300px;
      overflow: hidden;
      text-overflow: ellipsis; 
    }
    
    .operational-btn{
      opacity: 0;
      transition: opacity 0.15s ease-in-out
    }
    .card:hover .operational-btn{
      opacity: 1;
      transition-delay: 0.15s;
    }
    #flipIcon {
      transform: rotate(180deg);
      margin-top: -5rem;
    }
    .underline-text{
      padding-bottom:5px;
      border-bottom: 2px solid #192F64;
    }
    .modal-xl{
      max-width: 70% !important;
    } 
    .bi-x{
        font-size: 20px;
        font-weight: bolder;
    }
    .search-skill-input{
        padding: .5rem 1.5rem;
        border: 3px solid #45CDC5;
        outline:none; 
        width: 60%
    }
    .search-skill-btn{
        padding: .5rem 1rem; 
        background-color:#45CDC5; 
        color: #FFF; 
        border:none
    }
    .custom-form{
        width: 100%;
        padding: 5px 20px;
        outline:none;
        border: 1px solid #ced4da;
        display: block;
        background-color: #fff;
        border-radius: 2px;
    }
    .custom-btn{
        border:none;
        padding: 8px 17px;
        outline: none;
        border-radius: 2px;
    }
    .profile-completion-percentage{
        display: none;
    }
    .margin-row{
      margin-left: 3rem!important;
      transition: 0.15s ease-in-out;
    }
    .h5{
      font-size: 18px!important;
      font-weight: bold !important;
    }
    .nav-tabs {
      border-bottom: 1px solid transparent !important;
    }
    .select2-selection{
      width: 100%;
      border-radius: 2px!important;
      height: 35px!important;
      border: 1px solid #ced4da !important;
    }
    .modal-xl{
      min-width: 80% !important;
    }
    .modal-xxl{
      min-width: 95% !important;
    }
    .nav-tabs .nav-item.show .nav-link, .nav-tabs .nav-link.active {
        color: #192F64 !important;
        background-color: transparent !important;
        border-color: transparent transparent #192F64 !important;
        border-bottom-style: solid !important;
        border-bottom-width: 2px !important;
    }
    .nav-tabs .nav-link {
      margin-bottom: -1px;
      border: 1px solid transparent;
      border-color: transparent transparent transparent !important;
      border-top-left-radius: 0.25rem;
      border-top-right-radius: 0.25rem;
      border-bottom-style: solid !important;
      border-bottom-width: 1.5px !important;
      margin: 0 5px;
    }
    
    .nav-tabs .nav-item.show .nav-link, .nav-tabs a{
        color: #B2B5BD !important;
        background-color: transparent !important;
    }
    div.dataTables_wrapper div.dataTables_length select {
      font-size: small;
      width: 100% !important;
    }



    @media screen and (max-width: 767px) {
      .profile-completion-percentage {
        display: block;
      }
      .profile-completion-percentage-display{
        display: none;
      }
    }
    @media screen and (max-width: 1000px) {
      .margin-row {
        margin-left: 0!important;
        transition-delay: 0.15s;
      }
    }
  </style>
  <meta charset="utf-8">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>IT Blaster</title>
  <link rel="shortcut icon" href="<?= base_url()?>dist/img/logo.png"/>
  <link rel="apple-touch-icon" href="<?= base_url()?>dist/img/logo.png"/>

  <!-- Font Awesome Icons -->
  <!-- Theme style -->
  <link rel="stylesheet" href="<?= base_url()?>dist/css/adminlte.min.css">
  <link rel="stylesheet" href="<?= base_url()?>dist/fonts/font.css">
  <link rel="stylesheet" href="<?= base_url()?>plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="<?= base_url()?>plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
  <link rel="stylesheet" href="<?= base_url()?>plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.4/font/bootstrap-icons.css">
  <link rel="stylesheet" href="<?= base_url()?>plugins/select2/css/select2.min.css">
  <link rel="stylesheet" href="<?= base_url()?>plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css"/>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"/>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/apexcharts@latest/dist/apexcharts.min.css">
  <script src="https://cdn.jsdelivr.net/npm/apexcharts@latest/dist/apexcharts.min.js"></script>

</head>

<body class="sidebar-mini text-sm control-sidebar-slide-open sidebar-mini-xs sidebar-mini-md layout-fixed layout-navbar-fixed sidebar-closed sidebar-collapse">
   <!-- <div class="preloader flex-column justify-content-center align-items-center">
    <img class="animation__shake" src="<?= base_url()?>dist/img/logo.png" alt="IT Blaster Logo" height="160" width="160" style="filter: invert(100%);">
    <span class="animation__shake h2 font-weight-bold" style="color: #000!important;">IT BLASTER MANAGEMENT</span>
  </div> -->
  <div class="bs-canvas-overlay position-fixed w-100 h-100"></div>

  <!-- <input type="text" id="myInputTextField"> -->
<!-- oTable = $('#myTable').DataTable();   //pay attention to capital D, which is mandatory to retrieve "api" datatables' object, as @Lionel said
$('#myInputTextField').keyup(function(){
      oTable.search($(this).val()).draw() ;
}) -->