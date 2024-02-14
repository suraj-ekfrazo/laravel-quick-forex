<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TransactionCurrency extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table = 'transaction_currency';
    public $fillable = [  'id', 'txn_id','txn_currency_type','txn_frgn_curr_amount','txn_inr_amount','txn_booking_rate','txn_agent_commission','txn_branch_margin','txn_rate_block_id','branch_id'];

    public function transactionData(){
        return $this->hasOne(Transactions::class,'txn_number','txn_id')->with('purposeData')->with('sourceData');
    }

    public function getRateBlockData(){
        return $this->hasOne(RateBlock::class,'id','txn_rate_block_id');
    }
	
	 public function getAgent(){
        return $this->hasOne(AgentUsers::class,'id','branch_id');
    }

    public function transactionStatus(){
        return $this->transactionData()->where('is_active','=',1);
    }
}
