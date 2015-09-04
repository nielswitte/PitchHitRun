<?php
namespace Api\Queries;

use \Api\Contracts\IQuery;

use \Api\Helpers\Db;

use \Api\Models\CategoryModel;
use \Api\Models\ScoreModel;
use \Api\Models\SectionModel;
use \Api\Models\UserModel;

use \Api\Queries\QueryBase;

class ScoresQuery extends QueryBase implements IQuery {

    public function Execute() {
		$results = $this->Db()->join('Sections s', 's.id = r.sectionId', 'INNER')
		->join('Users u', 'u.id = r.userId', 'INNER')
        ->join('Categories c', 'c.id = u.categoryId', 'LEFT')
        ->orderBy('u.firstName', 'ASC')
        ->orderBy('u.lastName', 'ASC')
        ->get('Scores r', null,
			'r.id AS id,
			r.score AS score,
			s.id AS sectionId,
			s.name AS sectionName,
            u.id AS userId,
            u.firstName AS firstName,
            u.lastName AS lastName,
            u.birthday AS birthday,
            u.gender as gender,
            c.id AS categoryId,
            c.name AS categoryName');

        $scores = array();
        // Add all user object to array
        foreach ($results as $i => $result) {
			$s = new SectionModel($result['sectionId'], $result['sectionName']);
            $c = new CategoryModel($result['categoryId'], $result['categoryName']);
            $u = new UserModel($result['userId'], $result['firstName'], $result['lastName'], $result['birthday'], $result['gender'], $c);
            $r = new ScoreModel($result['id'], $s, $u, $result['score']);

            $scores[] = $r->toArray();
        }

        return $scores;
    }
}