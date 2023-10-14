<?php
	if(! defined('BASEPATH') ){ exit('Unable to view file.'); }
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
                    <h5 class="card-title text-center pb-0 fs-4">Create an Account</h5>
                    <p class="text-center small">Enter your personal details to create account</p>
                  </div>
                  <form class="row g-3 needs-validation" id="registrationForm" novalidate>
					<div id="registrationStatus"></div>
					<input type="hidden" id="regToken" value="<?php echo $token; ?>" />
                    <div class="col-12">
                      <label for="regLogin" class="form-label">Username</label>
                      <div class="input-group has-validation">
                        <span class="input-group-text" id="inputGroupPrepend">@</span>
                        <input type="text" class="form-control" id="regLogin" placeholder="John_Doe" required>
                        <div class="invalid-feedback">Please choose a username.</div>
                      </div>
                    </div>
                    <div class="col-12">
                      <label for="regEmail" class="form-label">Email Address</label>
                      <input type="email" class="form-control" id="regEmail" placeholder="email@domain.tld" required>
                      <div class="invalid-feedback">Please enter a valid Email adddress!</div>
                    </div>
                    <div class="col-12">
                      <label for="regGender" class="form-label">Gender</label>
					  <select class="form-control" id="regGender">
						<option value="0" disabled selected>-- Please Select --</option>
						<option value="1">Male</option>
						<option value="2">Female</option>
					  </select>
                      <div class="invalid-feedback">Please select your gender!</div>
                    </div>
                    <div class="col-12">
                      <label for="regPass" class="form-label">Password</label>
                      <input type="password" class="form-control" id="regPass" required>
                      <div class="invalid-feedback">Please enter your password!</div>
                    </div>
					<?php 
						if(!empty($config['recaptcha_pub'])){
							echo '<div class="g-recaptcha" data-sitekey="'.$config['recaptcha_pub'].'"></div>';
						}
					?>
                    <div class="col-12">
                      <div class="form-check">
                        <input class="form-check-input" type="checkbox" value="" id="tos" required>
                        <label class="form-check-label" for="tos">I agree and accept the <a href="<?php echo GenerateURL('tos'); ?>">terms and conditions</a></label>
                        <div class="invalid-feedback">You must agree before submitting.</div>
                      </div>
                    </div>
                    <div class="col-12">
                      <button class="btn btn-primary w-100" type="submit">Create Account</button>
                    </div>
                    <div class="col-12">
                      <p class="small mb-0">Already have an account? <a href="<?php echo GenerateURL('login'); ?>">Log in</a></p>
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
?>
  <script>
	$('#registrationForm').on('submit', function(e) {
		e.preventDefault();
		$("#registrationStatus").html('<div class="alert alert-info" role="alert">Please wait...</div>');
		var token = $('#regToken').val();
		var username = $('#regLogin').val();
		var password = $('#regPass').val();
		var email = $('#regEmail').val();
		var gender = $('#regGender').val();
		var tos = $('#tos').is(":checked");

		if(tos == false) {
			$("#registrationStatus").html('<div class="alert alert-danger" role="alert">Please read and agree our <a href="<?php echo GenerateURL('tos'); ?>" target="_blank">Terms & Conditions</a> before registration!</div>');
		} else if(username == '') {
			$("#registrationStatus").html('<div class="alert alert-danger" role="alert">Please complete your username!</div>');
		} else if(email == '') {
			$("#registrationStatus").html('<div class="alert alert-danger" role="alert">Please complete your password!</div>');
		} else if(password == '' || password.length < 8) {
			$("#registrationStatus").html('<div class="alert alert-danger" role="alert">Your password must contain at least 8 characters, 1 lowercase letter, 1 capital letter and 1 number!</div>');
		} else if(gender == 0) {
			$("#registrationStatus").html('<div class="alert alert-danger" role="alert">Please select your gender!</div>');
		} else if(token == '') {
			$("#registrationStatus").html('<div class="alert alert-danger" role="alert">Session expired, please refresh this page and try again!</div>');
		} else {
			var response = <?php echo (empty($config['recaptcha_pub']) ? 'null' : 'grecaptcha.getResponse()'); ?>;
			$.ajax({
				type: "POST",
				url: "system/ajax.php",
				data: {a: 'register', token: token, username: username, password: password, email: email, gender: gender, tos: tos, recaptcha: response},
				dataType: "json",
				success: function(data) {
					if(data.status == 0){
						<?php echo (empty($config['recaptcha_pub']) ? '' : 'grecaptcha.reset();'); ?>
						$("#registrationStatus").html(data.msg).fadeIn('slow');
					}else{
						$("#registrationStatus").html(data.msg).fadeIn('slow');
						window.setTimeout(function() {
							if(data.loggedin == 1) {
								document.location.href = '<?php echo $config['secure_url']; ?>';
							}
						}, 1000);
					}
				}
			});
		}
	});
  </script>
<?php
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