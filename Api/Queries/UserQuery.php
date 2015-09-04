<?php
namespace Api\Queries;

use \Api\Contracts\IQuery;

use \Api\Helpers\Db;

use \Api\Libs\RestServer\RestException;

use \Api\Models\CategoryModel;
use \Api\Models\UserModel;

use \Api\Queries\QueryBase;

class UserQuery extends QueryBase implements IQuery {
    private $userId;

    public function __construct($id) {
        parent::__construct();
        $this->userId = $id;
    }

    public function Execute() {
        $result = $this->Db()
            ->join('Categories c', 'c.id = u.categoryId', 'LEFT')
            ->where('u.id', $this->userId)
            ->orderBy('u.firstName', 'ASC')
            ->orderBy('u.lastName', 'ASC')
            ->getOne('Users u',
                'u.id AS id,
                u.firstName AS firstName,
                u.lastName AS lastName,
                u.birthday AS birthday,
                u.gender as gender,
                c.id AS categoryId,
                c.name AS categoryName');

        // User found?
        if($result == null) {
            throw new RestException(500, 'Deelnemer niet gevonden. ' . $this->Db()->getLastError());
        }

        $c = new CategoryModel($result['categoryId'], $result['categoryName']);
        $u = new UserModel($result['id'], $result['firstName'], $result['lastName'], $result['birthday'], $result['gender'], $c);

        return $u->toArray();
    }
}