<?php
$contact = $pages->find('contact');
?>

<section class="contact" id="contact">

<div class="inner">
	<div class="wrap">

		<div class="contact_infos">
			<?php echo $contact->contact()->kt() ?>
		</div>
		<ul class="social">
			<?php foreach($contact->socials()->yaml() as $social): ?>
				<li>
					<a href="<?php echo $social['link'] ?>" target="_blank"><?php echo $social['name'] ?></a>
				</li>
				<li> | </li>
			<?php endforeach ?>
		</ul>

	</div>

	<div class="sidebar">
		<?php echo $contact->sidebar()->kt() ?>
	</div>
</div>

<div class="credits">
		<h1>Credits</h1>
		<div class="content">
			<?php echo $contact->credits()->kt() ?>
		</div>
		© <?php echo date(Y) ?>. All rights reserved by Maison Nue
	</div>

</section>