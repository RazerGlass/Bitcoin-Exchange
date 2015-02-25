<?php if (!defined('access') or !access) die('This file cannot be directly accessed.'); ?>
<?php /* fuck it, cba with an admin sidebar

    <!-- add class "sidebar-collapsed" to close sidebar by default, "chat-visible" to make chat appear always -->
    <div class="page-container">
    <!-- Add "fixed" class to make the sidebar fixed always to the browser viewport. -->
    <!-- Adding class "toggle-others" will keep only one menu item open at a time. -->
    <!-- Adding class "collapsed" collapse sidebar root elements and show only icons. -->
    <div class="sidebar-menu toggle-others fixed collapsed">
	<div class="sidebar-menu-inner">
    <div style="padding-top: 80px;"></div>
            <ul id="main-menu" class="main-menu">
                <!-- add class "multiple-expanded" to allow multiple submenus to open -->
                <!-- class "auto-inherit-active-class" will automatically add "active" class for parent elements who are marked already with class "active" -->
           
			  <li>
                    <li class="opened active">
                        <a href="">
                            <i class="linecons-cog"></i>
                            <span class="title"> <?php _ex("View User Guides"); ?></span>
                        </a>
                        <ul>
                            <li>
                                <a href="<?php echo ADMINURL; ?>/guides">
                                    <span class="title"> <?php _ex("View User Guides"); ?></span>
                                </a>
                            </li>
                            <li>
                                <a href="<?php echo ADMINURL; ?>/settings">
                                    <span class="title"> <?php _ex("Settings"); ?></span>
                                </a>
                            </li>
                            <li>
                                <a href="<?php echo ADMINURL; ?>/addguide">
                                    <span class="title"> <?php _ex("Add Guides"); ?></span>
                                </a>
                            </li>	
                            <li>
                                <a href="<?php echo ADMINURL; ?>/users">
                                    <span class="title"> <?php _ex("View Users"); ?></span>
                                </a>
                            </li>		
                            <li>
                                <a href="<?php echo ADMINURL; ?>/verifyusers">
                                    <span class="title"> <?php _ex("Verify Users"); ?></span>
                                </a>
                            </li>								
                        </ul>

                       
                    </li>

            </ul>

        </div>

     </div>
	 page container below need removing if I add the sidebar back
 */ ?>
 <div class="page-container">
    <div class="main-content "> 
   

 