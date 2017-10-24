<?php
include 'sqlite.php';
date_default_timezone_set("Asia/Shanghai") ;
//echo '这是个从PHP文件中读取的数据。<br />';
//echo date("c");
$db = MyDB::getInstance();
$lastRecord = $db->getLastRecord();
	if ($lastRecord['type'] == 0||$lastRecord['type'] == 2) {
		return ;
	}
$dvalue = strtotime(date("c"))-strtotime($lastRecord['date']);
if ($dvalue >= 2700) {	# code...
	$db->setTotalCount($db->getTotalCount()+$dvalue);
	$db->endRecord(date("c"));
}