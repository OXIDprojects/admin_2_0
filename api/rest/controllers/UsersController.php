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
 *
 */
class UsersController extends Admin2_Controller_Abstract
{

    /**
     * Handle method GET
     *
     * @return void
     */
    public function get()
    {
        // use: oxdefaultadmin
        // filter: filter[field] = filtervalue
        $userModel = new Application_Model_User();
        $request = $this->getRequest();
        $entity = $request->getEntity();
        if (!empty($entity)) {
            $userData = $userModel->getUser($entity);
        }

        if ($userData === null) {
            return;
        }

        $result = $this->getResult();
        $result->setData(array('user' => $userData));
    }

    /**
     * Handle method GET without an entity.
     *
     * @return void
     */
    public function getList()
    {
        $userModel = new Application_Model_User();
        $request = $this->getRequest();
        $limit = $request->getParam('limit', 50);
        $offset = $request->getParam('offset', 0);
        $filter = $request->getParam('filter', array());
        $userData = $userModel->getUserList($limit, $offset, $filter);

        if ($userData === null) {
            return;
        }

        $result = $this->getResult();
        $result->setData(array('userlist' => $userData));
    }


    /**
     * Handle method POST
     *
     * @return void
     */
    public function post()
    {
        // TODO: Implement post() method.
    }

    /**
     * Handle method PUT
     *
     * @return void
     */
    public function put()
    {
        // TODO: Implement put() method.
    }

    /**
     * Handle method DELETE
     *
     * @return void
     */
    public function delete()
    {
        // TODO: Implement delete() method.
    }
}
