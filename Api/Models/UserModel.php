<?php
namespace Api\Models;

use \Api\Contracts\IModel;

class UserModel implements IModel {
	private $id;
	private $firstName;
	private $lastName;
	private $birthday;
	private $gender;
	private $category;

	public function __construct($id = null, $firstName, $lastName, $birthday, $gender, $category = null) {
		$this->id = $id;
		$this->firstName = $firstName;
		$this->lastName = $lastName;
		$this->birthday = $birthday;
		$this->gender = $gender;
		$this->category = $category;
	}

	public function GetId() {
		return $this->id;
	}

	public function GetFirstName() {
		return $this->firstName;
	}

	public function GetLastName() {
		return $this->lastName;
	}

	public function GetFullName() {
		return sprintf('%s %s', $this->firstName, $this->lastName);
	}

	public function GetGender() {
		return $this->gender;
	}

	public function GetBirthday() {
		return $this->birthday;
	}

	public function GetCategory() {
		return $this->category;
	}

	public function ToArray() {
		return array(
			'Id' 		=> $this->GetId(),
			'FirstName' => $this->GetFirstName(),
			'LastName' 	=> $this->GetLastName(),
			'FullName' 	=> $this->GetFullName(),
			'Birthday' 	=> $this->GetBirthday(),
			'Gender' 	=> $this->GetGender(),
			'Category'	=> $this->GetCategory() != null ? $this->GetCategory()->toArray() : null
		);
	}
}