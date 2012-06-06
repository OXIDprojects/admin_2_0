<?php

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
        } else {
            $limit = $request->getParam('limit', 50);
            $offset = $request->getParam('offset', 0);
            $filter = $request->getParam('filter', array());
            $userData = $userModel->getUserList($limit, $offset, $filter);
        }

        if ($userData === null) {
            return;
        }

        $result = $this->getResult();
        if (!empty($entity)) {
            $result->setData(array('user' => $userData));
        } else {
            $result->setData(array('userlist' => $userData));
        }
    }

    /**
     * Handle method POST
     *
     * @return null
     */
    public function post()
    {
        // TODO: Implement post() method.
    }

    /**
     * Handle method PUT
     *
     * @return null
     */
    public function put()
    {
        // TODO: Implement put() method.
    }

    /**
     * Handle method DELETE
     *
     * @return null
     */
    public function delete()
    {
        // TODO: Implement delete() method.
    }
}
