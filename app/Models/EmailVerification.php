<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\EmailVerification
 *
 * @property int $id
 * @property int $code
 * @property string $expires_at
 * @property int $is_confirmed
 * @property int $user_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|EmailVerification newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|EmailVerification newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|EmailVerification query()
 * @method static \Illuminate\Database\Eloquent\Builder|EmailVerification whereCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EmailVerification whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EmailVerification whereExpiresAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EmailVerification whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EmailVerification whereIsConfirmed($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EmailVerification whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EmailVerification whereUserId($value)
 * @mixin \Eloquent
 * @property int $is_used
 * @method static \Illuminate\Database\Eloquent\Builder|EmailVerification whereIsUsed($value)
 */
class EmailVerification extends Model
{
    use HasFactory;
    protected $table = 'email_code_verifications';
    protected $fillable = ['code', 'is_confirmed', 'expires_at', 'user_id'];

}
