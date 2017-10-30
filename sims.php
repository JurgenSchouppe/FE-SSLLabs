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
            echo "<a href='prots.php'><i class='fa fa-user-secret'></i></a>";
            echo "<a class='active' href='sims.php'><i class='fa fa-handshake-o'></i></a>";
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
                echo "<div class='sims'>";
                $isi=0;
                 $simsnr =(count($attr2check['endpoints'][0]['details']['sims']['results']));
                        echo "<p><b>Number of tested Handshakes :</b>$simsnr</p>\n";


echo "<table>";
echo "<tr>";
echo "<th>Simulation</th>";
echo "<th>ID</th>";
echo "<th>name</th>";
echo "<th>version</th>";
echo "<th>Reference</th>";
echo "<th>ErrorCode</th>";
echo "<th>attemps</th>";
echo "<th>protocol ID</th>";
echo "<th>suite ID</th>";
echo "<th>kx Inof</th>";
echo "</tr>";
echo "<tr>";

                         while ($isi <= $simsnr -1) {
                                echo "<td><p><b>Simulation $isi</b></p></td>";
                         foreach ($attr2check['endpoints'][0]['details']['sims']['results'][$isi]['client'] as $field => $value) {
	                         if (is_Array ($value)) {
                                 } else {
                                 echo "<td>$value</td>";
                                 }
                                 }
                                foreach ($attr2check['endpoints'][0]['details']['sims']['results'][$isi] as $field => $value) {
                                        if (is_Array ($value)) {
                                        } else {
                                                 echo "<td>$value</td>";
                                         }
                                }
                                echo "</tr><tr>";
                        $isi++;

                          }
echo "</tr>";
echo "</table>";
echo "</div>";
echo "</body>";

?>
	

