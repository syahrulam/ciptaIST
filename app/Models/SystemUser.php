<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SystemUser extends Model
{
    protected $table        = 'system_user'; 
    protected $primaryKey   = 'user_id';
    
    protected $fillable = [
        'user_id',
        'user_group_id',
        'full_name',

    ];

    public function systemusergroup()
    {
        return $this->belongsTo(SystemUserGroup::class);
    }
}