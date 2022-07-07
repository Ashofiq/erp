<?php

namespace App\Models\Accounts\ChartOfAccount;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Settings\Company\Company;
use App\Models\Accounts\Transaction\AccTransactionDetails;

class ChartOfAccount extends Model
{
    use HasFactory;

    const CASHATBANKID = 6;
    const CASHINHAND = 5;

    public function company()
    {
        return $this->belongsTo(Company::class, 'companyId', 'id');
    }

    public function transactiondetails()
    {
        return $this->hasMany(AccTransactionDetails::class, 'chartOfAccId', 'id');
    }
}
