<?php
    session_start();
    $_SESSION = array();
    include 'functions.php';
    echo "<head>";
    echo "<title>FE SSL LABS TOOL</title>";
    echo "<link rel='stylesheet' type='text/css' href='css/bootstrap.min.css'>";
    echo "<link rel='stylesheet' type='text/css' href='css/font-awesome.min.css'>";
    echo "<link rel='stylesheet' type='text/css' href='css/menu.css'>";
    echo "<link rel='stylesheet' type='text/css' href='css/main.css'>";
    echo "<link rel='stylesheet' type='text/css' href='css/rating.css'>";
    echo "</head>";

    echo "<body>";
    echo "<div class='title'><center><H2>FE SSL LABS TOOL</H2></center></div>";
    echo "<div class='icon-bar'>";
    echo "<a class='active' href='index.php'><i class='fa fa-home'></i></a>";
    echo "</div>";
$count = 0;
$path = 'summary.php?site=';
$dir = ('/data/sslscan/scans');
echo "<div class='centerm'>";
echo "<div class='tableI'>";
echo "<table>";
echo "<tr>";
echo "<th>Site name</th>";
echo "<th>Latest Rating</th>";
echo "<th>Previous Rating</th>";
echo "<th>Entry Point / VIP</th>";
#echo "<th>Previous Scan Time</th>";
echo "</tr>";
if ($handle = opendir('/data/sslscan/scans')) {
    while (false !== ($file = readdir($handle))) {
        if ($file != "." && $file != "..") {$count++;
	    echo "<tr>";
            echo("<td><a href=\"$path".$file."\">".$file."</a></td>");


		$file2checkL = file_get_contents("$dir/$file/latest.json");
		$attr2checkL = json_decode($file2checkL, true);
		$attr2checkL = $attr2checkL[0];

	    
                foreach ($attr2checkL['endpoints'][0] as $field => $value) {

					if ( $field == 'grade') {

                        if ( $value == 'A-' ||  $value == 'A'  ||  $value == 'A+' )  {
                                echo "<td><div class='rating_gs'><p>$value</p></div></td>";
                        }
                        if ( $value == 'B-' ||  $value == 'B'  ||  $value == 'B+' || $value == 'C-' ||  $value == 'C'  ||  $value == 'C+')  {
                                echo "<td><div class='rating_as'><p>$value</p></div></td>";
                        }
                        if ( $value == 'F' ||  $value == 'T' ) {
                                echo "<td><div class='rating_rs'><p>$value</p></div></td>";
                        }
			}
		}	
		
		$file2checkO = file_get_contents("$dir/$file/previous.json");
		$attr2checkO = json_decode($file2checkO, true);
		$attr2checkO = $attr2checkO[0];

	

                foreach ($attr2checkO['endpoints'][0] as $field => $value) {

					if ( $field == 'grade') {

                        if ( $value == 'A-' ||  $value == 'A'  ||  $value == 'A+' )  {
                                echo "<td><div class='rating_gs'><p>$value</p></div></td>";
                        }
                        if ( $value == 'B-' ||  $value == 'B'  ||  $value == 'B+' || $value == 'C-' ||  $value == 'C'  ||  $value == 'C+')  {
                                echo "<td><div class='rating_as'><p>$value</p></div></td>";
                        }
                        if ( $value == 'F' ||  $value == 'T' ) {
                                echo "<td><div class='rating_rs'><p>$value</p></div></td>";
                        }
			}	
					if ( $field == 'testTime') {
						$time=(gmdate('H:i:s', floor($value * 3600)));
						echo "<td><div class='field'><p>$time</p></div></td>";
					}
		}		
   
		
		foreach ($attr2checkL['endpoints'][0] as $field => $value) {

					if ( $field == 'ipAddress') {
					 echo "<td><div class='field'><p>$value</p></div></td>";
						}
		}
	    echo "</tr>";
        }
    }
echo "</table>";



echo '<br /><br /><a href="http://$IP/tools/">Return</a>';
	// change $IP with the ip adress or FQDN of your webserver
    closedir($handle);
} 
echo "</div>";
echo "</div>";
echo "</body>";









?>
