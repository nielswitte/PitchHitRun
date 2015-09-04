<?php
#namespace Api\Controllers;

use \Api\Controllers\ControllerBase;

use \Api\Libs\RestServer\RestException;

use \Api\Helpers\Db;

use \Api\Models\CategoryModel;
use \Api\Models\UserModel;

use \Api\Queries\UserQuery;
use \Api\Queries\UsersQuery;

class UserController extends ControllerBase {
    /**
     * Gets all users
     *
     * @url GET /
     */
    public function GetUsers() {
        $users = new UsersQuery();
        // Return list with users
        return $users->Execute();
    }

    /**
     * Gets the user by id or current user
     *
     * @url GET /$id
     */
    public function GetUser($id)
    {
        $user = new UserQuery($id);
        return $user->Execute();
    }

    /**
     * Saves a user to the database
     * Or update an existing user
     *
     * @url POST /
     * @url PUT /$id
     */
    public function SaveUser($id = null, $data)
    {
        // Only process valid data
        if($this->ValidateUser($data)) {

            // Format for update/insert query
            $dbData = Array (
                'firstName' => $data->FirstName,
                'lastName'  => $data->LastName,
                'birthday'  => $data->Birthday,
                'gender'    => $data->Gender,
                'categoryId'=> $data->Category->Id
            );

            // Update existing user?
            if($id) {
                $this->Db()->where ('id', $id);
                if ($this->Db()->update ('Users', $dbData)) {
                    $user = new UserModel($id, $data->FirstName, $data->LastName, $data->Birthday, $data->Gender, $data->Category);
                } else {
                    throw new RestException(500, 'Update mislukt: ' . $this->Db()->getLastError());
                }
            // Add new user
            } else {
                $id = $this->Db()->insert('Users', $dbData);
                if ($id) {
                    $user = new UserModel($id, $data->FirstName, $data->LastName, $data->Birthday, $data->Gender, $data->Category);
                } else {
                    throw new RestException(500, 'Toevoegen mislukt: ' . $this->Db()->getLastError());
                }
            }

            return $user->toArray();
        }
    }

    /**
     * Removes a user from the database
     *
     * @url DELETE /$id
     */
    public function DeleteUser($id) {
        $this->Db()->where('id', $id);
        if($this->Db()->delete('Users')) {
            return 'Gebruiker verwijderd.';
        } else {
            throw new RestException(500, 'Niet gelukt om gebruiker met Id: \'' . $id . '\' te verwijderen');
        }
    }

    /**
     * Validates user input
     *
     * @return boolean true when valid
     */
    private function ValidateUser($userDate) {
        if($userDate->FirstName === null) {
            throw new RestException(400, 'Voornaam is verplicht');
        }
        if($userDate->LastName === null) {
            throw new RestException(400, 'Achternaam is verplicht');
        }
        if($userDate->Birthday === null) {
            throw new RestException(400, 'Verjaardag is verplicht');
        }
        if($userDate->Gender === null) {
            throw new RestException(400, 'Geslacht is verplicht');
        }
        if($userDate->Category === null || $userDate->Category->Id === null) {
            throw new RestException(400, 'Category is verplicht');
        }
        return true;
    }
}
