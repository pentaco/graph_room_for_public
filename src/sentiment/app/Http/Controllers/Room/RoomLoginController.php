<?php

namespace App\Http\Controllers\Room;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class RoomLoginController extends Controller
{
    public function __invoke(Request $request)
    {
        $room_code = $request->room_code;
        return redirect(route('room', ['room_code' => $room_code]));
    }
}
