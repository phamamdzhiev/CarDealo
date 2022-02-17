<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property string $email
 * @property int $token
 * @property string $created_at
 * @property string $expires_at
 */
class PasswordReset extends Model
{
    /**
     * @var array
     */
    protected $table = 'password_resets';
    protected $fillable = ['email', 'token', 'code', 'created_at', 'expires_at'];
    public $timestamps = false;

}
