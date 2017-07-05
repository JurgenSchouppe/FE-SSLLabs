<?php
    include 'functions.php';

 session_start();
    
 $site = $_SESSION['site'];
 $dirP = ('/data/sslscan/scans');
 $file2check = file_get_contents("$dirP/$site/latest.json");
 $attr2check = json_decode($file2check, true);
 $attr2check = $attr2check[0];


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
            echo "<a class='active' href='certs.php?site=$site'><i class='fa fa-chain'></i></a>";
            echo "<a href='details.php'><i class='fa fa-cog'></i></a>";
            echo "<a href='prots.php'><i class='fa fa-user-secret'></i></a>";
            echo "<a href='sims.php'><i class='fa fa-handshake-o'></i></a>";
            echo "<a href='raw.php'><i class='fa fa-book'></i></a>";
    echo "</div>";


    Hgrade();

	
	echo "<div class='wrap2'>";
	    	echo "<div class='cert'>";
		$i = 0;

//		var_dump($attr2check);
			foreach ($attr2check['endpoints'][0]['details']['key'] as $field => $value) {
					echo "<p><b>$field : </b>$value</p>"; 	
			}
			 foreach ($attr2check['endpoints'][0]['details']['cert'] as $field => $value) {
                                         echo "<p><b>$field : </b>$value</p>";
			}

			foreach ($attr2check['endpoints'][0]['details']['cert']['commonNames'] as $field => $value) {
			         	echo "<p><b>CN : </b>$value</p>\n";
		        }
			foreach ($attr2check['endpoints'][0]['details']['cert']['altNames'] as $field => $value) {
			                 echo "<p><b>SAN : </b>$value</p>\n";
			}

				$certnr =(count($attr2check['endpoints'][0]['details']['chain']['certs']));
				echo "<p><b>Number of Certificates found :</b>$certnr</p>\n";

		 		while ($i <= $certnr -1 ) {	
					
					echo "<p><b>Certificate $i\n</b></p>";
	                	        foreach ($attr2check['endpoints'][0]['details']['chain']['certs'][$i] as $field => $value) {
			                	        echo "<p>&emsp;<b>$field :</b>$value</p>\n";	
                        		}
				$i++;
				}
		echo "</div>";

	echo "</div>";

    echo "</body>";

$var_post = $_POST ['site'];

?>
