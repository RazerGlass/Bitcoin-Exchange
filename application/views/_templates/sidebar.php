<?php if (!defined( 'access') or !access) die( 'This file cannot be directly accessed.'); ?>
<div class="page-container chat-visible">
  <?php /** ** stop us getting an error notice it won 't b0rx the site but
	 ** will show an error which looks terrible and is terrible practice
	**/
	if(isset($_SESSION['user'])){
	$user = $this->model->user();
	}
	$sidebar = isset($user->sidebaropen) ? $user->sidebaropen : 0; ?>
	<?php if($sidebar == 0){ ?>
	<div class="sidebar-menu toggle-others fixed" style="width:15%">
	<div class="sidebar-menu-inner">
    <div style="padding-top: 80px;"></div>
            <ul id="main-menu" class="main-menu">
                <!-- add class "multiple-expanded" to allow multiple submenus to open -->
                <!-- class "auto-inherit-active-class" will automatically add "active" class for parent elements who are marked already with class "active" -->
			<?php if (!$this->model->user() == ''): ?>
			  <li>
			  <a href="<?php echo URL; ?>">
			  <i class="fa fa-lg fa-fw fa-dashboard"></i> 
			  <span class="menu-item-parent">Home</span>
			  </a>
			  <a href="<?php echo URL; ?>dashboard/deposit">
			  <i class="fa fa-lg fa-fw fa-cc-visa"></i> 
			  <span class="menu-item-parent">Deposit/Withdraw</span>
			  </a>
			  <a href="<?php echo URL; ?>dashboard/trades/">
			  <i class="fa fa-lg fa-fw fa-line-chart"></i> 
			  <span class="menu-item-parent">Trades</span>
			  </a>
			  <a href="<?php echo URL; ?>dashboard/transactions/">
			  <i class="fa fa-lg fa-fw fa-history"></i> 
			  <span class="menu-item-parent">Transactions</span>
			  </a>
			  <a href="<?php echo URL; ?>user/security">
			  <i class="fa fa-lg fa-fw fa-lock"></i> 
			  <span class="menu-item-parent">Security</span>
			  </a>
             <li class="active">
                <a href="">
                <i class="fa-line-chart"></i>
                <span class="title"> <?php _ex("Markets"); ?></span>
                </a>
                <ul>
				<?php 
		$coinmarket= $this->model->site();
	    $coinmarket = explode(",",$coinmarket->coins);
	    foreach($coinmarket as $coinlinks){ ?>
		
		<li>
		<a href="<?php echo URL; ?>dashboard/?market=<?php echo $coinlinks; ?>">
		<span class="title"> <?php echo str_replace('_', '/', $coinlinks); ?></span>
		</a>
		</li>
<?php } ?>
        </ul>
        </li>

		<div id="usersidebar">
		<p class="header"><?php _ex("Welcome back"); ?></p> 
		<p class="info" style="color:white;"><?php echo $user->username; ?><br><br>
		<?php if($user->detailverified == 0): ?>
		<div class="btn btn-xs btn-danger" style="width:100%"><?php _ex("Verify now!"); ?></div></p>
		<?php else: ?>
		<div class="btn btn-xs btn-success" style="width:100%"><?php _ex("Verified"); ?></div></p>
		<?php endif; ?>
        </div>
		<?php else: ?>
			 <a href="<?php echo URL; ?>user/login">
			  <i class="fa fa-lg fa-fw fa-user"></i> 
			  <span class="menu-item-parent"><?php _ex("Login"); ?></span>
			  </a>
			  <a href="<?php echo URL; ?>user/register">
			  <i class="fa fa-lg fa-fw fa-pencil"></i> 
			  <span class="menu-item-parent"><?php _ex("Register"); ?></span>
			  </a>
			  <a href="<?php echo URL; ?>api">
			  <i class="fa fa-lg fa-fw fa-code"></i> 
			  <span class="menu-item-parent"><?php _ex("API"); ?></span>
			  </a>
		<?php endif; ?>
		
                 </li>
            </ul>
      </div>
 </div>
 <?php } ?>
 

 <div class="main-content">