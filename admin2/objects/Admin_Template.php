<?php
/**
 * This file is part of Oxid Admin2
 */
/**
 * Helper for rendering Html Snippets
 *
 * @author Dennis Heidtmann
 * @author Rafael Dabrowski
 * @author Daniel Schlichtholz <admin@mysqldumper.de>
 */
class Admin_Template
{
    /**
     * @var Rest_Client
     */
    static private $restClient;

    /**
     * Render a Html Snippet and return its content.
     *
     * Nested PHP will be executed.
     *
     * @param string $snippetName The name of the snippet to fetch
     *
     * @return string The fetched Html snippet ready to output
     */
    public function getHtmlSnippet($snippetName)
    {
        $snippet = '';
        $snippetName = (string) $snippetName;
        $fileName = realpath(dirname(__FILE__) . '/../views/snippets/' . $snippetName . '.php');
        if (is_readable($fileName)) {
            ob_start();
            include($fileName);
            $snippet = ob_get_clean();
        }
        return $snippet;
    }

    /**
     * Gets the Content of the provided Site
     *
     * @param string $site URL to Site
     *
     * @return void
     */
    public function getContent($site)
    {
        if (self::$restClient === null) {
            self::$restClient = new Rest_Client();
        }
        $obj = self::$restClient->getData($site);

        //@todo get rid of singleton Field_Defintions and let method return rendered content
        Field_Definitions::renderItems($obj);
    }

}
