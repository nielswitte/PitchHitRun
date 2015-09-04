<?php
#namespace Api\Controllers;
use \Api\Controllers\ControllerBase;

use \Api\Libs\RestServer\RestException;

use \Api\Models\ScoreModel;

use \Api\Queries\ScoresQuery;

class ScoresController extends ControllerBase {
    /**
     * Gets all scores
     *
     * @url GET /
     */
    public function GetScores() {
        $sections = new ScoresQuery();
        return $sections->Execute();
    }

    /**
     * Saves a score to the database
     * Or updates an existing score
     *
     * @url POST /
     * @url PUT /$id
     */
    public function SaveScore($id = null, $data)
    {
        // Only process valid data
        if($this->ValidateScore($data)) {

            // Format for update/insert query
            $dbData = Array (
                'sectionId' => $data->Section->Id,
                'userId'    => $data->User->Id,
                'score'     => $data->Score
            );

            // Update existing user?
            if($id) {
                $this->Db()->where('id', $id);
                if ($this->Db()->update('Scores', $dbData)) {
                    $score = new ScoreModel($id, $data->Section, $data->User, $data->Score);
                } else {
                    throw new RestException(500, 'Update mislukt: ' . $this->Db()->getLastError());
                }
            // Add new user
            } else {
                $id = $this->Db()->insert('Scores', $dbData);
                if ($id) {
                    $score = new ScoreModel($id, $data->Section, $data->User, $data->Score);
                } else {
                    throw new RestException(500, 'Toevoegen mislukt: ' . $this->Db()->getLastError());
                }
            }

            return $score->toArray();
        }
    }

    /**
     * Removes a score from the database
     *
     * @url DELETE /$id
     */
    public function DeleteSection($id) {
        $this->Db()->where('id', $id);
        if($this->Db()->delete('Scores')) {
            return 'Score verwijderd.';
        } else {
            throw new RestException(500, 'Niet gelukt om score met Id: \'' . $id . '\' te verwijderen');
        }
    }

    /**
     * Validates score input
     *
     * @return boolean true when valid
     */
    private function ValidateScore($userDate) {
        if($userDate->Section === null || $userDate->Section->Id === null) {
            throw new RestException(400, 'Onderdeel is verplicht');
        }

        if($userDate->User === null || $userDate->User>Id === null) {
            throw new RestException(400, 'Deelnemer is verplicht');
        }

        if($userDate->Score === null) {
            throw new RestException(400, 'Score is verplicht');
        }

        return true;
    }
}