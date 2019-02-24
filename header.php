<?php
require_once "check_index_usage.php";
?>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="description" content="">
        <meta name="author" content="">

        <title>КУРСОВ ПРОЕКТ/ Галя Георгиева blog</title>

        <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

        <!-- Custom fonts for this template -->
        <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
        <link href='https://fonts.googleapis.com/css?family=Lora:400,700,400italic,700italic' rel='stylesheet' type='text/css'>
        <link href='https://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800' rel='stylesheet' type='text/css'>

        <!-- Custom styles for this template -->
        <link href="css/clean-blog.min.css" rel="stylesheet">
        <link href="css/clean-blog.css" rel="stylesheet">
    </head>

    <body>
        
         
        <!-- Navigation -->
        <nav class="navbar navbar-expand-lg navbar-light fixed-top" id="mainNav">
            <div class="container">
                <div class="collapse navbar-collapse" id="navbarResponsive">
                    <ul class="navbar-nav ml-auto">
                        <li class="nav-item">
                            <a class="nav-link" href="index.php?p=index">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="index.php?p=about">About me</a>
                        </li>
                        <?php
                        require_once 'logged_check.php';
                        if (!$is_user_logged) {
                            ?>
                            <li class="nav-item">
                                <a class="nav-link" href="index.php?p=login">Login</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="index.php?p=register">Register</a>
                            </li>
                            <?php
                        } else {
                            ?>
                            <li class="nav-item">
                                <a class="nav-link" href="index.php?p=logout">Logout</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link"><u><font color="red"> WELLCOME <?php echo $_COOKIE['name'] ?></font></u></a>
                            </li>
                            <?php
                            if ($is_admin_logged) {
                                ?>
                                <li class="nav-item">
                                    <a href="index.php?p=post_add">ADD POST</a>
                                </li>
                                <?php
                            }
                        }
                        ?>
                    </ul>
                </div>
            </div>
        </nav>

        <!-- Page Header -->
        
        <header class="masthead" style="background-image: url('img/home-bg.jpg')">
            <div class="overlay"></div>
            <div class="container">
                <div class="col-lg-8 col-md-10 mx-auto">
                    <div class="site-heading">
                        <a href="index.php?p=index">
                            <h1>Galya`s Blog</h1>
                            <span class="subheading">A Blog for my favorite things! </span></a>
                    </div>
                </div>
            </div>
            <a style="position: inherit; margin: 0 40px" class="btn btn-primary" href="index.php?p=posts_all">ALL POSTS</a>

           
        </header>