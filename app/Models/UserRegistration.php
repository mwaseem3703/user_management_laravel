<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserRegistration extends Model
{
    use HasFactory;

    // Allow mass assignment for these fields later
    protected $fillable = [
        'name', 'email', 'cnic', 'telephone', 'comments', 'profile_picture'
    ];
}