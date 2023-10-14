<?php
	if(! defined('BASEPATH') ){ exit('Unable to view file.'); }
?>
  <footer id="footer" class="footer">
    <?php echo eval(base64_decode('ZWNobyAnPGRpdiBjbGFzcz0iY29weXJpZ2h0Ij5BbGwgcmlnaHRzIHJlc2VydmVkICZjb3B5OyA8c3Ryb25nPjxzcGFuPicuICRjb25maWdbJ3NpdGVfbG9nbyddLic8L3NwYW4+PC9zdHJvbmc+PC9kaXY+PGRpdiBjbGFzcz0iY3JlZGl0cyI+UG93ZXJlZCBieSA8YSBocmVmPSJodHRwczovL3BhaWRvZmZlcnMubmV0LyIgdGFyZ2V0PSJfYmxhbmsiPlBhaWRPZmZlcnMubmV0PC9hPjwvZGl2Pic7')); ?>
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
?>
	<script>
		var current_version = '<?php echo $config['version']; ?>';
		function getVersion() {
		$.ajax({
			url: '/system/ajax.php?a=scriptVersion',
			timeout: 7500,
			success: function(b) {
				$('#latest_version').html(b);
			},
			error: function(b) {
				$('#latest_version').html(current_version);
			}
		})}
		
		function getNews() {
		$.ajax({
			url: '/system/ajax.php?a=getNews',
			timeout: 7500,
			success: function(b) {
				$('#loadNews').html(b);
			},
			error: function(b) {
				$('#loadNews').html(current_version);
			}
		})}
		
		setTimeout(getNews(), 1000);
		setTimeout(getVersion(), 1000);
	</script>
	<!-- PaidOffers Lite v<?php echo $config['version']; ?> - Developed by www.ScriptStore.xyz -->
</body>
</html>