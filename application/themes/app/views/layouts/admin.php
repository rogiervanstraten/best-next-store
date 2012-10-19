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

			<ul class="nav">
				<li>
					<span class="group"><i class="icon-th icon-white"></i> Base</span>
					<ul>
						<li><a href="<?= site_url() ?>/app/dashboard">Dashboard</a></li>
					</ul>
				</li>
				<li>
					<span class="group"><i class="icon-user icon-white"></i> Clients</span>
					<ul>
						<li><a href="<?= site_url() ?>/app/users">Users (clients)</a></li>
						<li><a href="<?= site_url() ?>/app/statistics">Statistics</a></li>
						<li><a href="<?= site_url() ?>/app/statistics/reports">Reports</a></li>
					</ul>
				</li>
				<li>
					<span class="group"><i class="icon-cog icon-white"></i> Application</span>
					<ul>
						<li><a href="<?= site_url() ?>/app/settings">Settings</a></li>
						<li><a href="<?= site_url() ?>/app/logout">Logout</a></li>
					</ul>
				</li>
			</ul>

			<a class="logo" href="/">Smarten UP</a>

		</div>
	</div>
	
	<?php echo $template['body']; ?>
	<script src="//ajax.googleapis.com/ajax/libs/jquery/1.8.0/jquery.min.js"></script>
	<script>window.jQuery || document.write('<script src="<?php echo base_url(); ?>assets/js/vendor/jquery-1.8.0.min.js"><\/script>')</script>
	<script src="<?php echo base_url(); ?>assets/js/effects.min.js"></script>
	<link rel="stylesheet" href="<?php echo base_url(); ?>assets/resources/datatables/css/jquery.dataTables_themeroller.css">
	<script src="<?php echo base_url(); ?>assets/resources/datatables/js/jquery.dataTables.js"></script>
	
<script type="text/javascript" charset="utf-8">
	$(document).ready(function(){
		if($('#users'))
		{
			$('#users').dataTable({
				"bAutoWidth": false,
				"bLengthChange": false,
				"iDisplayLength": 40,
		    "oLanguage": {
		      "sSearch": ""
		    },
				"aoColumns": [{"sClass": "left" },{"sClass": "right"},{"sClass": "right"},{"sClass": "right"},{"sClass": "right"}]
				});
		}
		
	});
</script>
</body></html>