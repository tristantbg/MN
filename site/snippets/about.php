<?php
$about = $pages->find('about');
$work = $pages->find('work');
$skills_index = 0;

// fetch all tags
$all_categories = $work->children()->visible()->pluck('categories', ',', true);

$galleryPage = $work;
$galleryImages = array();

foreach ($all_categories as $cat) {

	$projectChilds = $galleryPage->children()->filterBy('categories', $cat, ',')->visible();

	$index = 0;

	foreach ($projectChilds as $project) {
		
		foreach($project->thumbs()->toStructure() as $thumb) {

			if ($thumb->featured() == '1') {

				$image = $thumb->content();
				$t = resizeOnDemand($image->toFile(), 900);
				$w = $project->image($image)->width();
				$h = $project->image($image)->height();

				$galleryImages[tagslug($cat)][$index][0] = $t;
				$galleryImages[tagslug($cat)][$index][1] = $w;
				$galleryImages[tagslug($cat)][$index][2] = $h;

				$index++;
			}
		}
	}

}

foreach($about->moreimages()->toStructure() as $thumb) {
	$image = $thumb->content();
	$cat = $thumb->category();

	$t = resizeOnDemand($image->toFile(), 900);
	$w = $about->image($image)->width();
	$h = $about->image($image)->height();

	$stack = array($t, $w, $h);

	array_push($galleryImages[tagslug($cat)], $stack);

	}

$js_array = json_encode($galleryImages);
?>

<section class="about" id="about">

	<div class="wrap">

		<div class="logo">
			<img src="<?php echo url('assets/images/logo_mn.svg') ?>" onerror="this.src='img/logo_mn.png'; this.onerror=null;" alt="Maison Nue">
		</div>
		<span class="intro">
			<?php echo $about->intro()->kt() ?>
		</span>
		<br><br>
		<span class="skills">
			<?php echo $about->outro()->kt() ?>
			<?php foreach($all_categories as $category): ?>
				<span class="link skill invert" data-filter="<?php echo tagslug($category) ?>"><?php echo widont($category) ?></span>
				<?php if ($skills_index == count($all_categories)-2) {
					echo ' and ';
				} elseif ($skills_index == count($all_categories)-1) {
				}
				else {
					echo '<span class="separator">, </span>';
				}

				?>
				<?php $skills_index++ ?>
			<?php endforeach ?>
			with a minimal and bold attitude.
		</span>

	</div>

	<div class="visualBack"></div>

	<script type='text/javascript'>
		var landing_images = <?php echo $js_array ?> ;
	</script>

	<button class="arrow" type="button">
		<svg version="1.1" x="0px" y="0px"
		viewBox="0 0 30 30" enable-background="new 0 0 30 30" xml:space="preserve">
		<polygon fill="#000" points="24.3,9 15,20.1 5.7,9 "/>
		</svg>
	</button>

</section>