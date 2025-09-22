<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TblSpinsHistory extends Model
{
    protected $table = 'tbl_spins_history';
    protected $primaryKey = 'spin_history_id';
    public $timestamps = false;

    protected $fillable = [
        'spin_history_no',
        'spin_campaign_id',
        'spin_kaiin_id',
        'spin_checkin_id',
        'spin_reward_id',
        'created_date',
        'created_user_id',
        'updated_user_id',
    ];

    protected $casts = [
        'created_date' => 'datetime',
        'updated_date' => 'datetime',
    ];

    // RELATIONSHIPS
    public function reward()
    {
        return $this->belongsTo(TblGaraponReward::class, 'spin_reward_id', 'reward_id');
    }

    // If you have a Campaign model (garapon_config), uncomment the following relationship:
    // public function campaign()
    // {
    //     return $this->belongsTo(GaraponConfig::class, 'spin_campaign_id', 'campaign_id');
    // }

    public function getIsMissAttribute(): bool
    {
        return is_null($this->spin_reward_id);
    }
}
