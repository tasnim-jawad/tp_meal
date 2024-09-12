<?php

namespace App\Models\Admin;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Batch extends Model
{
    use HasFactory;

    public function user(){
        return $this->hasMany(User::class,'batch_id');
    }

    public function department()                             //A user can have only one user_role
    {
        return $this->belongsTo(Department::class);
    }
}
