<?php
	if(! defined('BASEPATH') ){ exit('Unable to view file.'); }
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title><?php echo $config['site_name']; ?></title>
	<meta name="author" content="NGB Solutions (c) ScriptStore.xyz">
	<meta content="<?php echo $config['site_description']; ?>" name="description">
	<meta content="<?php echo $config['site_keywords']; ?>" name="keywords">
	<base href="<?php echo $config['secure_url']; ?>">
    <link href="https://fonts.googleapis.com/css?family=Raleway:100,300,400,500,700,900" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="assets/landing/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="assets/landing/css/font-awesome.css">
    <link rel="stylesheet" href="assets/landing/css/style.css">
  </head>
  <body>
    <header class="header-area header-sticky">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <nav class="main-nav">
                        <a href="<?php echo $config['secure_url']; ?>" class="logo">
                            <img src="assets/landing/images/logo.png" alt="<?php echo $config['site_logo']; ?>"/>
                        </a>
                        <ul class="nav">
                            <li><a href="<?php echo GenerateURL('login'); ?>">Login</a></li>
                            <li><a href="<?php echo GenerateURL('register'); ?>" class="sign_up text-light"><b>Register</b></a></li>
                        </ul>
                        <a class="menu-trigger">
                            <span>Menu</span>
                        </a>
                    </nav>
                </div>
            </div>
        </div>
    </header>
    <div class="welcome-area" id="welcome">
        <div class="header-text">
            <div class="container">
                <div class="row">
                    <div class="offset-xl-3 col-xl-6 offset-lg-2 col-lg-8 col-md-12 col-sm-12">
                        <h1>Complete Offers &amp; <strong>Earn Money</strong></h1>
                        <p><?php echo $config['site_logo']; ?> is a very easy way to earn some quick Cash by completing free offers.</p>
                        <a href="<?php echo GenerateURL('register'); ?>" class="main-button-slider">Join now, it's FREE</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <section class="section home-feature">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="row">
                        <div class="col-lg-4 col-md-6 col-sm-6 col-12" data-scroll-reveal="enter bottom move 50px over 0.6s after 0.2s">
                            <div class="features-small-item">
                                <div class="icon">
                                    <i class="fa fa-user-plus fa-3x"></i>
                                </div>
                                <h5 class="features-title">Register for FREE</h5>
                                <p>It takes less than a minute to create your account.</p>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-6 col-sm-6 col-12" data-scroll-reveal="enter bottom move 50px over 0.6s after 0.4s">
                            <div class="features-small-item">
                                <div class="icon">
                                    <i class="fa fa-check-circle fa-3x"></i>
                                </div>
                                <h5 class="features-title">Earn Coins</h5>
                                <p>Earn coins by completing different tasks like Offers &amp; Surveys.</p>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-6 col-sm-6 col-12" data-scroll-reveal="enter bottom move 50px over 0.6s after 0.6s">
                            <div class="features-small-item">
                                <div class="icon">
                                    <i class="fa fa-credit-card fa-3x"></i>
                                </div>
                                <h5 class="features-title">Withdraw Money</h5>
                                <p>Transform your free coins into real money sent directly to your account.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="section padding-top-70 padding-bottom-0" id="features">
        <div class="container">
            <div class="row">
                <div class="col-lg-5 col-md-12 col-sm-12 align-self-center" data-scroll-reveal="enter left move 30px over 0.6s after 0.4s">
                    <img src="assets/landing/images/earn.svg" class="rounded img-fluid d-block mx-auto" alt="App">
                </div>
                <div class="col-lg-1"></div>
                <div class="col-lg-6 col-md-12 col-sm-12 align-self-center mobile-top-fix">
                    <div class="left-heading">
                        <h2 class="section-title">Earn FREE Cash</h2>
                    </div>
                    <div class="left-text">
                        <p>Easy as 1, 2, 3, our platform gives you the chance to earn some quick cash by doing extremely simple tasks like completing some offers and surveys.</p>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="hr"></div>
                </div>
            </div>
        </div>
    </section>
    <section class="section padding-bottom-100">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-md-12 col-sm-12 align-self-center mobile-bottom-fix">
                    <div class="left-heading">
                        <h2 class="section-title">How do I get paid?</h2>
                    </div>
                    <div class="left-text">
						<?php
							$methods = $db->QueryFetchArrayAll("SELECT * FROM `withdraw_methods` ORDER BY `minimum` ASC");
							
							$gateways = '';
							
							foreach($methods as $method)
							{
								$gateways .= '<li><b>'.$method['method'].'</b>: $'.$method['minimum'].' minimum withdrawal</li>';
							}
						?>
                        <p>You can withdraw your earnings in the following ways:</p>
						<ul><?php echo $gateways; ?></ul>
                    </div>
                </div>
                <div class="col-lg-1"></div>
                <div class="col-lg-5 col-md-12 col-sm-12 align-self-center mobile-bottom-fix-big" data-scroll-reveal="enter right move 30px over 0.6s after 0.4s">
                    <img src="assets/landing/images/main.svg" class="rounded img-fluid d-block mx-auto" alt="App">
                </div>
            </div>
        </div>
    </section>
	<?php
		$stats = array();
		$stats['users'] = $db->QueryFetchArray("SELECT COUNT(`id`) AS `total` FROM `users`");
		$stats['offers'] = $db->QueryFetchArray("SELECT COUNT(`id`) AS `total` FROM `completed_offers`");
		$stats['rewards'] = $db->QueryFetchArray("SELECT SUM(`amount`) AS `total` FROM `withdrawals` WHERE `status`='1'");
	?>
    <section class="counter">
        <div class="content">
            <div class="container">
                <div class="row">
                    <div class="col-lg-4 col-md-6 col-sm-12">
                        <div class="count-item decoration-bottom">
                            <strong><?php echo number_format($stats['users']['total']); ?></strong>
                            <span>Members</span>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6 col-sm-12">
                        <div class="count-item decoration-top">
                            <strong><?php echo number_format($stats['offers']['total']); ?></strong>
                            <span>Completed Offers</span>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6 col-sm-12">
                        <div class="count-item">
                            <strong><?php echo number_format($stats['rewards']['total'], 2); ?></strong>
                            <span>USD Paid Out</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="section colored" id="contact-us">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="center-heading">
                        <h2 class="section-title">Talk To Us</h2>
                    </div>
                </div>
                <div class="offset-lg-3 col-lg-6">
                    <div class="center-text">
                        <p>Do you have any questions or concerns? Please let us know!</p>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-4 col-md-6 col-sm-12">
                    <h5 class="margin-bottom-30">Keep in touch</h5>
                    <div class="contact-text">
                        <p>Drop us a message and our team will respond to you as soon as possible.</p>
                    </div>
                </div>
                <div class="col-lg-8 col-md-6 col-sm-12">
                    <div class="contact-form">
                        <form id="contact" onsubmit="contactAjax(); return false">
						  <div id="contactStatus"></div>
						  <input type="hidden" id="contactToken" value="<?php echo $token; ?>" />
                          <div class="row">
                            <div class="col-lg-6 col-md-12 col-sm-12">
                              <fieldset>
                                <input name="name" type="text" class="form-control" id="contactName" placeholder="Full Name" required="">
                              </fieldset>
                            </div>
                            <div class="col-lg-6 col-md-12 col-sm-12">
                              <fieldset>
                                <input name="email" type="email" class="form-control" id="contactEmail" placeholder="E-Mail Address" required="">
                              </fieldset>
                            </div>
                            <div class="col-lg-12">
                              <fieldset>
                                <textarea name="message" rows="6" class="form-control" id="contactMessage" placeholder="Your Message" required=""></textarea>
                              </fieldset>
                            </div>
                            <div class="col-lg-12">
                              <fieldset>
                                <button type="submit" id="form-submit" class="main-button">Send Message</button>
                              </fieldset>
                            </div>
                          </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <footer>
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12">
                    <ul class="social">
                        <li><a href="#"><i class="fa fa-facebook"></i></a></li>
                        <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                    </ul>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <?=eval(base64_decode('ZWNobyAoZW1wdHkoJENPTkZbJ2RwYiddKSB8fCAkQ09ORlsnZHBiJ10gIT0gMSA/ICc8cCBjbGFzcz0iY29weXJpZ2h0Ij5BbGwgcmlnaHRzIHJlc2VydmVkICZjb3B5OyAnLmRhdGUoJ1knKS4nICcuJGNvbmZpZ1snc2l0ZV9sb2dvJ10uJyA8YnIgLz5Qb3dlcmVkIGJ5IDxhIGhyZWY9Imh0dHBzOi8vcGFpZG9mZmVycy5uZXQvIiB0YXJnZXQ9Il9ibGFuayIgc3R5bGU9ImNvbG9yOiMwMDAiPlBhaWRPZmZlcnMubmV0PC9hPjwvcD4nIDogJzxwIGNsYXNzPSJjb3B5cmlnaHQiPkFsbCByaWdodHMgcmVzZXJ2ZWQgJmNvcHk7ICcuZGF0ZSgnWScpLicgJy4kY29uZmlnWydzaXRlX2xvZ28nXS4nPC9wPicpOw=='))?>
                </div>
            </div>
        </div>
    </footer>
    <script src="assets/landing/js/jquery-2.1.0.min.js"></script>
    <script src="assets/landing/js/popper.js"></script>
    <script src="assets/landing/js/bootstrap.min.js"></script>
    <script src="assets/landing/js/scrollreveal.min.js"></script>
    <script src="assets/landing/js/waypoints.min.js"></script>
    <script src="assets/landing/js/jquery.counterup.min.js"></script>
    <script src="assets/landing/js/imgfix.min.js"></script> 
    <script src="assets/landing/js/custom.js"></script>
	<script>
		function contactAjax(){$("#contactStatus").html('<div class="alert alert-info" role="alert">Please wait...</div>');var a=$("#contactToken").val(),t=$("#contactName").val(),e=$("#contactEmail").val(),l=$("#contactMessage").val();""==t?$("#contactStatus").html('<div class="alert alert-danger" role="alert">Please complete your full name!</div>'):""!=e&&validateEmail(e)?""==l||l.length<8?$("#contactStatus").html('<div class="alert alert-danger" role="alert">Please complete your message!</div>'):$.ajax({type:"POST",url:"system/ajax.php",data:{a:"contact",token:a,name:t,email:e,message:l},dataType:"json",success:function(a){$("#contactStatus").html(a.msg).fadeIn("slow"),$("#contactName").val(""),$("#contactEmail").val(""),$("#contactMessage").val("")}}):$("#contactStatus").html('<div class="alert alert-danger" role="alert">Please complete your email address!</div>')}function validateEmail(a){return/^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/.test(String(a).toLowerCase())}$(document).on("click","[data-click=scroll-to-target]",function(a){a.preventDefault();var t=!t&&$(this).attr("href")?$(this).attr("href"):t;$("html, body").animate({scrollTop:$(t).offset().top-50},500)});
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
	<!-- PaidOffers Lite v<?php echo $config['version']; ?> - Developed by www.ScriptStore.xyz -->
  </body>
</html>