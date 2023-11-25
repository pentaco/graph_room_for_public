<?php

namespace App\Http\Controllers\Room;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class RoomThanksController extends Controller
{
    public function __invoke(Request $request, $room_code)
    {
        return view('room.thanks', compact('room_code'));
    }
}
