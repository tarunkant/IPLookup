<?php 
	/**
 	* @author Tarunkant Gupta
  	* @author Tarunkant Gupta <tarunkant05@gmail.com><tarun05blog.wordpress.com>
  	*/
        $String1 = $_POST['intip'];
        $myfile = fopen("intIP","w") or die("Unable to open file!");
        fwrite($myfile,$String1."\n");
        fclose($myfile);               
?>
