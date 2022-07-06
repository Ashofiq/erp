<?php

namespace App\Repositories\Settings\User;

use App\Repositories\Settings\User\UserInterface as UserInterface;
use App\Models\User;
use Config;
use Hash;

class UserRepository implements UserInterface
{
    public $user;
    private $pagelimit;

    function __construct(User $user) {
	    $this->user = $user;
        $this->pagelimit = Config::get('app.PAGELIMIT');
    }

    public function saveUser($data)
    {
        $this->user->name = $data->name;
        $this->user->email = $data->email;
        $this->user->password = Hash::make($data->password);
        $this->user->save();
        return $this->user;
    }

    public function update($data){
        $user = $this->user->where('email', $data->email)->first();
        $user->name = $data->name;
        $user->email = $data->email;
        $user->password = Hash::make($data->password);
        $user->save();
        return $this->user;
    }

    public function gelAll(){
        return $this->user->with('company')->paginate($this->pagelimit);
    }

    public function all(){
        return $this->user->get();
    }
}