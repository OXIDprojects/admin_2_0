<?php
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Template for Sites
 *
 * @author rafael
 */
class Site
{
/**
 *
 * @var Content 
 */
    private $content = null;
    /**
     *Contains all Names of used JS Libraries
     * @var Array of string 
     */
    public $jsLibs = array();
    /**
     * Contains all JS Scripts which should be executet after Document is Ready
     * @var Array of string 
     */
    public $jsDocReady = array();
    
    /**
     *Contains all additional CSS Files
     * @var Array of Strings
     */
    public $cssFiles = array();
    /**
     *  The Title of The Site
     * @var string 
     */
    public $Title = "";

    /**
     *  Generates HTML For Including necessary CSS Files
     * @return String  
     */
    public function getCssFiles()
    {
        $output = "";
        if (count($this->cssFiles) > 0)
        {
            foreach ($this->cssFiles as $file)
            {
                $output .= "<link src='css/{$file}.css' type='text/css'/>\n";
            }
            return $output;
        }
    }

    /**
     * Setter for Content of Site, Starts $this->setArray()
     * @param type $content 
     */
    public function setContent($content)
    {
        $this->content = $content;
        $this->setArrays($content->Items);
    }

    /**
     *Searches for all needed JS and CSS 
     * @param Array of Widgets $items 
     */
    private function setArrays($items)
    {
        foreach ($items as $item)
        {
            if ($item->bHasJsDoc && !isset($this->jsDocReady[$item->Type]))
            {

                $this->jsDocReady[$item->Type] = $item->getJsDocReady();
            }
            if ($item->bHasJs)
            {

                $this->jsLibs = array_values(array_unique(array_merge($this->jsLibs, $item->jsLibs)));
            }
            if (isset($item->Items))
            {
                $this->setArrays($item->Items);
            }
        }
    }

    /**
     *Generates HTML Output for necessary JS Librarys
     * @return string 
     */
    public function getJsLibs()
    {
        $output = "";
        if (count($this->jsLibs) > 0)
        {
            foreach ($this->jsLibs as $lib)
            {
                $output .= "<script src='js/{$lib}.js' type='text/javascript'></script>\n";
            }
        }
        return $output;
    }

    /**
     * Generates HTML Output for all JS Scripts Started after Document Ready 
     * @return string 
     */
    public function getJsDocReady()
    {
        $output = "";
        if (count($this->jsDocReady) > 0)
        {
            $output = "<script type='text/javascript'>";
            foreach ($this->jsDocReady as $script)
            {
                $output .= $script . "\n\n";
            }
            $output .="</script>";
        }
        return $output;
    }

    /**
     *Gets basic HTML Snippets
     * @param string $snippetName
     * @return string 
     */
    public function getHtmlSnippet($snippetName)
    {
        $snippet = '';
        $snippetName = (string) $snippetName;
        $fileName = realpath(dirname(__FILE__) . '/snippets/' . $snippetName . '.php');
        if (is_readable($fileName))
        {
            ob_start();
            include($fileName);
            $snippet = ob_get_clean();
        }
        return $snippet;
    }

    /**
     *Renders the HTML Output 
     */
    public function render()
    {
        
       ?><!DOCTYPE html>
        <html id="home" lang="de">
            <head>
                <meta charset=utf-8 />
                <title>Admin 2 / <?php $this->Title ?></title>
                <?php
                echo $this->getHtmlSnippet('css');
                echo $this->getCssFiles();
                echo $this->getHtmlSnippet('jsIncludesMain');
                ?>
            </head>
            <body>
                <?php echo $this->getHtmlSnippet('topNavi'); ?>

                <div id="main" role="main">
                    <?php echo $this->getHtmlSnippet('navBar'); ?>
                    <div id="content">
                        <?php
                        $start = microtime(true);
                        echo $this->content->output();
                        echo microtime(true) - $start . ' Sekunden verbraucht';
                        ?>

                    </div>
                </div>
                <?php
                echo $this->getHtmlSnippet("footer");
                echo $this->getJsLibs();
                echo $this->getJsDocReady()
                ?>
            </body>
        </html>
        <?php
    }

}
?>
