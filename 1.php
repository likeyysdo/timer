<?php
include 'sqlite.php';
date_default_timezone_set("Asia/Shanghai") ;
//echo '这是个从PHP文件中读取的数据。<br />';
//echo date("c");
$db = MyDB::getInstance();
$action = $_GET["action"];

switch ($action) {
	case 'getTotalCount':
		# code...
	echo $db->getTotalCount();
		break;
	case 'startRecord':
		# code...
	$lastRecord = $db->getLastRecord();
	if ($lastRecord['type'] == 0) {
		$dvalue = strtotime(date("c"))-strtotime($lastRecord['date']);
		$db->setTotalCount($db->getTotalCount()-$dvalue);
		$db->startRecord(date("c"));

	}
		break;
	case 'endRecord':
		# code...
	$lastRecord = $db->getLastRecord();
	if ($lastRecord['type'] == 1) {
	$dvalue = strtotime(date("c"))-strtotime($lastRecord['date']);
	$db->setTotalCount($db->getTotalCount()+$dvalue);
	$db->endRecord(date("c"));
	}
	break;
	
	case 'getLastRecord':
		# code...
	$lastRecord = $db->getLastRecord();
	if (is_null($lastRecord['num'])) {
		$tempDate = date("c");
		$db->startRecord($tempDate);
		$db->endRecord($tempDate);
		$lastRecord['type'] = 2;
		$lastRecord['count'] = $db->getTotalCount();
		echo json_encode($lastRecord);
		break;
	}
	$lastRecord['count'] = $db->getTotalCount();
	if ($lastRecord['type']) {
		$lastRecord['tempCount'] = $lastRecord['count']+strtotime(date("c"))-strtotime($lastRecord['date']);
	}else{
		$lastRecord['tempCount'] = $lastRecord['count']-(strtotime(date("c"))-strtotime($lastRecord['date']));
	}
	
	echo json_encode($lastRecord);
		break;
	case 'time':
			# code...
		$time = $_GET["value"];
		$datetime1 = new DateTime($time);
		$d1 = DateTime::createFromFormat($datetime1::ISO8601,$time);
		echo $d1->format($datetime1::ISO8601);

			break;
	default:
		# code...
		break;
	}
/*if ($p == 1) {
	# code...
	echo date("c");
	echo $_GET["name"];
}*/


function php1test(){
echo date("c");
echo "<br>------------------<br />";

$datetime1 = new DateTime(date("c"));
echo $datetime1::ISO8601;
echo $datetime1->format(“Y“);
echo "<br>------------------<br />";
$d1 = DateTime::createFromFormat($datetime1::ISO8601,date("c"));
echo $d1->format($datetime1::ISO8601),"<br>*******<br>";
//2017-05-12 14:25:00
$datetime2  = new DateTime("2017-10-21T16:41:46.932Z");
echo $datetime2->format($datetime2::ISO8601),"<br>*******<br>";

//获取$datetime2 - $datetime1的时间差
$timediff = $datetime1->diff($datetime2);
//echo $timediff;
$datetime_1 = mktime(14, 25, 0, 3, 31, 2017);
$now = mktime();
echo strtotime($d1->format($datetime1::ISO8601));
echo $now;


echo "<br>------------------<br />";
echo $d1->format($datetime1::ISO8601);
$d1 = DateTime::createFromFormat($datetime1::ISO8601,date("c"));
echo $stime = strtotime($datetime2->format($datetime1::ISO8601));
echo $now - $stime;
echo "<br>------------------<br />";

$d3 = DateTime::createFromFormat(DateTime::ISO8601,date("c"));
echo strtotime(date("c"));
}
//php1test();
//echo st