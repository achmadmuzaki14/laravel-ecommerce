<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    use HasFactory;
    protected $table = "profiles";
    protected $fillable = [
        'address',
        'phone',
        'gender',
        'user_id',
        'dob',
        'picture'
    ];

    public function user(){
        return $this->belongsTo('App\User');
    }
}
