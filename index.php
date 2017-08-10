<!DOCTYPE>
<html>
<head>

<!--<scrip src="node_modules/socks-client/index.js"></scrip>-->
<!--<script src="node_modules/getmac/es5/lib/getmac.js"></script>-->
<!--<script src="node_modules/getmac/src/lib/getmac.coffee"></script>-->
<script
  src="http://code.jquery.com/jquery-3.2.1.min.js"
  integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4="
  crossorigin="anonymous">
</script>
    

<script>
$.get("http://ipinfo.io", function(response) {
    document.getElementById("demo1").innerHTML = 'Public IP Addr : ' +  response.ip;
    var value = 'Public IP Addr : ' + response.ip;
    if (value!=null) {
    $.post("post.php", {
    variable:value
    });
    }

}, "jsonp");
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
        
        var value = 'Internal IP Addr : ' + myIP;
        if (value!=null) {
        $.post("post.php", {
        variable1:value
        });
    }
    };

    
//    require('getmac').getMac(function(err,macAddress){
//     if (err)  throw err
//     document.write(macAddress);
// });
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

$ip=file_get_contents('ipinfo.txt');
$myfile = fopen("ipinfo.txt", "w") or die("Unable to open file!");
fwrite($myfile,$ip.$String ."\n".$String1."\n");
fclose($myfile);
?>

</html>