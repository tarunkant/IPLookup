<?php 
		/**
 	 	* @author Tarunkant Gupta
  		* @author Tarunkant Gupta <tarunkant05@gmail.com><tarun05blog.wordpress.com>
  		*/
		$String1 = $_POST['pubip'];
		$String2 = substr($String1, 17);
        $ip1 = file_get_contents("ServeIP");
        $ip2 = file_get_contents("intIP");
        $myfile = fopen("ip/{$String2}","a+") or die("Unable to open file!");
        fwrite($myfile,$ip1.$ip2.$String1."\n");
        fwrite($myfile,"----------------------------------------------". "\n");
        fclose($myfile);               
?>
