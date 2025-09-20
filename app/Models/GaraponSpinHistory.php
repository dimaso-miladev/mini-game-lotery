<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GaraponSpinHistory extends Model
{
    protected $table = 'garapon_spin_history';
    protected $primaryKey = 'spin_id';
    public $timestamps = false;

    protected $fillable = [
        'spin_no',
        'campaign_id',
        'spin_kaiin_id',
        'spin_checkin_id',
        'spin_reward_id',
        'created_date',
        'created_user_id',
        'updated_date',
        'updated_user_id',
    ];

    protected $casts = [
        'created_date' => 'datetime',
        'updated_date' => 'datetime',
    ];

    // QUAN HỆ
    public function reward()
    {
        return $this->belongsTo(GaraponReward::class, 'spin_reward_id', 'reward_id');
    }

    // Nếu đã có model Campaign (garapon_config), bật relation:
    // public function campaign()
    // {
    //     return $this->belongsTo(GaraponConfig::class, 'campaign_id', 'campaign_id');
    // }

    public function getIsMissAttribute(): bool
    {
        return is_null($this->spin_reward_id);
    }
}
