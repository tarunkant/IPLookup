<?php 
        $String1 = $_POST['intip'];
        $myfile = fopen("intIP","w") or die("Unable to open file!");
        fwrite($myfile,$String1."\n");
        fclose($myfile);               

?>
