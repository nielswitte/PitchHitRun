<?php
namespace Api\Queries;

use \Api\Contracts\IQuery;

use \Api\Helpers\Db;

use \Api\Models\CategoryModel;
use \Api\Models\UserModel;

use \Api\Queries\QueryBase;

class UsersQuery extends QueryBase implements IQuery {

    public function Execute() {
        $results = $this->Db()
            ->join('Categories c', 'c.id = u.categoryId', 'LEFT')
            ->orderBy('u.firstName', 'ASC')
            ->orderBy('u.lastName', 'ASC')
            ->get('Users u', null,
                'u.id AS id,
                u.firstName AS firstName,
                u.lastName AS lastName,
                u.birthday AS birthday,
                u.gender as gender,
                c.id AS categoryId,
                c.name AS categoryName');

        $users = array();
        // Add all user object to array
        foreach ($results as $i => $result) {
            $c = new CategoryModel($result['categoryId'], $result['categoryName']);
            $u = new UserModel($result['id'], $result['firstName'], $result['lastName'], $result['birthday'], $result['gender'], $c);

            $users[] = $u->toArray();
        }

        return $users;
    }
}