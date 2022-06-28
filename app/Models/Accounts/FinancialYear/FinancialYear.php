<?php

namespace App\Models\Accounts\FinancialYear;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Settings\Company\Company;

class FinancialYear extends Model
{
    use HasFactory;

    public function company()
    {
        return $this->belongsTo(Company::class, 'companyId', 'id');
    }
}
