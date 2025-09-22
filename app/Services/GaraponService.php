<?php

namespace App\Services;

use App\Exceptions\WpnException;
use App\Models\TblGaraponSetting;
use App\Models\TblSpinsHistory;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class GaraponService
{
    public function spin(int $campaignId, ?int $checkinId)
    {
        return DB::transaction(function () use ($campaignId, $checkinId) {
            $user = Auth::user();

            $lastSpin = TblSpinsHistory::where('spin_campaign_id', $campaignId)
                ->where('spin_kaiin_id', $user->kaiin_id)
                ->orderBy('spin_history_no', 'desc')
                ->lockForUpdate()
                ->first();

            $nextSpinNo = ($lastSpin) ? $lastSpin->spin_history_no + 1 : 1;

            $setting = TblGaraponSetting::with(['reward.type'])
                ->where('campaign_id', $campaignId)
                ->where('spin_no', $nextSpinNo)
                ->first();

            if (!$setting && TblGaraponSetting::where('campaign_id', $campaignId)->doesntExist()) {
                throw new WpnException('E405');
            }
            
            if (!$setting) {
                Log::warning('Garapon setting not found for campaign_id: ' . $campaignId . ' and spin_no: ' . $nextSpinNo);
            }

            $spinHistory = new TblSpinsHistory();
            $spinHistory->spin_history_no = $nextSpinNo;
            $spinHistory->spin_campaign_id = $campaignId;
            $spinHistory->spin_kaiin_id = $user->kaiin_id;
            $spinHistory->spin_checkin_id = $checkinId;
            $spinHistory->spin_reward_id = $setting->reward_id ?? null;
            $spinHistory->created_user_id = $user->kaiin_id;
            $spinHistory->updated_user_id = $user->kaiin_id;
            $spinHistory->save();

            if ($setting && $setting->reward) {
                $spinHistory->setRelation('reward', $setting->reward);
            }

            return $spinHistory;
        });
    }
}
