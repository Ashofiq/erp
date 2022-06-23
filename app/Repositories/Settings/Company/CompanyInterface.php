<?php 

namespace App\Repositories\Settings\Company;


interface CompanyInterface {

    public function allCompany();

    public function saveCompany($data);

    public function latestOne();

    // public function delete($id);

    // public function update($id,$data);

    // public function getCategoryIdBySlug($slug);

    // public function getCategoryParentId($parentId);
    
}