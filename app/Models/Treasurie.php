<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Treasurie extends Model
{
    use HasFactory,SoftDeletes;
    protected  $table = 'treasuries';
    protected  $fillable = ["name", "is_master", "active","last_isal_exchange", "last_isal_collect", "added_by", "updated_by", "com_code", "date",];
}

