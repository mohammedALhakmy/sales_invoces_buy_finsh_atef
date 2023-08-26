<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Store extends Model
{
    use HasFactory,SoftDeletes;
    protected $table = 'stores';
    protected $fillable = ["name", "phones", "address", "com_code", "active", "date", "added_by", "updated_by"];
}
