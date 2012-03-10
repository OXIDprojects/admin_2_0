<?php
$url = explode('/rest/', $_SERVER['REQUEST_URI'],2);
if (count($url)==2) {
    echo $url[1];
}
?>