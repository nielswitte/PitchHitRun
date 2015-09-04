<?php
namespace Api\Models;

use \Api\Contracts\IModel;

class ScoreModel implements IModel {
	private $id;
	private $section;
	private $score;
	private $user;

	public function __construct($id = null, $section, $user, $score) {
		$this->id = $id;
		$this->section = $section;
		$this->user = $user;
		$this->score = $score;
	}

	public function GetId() {
		return $this->id;
	}

	public function GetSection() {
		return $this->section;
	}

	public function GetScore() {
		return $this->score;
	}

	public function GetUser() {
		return $this->user;
	}

	public function toArray() {
		return array(
			'Id' 		=> $this->GetId(),
			'Section'	=> $this->GetSection()->toArray(),
			'User'		=> $this->GetUser()->toArray(),
			'Score'		=> $this->GetScore()
		);
	}
}