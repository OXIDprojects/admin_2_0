<?php
header('Content-type: text/html; charset=utf-8');
include "objects/Admin_Template.php";
include "objects/Field_Definitions.php";
include "objects/Rest_Client.php";

$template = new Admin_Template();?>
<!DOCTYPE html>
<html id="home" lang="de">
    <head>
        <meta charset=utf-8 />
        <title>Admin 2 / </title>
        <?php
            echo $template->getHtmlSnippet('css');
            echo $template->getHtmlSnippet('jsIncludesMain');
        ?>
    </head>
    <body>
        <?php echo $template->getHtmlSnippet('topNavi');?>

        <div id="main" role="main">
            <?php echo $template->getHtmlSnippet('navBar');?>
            <div id="content">
                <?php echo $template->getContent("json/page.json"); ?>
            </div>
        </div>
        <?php echo $template->getHtmlSnippet("footer"); ?>
    </body>
</html>

