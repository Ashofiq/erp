<?php

namespace App\Models\Settings\CompanyAssign;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use Auth;
use Illuminate\Support\Facades\App;

class CompanyAssign extends Model
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
}
