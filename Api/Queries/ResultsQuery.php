<?php
namespace Api\Queries;

use \Api\Contracts\IQuery;

use \Api\Helpers\Db;

use \Api\Models\CategoryModel;
use \Api\Models\ResultsModel;
use \Api\Models\ScoreModel;
use \Api\Models\SectionModel;
use \Api\Models\UserModel;

use \Api\Queries\QueryBase;

class ResultsQuery extends QueryBase implements IQuery {
    private $filters;

    public function __construct($filters) {
        parent::__construct();

        $this->filters = $filters;
    }

    public function Execute() {
        $results = array();

        $users = $this->Db()
            ->join('Categories c', 'c.id = u.categoryId', 'LEFT');

        // Use gender filter?
        if($this->filters != null && isset($this->filters['Gender'])) {
            $users->where('u.gender', $this->filters['Gender']);
        }

        // Use category filter?
        if($this->filters != null && isset($this->filters['Category'])) {
            $users->where('u.categoryId', $this->filters['Category']);
        }
        // Get all users
        $users = $users->get('Users u', null, 'u.id AS userId,
            u.firstName AS firstName,
            u.lastName AS lastName,
            u.birthday AS birthday,
            u.gender as gender,
            c.id AS categoryId,
            c.name AS categoryName');

        // Add all user object to array
        foreach ($users as $user) {
            // Set basic user/cat information
            $cat = new CategoryModel($user['categoryId'], $user['categoryName']);
            $user = new UserModel($user['userId'], $user['firstName'], $user['lastName'], $user['birthday'], $user['gender'], $cat);
            // Reset score
            $totalScore = 0;
            $userScores = array();

            // Get user's scores
            $scores = $this->Db()
                ->join('Sections s', 's.id = r.sectionId', 'INNER');

            // Use section filter?
            if($this->filters != null && isset($this->filters['Section'])) {
                $scores->where('s.id', $this->filters['Section']);
            }

            $scores = $scores->where('r.userId', $user->GetId())
                ->orderBy('s.name', 'ASC')
                ->get('Scores r', null,
                    'r.id AS id,
                    r.score AS score,
                    s.id AS sectionId,
                    s.name AS sectionName');

            // Process user's scores
            foreach ($scores as $score) {
                // Add to total score
                $totalScore = $totalScore + $score['score'];
                $sec = new SectionModel($score['sectionId'], $score['sectionName']);
                $sco = new ScoreModel($score['id'], $sec, $user, $score['score']);
                $userScores[] = $sco;
            }

            // Results model
            $res = new ResultsModel($user, $userScores, $totalScore);
            // Include results
            $results[] = $res->toArray();
        }

        return $results;
    }
}