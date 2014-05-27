<?php @session_start()?>
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title><?php echo $title; ?></title>
        <link rel="stylesheet" type="text/css" href="Styles/Stylesheet.css" />
    </head>
    <body>
        <div id="wrapper">
            <div id="banner">             
            </div>
            
            <nav id="navigation">
                <ul id="nav">
                    <li><a href="index.php">Gyvūnai</a></li>
                    <li><a href="Management.php">Valdymas</a></li>
                    <?php
                    //include("config.php");

                    // Check if user is logged and existing session
                    if(isset($_SESSION['logat'])) {?>
                        <li style="float: right"><a href="logout.php">Atsijungti</a></li><?php

                    }else{?>
                        <li style="float: right"><a href="index2.php">Prisijungti</a></li><?php

                    }
                    ?>

                </ul>
            </nav>
            
            <div id="content_area">
                <?php echo $content; ?>
            </div>
            <?php

            if(preg_match("/index\.php/", $_SERVER["REQUEST_URI"])){
            ?>
            
            <div id="sidebar">
                <h3>Pasirinkite rūšį:</h3>
                <ul>
                    <?php echo $content2; ?>
                </ul>
                
            </div>
            <?php } ?>
            
            <footer>
                <p>Karolis Stagniūnas IF-2/7</p>
            </footer>
        </div>
    </body>
</html>
