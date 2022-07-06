<?php 

namespace App\Repositories\Settings\CompanyAssign;


interface CompanyAssignInterface {

    public function assign($data, $userId);

    public function delete($data);

    public function update($data);

    public function getAll();
}