<?php
/** Update database **/
$add_config = array();

// Update to 1.1.0
$db->Query("INSERT IGNORE INTO `offerwall_config` (`config_name`, `config_value`) VALUES ('notik_id', ''),('notik_api', ''),('notik_secret', '')");

// Remove files
if($db->Connect()){
	eval(base64_decode('QHVubGluayhyZWFscGF0aChkaXJuYW1lKF9fRklMRV9fKSkuJy9ydW5fdXBkYXRlLnBocCcpOw=='));
}
?>