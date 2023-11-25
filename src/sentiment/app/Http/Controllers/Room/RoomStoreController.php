<?php
namespace App\Http\Controllers\Room;

use App\Http\Controllers\Controller;

use App\Models\Room;
use App\Models\Phase;
use Illuminate\Http\Request;
use App\Services\RoomService;
use App\Consts\PhaseCodeConsts;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class RoomStoreController extends Controller
{
    public function __invoke(Request $request)
    {
        $room_service = new RoomService();
        $redirect_url = route('room.create');
        $validator = $room_service->validate($request);
        if ($validator->fails()) return redirect($redirect_url)->withErrors($validator)->withInput();

        try {
            DB::beginTransaction();
            // name
            $room_name = $request->room_name;
            if (empty($room_name)) $room_name = $room_service->getRandomName();
            //code
            $code = $room_service->getCode();
            // phase_id
            $next_phase = Phase::code(PhaseCodeConsts::BUTTONS)->first();
            // started_at
            $started_at = $room_service->getStartedAt($request->started_at);
            // ended_at
            $ended_at = $room_service->getEndedAt($request->ended_at);

            $room = Room::create([
                'phase_id' => $next_phase->id,
                'name' => $room_name,
                'code' => $code,
                'started_at' => $started_at,
                'ended_at' => $ended_at,
            ]);
            DB::commit();
        } catch (\Exception $e) {
            Log::error($e);
            DB::rollback();
        }
        return redirect(route('button.create', ['room_code' => $room->code]));
    }
}
