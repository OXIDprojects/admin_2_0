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
        $result = $this->getResult();

        // TODO: 400 bad request
        // request cannot be fulfilled due to bad syntax
        // $result->setResponseCode(400);

        if (!empty($entity)) {
            $userData = $userModel->getUser($entity);
        }

        if (empty($userData)) {
            // 404 requested resource could not be found
            $result->setResponseCode(Admin2_Controller_Result::NOT_FOUND);
        }
        $result->setResponseCode(Admin2_Controller_Result::OK);
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

        if (empty($userData)) {
            return;
        }

        $result = $this->getResponse();
        $result->setData(array('userlist' => $userData));
    }

    /**
     * Handle method POST to create a new user
     *
     * @return void
     */
    public function post()
    {
        // TODO: Implement post() method.

        // no user name -> 406
        // 406 Not Acceptable


        // 201 successfully created
        // location in header
    }

    /**
     * Handle method PUT to update a user
     *
     * @return void
     */
    public function put()
    {
        // TODO: Implement put() method.

        // no oxid/s -> 406
        // 406 Not Acceptable

        // 200 request wsa successfully
        // response in header
    }

    /**
     * Handle method DELETE
     *
     * @return void
     */
    public function delete()
    {
        // TODO: Implement delete() method.

        // no oxid/s -> 406
        // 406 Not Acceptable

        // 200 request wsa successfully
        // response in header
    }
}
