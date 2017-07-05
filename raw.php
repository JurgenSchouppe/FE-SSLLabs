<?php
    session_start();
    include 'functions.php';

    include '/var/www/html/tools/kint/Kint.class.php';
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
            echo "<a href='sims.php'><i class='fa fa-handshake-o'></i></a>";
            echo "<a class='active' href='raw.php'><i class='fa fa-book'></i></a>";
    echo "</div>";

$site = $_SESSION['site'];
$dirP = ('/data/sslscan/scans');
$file2check = file_get_contents("$dirP/$site/latest.json");
$attr2check = json_decode($file2check, true);
$attr2check = $attr2check[0];


    Hgrade(); 

    d($attr2check);
?>
