<?php 

namespace App\Repositories\Accounts\FinancialYear;


interface FinancialYearInterface {

    public function active();

    public function saveFinancialYear($data);

    public function latestOne();

    public function all();

    public function checkAndDeactive($companyId);

    
}