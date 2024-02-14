<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ManageSources extends Model
{
    use HasFactory;
    public $fillable = [  'id', 'source_name', 'tcs_rate','exempt', 'documents', 'status', 'created_at', 'updated_at', 'deleted_at'];
}
