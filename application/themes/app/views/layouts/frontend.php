<!doctype html><!--[if lt IE 7 ]><html lang="en" class="no-js ie6"><![endif]--><!--[if IE 7 ]><html lang="en" class="no-js ie7"><![endif]--><!--[if IE 8 ]><html lang="en" class="no-js ie8"> <![endif]--><!--[if IE 9 ]><html lang="en" class="no-js ie9"><![endif]--><!--[if (gt IE 9)|!(IE)]><!--><html lang="en" class="no-js"><!--<![endif]-->
<head>
  <meta charset="utf-8"><meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
  <title><?php echo $template['title']; ?></title>
  <meta name="description" content="">
  <meta name="keywords" content="">
  <meta name="author" content="">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="shortcut icon" href="/favicon.ico">
  <link rel="apple-touch-icon" href="/apple-touch-icon.png">
  <?php echo $template['metadata']; ?>

	<link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/login.med.css">

	<link rel="stylesheet" href="<?php echo base_url(); ?>assets/bootstrap/css/bootstrap.css">
	
  <script src="<?php echo base_url(); ?>assets/js/vendor/modernizr-2.6.1.min.js"></script>
	<script src="https://maps.googleapis.com/maps/api/js?sensor=false"></script>
</head>

<style type="text/css" media="screen">.login .ui-logo {background: url(<?= base_url();?>assets/img/logo-black.png) no-repeat;}</style>

<body><!--[if lt IE 7]><p class="chromeframe">You are using an outdated browser. <a href="http://browsehappy.com/">Upgrade your browser today</a> or <a href="http://www.google.com/chromeframe/?redirect=true">install Google Chrome Frame</a> to better experience this site.</p><![endif]-->
	<div class="ui-login-nav">
		<ul class="ui-nav">
			<li><a href="#">About</a></li>
			<li><a href="#">Sign up</a></li>

		</ul>
	</div>
<?php echo $template['body']; ?>

<script src="//ajax.googleapis.com/ajax/libs/jquery/1.8.0/jquery.min.js"></script>
<script>window.jQuery || document.write('<script src="<?php echo base_url(); ?>assets/js/vendor/jquery-1.8.0.min.js"><\/script>')</script>
<script src="<?php echo base_url(); ?>assets/js/effects.min.js"></script>

<script src="<?php echo base_url(); ?>assets/bootstrap/js/bootstrap.js"></script>
<script src="<?php echo base_url(); ?>assets/js/backstretch.plugin.min.js"></script>


<script type="text/javascript" charset="utf-8">
$('#identity').keypress(function(event){
	if (event.which == 33) 
	{
		event.preventDefault();
		$('#identity').val('demo@bestnextstore.com');
		$('#password').val('12345678');
	}
});

$(document).ready(function(){
	if($('.login'))
	{
		$('.login').delay(200).animate({marginTop:'100px',opacity:1},600, 'swing');
	}
	
	$.backstretch("<?= base_url();?>assets/img/login-bg-1.jpg");
	
});

</script></body></html>