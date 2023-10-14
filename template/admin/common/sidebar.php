<?php
	if(! defined('BASEPATH') ){ exit('Unable to view file.'); }
	
	$pendingJobs = $db->QueryFetchArray("SELECT `id` FROM `jobs_done` WHERE `status`='0' LIMIT 1");
	$pendingPay = $db->QueryFetchArray("SELECT `id` FROM `withdrawals` WHERE `status`='0' LIMIT 1");
	
	$job_alert = '';
	if(!empty($pendingJobs['id']))
	{
		$job_alert = ' <i class="bi bi-exclamation-triangle-fill text-warning"></i>';
	}
	
	$pay_alert = '';
	if(!empty($pendingPay['id']))
	{
		$pay_alert = ' <i class="bi bi-exclamation-triangle-fill text-warning"></i>';
	}
?>
  <aside id="sidebar" class="sidebar">
    <ul class="sidebar-nav" id="sidebar-nav">
      <li class="nav-item">
        <a class="nav-link<?php echo (!isset($_GET['page']) ? '' : ' collapsed'); ?>" href="<?php echo GenerateURL('dashboard', false, true); ?>">
          <i class="bi bi-grid"></i>
          <span>Dashboard</span>
        </a>
      </li>
      <li class="nav-heading">Users</li>
      <li class="nav-item">
        <a class="nav-link<?php echo (isset($_GET['page']) && in_array($_GET['page'], array('users', 'affiliates')) ? '' : ' collapsed'); ?>" data-bs-target="#earn-nav" data-bs-toggle="collapse" href="#">
          <i class="bi bi-x-diamond-fill"></i><span>Users</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="earn-nav" class="nav-content collapse<?php echo (isset($_GET['page']) && in_array($_GET['page'], array('users', 'affiliates')) ? ' show' : ''); ?>" data-bs-parent="#sidebar-nav">
          <li>
            <a href="<?php echo GenerateURL('users', false, true); ?>"<?php echo (isset($_GET['page']) && $_GET['page'] == 'users' && !isset($_GET['y']) ? ' class="active"' : ''); ?>>
              <i class="bi bi-circle"></i><span>All users</span>
            </a>
          </li>
          <li>
            <a href="<?php echo GenerateURL('users&y=today', false, true); ?>"<?php echo (isset($_GET['page']) && $_GET['page'] == 'users' && isset($_GET['y']) ? ' class="active"' : ''); ?>>
              <i class="bi bi-circle"></i><span>Registered Today</span>
            </a>
          </li>
        </ul>
      </li>
      <li class="nav-item">
        <a class="nav-link<?php echo (isset($_GET['page']) && in_array($_GET['page'], array('completed', 'rejected', 'canceled')) ? '' : ' collapsed'); ?>" data-bs-target="#trans-nav" data-bs-toggle="collapse" href="#">
          <i class="bx bx-list-ul"></i><span>Transactions</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="trans-nav" class="nav-content collapse<?php echo (isset($_GET['page']) && in_array($_GET['page'], array('completed', 'rejected', 'canceled')) ? ' show' : ''); ?>" data-bs-parent="#sidebar-nav">
          <li>
            <a href="<?php echo GenerateURL('completed', false, true); ?>"<?php echo (isset($_GET['page']) && $_GET['page'] == 'completed' ? ' class="active"' : ''); ?>>
              <i class="bi bi-circle"></i><span>Complete</span>
            </a>
          </li>
          <li>
            <a href="<?php echo GenerateURL('rejected', false, true); ?>"<?php echo (isset($_GET['page']) && $_GET['page'] == 'rejected' ? ' class="active"' : ''); ?>>
              <i class="bi bi-circle"></i><span>Rejected</span>
            </a>
          </li>
          <li>
            <a href="<?php echo GenerateURL('canceled', false, true); ?>"<?php echo (isset($_GET['page']) && $_GET['page'] == 'canceled' ? ' class="active"' : ''); ?>>
              <i class="bi bi-circle"></i><span>Canceled</span>
            </a>
          </li>
        </ul>
      </li>
      <li class="nav-item">
        <a class="nav-link<?php echo (isset($_GET['page']) && in_array($_GET['page'], array('withdrawals', 'pendingwithdrawals')) ? '' : ' collapsed'); ?>" data-bs-target="#rewards-nav" data-bs-toggle="collapse" href="#">
          <i class="bi bi-credit-card-fill"></i><span>Withdrawals<?php echo $pay_alert; ?></span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="rewards-nav" class="nav-content collapse<?php echo (isset($_GET['page']) && in_array($_GET['page'], array('withdrawals', 'pendingwithdrawals')) ? ' show' : ''); ?>" data-bs-parent="#sidebar-nav">
          <li>
            <a href="<?php echo GenerateURL('withdrawals', false, true); ?>"<?php echo (isset($_GET['page']) && $_GET['page'] == 'withdrawals' ? ' class="active"' : ''); ?>>
              <i class="bi bi-circle"></i><span>Complete</span>
            </a>
          </li>
          <li>
            <a href="<?php echo GenerateURL('pendingwithdrawals', false, true); ?>"<?php echo (isset($_GET['page']) && $_GET['page'] == 'pendingwithdrawals' ? ' class="active"' : ''); ?>>
              <i class="bi bi-circle"></i><span>Pending</span>
            </a>
          </li>
        </ul>
      </li>
      <li class="nav-heading">Settings</li>
      <li class="nav-item">
        <a class="nav-link<?php echo (isset($_GET['page']) && $_GET['page'] == 'settings' ? '' : ' collapsed'); ?>" href="<?=GenerateURL('settings', false, true)?>">
          <i class="bi bi-gear-fill"></i>
          <span>Website Settings</span>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link<?php echo (isset($_GET['page']) && $_GET['page'] == 'captcha' ? '' : ' collapsed'); ?>" href="<?=GenerateURL('captcha', false, true)?>">
          <i class="bi bi-gear-fill"></i>
          <span>Captcha Settings</span>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link<?php echo (isset($_GET['page']) && $_GET['page'] == 'offerwalls' ? '' : ' collapsed'); ?>" href="<?=GenerateURL('offerwalls', false, true)?>">
          <i class="bi bi-gear-fill"></i>
          <span>Notik Settings</span>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link<?php echo (isset($_GET['page']) && $_GET['page'] == 'payset' ? '' : ' collapsed'); ?>" href="<?=GenerateURL('payset', false, true)?>">
          <i class="bi bi-gear-fill"></i>
          <span>Withdrawal Settings</span>
        </a>
      </li>
    </ul>
	<div class="alert alert-secondary fade show mt-4">
	  <small>Script Version: <b><?php echo $config['version']; ?></b></small><br />
	  <small>Latest Version: <b><span id="latest_version"><div class="spinner-border spinner-border-sm" role="status"><span class="visually-hidden">Loading...</span></div></span></b></small>
	</div>
  </aside>