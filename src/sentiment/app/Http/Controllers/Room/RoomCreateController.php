<?php
namespace App\Http\Controllers\Room;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

class RoomCreateController extends Controller
{
    public function __invoke(Request $request)
    {
        return view('room.create');
    }
}
