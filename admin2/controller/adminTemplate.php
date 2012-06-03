<?php
/**
 * This file is part of Oxid Admin2
 */

/**
 * Controller for Creating Site
 *
 * @author Dennis Heidtmann
 * @author Rafael Dabrowski
 * @author Daniel Schlichtholz <admin@mysqldumper.de>
 * @author Joscha Krug <krug@marmalade.de>
 */
class adminTemplate
{
    /**
     * Initializes the process
     *
     * @return void
     */
    public function run()
    {

        $controllerName = $this->_getClassName();

        //ToDo: implement oxNew()
        $controller = new $controllerName;

        $template = $controller->render();

        $page = $this->output( $template );

        $this->finalize( $page );

    }

    /**
     * Function to render the Template
     *
     * @return string with the fully rendered page
     */
    public function output( $template) {

        ob_start();

        require getShopBasePath() . 'views/' . $template;

        $page = ob_get_contents();

        ob_end_clean();

        return $page;
    }

    /**
     * Finalize the output end do the echo
     * prepared for the copyright output
     *
     * @return void
     */
    public function finalize( $page )
    {
        echo $page;
    }

    protected function _getClassName()
    {
        //ToDo: Please implement the OXID getConfig() function
        if( !empty($_REQUEST['cl']) ) {
            return $_REQUEST['cl'];
        } else {
            return 'login';
        }
    }

}
