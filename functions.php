<?php

session_start();
function includephp() {
	foreach (glob('/var/www/html/fessllabs/*.php') as $filename)

	{
	include $filename;
	}
}


function ReadUrl() {
	$Url = $_GET['site'];
	$file2check = file_get_contents("http://$IP/fessllabs/$Url");
	// change $IP with the ip adress or FQDN of your webserver
	$attr2check = json_decode($file2check, true);
}

function replace_key($find, $replace, $array) {
 $arr = array();
 foreach ($array as $key => $value) {
  if ($key == $find) {
   $arr[$replace] = $value;
  } else {
   $arr[$key] = $value;
  }
 }
 return $arr;
}

function SessionGet() {
$site = $_SESSION['site'];
$dirP = ('/data/sslscan/scans');
$file2check = file_get_contents("$dirP/$site/latest.json");
$attr2check = json_decode($file2check, true);
$attr2check = $attr2check[0];
}


function Tmenu() {
 echo "<div class='title'><center><H2>FE SSL LABS TOOL</H2></center></div>";
    echo "<div class='icon-bar'>";
            echo "<a class='active' href='index.php'><i class='fa fa-home'></i></a>";
            echo "<a href='summary.php'><i class='fa fa-address-card'></i></a>";
            echo "<a href='certs.php'><i class='fa fa-chain'></i></a>";
            echo "<a href='details.php'><i class='fa fa-cog'></i></a>";
            echo "<a href='prots.php'><i class='fa fa-user-secret'></i></a>";
            echo "<a href='sims.php'><i class='fa fa-handshake-o'></i></a>";
            echo "<a href='raw.php'><i class='fa fa-book'></i></a>";
    echo "</div>";

}

function Hgrade() {
$site = $_SESSION['site'];
$dirP = ('/data/sslscan/scans');
$file2check = file_get_contents("$dirP/$site/latest.json");
$attr2checkf = json_decode($file2check, true);
$attr2checkf = $attr2checkf[0];

        //print host in header of page
        foreach ($attr2checkf as $field => $value) {
                if ( $field == 'host' ) {
                        echo "<div class='host'><p>$value</p></div>";
                }
        }

        foreach ($attr2checkf['endpoints'][0] as $field => $value) {

                if ( $field == 'grade') {

                        if ( $value == 'A-' ||  $value == 'A'  ||  $value == 'A+' )  {
                                echo "<div class='rating_g'><p>$value</p></div>";
                        }
                        if ( $value == 'B-' ||  $value == 'B'  ||  $value == 'B+' || $value == 'C-' ||  $value == 'C'  ||  $value == 'C+')  {
                                echo "<div class='rating_a'><p>$value</p></div>";
                        }
                        if ( $value == 'F' ||  $value == 'T' ) {
                                echo "<div class='rating_r'><p>$value</p></div>";
                        }
                }

        }
	
	foreach ($attr2checkf['endpoints'][0] as $field => $value) {

		 if ( $field == 'hasWarnings') {

	                                        if ( $value =='1' ) {
                                                        echo "<div class='warningBox'>";
                                                        echo "The SSL configuration contains errors / best practice mismatches";
                                                        echo "</div>";
						}
  						

                 }
	
		 if ( $field == 'isExceptional') {
		
						if ( $value =='1' ) {
                                                        echo "<div class='highlightBox'>";
                                                        echo "HTTP Strict Transport Security (HSTS) with long duration deployed on this server.";
                                                        echo "</div>";
						}
		}



}	
	
	echo "<div class='infoBox'>";	
        	echo "Visit the <a href='https://www.ssllabs.com/projects/documentation/index.html' rel='noreferrer'>documentation page</a> for more information, configuration guides, and books. Known issues are documented<a href='https://community.qualys.com/docs/DOC-4865'> here</a>";
        echo "</div>";

}


//function showWrap1() {
//	document.getElementByClassName('wrap1').style.display = 'block';
//}

//function closeWrap1() {
//	document.getElementByClassName('wrap1').style.display = 'none';
//}





function TreeView($array, $index = 0)
{
    global $tree, $arr_log;

    $space = '';
    for ($i = 0; $i < $index; $i++) {
        $space .= '-';
    }

    foreach ($array as $folder)
    {
        $tree .= $space .' '. $folder['dirName'] .'<br />';

        if (is_array($folder['children'])) {
            $index++;
            $arr_log[$folder['dirName']] = $index;
            TreeView($folder['children'], $index);
        }

        if ($arr_log[$folder['dirName']] > 0) {
            $index--;
        }
    }
}
?>
