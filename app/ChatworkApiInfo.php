<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * チャットワークのAPI情報
 * Class ChatworkApiInfo
 * @package App
 */
class ChatworkApiInfo extends Model
{
    protected $table = 'chatwork_api_infos';

    protected $fillable = [
        'id',
        'user_id',
        'token',
        'created_at',
        'updated_at',
    ];

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    /**
     * ユーザーIDに紐づくModelを返却する
     * @param $userId
     * @return null
     */
    public static function getChatworkApiInfoByUserId($userId)
    {
        if (empty($userId)) {
            return null;
        }
        return self::where('user_id', $userId)->first();
    }
}
