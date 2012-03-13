<?php

/**
 *
 * Da wir kein SMARTY einsetzen, bauen wir unser HTML selber
 * @author Dennis Heidtmann
 * @author Rafael Dabrowski
 *
 */
class Admin_Template
{

    private $_isRequest = false;
    private $_js = Array();
    private $_jQuery = Array();
    private $_inlineCSS = Array();
    private $_css = Array();

    public function __construct()
    {
        if (isset($_GET["request"]))
            $this->_isRequest = true;
    }

    private function getHTMLcss()
    {
        ?>
        <!-- oxid admin basis -->
        <link rel="stylesheet" type="text/css" media="screen" href="css/ox_reset.css">
        <link rel="stylesheet" type="text/css" media="screen" href="css/ox_style.css">

        <!-- jquery ui Theme-->
        <link rel="stylesheet" type="text/css" media="screen" href="css/smoothness/jquery-ui-1.8.18.custom.css">

        <!-- Fluid CSS -->
        <link rel="stylesheet" type="text/css" media="screen" href="css/fluid_grid.css">
        <?php
    }

    private function getHTMLJSLibs()
    {
        ?>
        <!-- jQuery Base-->
        <script type="text/javascript" src="js/jquery-1.7.1.min.js"></script>
        <script type="text/javascript" src="js/jquery-ui-1.8.18.custom.min.js"></script>
        <!-- DataTable Grid -->
        <script type="text/javascript" src="js/jquery.dataTables.min.js"></script>

        <!-- unsere jquery functions -->
        <script type="text/javascript" src="js/ox_jquery.js"></script>
        <?php
    }

    /**
     * Get the Navigationbar  
     */
    function getHTMLNavBar()
    {
        ?>
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
        <?php
    }

    /**
     * Gets the Content of the provided Site 
     * @global object $rc Rest_Client Object
     * @param type $site URL to Site
     */
    function getContent($site)
    {
        global $rc;
        $obj = $rc->getData($site);

        Field_Definitions::renderItems($obj);
    }

}