<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ManagePurposes extends Model
{
    use HasFactory;
    public $fillable = [  'id', 'purpose_name', 'purpose_code','tcs', 'documents', 'status', 'created_at', 'updated_at', 'deleted_at'];
}
