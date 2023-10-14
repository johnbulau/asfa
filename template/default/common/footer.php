<?php
	if(! defined('BASEPATH') ){ exit('Unable to view file.'); }
?>
  <footer id="footer" class="footer">
    <?php echo eval(base64_decode('ZWNobyAoZW1wdHkoJENPTkZbJ2RwYiddKSB8fCAkQ09ORlsnZHBiJ10gIT0gMSA/ICc8ZGl2IGNsYXNzPSJjb3B5cmlnaHQiPkFsbCByaWdodHMgcmVzZXJ2ZWQgJmNvcHk7IDxzdHJvbmc+PHNwYW4+Jy4gJGNvbmZpZ1snc2l0ZV9sb2dvJ10uJzwvc3Bhbj48L3N0cm9uZz48L2Rpdj48ZGl2IGNsYXNzPSJjcmVkaXRzIj5Qb3dlcmVkIGJ5IDxhIGhyZWY9Imh0dHBzOi8vcGFpZG9mZmVycy5uZXQvIiB0YXJnZXQ9Il9ibGFuayI+UGFpZE9mZmVycy5uZXQ8L2E+PC9kaXY+JyA6ICc8ZGl2IGNsYXNzPSJjb3B5cmlnaHQiPkFsbCByaWdodHMgcmVzZXJ2ZWQgJmNvcHk7IDxzdHJvbmc+PHNwYW4+Jy4kY29uZmlnWydzaXRlX2xvZ28nXS4nPC9zcGFuPjwvc3Ryb25nPjwvZGl2PicpOw==')); ?>
  </footer>
  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>
  <script src="assets/vendor/jquery/jquery-3.3.1.min.js"></script>
  <script src="assets/vendor/apexcharts/apexcharts.min.js"></script>
  <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="assets/vendor/chart.js/chart.min.js"></script>
  <script src="assets/vendor/echarts/echarts.min.js"></script>
  <script src="assets/vendor/tinymce/tinymce.min.js"></script>
  <script src="assets/js/main.js"></script>
<?php
	// Load page level scripts
	if(!empty($load_scripts))
	{
		foreach($load_scripts as $script)
		{
			echo '<script src="'.$script.'"></script>';
		}
	}
	
	if(!empty($footer_js))
	{
		$packer = new JavaScriptPacker($footer_js, 'Normal', true, false);
		$packed = $packer->pack();

		echo '<script>'.$packed.'</script>';
	}

	if(!empty($config['analytics_id'])) {
?>
	<script async src="https://www.googletagmanager.com/gtag/js?id=<?php echo $config['analytics_id']; ?>"></script>
	<script>
	  window.dataLayer = window.dataLayer || [];
	  function gtag(){dataLayer.push(arguments);}
	  gtag('js', new Date());

	  gtag('config', '<?php echo $config['analytics_id']; ?>');
	</script>
<?php } ?>
	<!-- PaidOffers Lite v<?php echo $config['version']; ?> - Developed by www.ScriptStore.xyz -->
</body>
</html>