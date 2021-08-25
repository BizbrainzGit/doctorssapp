<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="Find easily a doctor and book online an appointment">
  <meta name="author" content="Ansonika">
  <title>DOCTORSS - Find easily a doctor and book online an appointment</title>

  <!-- Favicons-->
  <link rel="shortcut icon" href="/<?php echo base_url();?>assets/frontend/img/favicon.ico" type="image/x-icon">
  <link rel="apple-touch-icon" type="image/x-icon" href="/<?php echo base_url();?>assets/frontend/img/apple-touch-icon-57x57-precomposed.png">
  <link rel="apple-touch-icon" type="image/x-icon" sizes="72x72" href="/<?php echo base_url();?>assets/frontend/img/apple-touch-icon-72x72-precomposed.png">
  <link rel="apple-touch-icon" type="image/x-icon" sizes="114x114" href="/<?php echo base_url();?>assets/frontend/img/apple-touch-icon-114x114-precomposed.png">
  <link rel="apple-touch-icon" type="image/x-icon" sizes="144x144" href="/<?php echo base_url();?>assets/frontend/img/apple-touch-icon-144x144-precomposed.png">

  <!-- GOOGLE WEB FONT -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

  <!-- BASE CSS -->
  <link href="/<?php echo base_url();?>assets/frontend/css/bootstrap.min.css" rel="stylesheet">
  <link href="/<?php echo base_url();?>assets/frontend/css/style.css" rel="stylesheet">
  <link href="/<?php echo base_url();?>assets/frontend/css/menu.css" rel="stylesheet">
  <link href="/<?php echo base_url();?>assets/frontend/css/vendors.css" rel="stylesheet">
  <link href="/<?php echo base_url();?>assets/frontend/css/icon_fonts/css/all_icons_min.css" rel="stylesheet">
  
  <!-- SPECIFIC CSS -->
  <link href="/<?php echo base_url();?>assets/frontend/css/date_picker.css" rel="stylesheet">  


  <!-- YOUR CUSTOM CSS -->
  <link href="/<?php echo base_url();?>assets/frontend/css/custom.css" rel="stylesheet">
  
  <!-- Modernizr -->
  <script src="/<?php echo base_url();?>assets/frontend/js/modernizr.js"></script>
  <style type="text/css">
    [data-loader="circle-side"] {
    position: fixed;
    left: 0px;
    top: 0px;
    width: 100%;
    height: 100%;
    z-index: 9999;
    background: url("/<?php echo base_url();?>assets/images/Doctors_Gif.GIF") 50% 50% no-repeat rgb(249,249,249);
    opacity: .8;
 
}

  </style>

</head>

<body>

  <!-- <div id="preloader" class="Fixed">
    <div data-loader="circle-side"></div>
  </div> -->
  <!-- /Preload-->
  
  <div id="page">   
  <header class="header_sticky">  
    <a href="#menu" class="btn_mobile">
      <div class="hamburger hamburger--spin" id="hamburger">
        <div class="hamburger-box">
          <div class="hamburger-inner"></div>
        </div>
      </div>
    </a>
    <!-- /btn_mobile-->
    <div class="container">
      <div class="row">
        <div class="col-lg-3 col-6">
          <div id="logo_home">
           <!--   <h1> -->
              <a href="/<?php echo base_url();?>" >  
                <img src="/<?php echo base_url();?>assets/images/weblogo.png" data-retina="true" alt="Website Logo" width="163" height="36" class="img-fluid"> </a>
            <!--  </h1> -->
          </div>
        </div>
        <div class="col-lg-9 col-6">
          <ul id="top_access">

              <?php if(isset($this->session->user_roles) && $this->session->user_roles=="Patient") {?>  
                       <li><a href="/<?php echo base_url();?>Patient-Dashboard"> 
                         <img src="/<?php echo base_url().$this->session->profile_pic_path;?>" style="width:30px;height: 30px; border-radius: 50%;">
                         <span><?php echo $this->session->name ; ?></span>

                       </a></li>
                  <?php }else{ ?>
                       <li><a href="/<?php echo base_url();?>login"><i class="pe-7s-user"></i></a></li>
                <?php }?>
        
          </ul>
          <nav id="menu" class="main-menu">
            <ul>
              <li>
                <span><a href="/<?php echo base_url();?>">Home</a></span>
              </li>
              <li>
                <span><a href="/<?php echo base_url();?>Listview">Doctors</a></span>
              </li>
              <li>
                <span><a href="/<?php echo base_url();?>Clinicview">Clinics</a></span>
              </li>
              <li><span><a href="/<?php echo base_url();?>Contact">Contact Us</a></span></li>
            </ul>
          </nav>
          <!-- /main-menu -->
        </div>
      </div>
    </div>
    <!-- /container -->
  </header>
  <!-- /header -->  