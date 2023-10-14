<?php
	if(! defined('BASEPATH') ){ exit('Unable to view file.'); }
?>
  <aside id="sidebar" class="sidebar">
    <ul class="sidebar-nav" id="sidebar-nav">
	 <?php
		if($is_online)
		{
	 ?>
      <li class="nav-item">
        <a class="nav-link<?php echo (!isset($_GET['page']) ? '' : ' collapsed'); ?>" href="<?php echo $config['secure_url']; ?>">
          <i class="bi bi-grid"></i>
          <span>Dashboard</span>
        </a>
      </li>
	 <?php
		}
		else
		{
	 ?>
      <li class="nav-item">
        <a class="nav-link<?php echo (!isset($_GET['page']) ? '' : ' collapsed'); ?>" href="<?php echo GenerateURL('login'); ?>">
          <i class="bi bi-person-check"></i>
          <span>Login</span>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link<?php echo (!isset($_GET['page']) ? '' : ' collapsed'); ?>" href="<?php echo GenerateURL('register'); ?>">
          <i class="bi bi-person-plus-fill"></i>
          <span>Register</span>
        </a>
      </li>
	 <?php
		}
		
		if($is_online)
		{
	 ?>
      <li class="nav-heading">Earn</li>
      <li class="nav-item">
        <a class="nav-link<?php echo (isset($_GET['page']) && $_GET['page'] == 'offers' ? '' : ' collapsed'); ?>" href="<?=GenerateURL('offers')?>">
          <i class="bi bi-x-diamond-fill"></i>
          <span>Earn Coins</span>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link<?php echo (isset($_GET['page']) && in_array($_GET['page'], array('completed', 'rejected', 'canceled')) ? '' : ' collapsed'); ?>" data-bs-target="#trans-nav" data-bs-toggle="collapse" href="#">
          <i class="bx bx-list-ul"></i><span>Transactions</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="trans-nav" class="nav-content collapse<?php echo (isset($_GET['page']) && in_array($_GET['page'], array('completed', 'rejected', 'canceled')) ? ' show' : ''); ?>" data-bs-parent="#sidebar-nav">
          <li>
            <a href="<?php echo GenerateURL('completed'); ?>"<?php echo (isset($_GET['page']) && $_GET['page'] == 'completed' ? ' class="active"' : ''); ?>>
              <i class="bi bi-circle"></i><span>Complete</span>
            </a>
          </li>
          <li>
            <a href="<?php echo GenerateURL('rejected'); ?>"<?php echo (isset($_GET['page']) && $_GET['page'] == 'rejected' ? ' class="active"' : ''); ?>>
              <i class="bi bi-circle"></i><span>Rejected</span>
            </a>
          </li>
          <li>
            <a href="<?php echo GenerateURL('canceled'); ?>"<?php echo (isset($_GET['page']) && $_GET['page'] == 'canceled' ? ' class="active"' : ''); ?>>
              <i class="bi bi-circle"></i><span>Canceled</span>
            </a>
          </li>
        </ul>
      </li>
      <li class="nav-item">
        <a class="nav-link<?php echo (isset($_GET['page']) && $_GET['page'] == 'withdraw' ? '' : ' collapsed'); ?>" href="<?=GenerateURL('withdraw')?>">
          <i class="bi bi-credit-card-fill"></i>
          <span>Withdraw</span>
        </a>
      </li>
	 <?php
		}
	 ?>
      <li class="nav-heading">Help</li>
      <li class="nav-item">
        <a class="nav-link<?php echo (isset($_GET['page']) && in_array($_GET['page'], array('tos', 'privacy')) ? '' : ' collapsed'); ?>" data-bs-target="#info-nav" data-bs-toggle="collapse" href="#">
          <i class="bi bi-question-circle"></i><span>Info</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="info-nav" class="nav-content collapse<?php echo (isset($_GET['page']) && in_array($_GET['page'], array('tos', 'privacy')) ? ' show' : ''); ?>" data-bs-parent="#sidebar-nav">
          <li>
            <a href="<?php echo GenerateURL('tos'); ?>"<?php echo (isset($_GET['page']) && $_GET['page'] == 'tos' ? ' class="active"' : ''); ?>>
              <i class="bi bi-circle"></i><span>Terms of Service</span>
            </a>
          </li>
          <li>
            <a href="<?php echo GenerateURL('privacy'); ?>"<?php echo (isset($_GET['page']) && $_GET['page'] == 'privacy' ? ' class="active"' : ''); ?>>
              <i class="bi bi-circle"></i><span>Privacy Policy</span>
            </a>
          </li>
        </ul>
      </li>
      <li class="nav-item">
        <a class="nav-link<?php echo (isset($_GET['page']) && $_GET['page'] == 'contact' ? '' : ' collapsed'); ?>" href="<?=GenerateURL('contact')?>">
          <i class="bi bi-envelope"></i>
          <span>Contact Us</span>
        </a>
      </li>
    </ul>
  </aside>