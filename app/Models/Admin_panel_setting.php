<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Admin_panel_setting extends Model
{
    use HasFactory,SoftDeletes;
    protected $table = 'admin_panel_settings';
    protected $fillable = [ "system_name", "photo", "active", "general_alert", "address", "phone", "com_code", "added_by", "updated_by",];
    protected $guarded = [];
}
