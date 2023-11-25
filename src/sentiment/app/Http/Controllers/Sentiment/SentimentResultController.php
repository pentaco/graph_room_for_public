<?php

namespace App\Http\Controllers\Sentiment;

use Carbon\Carbon;
use App\Models\Room;
use App\Models\Sentiment;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class SentimentResultController extends Controller
{
    public function __invoke(Request $request, $room_code)
    {
        try {
            $room = Room::code($room_code)->first();
            if (empty($room))  throw new NotFoundHttpException("Room not found.");
            $buttons = $room->buttons;
            $interval = 5;
            $startTime = Carbon::parse($room->started_at);
            $endTime = Carbon::parse($room->ended_at);

            // 10分間隔でデータを格納するための配列を初期化
            $interval_counts = [];

            foreach ($buttons as $index => $button) {
                // 10分ごとに時間を進めながら処理
                $buttonCounts = [];

                for ($currentTime = $startTime->copy(); $currentTime->lte($endTime); $currentTime->addMinutes($interval)) {
                    if ($index === 0) $interval_times[] = Carbon::parse($currentTime)->format('Y-m-d H:i:s');
                    $nextInterval = $currentTime->copy()->addMinutes($interval);
                    $count = Sentiment::where('button_id', $button->id)->whereBetween('created_at', [$currentTime, $nextInterval])->count();
                    $buttonCounts[] = $count;
                }
                $interval_counts[] = $buttonCounts;
            }


            return response()->json(['interval_counts' => $interval_counts, 'interval_times' => $interval_times], Response::HTTP_OK);
        } catch (\Exception $e) {
            Log::error($e);
            DB::rollback();
            return response()->json("登録に失敗しました。", Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
