<?php if(stripos($_SERVER['PHP_SELF'],'index')){ ?>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="author" content="Untree.co">
    <link rel="shortcut icon" href="favicon.png">
    <meta name="description" content="" />
    <meta name="keywords" content="bootstrap, bootstrap4" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;700&family=Source+Serif+Pro:wght@400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/owl.carousel.min.css">
    <link rel="stylesheet" href="css/owl.theme.default.min.css">
    <link rel="stylesheet" href="css/jquery.fancybox.min.css">
    <link rel="stylesheet" href="fonts/icomoon/style.css">
    <link rel="stylesheet" href="fonts/flaticon/font/flaticon.css">
    <link rel="stylesheet" href="css/daterangepicker.css">
    <link rel="stylesheet" href="css/aos.css">
    <link rel="stylesheet" href="css/style.css">
    <title>List Of Tokyo Restaurant</title>
  </head>
  <style>
  /* hover */
    .c-hover{
      padding-bottom: 5px;
      position: relative;
    }
    .c-hover::before {
      background: #1A374D;
      content: '';
      width: 100%;
      height: 2px;
      position: absolute;
      left: 0;
      bottom: 0;
      margin: auto;
      transform-origin: right top;
      transform: scale(0, 1);
      transition: transform .3s;
    }
    .c-hover:hover::before {
      transform-origin: left top;
      transform: scale(1, 1);
    }
  </style>
<?php }else{ ?>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="author" content="Untree.co">
    <link rel="shortcut icon" href="../favicon.png">
    <meta name="description" content="" />
    <meta name="keywords" content="bootstrap, bootstrap4" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;700&family=Source+Serif+Pro:wght@400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/owl.carousel.min.css">
    <link rel="stylesheet" href="../css/owl.theme.default.min.css">
    <link rel="stylesheet" href="../css/jquery.fancybox.min.css">
    <link rel="stylesheet" href="../fonts/icomoon/style.css">
    <link rel="stylesheet" href="../fonts/flaticon/font/flaticon.css">
    <link rel="stylesheet" href="../css/daterangepicker.css">
    <link rel="stylesheet" href="../css/aos.css">
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../css/jquery.datetimepicker.css">
    <title>List Of Tokyo Restaurant</title>
  </head>
  <style>
  /* hover */
    .c-hover{
      padding-bottom: 5px;
      position: relative;
    }
    .c-hover::before {
      background: #1A374D;
      content: '';
      width: 100%;
      height: 2px;
      position: absolute;
      left: 0;
      bottom: 0;
      margin: auto;
      transform-origin: right top;
      transform: scale(0, 1);
      transition: transform .3s;
    }
    .c-hover:hover::before {
      transform-origin: left top;
      transform: scale(1, 1);
    }
  </style>
<?php } ?>