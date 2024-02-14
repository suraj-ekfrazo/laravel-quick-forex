<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Payments extends Model
{
    use HasFactory;
    use SoftDeletes;
    public $table = 'payments';
    public $fillable = [  'id', 'user_id','transaction_id','r_payment_id','method','currency', 'user_email', 'amount','json_response','created_at'];
}
