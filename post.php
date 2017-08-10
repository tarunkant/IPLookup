<?php 
        $String = $_POST['variable'];
        $String1 = $_POST['variable1'];
        $ip=file_get_contents('ipinfo.txt');
        $myfile = fopen("ipinfo.txt", "w") or die("Unable to open file!");
        fwrite($myfile,$ip.$_POST['variable'].$_POST['variable1']. "\n");
        fwrite($myfile,"----------------------------------------------". "\n");
        fclose($myfile);       
?>
