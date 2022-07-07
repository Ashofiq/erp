<?php 

namespace App\Repositories\Settings\Company;


interface CompanyInterface {

    public function allCompany();

    public function userCompany();

    public function saveCompany($data);

    public function latestOne();

    public function all();  

    public function getUserDefaultCompanyId();

    public function getById($id);
    
    // public function delete($id);

    // public function update($id,$data);

    // public function getCategoryIdBySlug($slug);

    // public function getCategoryParentId($parentId);
    
}