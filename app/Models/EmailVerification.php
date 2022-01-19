<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmailVerification extends Model
{
    use HasFactory;
    protected $table = 'email_code_verifications';
    protected $fillable = ['code', 'is_confirmed', 'expires_at', 'user_id'];

}
