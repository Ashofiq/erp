<?php 

namespace App\Repositories\Settings\User;


interface UserInterface {

    public function saveUser($data);

    public function update($data);

    public function gelAll(); // paginate

    public function all();
}