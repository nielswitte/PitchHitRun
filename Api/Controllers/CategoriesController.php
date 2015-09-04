<?php
#namespace Api\Controllers;

use Api\Controllers\ControllerBase;

use \Api\Libs\RestServer\RestException;

use \Api\Helpers\Db;

use \Api\Models\CategoryModel;

use \Api\Queries\CategoriesQuery;

class CategoriesController extends ControllerBase {
    /**
     * Gets all categories
     *
     * @url GET /
     */
    public function GetCategories() {
        $categories = new CategoriesQuery();
        // Return list with categories
        return $categories->Execute();
    }

    /**
     * Saves a category to the database
     * Or updates an existing category
     *
     * @url POST /
     * @url PUT /$id
     */
    public function SaveCategory($id = null, $data)
    {
        // Only process valid data
        if($this->ValidateCategory($data)) {

            // Format for update/insert query
            $dbData = Array (
                'name' => $data->Name,
            );

            // Update existing user?
            if($id) {
                $this->Db()->where('id', $id);
                if ($this->Db()->update('Categories', $dbData)) {
                    $category = new CategoryModel($id, $data->Name);
                } else {
                    throw new RestException(500, 'Update mislukt: ' . $this->Db()->getLastError());
                }
            // Add new user
            } else {
                $id = $this->Db()->insert('Categories', $dbData);
                if ($id) {
                    $category = new CategoryModel($id, $data->Name);
                } else {
                    throw new RestException(500, 'Toevoegen mislukt: ' . $this->Db()->getLastError());
                }
            }

            return $category>toArray();
        }
    }

    /**
     * Removes a category from the database
     *
     * @url DELETE /$id
     */
    public function DeleteCategory($id) {
        $this->Db()->where('id', $id);
        if($this->Db()->delete('Categories')) {
            return 'Categorie verwijderd.';
        } else {
            throw new RestException(500, 'Niet gelukt om categorie met Id: \'' . $id . '\' te verwijderen');
        }
    }

    /**
     * Validates category input
     *
     * @return boolean true when valid
     */
    private function ValidateCategory($userDate) {
        if($userDate->Name === null) {
            throw new RestException(400, 'Naam is verplicht');
        }

        return true;
    }
}
