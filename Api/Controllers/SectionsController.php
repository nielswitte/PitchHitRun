<?php
#namespace Api\Controllers;
use \Api\Controllers\ControllerBase;

use \Api\Libs\RestServer\RestException;

use \Api\Models\SectionModel;

use \Api\Queries\SectionsQuery;

class SectionsController extends ControllerBase {
    /**
     * Gets all sections
     *
     * @url GET /
     */
    public function GetSections() {
        $sections = new SectionsQuery();
        return $sections->Execute();
    }

    /**
     * Saves a section to the database
     * Or updates an existing section
     *
     * @url POST /
     * @url PUT /$id
     */
    public function SaveSection($id = null, $data)
    {
        // Only process valid data
        if($this->ValidateSection($data)) {

            // Format for update/insert query
            $dbData = Array (
                'name' => $data->Name,
            );

            // Update existing user?
            if($id) {
                $this->Db()->where('id', $id);
                if ($this->Db()->update('Sections', $dbData)) {
                    $section = new SectionModel($id, $data->Name);
                } else {
                    throw new RestException(500, 'Update mislukt: ' . $this->Db()->getLastError());
                }
            // Add new user
            } else {
                $id = $this->Db()->insert('Sections', $dbData);
                if ($id) {
                    $section = new SectionModel($id, $data->Name);
                } else {
                    throw new RestException(500, 'Toevoegen mislukt: ' . $this->Db()->getLastError());
                }
            }

            return $section>toArray();
        }
    }

    /**
     * Removes a section from the database
     *
     * @url DELETE /$id
     */
    public function DeleteSection($id) {
        $this->Db()->where('id', $id);
        if($this->Db()->delete('Sections')) {
            return 'Onderdeel verwijderd.';
        } else {
            throw new RestException(500, 'Niet gelukt om onderdeel met Id: \'' . $id . '\' te verwijderen');
        }
    }

    /**
     * Validates section input
     *
     * @return boolean true when valid
     */
    private function ValidateSection($userDate) {
        if($userDate->Name === null) {
            throw new RestException(400, 'Naam is verplicht');
        }

        return true;
    }
}
