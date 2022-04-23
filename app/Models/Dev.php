<?php

namespace App\Models;

use App\Notifications\ResetPassword;
use App\Notifications\VerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Notifications\Notifiable;

class Dev extends Model//, MustVerifyEmail
{
    use Notifiable,
        HasFactory;
        
    protected $dates = ['created_at', 'updated_at']; 
    protected $guarded = []; 

}
