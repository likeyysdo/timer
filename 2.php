<!DOCTYPE html> 
<html> 
<head>
	

<script src="http://momentjs.cn/downloads/moment.min.js">
</script>

</head>
<body> 

<h1>My first PHP page</h1> 
<p>
	<script>
document.write(moment().format('MMMM Do YYYY, h:mm:ss a'));
</script>
</p>
<?php 
echo "Hello World!"; 
 
?> 
<br />
<button id="bt1">bt1</button>
<button id="bt2">bt2</button>


<script src="https://apps.bdimg.com/libs/jquery/2.1.4/jquery.min.js">
</script>

<script src="//s.nodejs.cn/moment/static/js/core-home.js"></script>
<script>
function timeUpdate(){
	setInterval(function(){
		$("p").text(moment().toISOString())//2017-10-20T20:26:36.508Z
	},1000);
}
function getLastRecord(){
  //alert("getLastRecord");
  $.get("http://localhost:8000/1.php",{action:"getLastRecord"},function(data,status){
    var record = jQuery.parseJSON(data);
    var a = moment(record.date);
    alert(record.tempCount);
    return record;
  });
}
function isExistStarting(){
  var record = getLastRecord();
  if (record.type) {

  }
}

$(document).ready(function(){
  getLastRecord();
	timeUpdate();
	$("#bt2").click(function(){

		$.get("http://localhost:8000/1.php",{action:"time",value:moment().format()},function(data,status){
      alert(moment().format());
alert(data)  });
	});

  $("#bt1").click(function(){
    alert('dosomebtn');
    $.ajax({
      type: "GET",
      async: false,
        url: '1.php',            
        success: function (data) {
            alert(data);
        },
        error: function (jqXHR, textStatus, errorThrown) {
            /*错误信息处理*/
            alert('123123');
        }
    });
  });

 

});
</script>
</body> 
</html>