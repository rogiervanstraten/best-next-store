<!doctype html><!--[if lt IE 7 ]><html lang="en" class="no-js ie6"><![endif]--><!--[if IE 7 ]><html lang="en" class="no-js ie7"><![endif]--><!--[if IE 8 ]><html lang="en" class="no-js ie8"> <![endif]--><!--[if IE 9 ]><html lang="en" class="no-js ie9"><![endif]--><!--[if (gt IE 9)|!(IE)]><!--><html lang="en" class="no-js"><!--<![endif]-->
<head>
  <meta charset="utf-8"><meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
  <title><?php echo $template['title']; ?></title>
  <meta name="author" content="Best Next Store">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="shortcut icon" href="/favicon.ico">
  <link rel="apple-touch-icon" href="/apple-touch-icon.png">

	<link rel="stylesheet" href="<?php echo base_url(); ?>assets/bootstrap/css/bootstrap.css">
	<link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/bootstrap.med.css">
	
	<?php echo $template['metadata']; ?>
	
  <script src="<?php echo base_url(); ?>assets/js/vendor/modernizr-2.6.1.min.js"></script>
	<script src="https://maps.googleapis.com/maps/api/js?sensor=false"></script>
</head>
<style type="text/css" media="screen">#canvas img {max-width: none;}</style>
<body><!--[if lt IE 7]><p class="chromeframe">You are using an outdated browser. <a href="http://browsehappy.com/">Upgrade your browser today</a> or <a href="http://www.google.com/chromeframe/?redirect=true">install Google Chrome Frame</a> to better experience this site.</p><![endif]-->
	
	
	<div id="toolbar">

		<div class="ui-nav">
			<a class="client-logo" href="/">Bever Sport</a>

			<ul class="nav">
				<li>
					<span class="group"><i class="icon-signal icon-white"></i> Store Portfolio</span>
					<ul>
						<li><a href="<?= site_url() ?>/app/geo/coverage">Coverage</a></li>
						<li><a href="<?= site_url() ?>/app/geo/performance">Performance</a></li>
						<!--<li><a href="<?= site_url() ?>/app">New Store Potential</a></li>-->
					</ul>
				</li>
				<li>
					<span class="group"><i class="icon-map-marker icon-white"></i> Areas</span>
					<ul>
						<li><a href="<?= site_url() ?>/app/geo">Underperforming Areas</a></li>
						<li><a href="<?= site_url() ?>/app/geo">Drivetime Analytics</a></li>
					</ul>
				</li>
				<li>
					<span class="group"><i class="icon-cog icon-white"></i> Settings</span>
					<ul>
						<li><a href="<?= site_url() ?>/app">Define Target Group</a></li>
						<li><a href="<?= site_url() ?>/app">Define Catchment Area</a></li>
						<li><a href="<?= site_url() ?>/app">Upload Data</a></li>
					</ul>
				</li>
				<li>
					<span class="group"><i class="icon-user icon-white"></i> Application</span>
					<ul>
						<li><a href="<?= site_url() ?>/app/profile">Profile</a></li>
						<li><a href="<?= site_url() ?>/app/logout">Logout</a></li>
					</ul>
				</li>
			</ul>

			<a class="logo" href="/">Smarten UP</a>

		</div>
	</div>
	
	<?php echo $template['body']; ?>

</body></html>