<?php
define('BASEPATH', true);
require(realpath(dirname(__FILE__)).'/../init.php');

/* Define functions */
function write_cron($timestamp, $cron_name, $var_name){
	$filename = realpath(dirname(__FILE__)).'/times/'.$cron_name.'.php';
	$content = file_put_contents($filename, '<? $'.$var_name.'[\'time\'] = \''.$timestamp.'\'; ?>');

	$return = true;
	if(!$content){
		die('<center><b>System ERROR</b><br /><i>system/cron/times/'.$cron_name.'.php</i> must be writable (change permissions to 777)</center>');
		$return = false;
	}
	return $return;
}

/* Times */
$timestamp = time();
$daily_time = strtotime(date('j F Y'));

/* ---------------Starting Crons------------------ */
$realPath = realpath(dirname(__FILE__));
if(!is_writable($realPath.'/times')){
	die('<center><b>System ERROR</b><br /><i>system/cron/times/</i> directory must be writable (change permissions to 777)</center>');
}

/* Cron 5 minutes */
if(file_exists($realPath.'/times/5min_cron.php')){
	include($realPath.'/times/5min_cron.php');
}

if($cron_5min['time'] < ($timestamp-300)){
	$write = write_cron($timestamp, '5min_cron', 'cron_5min');
	if($write){
		$db->Query("DELETE FROM `wrong_logins` WHERE `time`<'".(time()-$config['login_wait_time'])."'");
	}
}
?>