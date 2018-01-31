<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Landing Zero Free Bootstrap Theme with Video</title>
    <meta name="description" content="This is a free Bootstrap landing page theme created for BootstrapZero. Feature video background and one page design." />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="generator" content="Codeply">
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/bootstrap.min.css" />
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/animate.min.css" />
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/ionicons.min.css" />
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/styles.css" />
  </head>
  <body>
    <nav id="topNav" class="navbar navbar-default navbar-fixed-top">
        <div class="container-fluid">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-navbar">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand page-scroll" href="#first"><i class="ion-ios-analytics-outline"></i> AI Interview</a>
            </div>
            <div class="navbar-collapse collapse" id="bs-navbar">
                <!-- <ul class="nav navbar-nav">
                    <li>
                        <a class="page-scroll" href="#one">navbar</a>
                    </li>
                </ul> -->
                <ul class="nav navbar-nav navbar-right">
                    <li>
                        <a class="page-scroll" data-toggle="modal" title="A free Bootstrap video landing theme" href="about/">About</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
<header id="first">
        <div class="header-content">
            <div class="inner">
                <h1 class="cursive">AI Based Interview</h1>
                <h4>Login as :</h4>
                <hr>
                <a href="admin" class="btn btn-primary btn-xl">Admin</a> &nbsp; 
                <a href="login" class="btn btn-primary btn-xl page-scroll">User</a>
            </div>
        </div>
        <video autoplay="" loop="" class="fillWidth fadeIn wow collapse in" data-wow-delay="0.5s" poster="https://s3-us-west-2.amazonaws.com/coverr/poster/Traffic-blurred2.jpg" id="video-background">
            <source src="https://s3-us-west-2.amazonaws.com/coverr/mp4/Traffic-blurred2.mp4" type="video/mp4">Your browser does not support the video tag. I suggest you upgrade your browser.
        </video>
</header>