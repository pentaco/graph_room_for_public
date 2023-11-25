<?php

namespace App\Http\Controllers\Sentiment;

use App\Models\Room;
use App\Models\Button;
use App\Models\Sentiment;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class SentimentStoreController extends Controller
{
    public function __invoke(Request $request)
    {
        try {
            $room = Room::code($request->room_code)->first();
            $button = Button::find($request->button_id);
            if (empty($room) || empty($button))  throw new NotFoundHttpException("Room not found.");
            Sentiment::create([
                'room_id' => $room->id,
                'button_id' => $button->id,
            ]);
            return response()->json("sentimentを登録しました。", Response::HTTP_OK);
        } catch (\Exception $e) {
            Log::error($e);
            DB::rollback();
            return response()->json("登録に失敗しました。", Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
