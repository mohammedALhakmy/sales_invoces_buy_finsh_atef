<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Sales_matrial_type extends Model
{
    use HasFactory,SoftDeletes;
    protected $table = 'sales_matrial_types';
    protected $fillable = [ "name", "added_by", "updated_by", "com_code", "date", "active"];
}
