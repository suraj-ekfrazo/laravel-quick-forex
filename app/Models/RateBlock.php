<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\AgentUsers;

class RateBlock extends Model
{
    use HasFactory;
    use softDeletes;
    public $fillable=['id','reference_number','branch_id','fx_currency','fx_value','purpose_id','fx_rate','deal_id','transaction_type','expiry_date','is_used','created_at','updated_at','deleted_at'];

    function getAgent(){
        return $this->hasOne(AgentUsers::class,'id','branch_id');
    }
	
	public function getPurpose()
    {
        return  $this->hasOne(ManagePurposes::class,'id','purpose_id');
    }
}
