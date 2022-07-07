<?php 

namespace App\Repositories\Customer;


interface CustomerInterface {

    public function addCustomer($data, $custChartOfAccId);

    public function updateCustomer($data, $custChartOfAccId);

    public function deleteCustomer($custChartOfAccId);
}