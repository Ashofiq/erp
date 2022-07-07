<?php

namespace App\Repositories\Customer;

use App\Repositories\Customer\CustomerInterface as CustomerInterface;
use App\Models\Customer\Customer;
use Config;

class CustomerRepository implements CustomerInterface
{
    public $customer;
    private $pagelimit;
    private $INITIALCUSTCODE = 1000;

    function __construct(Customer $customer) {
	    $this->customer = $customer;
        $this->pagelimit = Config::get('app.PAGELIMIT');
    }

    public function addCustomer($data, $custChartOfAccId){
        $customer = new $this->customer;
        $customer->companyId = $data->companyId;
        $customer->custCode = $this->getCustCode();
        $customer->custSlno = $this->getCustSlno();
        $customer->custName = $data->accHead;
        $customer->phone = $data->phone;
        $customer->email = $data->email;
        $customer->custChartOfAccId = $custChartOfAccId;
        if ($customer->save()) {
            return $customer;
        }

        return false;
    }

    public function getCustCode()
    {
        $code = $this->customer->latest()->first();
        return $code ? $code->custCode : $this->INITIALCUSTCODE;
    }

    public function getCustSlno()
    {
        return $this->customer->latest()->first()->custSlno ?? 1;
    }

    public function updateCustomer($data, $custChartOfAccId){
        $customer = $this->customer->where('custChartOfAccId', $custChartOfAccId)->first();
        $customer->companyId = $data->companyId;
        $customer->custName = $data->accHead;
        if ($customer->save()) {
            return $customer;
        }
        return false;
    }

    public function deleteCustomer($custChartOfAccId){
        $customer = $this->customer->where('custChartOfAccId', $custChartOfAccId)->first();
        if ($customer != null) {
            $customer->delete();
            return $customer;
        }
        return false;
    }
}