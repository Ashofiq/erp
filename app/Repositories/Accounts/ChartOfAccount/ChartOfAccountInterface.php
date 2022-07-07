<?php 

namespace App\Repositories\Accounts\ChartOfAccount;

interface ChartOfAccountInterface {
    const FIXEDASSETID = 10;
    const SUNDRYDEBTORSID = 27;

    public function saveChartOfAccount($data);

    public function updateChartOfAccount($data);

    public function deleteChartOfAccount($id);

    public function getByParentId($parentId);

    public function getById($parentId);
    
}