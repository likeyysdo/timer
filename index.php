<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" type="text/css">
  <link rel="stylesheet" href="2.css" type="text/css"> 

<script src="http://momentjs.cn/downloads/moment.min.js">
</script>

</head>
  

<body>
  
<!-- <nav class="navbar navbar-expand-md bg-primary navbar-dark">
    <div class="container">
      <a class="navbar-brand" href="#"><i class="fa d-inline fa-lg fa-cloud"></i><b>  Brand</b></a>
      <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbar2SupportedContent" aria-controls="navbar2SupportedContent" aria-expanded="false"
        aria-label="Toggle navigation"> <span class="navbar-toggler-icon"></span> </button>
      <div class="collapse navbar-collapse text-center justify-content-end" id="navbar2SupportedContent">
        <ul class="navbar-nav">
          <li class="nav-item">
            <a class="nav-link" href="#"><i class="fa d-inline fa-lg fa-bookmark-o"></i> Bookmarks</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#"><i class="fa d-inline fa-lg fa-envelope-o"></i> Contacts</a>
          </li>
        </ul>
        <a class="btn navbar-btn ml-2 text-white btn-secondary"><i class="fa d-inline fa-lg fa-user-circle-o"></i> Sign in</a>
      </div>
    </div>
  </nav>
-->
  <div class="py-5 text-center opaque-overlay" style="background-image: url(&quot;/cover_event.jpg&quot;);">
    <div class="container py-5">
      <div class="row">
        <div class="col-md-12 text-white">
          <h1 class="display-3 mb-4" id="title">Time is endless</h1>
          <h1 class="display-3 mb-4" id="titleMoney"><br></h1>
          <h4 class="display-5 mb-4" id="titleTime"><script>
document.write(moment().format('MMMM Do YYYY, H:mm:ss'));
</script></h4>
          <p class="lead mb-5" id="subTitle">
            <br /><br /></p>
          <a href="#" class="btn btn-lg mx-1 btn-secondary" id="freebtn">Seek for free</a>
          <a href="#" class="btn btn-lg btn-primary mx-1" id="dosomebtn">Dance with shackles</a>
        </div>
      </div>
    </div>
  </div>
  <!--
  <div class="py-5" style="background-image: url(&quot;https://pingendo.github.io/templates/sections/assets/form_red.jpg&quot;);">
    <div class="container">
      <div class="row">
        <div class="align-self-center col-md-6 text-white">
          <h1 class="text-center text-md-left display-3">Book a table</h1>
          <p class="lead">Why waiting if you can do it online?</p>
        </div>
        <div class="col-md-6" id="book">
          <div class="card">
            <div class="card-body p-5">
              <h3 class="pb-3">Make a reservation</h3>
              <form action="https://formspree.io/YOUREMAILHERE">
                <div class="form-group"> <label>Name</label>
                  <input class="form-control" placeholder="Your name, please"> </div>
                <div class="form-group"> <label>Time</label>
                  <input type="time" class="form-control"> </div>
                <div class="form-group"> <label>People</label>
                  <input type="number" class="form-control" placeholder="2"> </div>
                <button type="submit" class="btn mt-2 btn-outline-dark">Reserve</button>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
-->
  <script
  src="https://code.jquery.com/jquery-3.2.1.min.js"
  integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4="
  crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js" integrity="sha384-b/U6ypiBEHpOf/4+1nzFpr53nxSS+GLCkfwBdFNTxtclqqenISfwAzpKaMNFNmj4" crossorigin="anonymous"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/js/bootstrap.min.js" integrity="sha384-h0AbiXch4ZDo7tp9hKZ4TsHbi047NrKGLO3SEJAg45jXxnGIfYzk4Si90RDIqNm1" crossorigin="anonymous"></script>

<script>
function timeUpdate(){
  $("#titleMoney").text(count.toFixed(2));
  setInterval(function(){
    $("#titleTime").text(moment().format('MMMM Do YYYY, H:mm:ss'));

    if (isStart == 1) {
    count = count + 0.9512*3*3;
    $("#titleMoney").text(count.toFixed(2));
  }else if (isStart == 0){
    count = count - 0.9512*3; 
    $("#titleMoney").text(count.toFixed(2));
  }
  },300);

}
function getTotalCount(){
  
  $.get(url,{action:"getTotalCount"},function(data,status){
    //alert(data);
    count = Number(data) * 9.512;
    $("#titleMoney").text(count.toFixed(2));
  });
  //return count;
}
function startRecord(){
  getLastRecord();
   $.get(url,{action:"startRecord"},function(data,status){
    //alert(data);
    //count = Number(data);
    $("#titleMoney").text(count.toFixed(2));
    $("#subTitle").html("Start:"+moment(lastRecord.date).format('MMMM Do YYYY, H:mm:ss')+'<br />'+"End:"+moment(lastRecord.date).add(45,'m').format('MMMM Do YYYY, H:mm:ss'));
    isStart = 1;
  });
   
}
function endRecord(){
  isStart = 0;
  $.get(url,{action:"endRecord"},function(data,status){
    //alert(data);
    //count = Number(data);
    //$("#titleMoney").text(count.toFixed(2));
    getLastRecord();
  });
   
}

function getLastRecord(){
  //alert("getLastRecord");
  
  $.get(url,{action:"getLastRecord"},function(data,status){

  lastRecord = jQuery.parseJSON(data);
  if (lastRecord.type == "2") {
      $("#titleMoney").text(lastRecord.count.toFixed(2));
      return 0;
    }
  if (lastRecord.type == "1") {
    count = lastRecord.tempCount* 9.512;
    isStart = 1;
  }else{
  count = lastRecord.tempCount* 9.512;
  isStart = 0;
  } 
  });
}
$(document).ready(function(){
  isStart = 2;
  lastRecord = {};
  count = 0;
  url = window.location.pathname+"1.php";
  getLastRecord();
  timeUpdate();

  $("#freebtn").click(function(){
    endRecord();
    //$.get(url,{action:"getTotalCount"},function(data,status){
    //alert("数据: " + data + "\n状态: " + status);
  //});
  });

  $("#dosomebtn").click(function(){
    startRecord();
    
  });

});
</script>
</body>

</html>