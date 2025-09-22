<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\GaraponSpinRequest;
use App\Http\Resources\GaraponSpinResult as GaraponSpinResultResource;
use App\Services\GaraponService;
use Illuminate\Http\Request;

class GaraponController extends Controller
{
    private $garaponService;

    public function __construct(GaraponService $garaponService)
    {
        $this->garaponService = $garaponService;
    }

    public function spin(GaraponSpinRequest $request)
    {
        $validated = $request->validated();
        $campaignId = $validated['campaign_id'];
        $checkinId = $validated['spin_checkin_id'] ?? null;

        $spinResult = $this->garaponService->spin($campaignId, $checkinId);

        return new GaraponSpinResultResource($spinResult);
    }
}
