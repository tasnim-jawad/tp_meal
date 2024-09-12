<?php

namespace App\Models\Admin;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    use HasFactory;

    public function user(){
        return $this->hasMany(User::class,'department_id');
    }

    public function batch(){
        return $this->hasMany(Batch::class,'department_id');
    }
}
