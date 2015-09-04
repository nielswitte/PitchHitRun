<?php
#namespace Api\Controllers;
use \Api\Controllers\ControllerBase;

use \Api\Libs\RestServer\RestException;

use \Api\Models\ScoreModel;

use \Api\Queries\ResultsQuery;

class ResultsController extends ControllerBase {
    /**
     * Gets all results with the optional filtering
     *
     * @url GET /
     */
    public function GetResults() {
        // Parse additional filters
        parse_str($_SERVER['QUERY_STRING'], $filters);
		$sections = new ResultsQuery($filters);
        return $sections->Execute();
    }
}
