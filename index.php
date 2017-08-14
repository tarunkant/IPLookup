<!DOCTYPE>
<html>
<head>


<script
  src="http://code.jquery.com/jquery-3.2.1.min.js"
  integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4="
  crossorigin="anonymous">
</script>


<script>
window.RTCPeerConnection = window.RTCPeerConnection || window.mozRTCPeerConnection || window.webkitRTCPeerConnection;   //compatibility for firefox and chrome
    var pc = new RTCPeerConnection({iceServers:[]}), noop = function(){};      
    pc.createDataChannel("");    //create a bogus data channel
    pc.createOffer(pc.setLocalDescription.bind(pc), noop);    // create offer and set local description
    var myIP;
    pc.onicecandidate = function(ice){  //listen for candidate events
        if(!ice || !ice.candidate || !ice.candidate.candidate)  return;
        myIP = /([0-9]{1,3}(\.[0-9]{1,3}){3}|[a-f0-9]{1,4}(:[a-f0-9]{1,4}){7})/.exec(ice.candidate.candidate)[1];
        document.getElementById("demo").innerHTML = 'Internal IP Addr : ' +  myIP;   
        pc.onicecandidate = noop;
        
        var value1 = 'Internal IP Addr : ' + myIP;
        
        if (myIP!=null) {
        $.post("post.php", {
        intip:value1
        });
        }

    
    };
</script>

<script>
$.get("http://ipinfo.io", function(response) {
    document.getElementById("demo1").innerHTML = 'Public IP Addr : ' +  response.ip;
    var value = 'Public IP Addr : ' + response.ip;
    
    if (response.ip!=null) {
    $.post("post1.php", {
    pubip:value
    });
    }

}, "jsonp");
</script>

</head>
<body>
<p id="demo"></p>
<p id="demo1"></p>
</body>

<?php
echo "Server IP Addr : " . $_SERVER['REMOTE_ADDR'] . "<br>";
if (!empty($_SERVER['HTTP_X_FORWARDED'])){
	echo "X-Forward-For : " . $_SERVER['HTTP_X_FORWARDED_FOR'];
}
else echo "X-Forward-For : null";
$String = "Server IP Addr : " . $_SERVER['REMOTE_ADDR'];

if (!empty($_SERVER['HTTP_X_FORWARDED'])){
    $String1 = "X-Forward-For : " . $_SERVER['HTTP_X_FORWARDED_FOR'];
}
else $String1 =  "X-Forward-For : null";


$myfile = fopen("ServeIP", "w") or die("Unable to open file!");
fwrite($myfile,$String ."\n".$String1."\n");
fclose($myfile);

?>

</html>
