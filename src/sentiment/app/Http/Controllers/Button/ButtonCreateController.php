<?php

namespace App\Http\Controllers\Button;

use App\Models\Room;
use App\Models\Phase;
use Illuminate\Http\Request;
use App\Services\PhaseService;
use App\Consts\PhaseCodeConsts;
use App\Http\Controllers\Controller;

class ButtonCreateController extends Controller
{
    public function __invoke(Request $request, $room_code)
    {
        $room = Room::code($room_code)->first();
        if (empty($room)) abort(404);

        // 正しいPhaseではない場合はリダイレクトする
        $phase_service = new PhaseService;
        $current_phase = Phase::find($room->phase_id);
        if ($current_phase->code !== PhaseCodeConsts::BUTTONS) {
            return redirect($phase_service->getCurrentPhaseURL($current_phase->code, $room_code));
        }
        return view('button.create', compact('room_code'));
    }
}
