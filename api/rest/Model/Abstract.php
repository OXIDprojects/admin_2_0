<?php
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
    protected $currentLanguageId;

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
                $this->currentLanguageId = $language->id;
            }
        }
        $this->_languages = $languages;

        $this->init();
    }

    /**
     * Method for model specific initialization.
     *
     * @return null
     */
    public function init()
    {
    }
}
