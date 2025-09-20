<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GaraponRewardSetting extends Model
{
    protected $table      = 'garapon_reward_setting';
    protected $primaryKey = 'setting_id';
    public    $timestamps = false;

    protected $fillable = [
        'campaign_id',
        'spin_no',
        'reward_id',
        'created_date',
        'created_user_id',
        'updated_date',
        'updated_user_id',
    ];

    protected $casts = [
        'created_date' => 'datetime',
        'updated_date' => 'datetime',
    ];

    public function reward()
    {
        return $this->belongsTo(GaraponReward::class, 'reward_id', 'reward_id');
    }

    // Nếu bạn có model Campaign (garapon_config) thì mở relation dưới:
    // public function campaign()
    // {
    //     return $this->belongsTo(GaraponConfig::class, 'campaign_id', 'campaign_id');
    // }

    public function isMiss(): bool
    {
        return is_null($this->reward_id);
    }
}
