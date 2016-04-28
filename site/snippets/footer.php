</div>

<div class="mntl-crawler">
	<div class="mntl-crawler-icon">
		<img src="<?php echo url('assets/3615/M-Top.gif') ?>" height='100%' width='auto'>
	</div>
	<div id="mntl-crawler">
	<span><?php echo $pages->find('contact')->minitel() ?></span>
	</div>
</div>

<?php
echo js(array('assets/js/build/plugins.js', 'assets/js/build/app.min.js'));
?>

<?php if(!$site->googleanalytics()->empty()): ?>
	<!-- Google Analytics-->
	<script>
		(function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
			(i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
			m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
		})(window,document,'script','//www.google-analytics.com/analytics.js','ga');
		ga('create', '<?php echo $site->googleanalytics() ?>', 'auto');
		ga('send', 'pageview');
	</script>
<?php endif ?>

</body>
</html>