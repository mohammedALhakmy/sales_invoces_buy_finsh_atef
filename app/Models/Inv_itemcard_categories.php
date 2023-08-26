<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Inv_itemcard_categories extends Model
{
    use HasFactory,SoftDeletes;
    protected $table = 'inv_itemcard_categories';
    protected $fillable = ["name", "added_by", "updated_by", "com_code", "active", "date"];
}
