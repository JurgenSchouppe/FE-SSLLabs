<?php
  session_start();
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
            echo "<a href='index.php'><i class='fa fa-home'></i></a>";
            echo "<a href='summary.php'><i class='fa fa-address-card'></i></a>";
            echo "<a href='certs.php'><i class='fa fa-chain'></i></a>";
            echo "<a href='details.php'><i class='fa fa-cog'></i></a>";
            echo "<a class='active' href='prots.php'><i class='fa fa-user-secret'></i></a>";
            echo "<a href='sims.php'><i class='fa fa-handshake-o'></i></a>";
	    echo "<a href='raw.php'><i class='fa fa-book'></i></a>";
    echo "</div>";

$site = $_SESSION['site'];
$dirP = ('/data/sslscan/scans');
$file2check = file_get_contents("$dirP/$site/latest.json");
$attr2check = json_decode($file2check, true);
$attr2check = $attr2check[0];
    Hgrade();

	
        //map array keys
        //$mapfile2check = file_get_contents('http://136.173.62.86/ssllabspe/ssllabspe.map',true);
        //$attrfile2check = ($mapfile2check);

        echo "<div class='wrap2'>";
                echo "<div class='proto'>";
$ip=0;
$protonr =(count($attr2check['endpoints'][0]['details']['protocols']));
echo "<p><b>Number of supported protocols found :</b>$protonr</p>";
echo "<table>";
echo "<tr>";
echo "<th>Protocol<th>";
echo "<th>ID</th>";
echo "<th>name</th>";
echo "<th>version</th>";
echo "</tr>";
echo "<tr>";
                //$ip=0;
                 //$protonr =(count($attr2check['endpoints'][0]['details']['protocols']));
                 //       echo "<p><b>Number of supported protocols found :</b>$protonr</p>\n";
                 while ($ip <= $protonr -1 ) {
	                 echo "<td><p><b>Protocol $ip</b></p></td>";
                	 foreach ($attr2check['endpoints'][0]['details']['protocols'][$ip] as $field => $value) {
	        	         echo "<td><p>$value</p></td>";
                         }
                         echo "</tr><tr>";
                          $ip++;
                          }
echo "</tr>";
echo "</table>";

echo "</div>";
echo "<div class='suites'>";

$is=0;
$suitenr =(count($attr2check['endpoints'][0]['details']['suites']['list']));
echo "<p><b>Number of Cipher Suites found :</b>$suitenr</p>\n";
echo "<table>";
echo "<tr>";
echo "<th>Cipher Suite<th>";
echo "<th>ID</th>";
echo "<th>Name</th>";
echo "<th>Strenght</th>";
echo "</tr>";
echo "<tr>";
                while ($is <= $suitenr -1 ) {
	                echo "<td><p><b>Cipher Suite $is</b></p></td>";
        	        foreach ($attr2check['endpoints'][0]['details']['suites']['list'][$is] as $field => $value) {
	                        echo "<td><p>$value</p></td>";
                       }
                       echo "</tr><tr>";
                       $is++;
                       }
echo "</tr>";
echo "</table>";
echo "</div>";  
echo "</div>";
echo "</body>";
?>
