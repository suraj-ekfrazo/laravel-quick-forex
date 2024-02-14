<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Customers extends Model
{
    use HasFactory;
    use SoftDeletes;
    public $table = 'customers';
    public $fillable = [  'id', 'name','mobile','is_otp','created_by','created_at', 'updated_at', 'deleted_at'];
}
