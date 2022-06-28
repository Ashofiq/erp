<?php 

namespace App\Repositories\Accounts\ChartOfAccount;

interface ChartOfAccountInterface {
    const FIXEDASSETID = 10;

    public function saveChartOfAccount($data);

    public function getByParentId($parentId);

    public function getById($parentId);
    
}