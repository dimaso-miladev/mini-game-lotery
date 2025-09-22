<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TblGaraponReward extends Model
{
    protected $table = 'tbl_garapon_reward';
    protected $primaryKey = 'reward_id';
    public $timestamps = false;

    protected $fillable = [
        'reward_type_id',
        'reward_name',
        'reward_image_url',
        'created_date',
        'created_user_id',
        'updated_user_id',
    ];

    protected $casts = [
        'created_date' => 'datetime',
        'updated_date' => 'datetime',
    ];

    public function type()
    {
        return $this->belongsTo(MstRewardType::class, 'reward_type_id', 'reward_type_id');
    }

    public function settings()
    {
        return $this->hasMany(TblGaraponSetting::class, 'reward_id', 'reward_id');
    }

    public function spinHistories()
    {
        return $this->hasMany(TblSpinsHistory::class, 'spin_reward_id', 'reward_id');
    }
}
