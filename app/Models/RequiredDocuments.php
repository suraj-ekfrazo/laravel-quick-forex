<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RequiredDocuments extends Model
{
    use HasFactory;
    public $fillable = [  'id', 'document_name','created_at', 'updated_at', 'deleted_at'];
}
