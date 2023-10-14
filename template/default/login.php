<?php
	if(! defined('BASEPATH') ){ exit('Unable to view file.'); }

	$recover_key = false;
	if(isset($_GET['recover']))
	{
		$getKey = $db->EscapeString($_GET['recover']);
		$checkKey = $db->QueryFetchArray("SELECT `user_id` FROM `users_recovery` WHERE `hash_key`='".$getKey."' LIMIT 1");
		
		if(!empty($checkKey['user_id']))
		{
			$recover_key = true;
		}
	}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <title><?php echo (empty($page_title) ? $config['site_name'] : $page_title.' - '.$config['site_logo']); ?></title>
  <meta content="<?php echo $config['site_description']; ?>" name="description">
  <meta content="<?php echo $config['site_keywords']; ?>" name="keywords">
  <base href="<?php echo $config['secure_url']; ?>">
  <link href="assets/img/favicon.png" rel="icon">
  <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">
  <link href="https://fonts.gstatic.com" rel="preconnect">
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">
  <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
  <link href="assets/css/style.css" rel="stylesheet">
</head>
<body>
  <main>
    <div class="container">
      <section class="section register min-vh-100 d-flex flex-column align-items-center justify-content-center py-4">
        <div class="container">
          <div class="row justify-content-center">
            <div class="col-lg-4 col-md-6 d-flex flex-column align-items-center justify-content-center">
              <div class="d-flex justify-content-center py-4">
                <a href="<?php echo $config['secure_url']; ?>" class="logo d-flex align-items-center w-auto">
                  <img src="assets/img/logo.png" alt="">
                  <span class="d-none d-lg-block"><?php echo $config['site_logo']; ?></span>
                </a>
              </div>
              <div class="card mb-3">
                <div class="card-body">
                  <div class="pt-4 pb-2">
                    <h5 class="card-title text-center pb-0 fs-4">Login to Your Account</h5>
                    <p class="text-center small">Enter your username & password to login</p>
                  </div>
                  <form id="loginForm" class="row g-3 needs-validation" novalidate>
					<div id="loginStatus"></div>
					<input type="hidden" id="loginToken" value="<?php echo $token; ?>" />
                    <div class="col-12">
                      <label for="userLogin" class="form-label">Username</label>
                      <div class="input-group has-validation">
                        <span class="input-group-text" id="inputGroupPrepend">@</span>
                        <input type="text" class="form-control" id="userLogin" required>
                        <div class="invalid-feedback">Please enter your username.</div>
                      </div>
                    </div>
                    <div class="col-12">
                      <label for="userPass" class="form-label">Password</label>
                      <input type="password" class="form-control" id="userPass" required>
                      <div class="invalid-feedback">Please enter your password!</div>
                    </div>
					<?php 
						if(!empty($config['recaptcha_pub'])){
							echo '<div class="g-recaptcha" data-sitekey="'.$config['recaptcha_pub'].'"></div>';
						}
					?>
                    <div class="col-12">
                      <div class="form-check">
                        <input class="form-check-input" type="checkbox" value="true" id="remember">
                        <label class="form-check-label" for="remember">Remember me</label>
                      </div>
                    </div>
                    <div class="col-12">
                      <button class="btn btn-primary w-100" type="submit">Login</button>
                    </div>
                    <div class="col-12">
                      <p class="small mb-0">Forgotten password? <a href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#recoverModal">Click here</a> to recover it.</p>
                    </div>
                  </form>
                </div>
              </div>
              <?php echo eval(base64_decode('ZWNobyAoZW1wdHkoJENPTkZbJ2RwYiddKSB8fCAkQ09ORlsnZHBiJ10gIT0gMSA/ICc8ZGl2IGNsYXNzPSJjcmVkaXRzIj5BbGwgcmlnaHRzIHJlc2VydmVkICZjb3B5OyAnLmRhdGUoJ1knKS4nIDxzdHJvbmc+PHNwYW4+Jy4kY29uZmlnWydzaXRlX2xvZ28nXS4nIDwvc3Ryb25nPjwvc3Bhbj48YnIgLz48Y2VudGVyPlBvd2VyZWQgYnkgPGEgaHJlZj0iaHR0cHM6Ly9wYWlkb2ZmZXJzLm5ldC8iIHRhcmdldD0iX2JsYW5rIiBzdHlsZT0iY29sb3I6IzAwMCI+UGFpZE9mZmVycy5uZXQ8L2E+PC9jZW50ZXI+PC9kaXY+JyA6ICc8ZGl2IGNsYXNzPSJjcmVkaXRzIj5BbGwgcmlnaHRzIHJlc2VydmVkICZjb3B5OyAnLmRhdGUoJ1knKS4nIDxzdHJvbmc+PHNwYW4+Jy4kY29uZmlnWydzaXRlX2xvZ28nXS4nPC9zdHJvbmc+PC9zcGFuPjwvZGl2PicpOw==')); ?>
            </div>
          </div>
        </div>
      </section>
    </div>
  </main>
  	<?php
		if($recover_key) {
	?>
	<div id="recoverModal" class="modal fade">
		<div class="modal-dialog modal-dialog-centered modal-login animated">
			<div class="modal-content">
				<div class="modal-header">				
					<h5 class="modal-title">Change Password</h5>
					<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
				</div>
				<div class="modal-body">
					<form method="POST" id="changePass">
						<div id="recoverStatus"></div>
						<input type="hidden" id="changePassToken" value="<?php echo $token; ?>" />
						<div class="input-group mb-2">
							<span class="input-group-text"><i class="bi bi-lock"></i></span>
							<input type="password" class="form-control" id="newPassword" placeholder="New Password" required="required" />
						</div>
						<div class="input-group mb-2">
							<span class="input-group-text"><i class="bi bi-lock"></i></span>
							<input type="password" class="form-control" id="confirmPassword" placeholder="Confirm Password" required="required" />
						</div>
						<?php 
							if(!empty($config['recaptcha_pub'])){
								echo '<div class="g-recaptcha" data-sitekey="'.$config['recaptcha_pub'].'"></div>';
							}
						?>
						<div class="form-group mt-3">
							<button type="submit" class="btn btn-primary btn-block btn-lg" onclick="changePassAjax(); return false">Change Password</button>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
	<?php } else { ?>
	<div id="recoverModal" class="modal fade">
		<div class="modal-dialog modal-dialog-centered modal-login animated">
			<div class="modal-content">
				<div class="modal-header">				
					<h5 class="modal-title">Recover Password</h5>
					<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
				</div>
				<div class="modal-body">
					<form method="POST" id="recoverPass">
						<div id="recoverStatus"></div>
						<input type="hidden" id="recoverToken" value="<?php echo $token; ?>" />
						<div class="input-group mb-2">
							<span class="input-group-text"><i class="bi bi-envelope"></i></span>
							<input type="email" class="form-control" id="recoverEmail" placeholder="Email Address" required="required" />
						</div>
						<?php 
							if(!empty($config['recaptcha_pub'])){
								echo '<div class="g-recaptcha" data-sitekey="'.$config['recaptcha_pub'].'"></div>';
							}
						?>
						<div class="form-group mt-3">
							<button type="submit" class="btn btn-primary btn-block btn-lg">Recover</button>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
	<?php } ?>
  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>
  <script src="assets/vendor/apexcharts/apexcharts.min.js"></script>
  <script src="assets/vendor/jquery/jquery-3.3.1.min.js"></script>
  <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="assets/vendor/chart.js/chart.min.js"></script>
  <script src="assets/vendor/echarts/echarts.min.js"></script>
  <script src="assets/vendor/tinymce/tinymce.min.js"></script>
  <script src="assets/js/main.js"></script>
  <?php
	if(!empty($config['recaptcha_pub'])) {
		echo '<script src="https://www.google.com/recaptcha/api.js" async></script>';
	}

	$js_code = '';
	if(isset($_GET['activate']) && !empty($_GET['activate']))
	{
		$code = $db->EscapeString($_GET['activate']);
		if($db->QueryGetNumRows("SELECT `id` FROM `users` WHERE `activate`='".$code."' LIMIT 1") > 0){
			$db->Query("UPDATE `users` SET `activate`='0' WHERE `activate`='".$code."'");
			$js_code .= '$(document).ready(function() {$("#loginStatus").html(\'<div class="alert alert-success" role="alert">E-mail address was successfully verified!</div>\'); });';
		}
	}
	
	$js_code .= '$("#loginForm").on("submit", function(e) {
		e.preventDefault();
		$("#loginStatus").html(\'<div class="alert alert-info" role="alert">Please wait...</div>\');
		var token = $("#loginToken").val();
		var username = $("#userLogin").val();
		var password = $("#userPass").val();
		var remember = $("#remember").val();
		if(username == "") {
			$("#loginStatus").html(\'<div class="alert alert-danger" role="alert">Please complete your username or email address!</div>\');
		} else if(password == "") {
			$("#loginStatus").html(\'<div class="alert alert-danger" role="alert">Please complete your password!</div>\');
		} else if(token == "") {
			$("#loginStatus").html(\'<div class="alert alert-danger" role="alert">Session expired, please refresh this page and try again!</div>\');
		} else {
			var response = '.(empty($config['recaptcha_pub']) ? 'null' : 'grecaptcha.getResponse(0)').';
			$.ajax({
				type: "POST",
				url: "system/ajax.php",
				data: {a: "login", token: token, username: username, password: password, remember: remember, recaptcha: response},
				dataType: "json",
				success: function(data) {
					if(data.status == 0){
						'.(empty($config['recaptcha_pub']) ? '' : 'grecaptcha.reset(0);').'
						$("#loginStatus").html(data.msg).fadeIn("slow");
					}else{
						$("#loginStatus").html(data.msg).fadeIn("slow");
						window.setTimeout(function() {
							document.location.href = "'.$config['secure_url'].'";
						}, 750);
					}
				}
			});
		}
	});';
	
	if(!$recover_key)
	{
		$js_code .= '$("#recoverPass").on("submit", function(e) {
				e.preventDefault();
				$("#recoverStatus").html(\'<div class="alert alert-info" role="alert">Please wait...</div>\');
				var token = $("#recoverToken").val();
				var email = $("#recoverEmail").val();
				if(email == "") {
					$("#recoverStatus").html(\'<div class="alert alert-danger" role="alert">Please complete your email address!</div>\');
				} else {
					var response = '.(empty($config['recaptcha_pub']) ? 'null' : 'grecaptcha.getResponse(1)').';
					$.ajax({
						type: "POST",
						url: "system/ajax.php",
						data: {a: "recover", token: token, email: email, recaptcha: response},
						dataType: "json",
						success: function(data) {
							$("#recoverStatus").html(data.msg).fadeIn("slow");
						}
					});
				}
			});';
	}
	else
	{
		$js_code .= '$("#changePass").on("submit", function(e) {
				e.preventDefault();
				$("#recoverStatus").html(\'<div class="alert alert-info" role="alert">Please wait...</div>\');
				var token = $("#changePassToken").val();
				var pass1 = $("#newPassword").val();
				var pass2 = $("#confirmPassword").val();
				if(pass1 == "" || pass1.length < 8) {
					$("#recoverStatus").html(\'<div class="alert alert-danger" role="alert">Your password must contain at least 8 characters, 1 lowercase letter, 1 capital letter and 1 number!</div>\');
				} else if(pass1 != pass2) {
					$("#recoverStatus").html(\'<div class="alert alert-danger" role="alert">Your password confirmation is wrong!</div>\');
				} else {
					var response = '.(empty($config['recaptcha_pub']) ? 'null' : 'grecaptcha.getResponse(1)').';
					$.ajax({
						type: "POST",
						url: "system/ajax.php",
						data: {a: "changePass", token: token, pass1: pass1, pass2: pass2, hash_key: "'.$getKey.'", recaptcha: response},
						dataType: "json",
						success: function(data) {
							if(data.status == 200) {
								$("#loginStatus").html(data.msg).fadeIn("slow");
								$("#recoverModal").modal("hide");
							} else {
								$("#recoverStatus").html(data.msg).fadeIn("slow");
							}
						}
					});
				}
			});';
	}
	
	$js_code .= ($recover_key ? '$(document).ready(function() {$("#recoverModal").modal("show");});' : '');

	if(!empty($js_code))
	{
		$packer = new JavaScriptPacker($js_code, 'Normal', true, false);
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
</body>
</html>