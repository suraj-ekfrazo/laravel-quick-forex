<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RateMargin extends Model
{
    use HasFactory;
    public $table = 'rate_margin';
    public $fillable = [  'id', 'currency_name', 'xe_rate', 'sell_margin_10_12', 'sell_margin_12_2', 'sell_margin_2_3_30', 'sell_margin_3_30_end', 'holiday_margin', 'datetime'];
}
