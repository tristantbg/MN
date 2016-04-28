<?php 
$pdfpage = $pages->find('pdf');
$pdf = json_decode(get('projects', '[]'));
?>

<!doctype html>
<html class="no-js" lang="en">
<head>
	<title>Maison Nue - Custom Portfolio</title>

	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta http-equiv="Cache-Control" content="no-cache, no-store, must-revalidate" />
	<meta http-equiv="Pragma" content="no-cache" />
	<meta http-equiv="Expires" content="0" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<?php 
	echo css('assets/css/app.min.css');
	echo js(array('assets/js/vendor/pdfmake/pdfmake.min.js','assets/js/vendor/pdfmake/vfs_fonts.js'));
	?>

	<body>

	<div class="container">
	<section class="pdf_page">

	<div class="wrap">

			<p>Please wait…</p>
			<p>Your portfolio will download automatically.</p>

	</div>

	</section>
	</div>

	

		<script type="text/javascript">

			var pdf = <?php echo $pdf ?>;

			pdfMake.fonts = {
				PL: {
					normal: 'PL.ttf',
					italics: 'PLI.ttf',
				},
				HL: {
					normal: 'HL.ttf',
				}
			};

			var docDefinition = {
				pageSize: 'A4',
				pageOrientation: 'landscape',
				footer: function(currentPage, pageCount){
					return {
						stack: [
						{text: 'p — '+ currentPage.toString() + '/' + pageCount},
						"maisonnue.com",
						], margin: [60,-20,0,0]
					};
				},
                // [left, top, right, bottom] or [horizontal, vertical] or just a number for equal margins
                pageMargins: [30, 30, 30, 30],
                content: [
                {
                	///// PAGE COVER
                	columns: [
                	{
                		width: '*',
                		stack: [

                		{
                			image: 'logo',
                			width: 130,
                		},
                		{
                			text: 'Selected projects',
                			margin: [0,30,0,0]
                		},

                		{
                			text: 'on <?php echo date("d F Y") ?>',
                		},

                		], margin: [30,100,0,0]
                		
                	},
                	{
                		width: '*',
                		stack: [

                		{
                			image: 'intro',
                			fit: [380,535],
                		}

                		]
                	},
                	],
                	columnGap: 10,
                	pageBreak: 'after'
                },
                ///// PAGE INTRO
                {
                	image: 'logo',
                	width: 80,
                	margin: [30,0,0,0]
                },
                {
                	text: '\t\t MaisonNue is a Paris-based multidisciplinary creative studio founded in 2012.',
                	style: 'header',
                	margin: [0,90,0,0]
                },
                {
                	text: ['\t\t Inspired by the new and the now, the studio crafts images and creative strategies touching on ',
                	{ text: 'design', italics: true },
                	', ',
                	{ text: 'digital', italics: true },
                	', ',
                	{ text: 'art direction', italics: true },
                	', ',
                	{ text: 'photography', italics: true },
                	' and ',
                	{ text: 'brand content', italics: true },
                	' with a minimal and bold attitude.' ],
                	style: 'header',
                	margin: [0,20,0,0],
                	pageBreak: 'after'
                },



                <?php
                foreach ($pdf as $uid):
                	$project = $pages->find('work/'.$uid);
                ?>

                ///// PAGE PROJECT
                {
                	image: 'logo',
                	width: 80,
                	margin: [30,0,0,0]
                },
                {
                	columns: [
                	{
                		width: '*',
                		stack: [

                		{
                			text: '<?php echo addslashes($project->title()) ?>',
                			style: 'header',
                		}

                		],
                		margin: [0,0,20,0]
                		
                	},
                	{
                		width: '*',
                		stack: [

                		{
                			text: '<?php echo addslashes($project->subtitle()) ?>',
                			style: 'subheader'
                		}

                		]
                	},
                	],
                	columnGap: 10,
                	margin: [30,90,0,0]
                },
                {
                	columns: [
                	{
                		width: 80,
                		stack: [

                		{
                			text: '<?php echo $project->date('Y') ?>',
                			style: 'subheader',
                			margin: [0,0,0,20]
                		},

            			<?php
            			foreach ($project->categories()->split(',') as $cat):
            			?>

                			{
                				text: '<?php echo $cat ?>',
                				style: 'small',
                			},

                		<?php endforeach ?>

                	],



                },
                {
                	width: 220,
                	stack: [

                	<?php
                		$desc = $project->text();
                		$desc = addslashes($desc);
            			$desc = preg_split( "/\r|\n/", $desc );
            			//$desc = array_filter($desc);
            			foreach ($desc as $line):
            			
            			?>

                			{
                				text: '<?php echo $line ?>\n',
                			},

                		<?php endforeach ?>

                	]

                },
                {
                	width: 51,
                	stack: [

                	{
                		text: '',
                	}

                	]
                },
                {
                	width: '*',
                	stack: [
                	<?php if(!$project->featured()->empty() && $project->featured()->toFile()->extension() != 'gif'):?>
                	{
                		image: '<?php echo $project->image($project->featured())->resize(500)->dataUri(); ?>',
                		fit: [200,270],
                	}
                	<?php endif; ?>

                	]
                },
                ],
                columnGap: 10,
                margin: [30,30,0,0],
                pageBreak: 'after'
            },

            <?php foreach($project->pdf()->toStructure() as $page): ?>
			<?php if($page->_fieldset() == 'onecol'):?>

			{
				columns: [
				{
					width: '*',
					stack: [
					{
						image: 'logo',
						width: 80,

					}]
				},
				{
					width: '*',
					stack: [
					{
						text: '<?php echo addslashes($project->title()) ?>',
						alignment: 'right',
						margin: [0,3,0,0]
					}]
				}
				],
				margin: [30,0,30,0]
			},
			{
				stack: [

				{
					image: '<?php echo $page->imageone()->toFile()->resize(800)->dataUri() ?>',
					fit: [580,400],
					alignment: 'center'
				}

				],
				margin: [0,50,0,0],
				pageBreak: 'after'
			},

			<?php endif ?>

			<?php if($page->_fieldset() == 'twocol'):?>


			{
				columns: [
				{
					width: '*',
					stack: [
					{
						image: 'logo',
						width: 80,

					}]
				},
				{
					width: '*',
					stack: [
					{
						text: '<?php echo addslashes($project->title()) ?>',
						alignment: 'right',
						margin: [0,3,0,0]
					}]
				}
				],
				margin: [30,0,30,0]
			},
			{
				columns: [
				{
					width: 300,
					stack: [

					{
						image: '<?php echo $page->imageone()->toFile()->resize(800)->dataUri() ?>',
						width: 300,
						alignment: 'center'
					}

					]

				},
				{
					width: 300,
					stack: [

					{
						image: '<?php echo $page->imagetwo()->toFile()->resize(800)->dataUri() ?>',
						width: 300,
						alignment: 'center'
					}

					]
				},
				],
				columnGap: 10,
				margin: [100,50,0,0],
				pageBreak: 'after'
			},

			<?php endif ?>

            <?php endforeach ?>


        <?php endforeach ?>




                ///// PAGE OUTRO
                {
                	image: 'logo',
                	width: 80,
                	margin: [30,0,0,0]
                },
                {
                	text: '7 rue Paul-Louis Courier',
                	style: 'header',
                	margin: [30,90,0,0]
                },
                {
                	text: 'Paris 7e, France',
                	style: 'header',
                	margin: [30,0,0,0]
                },
                {
                	text: 'studio@maisonnue.com',
                	style: 'header',
                	margin: [30,20,0,0]
                },

                ],
                images: {
                	logo: '<?php echo $pdfpage->logo()->toFile()->dataUri() ?>',
                	intro: '<?php echo $pdfpage->featured()->toFile()->dataUri() ?>'
                },
                defaultStyle: {
                	font: 'HL',
                	fontSize: 9,
                	lineHeight: 1.4
                },
                styles: {
                	header: {
                		font: 'PL',
                		fontSize: 35,
                		lineHeight: 1
                	},
                	subheader: {
                		font: 'HL',
                		fontSize: 11,
                		lineHeight: 1.2
                	},
                	small: {
                		font: 'HL',
                		fontSize: 6,
                		lineHeight: 1.4
                	}
                }
            };
            pdfMake.createPdf(docDefinition).download('MaisonNue_Custom_Portfolio_<?php echo date('d-m-y') ?>.pdf');



        </script>

    </body>
    </html>
