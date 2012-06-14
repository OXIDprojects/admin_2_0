<?php
/**
 *  This file is part of Admin 2.0 project for OXID eShop CE/PE/EE.
 *
 *  The Admin 2.0 sourcecode is free software: you can redistribute it and/or modify
 *  it under the terms of the MIT License.
 *
 * @link      http://admin20.de
 * @copyright (C) 2012 :: Admin 2.0 Developers
 */
/**
 * Class to handle user data
 */
class Application_Model_User extends Admin2_Model_Abstract
{
    /**
     * Retrieve a list of user data.
     *
     * @param int   $limit  Maximum length of list
     * @param int   $offset Offset of first list item
     * @param array $filter Filter for where clause
     *
     * @return array
     */
    public function getUserList($limit = 50, $offset = 0, array $filter)
    {
        /** @var $userList oxUserList */
        $userList = oxNew('oxUserList');
        $userList->setSqlLimit($offset, $limit);

        $oListObject = $userList->getBaseObject();
        $sFieldList  = $oListObject->getSelectFields();
        $select      = 'SELECT ' . $sFieldList . ' FROM ' . $oListObject->getViewName();

        if ($sActiveSnippet = $oListObject->getSqlActiveSnippet()) {
            $select .= ' WHERE ' . $sActiveSnippet;
        }

        $database = oxDb::getDb();

        // add simple OR filter to query
        if (!empty($filter)) {
            $select .= ' AND (';
            $countFields = 0;

            foreach ($filter as $field => $clause) {
                $countFields++;
                if ($countFields > 1) {
                    $select .= ' OR ';
                }
                $select .= '`' . $field . '` LIKE ' . $database->quote('%' . $clause . '%');
            }
            $select .= ')';
        }

        $userList->selectString($select);

        $users = $userList->getArray();

        $counter   = 0;
        $usersData = array();
        /** @var $user oxUser */
        foreach ($users as $user) {
            $data = $this->getUser($user->getId());
            if (!empty($data)) {
                $counter++;
                $usersData['user' . $counter] = $data;
            }
        }
        return $usersData;
    }

    /**
     * Retrieve user data.
     *
     * @param string $entity Oxid of a user
     *
     * @return array|null
     */
    public function getUser($entity)
    {
        /** @var $user oxuser */
        $user = oxNew('oxuser');
        $user->disableLazyLoading();
        if (!$user->load($entity)) {
            return null;
        }

        $userData = array();
        $fields   = $user->getFieldNames();

        foreach ($fields as $field) {
            $userData[$field] = $user->getFieldData($field);
        }
        return $userData;
    }
}
