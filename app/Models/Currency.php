<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Currency extends Model
{
    use HasFactory;
    public $table = 'currency';
    public $fillable = ['cur_id', 'currency_name', 'status'];
 
}