<?php
	if(! defined('BASEPATH') ){ exit('Unable to view file.'); }
	
	$new_activity = $db->QueryFetchArray("SELECT COUNT(*) AS `total` FROM `users_activities` WHERE `user_id`='".$data['id']."' AND `read`='0'");
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <title><?php echo (empty($page_title) ? $config['site_name'] : $page_title.' - '.$config['site_logo']); ?></title>
	<meta name="author" content="NGB Solutions (c) ScriptStore.xyz">
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
  <header id="header" class="header fixed-top d-flex align-items-center">
    <div class="d-flex align-items-center justify-content-between">
      <a href="<?php echo $config['secure_url']; ?>" class="logo d-flex align-items-center">
        <img src="assets/img/logo.png" alt="">
        <span class="d-none d-lg-block"><?php echo $config['site_logo']; ?></span>
      </a>
      <i class="bi bi-list toggle-sidebar-btn"></i>
    </div>
	<?php
		if($is_online)
		{
	?>
    <nav class="header-nav ms-auto">
      <ul class="d-flex align-items-center">
        <li class="nav-item dropdown">
          <a class="nav-link nav-icon" href="<?=GenerateURL('activities')?>">
            <i class="bi bi-bell"></i>
            <?php echo ($new_activity['total'] > 0 ? '<span class="badge bg-primary badge-number">'.number_format($new_activity['total']).'</span>' : ''); ?>
          </a>
        </li>
        <li class="nav-item dropdown pe-3">
          <a class="nav-link nav-profile d-flex align-items-center pe-0" href="#" data-bs-toggle="dropdown">
            <img src="https://www.gravatar.com/avatar/<?=md5(strtolower(trim($data['email'])))?>?s=40" alt="" class="rounded-circle">
            <span class="d-none d-md-block dropdown-toggle ps-2"><?php echo $data['username']; ?></span>
          </a>
          <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile">
            <li class="dropdown-header">
              <h6><?php echo $data['username']; ?></h6>
              <span>Account Balance: <?php echo number_format($data['account_balance'], 2); ?> Coins</span>
            </li>
            <li><hr class="dropdown-divider"></li>
            <li>
              <a class="dropdown-item d-flex align-items-center" href="<?=GenerateURL('account')?>">
                <i class="bi bi-gear"></i>
                <span>Account Settings</span>
              </a>
            </li>
            <li><hr class="dropdown-divider"></li>
            <li>
              <a class="dropdown-item d-flex align-items-center" href="<?=GenerateURL('contact')?>">
                <i class="bi bi-question-circle"></i>
                <span>Need Help?</span>
              </a>
            </li>
			<?php if($data['admin'] == 1) { ?>
            <li><hr class="dropdown-divider"></li>
            <li>
              <a class="dropdown-item d-flex align-items-center" href="<?=GenerateURL('dashboard', false, true)?>" target="_blank">
                <i class="bi bi-graph-up"></i>
                <span><b>Admin Panel</b></span>
              </a>
            </li>
			<?php } ?>
            <li><hr class="dropdown-divider"></li>
            <li>
              <a class="dropdown-item d-flex align-items-center" href="<?=$config['secure_url']?>/?logout">
                <i class="bi bi-box-arrow-right"></i>
                <span>Sign Out</span>
              </a>
            </li>
          </ul>
        </li>
      </ul>
    </nav>
	<?php } ?>
  </header>