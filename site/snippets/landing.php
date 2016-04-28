<?php
$about = $pages->find('about');
?>

<section class="landing" id="landing">

	<div class="wrap">
		<div class="logo">
			<img src="<?php echo url('assets/images/logo_mn.svg') ?>" onerror="this.src='img/logo_mn.png'; this.onerror=null;" alt="Maison Nue">
		</div>
		<span class="intro">
			<?php echo $about->intro()->kt() ?>
		</span>
	</div>

</section>