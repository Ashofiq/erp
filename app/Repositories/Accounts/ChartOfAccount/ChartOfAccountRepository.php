<?php

namespace App\Repositories\Accounts\ChartOfAccount;

use App\Repositories\Accounts\ChartOfAccount\ChartOfAccountInterface as ChartOfAccountInterface;
use App\Models\Accounts\ChartOfAccount\ChartOfAccount;
use Config;

class ChartOfAccountRepository implements ChartOfAccountInterface
{
    public $chartOfAcc;
    private $pagelimit;
    
    function __construct(ChartOfAccount $chartOfAcc) {
	    $this->chartOfAcc = $chartOfAcc;
        $this->pagelimit = Config::get('app.PAGELIMIT');
    }

    public function getByParentId($parentId)
    {
        return $this->chartOfAcc->with('company')->where('parentId', $parentId)->paginate($this->pagelimit);
    }

    public function getById($parentId)
    {
        return $this->chartOfAcc->where('id', $parentId)->first();
    }
    
    public function saveChartOfAccount($data)
    {
        $this->chartOfAcc->companyId = $data->companyId;
        $this->chartOfAcc->accCode = self::genAccCode();
        $this->chartOfAcc->accHead = $data->accHead;
        $this->chartOfAcc->parentId = $data->parentId;
        $this->chartOfAcc->accLavel = self::genAccLavel($data->parentId);
        $this->chartOfAcc->accOrigin = self::genOrigin($data->parentId, $data->accHead);
        return $this->chartOfAcc->save();
    }

    public function updateChartOfAccount($data){
        $chartofacc = self::getById($data->id);

        $chartAcc = $this->chartOfAcc->find($data->id);
        $chartAcc->companyId = $data->companyId;
        $chartAcc->accHead = $data->accHead;
        $chartAcc->accOrigin = self::genOrigin($chartofacc->parentId, $data->accHead);
        return $chartAcc->save();
    }

    public function deleteChartOfAccount($id)
    {
        if ($this->chartOfAcc->find($id)->delete()) {
            return true;
        }

        return false;
    }

    public function genAccCode()
    {
        return $this->chartOfAcc->latest()->first()?->accCode + 1;
    }

    public function genAccLavel($parentId)
    {
        return $this->chartOfAcc->where('id', $parentId)->first()?->accLavel + 1;
    }

    public function genOrigin($parentId, $accHead)
    {
        $acc = $this->chartOfAcc->where('id', $parentId)->first();
        $origin = '';
        if ($acc != null) {
            $origin = $acc->accOrigin;
        }
        return $origin. ' '. $accHead.' >>';
    }

}