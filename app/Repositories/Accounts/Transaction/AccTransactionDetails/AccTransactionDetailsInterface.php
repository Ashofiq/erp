<?php 

namespace App\Repositories\Accounts\Transaction\AccTransactionDetails;


interface AccTransactionDetailsInterface {

    public function create($request);

    public function update($id, $request);
    
    public function exist($id);
}