<?php
/**
 *  This file is part of Admin 2.0 project for OXID eShop CE/PE/EE.
 *
 *  The Admin 2.0 sourcecode is free software: you can redistribute it and/or modify
 *  it under the terms of the MIT License.
 *
 *  @link      http://admin20.de
 *  @copyright (C) 2012 :: Admin 2.0 Developers
 */

/**
 * Abstract model class
 */
abstract class Admin2_Model_Abstract
{
    /**
     * Existing shop languages.
     *
     * @var array
     */
    protected $_languages;

    /**
     * Currently selected language.
     *
     * @var
     */
    protected $_currentLanguageId;

    /**
     * Class constructor.
     * Initializes the new instance.
     *
     * @return \Admin2_Model_Abstract
     */
    public function __construct()
    {
        $oxidLanguage = oxLang::getInstance();
        $oxidLanguages = $oxidLanguage->getLanguageArray();
        $languages = array();
        foreach ($oxidLanguages as $language) {
            $languages[$language->abbr] = (array) $language;
            if ($language->selected) {
                $this->_currentLanguageId = $language->id;
            }
        }
        $this->_languages = $languages;

        $this->init();
    }

    /**
     * Method for model specific initialization.
     *
     * @return void
     */
    public function init()
    {
    }
}
