<?php
	if(! defined('BASEPATH') ){ exit('Unable to view file.'); }

	// Load Sidebar
	require(BASE_PATH.'/template/'.$config['theme'].'/common/sidebar.php');
	
	// Load offerwall settings
	$ow_config = array();
	$ow_configs = $db->QueryFetchArrayAll("SELECT `config_name`,`config_value` FROM `offerwall_config`");
	foreach ($ow_configs as $con)
	{
		$ow_config[$con['config_name']] = $con['config_value'];
	}
	unset($ow_configs);
?>
<main id="main" class="main">
<div class="pagetitle">
  <h1>Earn Coins</h1>
  <nav>
	<ol class="breadcrumb">
	  <li class="breadcrumb-item"><a href="/">Home</a></li>
	  <li class="breadcrumb-item">Earn Coins</li>
	</ol>
  </nav>
</div>
<section class="section">
  <div class="row">
	<div class="col-lg-12">
	  <div class="card">
		<div class="card-body p-2">
			<?php
				if(empty($ow_config['notik_api']) || empty($ow_config['notik_id']))
				{
					echo '<div class="alert alert-warning text-center mb-0" role="alert"><i class="bi bi-exclamation-triangle-fill"></i> Notik Offerwall is not yet configured.</div>';
				}
				else
				{
					echo '<iframe src="https://notik.me/coins?api_key='.$ow_config['notik_api'].'&pub_id='.$ow_config['notik_id'].'&user_id='.$data['id'].'" style="width:100%;height:800px;border:0;margin:0;border-radius:5px;"></iframe>';
				}
			?>
		</div>
	  </div>
	</div>
  </div>
</section>
</main>