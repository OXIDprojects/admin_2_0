<?php
/*
 *
 */

include "objects/Admin_Template.php";
include "objects/Field_Definitions.php";
include "objects/Rest_Client.php";

$rc = new Rest_Client();  
$t = new Admin_Template();

//$t->render(); 


?>

<!DOCTYPE html>
<html id="home" lang="de">
    <head>
        <meta charset=utf-8 />
        <title>Admin 2 / </title>
        <link rel="stylesheet" type="text/css" media="screen" href="css/ox_reset.css">
        <link rel="stylesheet" type="text/css" media="screen" href="css/ox_style.css">

        <!-- jquery UI Theme-->
        <link rel="stylesheet" type="text/css" media="screen" href="css/smoothness/jquery-ui-1.8.18.custom.css">

        <!-- Fluid CSS -->
        <link rel="stylesheet" type="text/css" media="screen" href="css/fluid_grid.css">
        <script src="js/modernizr.custom.js"></script>
        <script src="js/jquery-1.7.1.min.js" type="text/javascript"></script>
        <script src="js/jquery.dataTables.min.js" type="text/javascript"></script>
		<script src="js/raphael.js" type="text/javascript"></script>
		<script src="js/amcharts.js" type="text/javascript"></script>
    </head>
    <body>
        <header id="oxhead">
            <div class="oxidinfo">
                <a href="http://www.oxid-esales.com/" title="Visit OXID eSales Website" target="_blank"><img src="img/logo.png" alt="OXID eShop - Logo" class="oxlogo" /></a>
                <div class="oxidversion">Community Edition 4.5.8_42471</div>
            </div>
            <nav id="main">
                <ul>
                    <li class="users">
                        <a href="#">Favorites</a>
                        <ul>
                            <li><a href="#">Show Orders</a></li>
                            <li><a href="#">Add Order</a></li>
                        </ul>
                    </li>
                    <li><a href="#">Some other stuff</a></li>
                    <li><a href="#">Help</a></li>
                    <li><a href="#">Logout</a></li>
                </ul>
            </nav>
        
        </header>
        
        <div id="main" role="main">
            <aside>
                <nav>
                    <ul>
                        <li class="products">
                            <a href="#">Orders</a>
                            <ul>
                                <li><a href="#">Show Orders</a></li>
                                <li><a href="#">Add Order</a></li>
                            </ul>
                        </li>
                        <li class="orders">
                            <a href="#">Orders</a>
                            <ul>
                                <li><a href="#">Show Orders</a></li>
                                <li><a href="#">Add Order</a></li>
                            </ul>
                        </li>
                        <li class="marketing">
                            <a href="#">Orders</a>
                            <ul>
                                <li><a href="#">Show Orders</a></li>
                                <li><a href="#">Add Order</a></li>
                            </ul>
                        </li>
                        <li class="users">
                            <a href="#">Orders</a>
                            <ul>
                                <li><a href="#">Show Orders</a></li>
                                <li><a href="#">Add Order</a></li>
                            </ul>
                        </li>
                        <li class="divider">&nbsp;</li>
                        <li class="settings">
                            <a href="#">Orders</a>
                            <ul>
                                <li><a href="#">Show Orders</a></li>
                                <li><a href="#">Add Order</a></li>
                            </ul>
                        </li>
                    </ul>
                </nav>
            </aside>
            <div id="content">
			
			<?php $t->getContent("json/page.json"); ?>
			
              
            </div>
        </div>
        
        <footer>
            OXID Admin 2.0 was developed by the OXID Community and OXID eSales AG
        </footer>
        
           <script src="js/joscha.js" type="text/javascript"></script>
        
    </body>
</html>

