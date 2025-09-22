<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\BaseResource;

class GaraponSpinResult extends BaseResource
{
    public function toArray($request)
    {
        return [
            'spin_history_id' => $this->spin_history_id,
            'spin_no' => $this->spin_history_no,
            'campaign_id' => $this->spin_campaign_id,
            'spin_reward_id' => $this->spin_reward_id,
            'is_miss' => $this->is_miss,
            'reward' => $this->whenLoaded('reward', function () {
                return [
                    'reward_id' => $this->reward->reward_id,
                    'reward_name' => $this->reward->reward_name,
                    'reward_image_url' => $this->reward->reward_image_url,
                    'type' => $this->reward->whenLoaded('type', function () {
                        return [
                            'reward_type_id' => $this->reward->type->reward_type_id,
                            'reward_type_code' => $this->reward->type->reward_type_code,
                            'reward_type_name' => $this->reward->type->reward_type_name,
                            'reward_description' => $this->reward->type->reward_description,
                        ];
                    }),
                ];
            }),
        ];
    }
}
