<?php 
$this->model->gettext(); 
function _ex($text){ 
echo gettext($text); } 

$this->model->sanatisesource(); 
session_start(); 
$site = $this->model->site(); 
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <meta name="description" content="<?php echo $site->description; ?>" />
  <meta name="keywords" content="<?php echo $site->keywords; ?>" />
  <meta name="author" content="Cryptxe Limited" />
  <base href="<?php echo URL; ?>" />
  <title>
    <?php echo $site->sitename ,' ', $site->slogan; ?></title>
  <link rel="apple-touch-icon" sizes="57x57" href="<?php echo URL; ?>img/apple-touch-icon-57x57.png">
  <link rel="apple-touch-icon" sizes="114x114" href="<?php echo URL; ?>img/apple-touch-icon-114x114.png">
  <link rel="apple-touch-icon" sizes="72x72" href="<?php echo URL; ?>img/apple-touch-icon-72x72.png">
  <link rel="apple-touch-icon" sizes="144x144" href="<?php echo URL; ?>img/apple-touch-icon-144x144.png">
  <link rel="apple-touch-icon" sizes="60x60" href="<?php echo URL; ?>img/apple-touch-icon-60x60.png">
  <link rel="apple-touch-icon" sizes="120x120" href="<?php echo URL; ?>img/apple-touch-icon-120x120.png">
  <link rel="apple-touch-icon" sizes="76x76" href="<?php echo URL; ?>img/apple-touch-icon-76x76.png">
  <link rel="apple-touch-icon" sizes="152x152" href="<?php echo URL; ?>img/apple-touch-icon-152x152.png">
  <link rel="apple-touch-icon" sizes="180x180" href="<?php echo URL; ?>img/apple-touch-icon-180x180.png">
  <link rel="icon" type="image/png" href="<?php echo URL; ?>img/favicon-192x192.png" sizes="192x192">
  <link rel="icon" type="image/png" href="<?php echo URL; ?>img/favicon-160x160.png" sizes="160x160">
  <link rel="icon" type="image/png" href="<?php echo URL; ?>img/favicon-96x96.png" sizes="96x96">
  <link rel="icon" type="image/png" href="<?php echo URL; ?>img/favicon-16x16.png" sizes="16x16">
  <link rel="icon" type="image/png" href="<?php echo URL; ?>img/favicon-32x32.png" sizes="32x32">
  <meta name="msapplication-TileColor" content="#157efb">
  <meta name="msapplication-TileImage" content="<?php echo URL; ?>img/mstile-144x144.png">
  <meta property="og:image" content="<?php echo URL; ?>img/mainlogo.png">
  <meta property="og:image:type" content="image/png">
  <meta property="og:image:width" content="488">
  <meta property="og:image:height" content="366">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Arimo:400,700,400italic">
  <link rel="stylesheet" href="<?php echo URL; ?>css/fonts/linecons/css/linecons.css">
  <link rel="stylesheet" href="<?php echo URL; ?>css/fonts/fontawesome/css/font-awesome.min.css">
  <link rel="stylesheet" href="<?php echo URL; ?>css/bootstrap.css">
  <link rel="stylesheet" href="<?php echo URL; ?>js/datatables/dataTables.bootstrap.css">
  <link rel="stylesheet" href="<?php echo URL; ?>css/xenon-core.css">
  <link rel="stylesheet" href="<?php echo URL; ?>css/xenon-forms.css">
  <link rel="stylesheet" href="<?php echo URL; ?>css/xenon-components.css">
  <link rel="stylesheet" href="<?php echo URL; ?>css/xenon-skins.css">
  <link rel="stylesheet" href="<?php echo URL; ?>css/charts/style.css">
  <script src="<?php echo URL; ?>js/jquery-1.11.1.min.js"></script>
  <script src="<?php echo URL; ?>js/amcharts.js" type="text/javascript"></script>
  <script src="<?php echo URL; ?>js/serial.js" type="text/javascript"></script>
  <script src="<?php echo URL; ?>js/amstock.js" type="text/javascript"></script>
  <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
  <script>
  var url = "<?php echo URL; ?>";
  </script>
  <script src="<?php echo URL; ?>js/application.js"></script>
  <script src="<?php echo URL; ?>js/bootstrap.min.js"></script>
  <script src="<?php echo URL; ?>js/TweenMax.min.js"></script>
  <script src="<?php echo URL; ?>js/resizeable.js"></script>
  <script src="<?php echo URL; ?>js/joinable.js"></script>
  <script src="<?php echo URL; ?>js/xenon-api.js"></script>
  <script src="<?php echo URL; ?>js/xenon-toggles.js"></script>
  <script src="<?php echo URL; ?>js/datatables/js/jquery.dataTables.min.js"></script>
  <script src="<?php echo URL; ?>js/datepicker/bootstrap-datepicker.js"></script>
  <script src="<?php echo URL; ?>js/datatables/dataTables.bootstrap.js"></script>
  <script src="<?php echo URL; ?>js/datatables/yadcf/jquery.dataTables.yadcf.js"></script>
  <script src="<?php echo URL; ?>js/datatables/tabletools/dataTables.tableTools.min.js"></script>
  <script src="<?php echo URL; ?>js/toastr/toastr.min.js"></script>
  <script src="<?php echo URL; ?>js/xenon-custom.js"></script>
  <script src="<?php echo URL; ?>js/jquery-validate/jquery.validate.min.js"></script>
  <script src="<?php echo URL; ?>js/amcharts.js" type="text/javascript"></script>
  <script src="<?php echo URL; ?>js/serial.js" type="text/javascript"></script>
  <script src="<?php echo URL; ?>js/amstock.js" type="text/javascript"></script>

  <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body class="page-body">

  <nav class="navbar horizontal-menu navbar-fixed-top">
    <!-- set fixed position by adding class "navbar-fixed-top" -->

    <div class="navbar-inner">

      <!-- Navbar Brand -->
      <div class="navbar-brand">
        <a href="<?php echo URL; ?>" class="logo">
                    <img src="<?php echo URL; ?>img/logo.png" width="200" alt="" class="hidden-xs" />
                    <img src="<?php echo URL; ?>img/logo.png" width="200" alt="" class="visible-xs" />
                </a>
        <!--
                <a href="#" data-toggle="sidebar" data-animate="true">
                    <i class="linecons-cog"></i>
                </a>
				-->
      </div>

      <!-- Mobile Toggles Links -->
      <div class="nav navbar-mobile">

        <!-- This will toggle the mobile menu and will be visible only on mobile devices -->
        <div class="mobile-menu-toggle">
          <!-- data-toggle="mobile-menu-horizontal" will show horizontal menu links only -->
          <!-- data-toggle="mobile-menu" will show sidebar menu links only -->
          <!-- data-toggle="mobile-menu-both" will show sidebar and horizontal menu links -->
          <a href="#" data-toggle="mobile-menu-horizontal">
            <i class="fa-bars"></i>
          </a>
        </div>

      </div>

      <div class="navbar-mobile-clear"></div>

      <!-- main menu -->
      <?php if (!$this->model->user() == '') { ?>
      <ul class="navbar-nav">
        <li>
          <a href="<?php echo URL; ?>dashboard">
            <i class="fa-line-chart"></i>
            <span class="title"><?php _ex("Dashboard"); ?> </span>
          </a>
          <ul>
            <?php $coinmarket=$this->model->site(); $coinmarket = explode(",", $coinmarket->coins); foreach($coinmarket as $coinlinks){ ?>
            <li>
              <a href="<?php echo URL; ?>dashboard/?market=<?php echo $coinlinks; ?>">
                <span class="title"> <?php echo str_replace('_', '/', $coinlinks); ?></span>
              </a>
            </li>
            <?php } ?>

          </ul>
        </li>
        <li class=" active">
          <a href="">
            <i class="linecons-desktop"></i>
            <span class="title"><?php _ex("Tools"); ?></span>
          </a>
          <ul>
            <li>
              <a href="<?php echo URL; ?>dashboard/trades/">
                <span class="title"><?php _ex("Trades"); ?></span>
              </a>
            </li>
            <li>
              <a href="<?php echo URL; ?>dashboard/transactions/">
                <span class="title"><?php _ex("Transactions"); ?></span>
              </a>
            </li>
            <li>
              <a href="<?php echo URL; ?>api/">
                <span class="title"><?php _ex("API"); ?></span>
              </a>
            </li>
            <li>
              <a href="<?php echo URL; ?>help/faq">
                <span class="title"><?php _ex("FAQ"); ?></span>
              </a>
            </li>
          </ul>
        </li>

        <li class="hidden-sm hidden-md hidden-lg">
          <a href="">
            <i class="fa-user"></i>
            <span class="title"><?php _ex("User"); ?></span>
          </a>
          <ul>
            <?php if($this->model->isadmin() == true) { ?>
            <li>
              <a href="<?php echo ADMINURL; ?>">
                <i class="fa-edit"></i>
                <?php _ex( "Admin CP"); ?>
              </a>
            </li>
            <?php } ?>
            <?php if($this->model->isstaff() == true) { ?>
            <li>
              <a href="<?php echo ADMINURL; ?>modcp">
                <i class="fa-edit"></i>
                <?php _ex( "ModCP"); ?>
              </a>
            </li>
            <?php } ?>
            <li>
              <a href="<?php echo URL; ?>dashboard/deposit/">
                <i class="fa-cc-visa"></i>
                <?php _ex( "Deposit"); ?>
              </a>
            </li>
            <li>
              <a href="<?php echo URL; ?>user/edit/">
                <i class="fa-wrench"></i>
                <?php _ex( "Edit Settings"); ?>
              </a>
            </li>
            <li>
              <a href="<?php echo URL; ?>user/security">
                <i class="fa-lock"></i>
                <?php _ex( "Security"); ?>
              </a>
            </li>
            <li>
              <a href="<?php echo URL; ?>user/api">
                <i class="fa-code"></i>
                <?php _ex( "User API"); ?>
              </a>
            </li>
            <li>
              <a href="<?php echo URL; ?>user/messages/">
                <i class="fa-envelope"></i>
                <?php _ex( "Messages"); $this->model->messagecount(); ?>
              </a>
            </li>
            <li>
              <a href="<?php echo URL; ?>user/information/">
                <i class="fa-user"></i>
                <?php _ex( "Information"); ?>
              </a>
            </li>
            <li>
              <a href="<?php echo URL; ?>help">
                <i class="fa-info"></i>
                <?php _ex( "Help"); ?>
              </a>
            </li>
            <li class="last">
              <a href="<?php echo URL; ?>user/logout?token=<?php echo $_SESSION["token"]; ?>">
                <i class="fa-lock"></i>
                <?php _ex( "Logout"); ?>
              </a>
            </li>
          </ul>
        </li>

      </ul>

      <!-- notifications and other links -->
      <ul class="nav nav-userinfo navbar-right">
        <li class="dropdown user-profile">
          <a href="#" data-toggle="dropdown">
                        <img src="<?php echo URL; ?>images/user-1.png" alt="user-image" class="img-circle img-inline userpic-32" width="28" />
                        <span>
                            <?php //   echo ucwords($user->user()); ?>
                            <i class="fa-angle-down"></i>
                        </span>
                    </a>

          <ul class="dropdown-menu user-profile-menu list-unstyled">
            <?php if($this->model->isadmin() == true) { ?>
            <li>
              <a href="<?php echo ADMINURL; ?>">
                <i class="fa-edit"></i>
                <?php _ex( "Admin CP"); ?>
              </a>
            </li>
            <?php } ?>
            <?php if($this->model->isstaff() == true) { ?>
            <li>
              <a href="<?php echo ADMINURL; ?>/modcp/">
                <i class="fa-edit"></i>
                <?php _ex( "ModCP"); ?>
              </a>
            </li>
            <?php } ?>
            <li>
              <a href="<?php echo URL; ?>dashboard/deposit/">
                <i class="fa-cc-visa"></i>
                <?php _ex( "Deposit"); ?>
              </a>
            </li>
            <li>
              <a href="<?php echo URL; ?>user/edit/">
                <i class="fa-wrench"></i>
                <?php _ex( "Edit Settings"); ?>
              </a>
            </li>
            <li>
              <a href="<?php echo URL; ?>user/security">
                <i class="fa-lock"></i>
                <?php _ex( "Security"); ?>
              </a>
            </li>
            <li>
              <a href="<?php echo URL; ?>user/api">
                <i class="fa-code"></i>
                <?php _ex( "User API"); ?>
              </a>
            </li>
            <li>
              <a href="<?php echo URL; ?>user/messages/">
                <i class="fa-envelope"></i>
                <?php _ex( "Messages"); $this->model->messagecount(); ?>
              </a>
            </li>
            <li>
              <a href="<?php echo URL; ?>user/information/">
                <i class="fa-user"></i>
                <?php _ex( "Information"); ?>
              </a>
            </li>
            <li>
              <a href="<?php echo URL; ?>help">
                <i class="fa-info"></i>
                <?php _ex( "Help"); ?>
              </a>
            </li>
            <li class="last">
              <a href="<?php echo URL; ?>user/logout?token=<?php echo $_SESSION["token"]; ?>">
                <i class="fa-lock"></i>
                <?php _ex( "Logout"); ?>
              </a>
            </li>
          </ul>
        </li>

        <?php }else{?>
        <!-- notifications and other links -->
        <ul class="nav nav-userinfo navbar-right">
          <li class="dropdown user-profile">
            <a href="#" data-toggle="dropdown">
                        <img src="<?php echo URL; ?>images/guest.png" alt="user-image" class="img-circle img-inline userpic-32" width="28" />
                        <span>
                            <?php //   echo ucwords($user->user()); ?>
                            <i class="fa-angle-down"></i>
                        </span>
                    </a>

            <ul class="dropdown-menu user-profile-menu list-unstyled">
              <li>
                <a href="<?php echo URL; ?>user/login/">
                  <i class="fa-edit"></i>
                  <?php _ex( "Login"); ?>
                </a>
              </li>
              <li>
                <a href="<?php echo URL; ?>user/register/">
                  <i class="fa-wrench"></i>
                  <?php _ex( "Register"); ?>
                </a>
              </li>
              <li>
                <a href="<?php echo URL; ?>help">
                  <i class="fa-info"></i>
                  <?php _ex( "Help"); ?>
                </a>
              </li>
              <li>
                <a href="<?php echo URL; ?>api">
                  <i class="fa-code"></i>
                  <?php _ex( "API"); ?>
                </a>
              </li>
            </ul>

            <?php } ?>
        </ul>

    </div>
  </nav>