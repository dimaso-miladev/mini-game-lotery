<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TblGaraponSetting extends Model
{
    protected $table = 'tbl_garapon_setting';
    protected $primaryKey = 'setting_id';
    public $timestamps = false;

    protected $fillable = [
        'campaign_id',
        'spin_no',
        'reward_id',
        'created_date',
        'created_user_id',
        'updated_user_id',
    ];

    protected $casts = [
        'created_date' => 'datetime',
        'updated_date' => 'datetime',
    ];

    public function reward()
    {
        return $this->belongsTo(TblGaraponReward::class, 'reward_id', 'reward_id');
    }

    // If you have a Campaign model (garapon_config), uncomment the following relationship:
    // public function campaign()
    // {
    //     return $this->belongsTo(GaraponConfig::class, 'campaign_id', 'campaign_id');
    // }

    public function isMiss(): bool
    {
        return is_null($this->reward_id);
    }
}
