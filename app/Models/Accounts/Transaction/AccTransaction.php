<?php

namespace App\Models\Accounts\Transaction;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\App;
use App\Models\Accounts\Transaction\AccTransactionDetails;
use Auth;
use Carbon\Carbon;

class AccTransaction extends Model
{
    use HasFactory;

    protected $fillable = ['updatedBy', 'createdBy'];

    public static function boot()
    {
        parent::boot();
        if(!App::runningInConsole())
        {
            static::creating(function ($model)
            {
                $model->fill([
                    'createdBy' => Auth::id(),
                    'updatedBy' => Auth::id()
                ]);
            });
            static::updating(function ($model)
            {
                $model->fill([
                    'updatedBy' => Auth::id(),
                    'updated_at' => Carbon::now()
                ]);
            });
        }
    }

    public function details()
    {
        return $this->hasMany(AccTransactionDetails::class, 'accTransId')
        ->join('chart_of_accounts', 'chart_of_accounts.id', '=', 'acc_transaction_details.chartOfAccId');
    }

    // scope 
    public function scopeTransFilter($query, $transType)
    {
        return $query->where('transType', $transType);
    }


    // accessor
    public function getVourcherNoAttribute(){
        return $this->transType . "-" . $this->voucherNo;
    }
}
