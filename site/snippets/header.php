<!-- Website designed and developed in collaboration with Tristan Bagot -->

<!DOCTYPE html>
<html lang="en" class="no-js">
<head>

	<meta charset="UTF-8" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
	<title><?php echo $site->title()->html() ?> | Creative Studio</title>
	<meta name="description" content="<?php echo $site->description()->html() ?>">
	<meta name="keywords" content="<?php echo $site->keywords()->html() ?>">
	<meta property="og:url" content="<?php echo $site->homePage()->url() ?>/"/>
	<meta property="og:description" content="<?php echo $site->description()->html() ?>"/>
	<meta property="og:image" content="<?= url('assets/images/og_image.jpg') ?>"/>
	<link rel="shortcut icon" href="<?= url('assets/images/favicon.ico') ?>">
	<link rel="icon" href="<?= url('assets/images/favicon.ico') ?>" type="image/x-icon">

	<?php 
	echo css('assets/css/app.min.css');
	echo js('assets/js/vendor/modernizr-build.js');
	?>
	<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
	<script>window.jQuery || document.write('<script src="assets/js/vendor/jquery.min.js">\x3C/script>')</script>

	<?php if(!$site->customcss()->empty()): ?>
		<style type="text/css">
			<?php echo $site->customcss()->html() ?>
		</style>
	<?php endif ?>

</head>
<body>
	
	<div class="loader">
		<div class="container blink"><img src="<?php echo url('assets/images/flag.png') ?>" width="25px"></div>
	</div>
	<nav class="mainmenu">
		<div class="inner">
			<div class="logo" data-target="page/about">
				<img src="<?php echo url('assets/images/logo_mn.svg') ?>" onerror="this.src='<?php echo url('assets/images/logo_mn.png') ?>'; this.onerror=null;" alt="Maison Nue" width="100%">
			</div>
			<ul>
				<li class="link" data-target="page/about">About</li>
				<li class="link" data-target="page/work">Work</li>
				<li class="link" data-target="page/collab">Collab</li>
				<li class="link" data-target="page/contact">Contact</li>
				<li class="link mobile" data-target="page/3615">3615 MN</li>
			</ul>
			<ul class="subscribe">
				<li class="title">Ask for portfolio</li>
				<li class="form">
				<form action="http://maisonnue.us12.list-manage.com/subscribe/post?u=7230e51d7a0195caebabf65b5&amp;id=be0044ad85" method="post" id="mc-embedded-subscribe-form" name="mc-embedded-subscribe-form" class="validate" target="_blank" novalidate>
					<div id="mc_embed_signup_scroll">
						<li class="mc-field-group">
							<input type="text" value="" name="FNAME" class="" id="mce-FNAME" placeholder="Name">
						</li>
						<li class="mc-field-group">
							<input type="email" value="" name="EMAIL" class="required email" id="mce-EMAIL" placeholder="Email">
						</li>
						<div id="mce-responses" class="clear">
							<div class="response" id="mce-error-response" style="display:none"></div>
							<div class="response" id="mce-success-response" style="display:none"></div>
						</div>    <!-- real people should not fill this in and expect good things - do not remove this or risk form bot signups-->
						<div style="position: absolute; left: -5000px;" aria-hidden="true"><input type="text" name="b_7230e51d7a0195caebabf65b5_be0044ad85" tabindex="-1" value=""></div>
						<li class="submit"><input type="submit" value="Ok" name="subscribe" id=""></li>
					</div>
				</form>
				<script type='text/javascript' src='http://s3.amazonaws.com/downloads.mailchimp.com/js/mc-validate.js'></script><script type='text/javascript'>(function($) {window.fnames = new Array(); window.ftypes = new Array();fnames[0]='EMAIL';ftypes[0]='email';fnames[1]='FNAME';ftypes[1]='text';fnames[2]='LNAME';ftypes[2]='text';}(jQuery));var $mcj = jQuery.noConflict(true);</script>
				</li>
			</div>
		</div>
		<div class="grad"></div>
	</nav>

	<div class="container">