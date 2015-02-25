<?php
  ?>
<section class="profile-env">
<?php //require APP . 'views/_templates/usersidebar.php'; ?>
<div class="col-md-12">
<ul class="cbp_tmtimeline">
<?php
 foreach($timeline as $r)            { ?>
    <li>
    <time class="cbp_tmtime" datetime="<?php  echo $r->time; ?>">
    <span><?php  echo $r->time; ?></span>
    </time>
    <div class="cbp_tmicon timeline-bg-success">
    <i class="fa-calendar"></i>
    </div>
    <div class="cbp_tmlabel">
    <h2><a href="#">
    <?php
		
		if ($r->buysell == "buy") {
			echo _ex("Bought"); 
			$buysell = "Bought ";
		} else {
			echo _ex("Sold");
			$buysell = "Sold ";
		}

		echo strtoupper($r->market) . '</a> <span>';
		_ex("totalling");
		echo ' ' . $r->cost . '</span></h2><p>';
		_ex("You");
		echo ' ' . $buysell;
		$r->amount . ' ';
		strtoupper($r->market);
		_ex("totalling");
		echo ' ' . $r->cost . ' USD ';
		echo _ex("with an I.P (internet protocol) address of");
		echo $r->ip;
		?>
    </p>
    </div>
    </li>
    <?php
 }if (count($timeline <= 0)) { ?>
    <li>
    <time class="cbp_tmtime" datetime="2014-10-03T18:30"><span class="hidden">03/10/2014</span> <span class="large">Now</span></time>
    <div class="cbp_tmicon timeline-bg-gray">
    <i class="fa-user"></i>
    </div>
    <div class="cbp_tmlabel empty">
    <span><?php  echo _ex("You have not completed any trades yet."); ?></span>
    </div>
    </li>
    <?php
 } ?>
</div>
</li>
</ul>
</div>
 