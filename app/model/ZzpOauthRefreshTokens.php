<?php

namespace App\model;

use Illuminate\Database\Eloquent\Model;

class ZzpOauthRefreshTokens extends Model
{
    protected $table = 'oauth_refresh_tokens';
    protected $dateFormat = 'U';
    protected $fillable = [
        'user_id',
        'access_token_id',
        'revoked',
        'expires_at',
        'updated_at',
        'created_at',
    ];

    public static function checkToken($user_id){
        return self::where('user_id',$user_id)->first();
    }

    public static function add($token_data){
        return $rel = self::create($token_data);
    }
}
