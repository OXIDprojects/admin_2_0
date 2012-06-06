<?php
/**
 *
 */
class Application_Model_User extends Admin2_Model_Abstract
{


    /**
     * Retrieve a list of user data.
     *
     * @param int $limit  Maximum length of list.
     * @param int $offset Offset of first list item.
     * @param array $filter Filter for where clause.
     *
     * @return array
     */
    public function getUserList($limit, $offset, array $filter)
    {
        /** @var $userList oxUserList */
        $userList = oxNew('oxUserList');
        $userList->setSqlLimit($offset, $limit);

        $oListObject = $userList->getBaseObject();
        $sFieldList = $oListObject->getSelectFields();
        $select = "SELECT $sFieldList FROM " . $oListObject->getViewName() . PHP_EOL;

        if ($sActiveSnippet = $oListObject->getSqlActiveSnippet()) {
            $select .= " WHERE $sActiveSnippet " . PHP_EOL;
        }

        $database = oxDb::getDb();

        # add simple OR filter to query
        //ToDo: make it more beautiful
        if (!empty($filter)) {
            $select .= " AND ( ";
            $countFields = 0;

            foreach ($filter as $field => $clause) {
                $countFields++;
                if ($countFields > 1)
                    $select .= " OR ";

                $quotedFirstClause = $database->quote('%' . $clause . '%');
                $quotedSecondClause = $database->quote($clause . '%');
                $quotedThirdClause = $database->quote('%' . $clause);

                $select .= " " . $field . " LIKE " . $quotedFirstClause . PHP_EOL;
                $select .= " OR " . $field . " LIKE " . $quotedSecondClause . PHP_EOL;
                $select .= " OR " . $field . " LIKE " . $quotedThirdClause . PHP_EOL;
            }
            $select .= " ) ";
        }

        $userList->selectString($select);

        $users = $userList->getArray();

        $counter = 0;
        $usersData = array();
        /** @var $user oxUser */
        foreach ($users as $oxId => $user) {
            $data = $this->getUser($oxId);
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
        if (!$user->load($entity))
            return null;


        $userData = array();
        $fields = $user->getFieldNames();

        foreach ($fields as $field) {
            $userData[$field] = $user->getFieldData($field);
        }

        return $userData;
    }
}