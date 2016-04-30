<?php
$work = $pages->find('work');
// fetch all tags
$all_categories = $work->children()->visible()->pluck('categories', ',', true);
?>

<section class="work" id="work">
	<div class="wrap">

		<div class="categories">
			<div class="all"><h1>I feel like </h1></div>
			<ul class="nav_categories">
			<div class="before">
				<svg version="1.1" x="0px" y="0px"
		viewBox="0 0 30 30" enable-background="new 0 0 30 30" xml:space="preserve">
		<polygon fill="#000" points="24.3,9 15,20.1 5.7,9 "/>
		</svg>
			</div>
				<li class="category enabled" data-filter="everything">everything</li>
				<?php foreach($all_categories as $category): ?>
					<li class="category" data-filter="<?php echo tagslug($category) ?>"><?php echo html($category) ?></li>
				<?php endforeach ?>
				<li class="category" data-filter="visuals">visuals</li>
				<div class="after">
					<svg version="1.1" x="0px" y="0px"
		viewBox="0 0 30 30" enable-background="new 0 0 30 30" xml:space="preserve">
		<polygon fill="#000" points="24.3,9 15,20.1 5.7,9 "/>
		</svg>
				</div>
			</ul>
			<!-- <div class="all">.</div> -->
		</div>
		<div class="projects">
			<?php foreach($work->children()->visible() as $project): ?>

				<?php 

				if(!$project->featured()->empty()):
					$featured_url = resizeOnDemand($project->image($project->featured()), 400);
				else: $featured_url = "";
				endif;

				$categories = $project->categories()->split(',');

				?>
				<div class="project<?php foreach($categories as $category): echo " ".tagslug($category); endforeach ?>" data-title="<?php echo $project->uid(); ?>">
					<div class="project_header">
						<div class="project_title" data-target="page/work/<?php echo $project->uid() ?>"><?php echo $project->title()->html() ?></div>
						<div class="year_title">
							<?php echo $project->date('Y') ?>
						</div>
						<div class="thumbnail_hover"><img class="lazyload" data-src="<?php echo $featured_url; ?>"></div>
						<div class="project_infos">
							<div class="project_divider">|</div>
							<div class="project_year">
								<?php echo $project->date('Y') ?>
								<div class="portfolio_select" alt="Add project to portfolio"></div>
							</div>
							
							<div class="infos_right">
							<?php if(!$project->subtitle()->empty()): ?>
								<div class="project_subtitle">
									<?php echo $project->subtitle()->html() ?>
								</div>
							<?php endif ?>
								<div class="project_desc hyphenate">
									<?php echo $project->text()->kirbytext() ?>
								</div>
							</div>
						</div>
					</div>
					<div class="project_content">
						<?php $switch = rand(0,1) ?>
						<?php foreach($project->thumbs()->toStructure() as $key => $thumb): ?>
							<?php //$thumbImage = thumb($project->image($thumb->content()), array('width' => $thumb->size()->value()))->url(); ?>
							<div class="project_image closed">
								<?php

								if ($thumb->video() != ''):

									// echo "<div class='project_video' style='width:" . $thumb->size()->value() . "px' data-small='" . $thumb->size()->value() . "'>" . $thumb->video()->oembed() . "</div>";

									echo "<div class='project_video' style='width:" . $rand_size . "px' data-small='" . $rand_size . "'>" . $thumb->video()->oembed() . "</div>";

								elseif ($image = $thumb->content()->toFile()):
									$image = $thumb->content()->toFile();

								if ($key%2 != $switch) {
									if ($image->landscape()) {
										$rand_size = rand(120,150);
									} else {
										$rand_size = rand(75,130);
									}
									
								} else {
									if ($image->landscape()) {
										$rand_size = rand(180,250);
									} else {
										$rand_size = rand(100,230);
									}
								}

								$srcset = '';
								for ($i = 600; $i <= 1800; $i += 300) {
									// if($i<2100): $srcset .= resizeOnDemand($image, $i) . ' ' . $i . 'w,';
									// else: $srcset .= $image->url() . ' ' . $i . 'w,';
									// endif;
									$srcset .= resizeOnDemand($image, $i) . ' ' . $i . 'w,';
								}
								?>
								<img 
								class="thumb lazyload <?php if($image->isLandscape()){ echo "landscape"; }?>"
								src="<?= url('assets/images/placeholder.gif') ?>"
								data-src="<?php //echo $image->url() ?>"
								data-srcset="<?php echo $srcset ?>" 
								data-sizes="50vw"
								data-optimumx="1.5"
								data-small="<?php echo $rand_size ?>"
								width="<?php echo $rand_size ?>px"
								height="auto"
								alt="<?php if (!$thumb->caption()->empty()): echo $project->title()->html().', '.$thumb->caption()->html().' — © '.$project->date(Y).', MaisonNue'; else: echo $project->title()->html().' — © '.$project->date(Y).', MaisonNue'; endif ?>">
								
							<?php endif ?>

						</div>
					<?php endforeach ?>

					<?php foreach($project->embed()->toStructure() as $embed): ?>
						<div class="project_embed">
							<?php echo $embed->link()->oembed(); ?>
						</div>

					<?php endforeach ?>
				</div>

				<div class="project_divider">|</div>


			</div>
		<?php endforeach ?>
	</div>

</div>

<div class="pdf_download">Download custom portfolio</div>

</section>