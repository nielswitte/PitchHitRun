<?php
namespace Api\Queries;

use \Api\Helpers\Db;

abstract class QueryBase {
    private $db;

    public function __construct() {
        $this->db = Db::$mysql;
    }

    public function Db() {
        return $this->db;
    }
}