<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Inv_uom extends Model
{
    use HasFactory,SoftDeletes;
    protected $table = 'inv_uoms';
    protected $fillable = [ "name", "is_master", "added_by", "updated_by", "com_code", "date", "active"];
}
