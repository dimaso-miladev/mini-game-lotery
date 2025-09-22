<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MstRewardType extends Model
{
    protected $table = 'mst_reward_type';
    protected $primaryKey = 'reward_type_id';
    public $incrementing = false;
    protected $keyType = 'int';
    public $timestamps = false;

    protected $fillable = [
        'reward_type_id',
        'reward_type_code',
        'reward_type_name',
        'reward_description',
        'created_date',
        'created_user_id',
        'updated_user_id',
    ];

    protected $casts = [
        'created_date' => 'datetime',
        'updated_date' => 'datetime',
    ];

    public function rewards()
    {
        return $this->hasMany(GaraponReward::class, 'reward_type_id', 'reward_type_id');
    }
}
