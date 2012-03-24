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
 */
class Admin_Template
{

    /**
     *
     * @var Site 
     */
    protected $Site = NULL;

    /**
     * @var Rest_Client
     */
    static private $_restClient;

    /**
     * Gets the Content of the provided Site
     *
     * @param string $site URL to Site
     *
     * @return void
     */
    public function run($site)
    {

        $this->createSite($site);
        $this->Site->render();
    }

    protected function createSite($site)
    {
        if (self::$_restClient === null)
        {
            self::$_restClient = new Rest_Client();
        }
        $obj = self::$_restClient->getData($site);
        $this->Site = new Site();
        $this->Site->Title = $obj->Title;

        $this->Site->setContent(new Content($obj));
    }

}
