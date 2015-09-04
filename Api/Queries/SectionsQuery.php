<?php
namespace Api\Queries;

use \Api\Contracts\IQuery;

use \Api\Helpers\Db;

use \Api\Models\SectionModel;

use \Api\Queries\QueryBase;

class SectionsQuery extends QueryBase implements IQuery {

    public function Execute() {
        $results = $this->Db()
            ->orderBy('name', 'ASC')
            ->get('Sections');

        $sections = array();
        // Add all user object to array
        foreach ($results as $i => $section) {
            $c = new SectionModel($section['id'], $section['name']);
            $sections[] = $c->toArray();
        }
        // Return list with onderdeels
        return $sections;
    }
}