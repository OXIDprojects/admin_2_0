<?php
class Application_Model_Shop_Config extends Admin2_Model_Abstract
{
    /**
     * Retrieves an array cintaining the installed modules.
     *
     * @return array
     */
    public function getModules()
    {
        $oxidConfig = oxConfig::getInstance();
        $modules = $oxidConfig->getShopConfVar('aModules');
        $moduleList = array();
        foreach ($modules as $oxidClass => $module) {
            $moduleList[$oxidClass] = explode('&', $module);
        }

        return $moduleList;
    }

    /**
     * Adds a module to OXIDs module list.
     *
     * @param string $oxidClass Name of the OXID class to overload.
     * @param string $module    Path and name of the module class
     *
     * @return bool
     */
    public function addModule($oxidClass, $module)
    {
        if ($oxidClass === null || $module === null) {
            return false;
        }

        $moduleList = $this->getModules();
        if (!isset($moduleList[$oxidClass])) {
            $moduleList[$oxidClass] = array($module);
        } else {
            $moduleList[$oxidClass][] = $module;
        }

        return $this->setModules($moduleList);
    }

    /**
     * Sets the complete module list.
     *
     * @param array $moduleList Array with modules.
     *
     * <code>
     * $moduleList = array(
     *      'oxacrticles'   => array('module1', 'module2'),
     *      'oxorder'       => array('invoicepdf/myorder'),
     * );
     * </code>
     *
     * @return bool
     */
    public function setModules($moduleList)
    {
        $oxidModuleList = array();
        foreach ($moduleList as $oxidClass => $modules) {
            $oxidModuleList[$oxidClass] = implode('&', $modules);
        }

        $oxidConfig = oxConfig::getInstance();
        $oxidConfig->saveShopConfVar('aarr', 'aModules', $oxidModuleList);

        return true;
    }

    /**
     * Removes a module from list.
     *
     * @param string $oxidClass Name of the OXID class to overload.
     * @param string $module    Path and name of the module class.
     *
     * @return bool
     */
    public function removeModules($oxidClass, $module)
    {
        $moduleList = $this->getModules();

        if (!isset($moduleList[$oxidClass]) || !in_array($module, $moduleList[$oxidClass])) {
            return false;
        }

        $moduleIndex = array_search($module, $moduleList[$oxidClass]);
        unset($moduleList[$oxidClass][$moduleIndex]);

        return $this->setModules($moduleList);
    }
}
