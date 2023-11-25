<?php
namespace App\Http\Controllers\Button;

use App\Models\Room;
use App\Models\Phase;
use App\Models\Button;
use Illuminate\Http\Request;
use App\Consts\PhaseCodeConsts;
use App\Services\ButtonService;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;

class ButtonStoreController extends Controller
{
    public function __invoke(Request $request, $room_code)
    {
        $room = Room::code($room_code)->first();
        if(empty($room)) abort(404);

        $button_service = new ButtonService;
        $redirect_url = route('button.create', ['room_code' => $room_code]);
        $validator = $button_service->validate($request);
        if ($validator->fails()) return redirect($redirect_url)->withErrors($validator)->withInput();

        $request_buttons = $button_service->getButtonArray($request);
        try {
            DB::beginTransaction();
            foreach ($request_buttons as $number => $data) {
                if (!empty($data['button_name'])) {
                    $interval = !empty($data['interval']) ? $data['interval'] : null;
                    $limit = !empty($data['limit']) ? $data['limit'] : null;
                    Button::create([
                        'room_id' => $room->id,
                        'name' => $data['button_name'],
                        'interval' => $interval,
                        'limit' => $limit,
                    ]);
                }
            }
            $next_phase = Phase::code(PhaseCodeConsts::IMAGES)->first();
            $room->update(['phase_id' => $next_phase->id]);
            DB::commit();
        } catch (\Exception $e) {
            Log::error($e);
            DB::rollback();
        }
        return redirect(route('image.create', ['room_code' => $room_code]));
    }
}
