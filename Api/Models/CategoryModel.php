<?php
namespace Api\Models;

use \Api\Contracts\IModel;

class CategoryModel implements IModel {
	private $id;
	private $name;

	public function __construct($id = null, $name) {
		$this->id = $id;
		$this->name = $name;
	}

	public function GetId() {
		return $this->id;
	}

	public function GetName() {
		return $this->name;
	}

	public function toArray() {
		return array(
			'Id' 		=> $this->GetId(),
			'Name' 		=> $this->GetName()
		);
	}
}