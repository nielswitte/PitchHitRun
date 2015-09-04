<?php
namespace Api\Queries;

use \Api\Contracts\IQuery;

use \Api\Helpers\Db;

use \Api\Models\CategoryModel;

use \Api\Queries\QueryBase;

class CategoriesQuery extends QueryBase implements IQuery {

    public function Execute() {
        $results = $this->Db()
            ->orderBy('name', 'ASC')
            ->get('Categories');

        $categories = array();
        // Add all user object to array
        foreach ($results as $i => $category) {
            $c = new CategoryModel($category['id'], $category['name']);
            $categories[] = $c->toArray();
        }

        return $categories;
    }
}