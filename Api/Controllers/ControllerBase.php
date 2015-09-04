<?php
namespace Api\Controllers;

use \Api\Helpers\Db;

abstract class ControllerBase {
    private $db;

    public function __construct() {
        $this->db = Db::$mysql;
    }

    public function Db() {
        return $this->db;
    }
}
