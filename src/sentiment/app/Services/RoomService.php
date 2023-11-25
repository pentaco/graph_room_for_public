<?php

namespace App\Services;

use Carbon\Carbon;
use App\Models\Room;
use App\Rules\TwoHoursBefore;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Validator as ValidationValidator;

class RoomService
{
    public function validate(Request $request): ValidationValidator
    {
        $validation_array = [
            'started_at' => ['required', 'string'],
            'ended_at' => ['required', 'string', new TwoHoursBefore],
        ];
        // if ($is_create || $required_PDF) {
        //     $validation_array = array_merge($validation_array, ['pdf' => ['required']]);
        // }
        return Validator::make($request->all(), $validation_array);
    }

    public function getRandomName(): string
    {
        $room_names = config('room.names');
        $room_name = $room_names[array_rand($room_names)];
        return $room_name;
    }

    public function getCode(): string
    {
        do {
            $random_string = Str::random(24);
        } while (Room::where('code', $random_string)->exists());
        return $random_string;
    }

    public function getStartedAt(?string $started_at): string
    {
        if (empty($started_at)) {
            $currentDateTime = Carbon::now();
            return $currentDateTime->format('Y-m-d H:i:s');
        }
        return $started_at;
    }


    public function getEndedAt(?string $ended_at): string
    {
        if (empty($ended_at)) {
            $currentDateTime = Carbon::now();
            // 一週間後の日時を計算
            $oneWeekLater = $currentDateTime->addWeek();
            return $oneWeekLater->format('Y-m-d H:i:s');
        }
        return $ended_at;
    }
}
