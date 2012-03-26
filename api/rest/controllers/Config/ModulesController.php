<?php
class Config_ModulesController extends Admin2_Controller_Abstract
{
    /**
     * Instance cache for the shop configuration model.
     *
     * @var Application_Model_Shop_Config
     */
    protected $_shopConfigModel;

    /**
     * Retrieves a list of the currently installed modules.
     *
     * @return null
     */
    public function get()
    {
        $shopConfigModel = $this->getShopConfigModel();
        $this->_result->setData($shopConfigModel->getModules());
    }

    /**
     * Adds a module to the module list.
     *
     * @return null
     */
    public function post()
    {
        $oxidClass = $this->_request->getEntity();
        $moduleName = $this->_request->getParam('moduleName');

        $shopConfigModel = $this->getShopConfigModel();
        $result = $shopConfigModel->addModule($oxidClass, $moduleName);
        $this->_result->setData($result);
    }

    /**
     * Writes a complete module list.
     *
     * @return null
     */
    public function put()
    {
        $moduleList = $this->_request->getParam('moduleList');
        $shopConfigModel = $this->getShopConfigModel();
        $result = $shopConfigModel->setModules($moduleList);
        $this->_result->setData($result);
    }

    /**
     * Removes a module from list.
     *
     * @return null
     */
    public function delete()
    {
        $oxidClass = $this->_request->getParam('oxidClass');
        $moduleName = $this->_request->getParam('moduleName');

        $shopConfigModel = $this->getShopConfigModel();
        $result = $shopConfigModel->removeModules($oxidClass, $moduleName);
        $this->_result->setData($result);
    }

    /**
     * Retrieves an instance of the shop configuration model.
     *
     * @return Application_Model_Shop_Config
     */
    protected function getShopConfigModel()
    {
        if ($this->_shopConfigModel === null) {
            $this->_shopConfigModel = new Application_Model_Shop_Config();
        }

        return $this->_shopConfigModel;
    }
}
