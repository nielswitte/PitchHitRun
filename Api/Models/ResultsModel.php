<?php
namespace Api\Models;

use \Api\Contracts\IModel;

class ResultsModel implements IModel {
	private $user;
	private $scores;
	private $totalScore;

	public function __construct($user, $scores = array(), $totalScore = 0) {
		$this->user = $user;
		$this->scores = $scores;
		$this->totalScore = $totalScore;
	}

	public function GetUser() {
		return $this->user;
	}

	public function GetScores() {
		return $this->scores;
	}

	public function GetTotalScore() {
		return $this->totalScore;
	}

	private function toScoresArray() {
		$result = array();
		foreach($this->GetScores() as $score) {
			$result[] = $score->toArray();
		}
		return $result;
	}

	public function toArray() {
		return array(
			'User' 		=> $this->GetUser()->toArray(),
			'Scores'	=> $this->toScoresArray(),
			'TotalScore'=> $this->GetTotalScore()
		);
	}
}