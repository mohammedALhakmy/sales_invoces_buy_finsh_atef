<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Treasurie_deliveries extends Model
{
    use HasFactory,SoftDeletes;

    protected $table = 'treasurie_deliveries';
    protected $fillable = [ "treasurie_id", "treasuries_can_delivery_id", "added_by", "updated_by", "com_code"];

}
