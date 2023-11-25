<?php
namespace App\Http\Controllers\Image;

use App\Models\Room;
use App\Models\Image;
use App\Models\Phase;
use Illuminate\Http\Request;
use App\Services\ImageService;
use App\Consts\PhaseCodeConsts;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class ImageStoreController extends Controller
{
    public function __invoke(Request $request, $room_code)
    {
        $room = Room::code($room_code)->first();
        if (empty($room)) abort(404);

        try {
            DB::beginTransaction();
            $images = [];
            $data_urls = $request->base64_upfiles;
            foreach ($data_urls as $data_url) {
                if (empty($data_url)) continue;
                $image_service = new ImageService;
                $image = $image_service->decodeDataUrl($data_url);
                $validation_result = $image_service->validateImage($image);
                if (!empty($validation_result)) {
                    return redirect(route('image.create'))
                        ->with('error', $validation_result);
                }
                $images[] = $image;
            }
            foreach ($images as $image) {
                $result = Storage::disk('public')->put($image['path'], $image['data']);
                if ($result) {
                    Image::create([
                        'room_id' => $room->id,
                        'path' => $image['path'],
                    ]);
                } else {
                    throw new \Exception("画像の登録に失敗しました。");
                }
            }
            $next_phase = Phase::code(PhaseCodeConsts::CREATED)->first();
            $room->update(['phase_id' => $next_phase->id]);
            DB::commit();
        } catch (\Exception $e) {
            Log::error($e);
            DB::rollback();
        }
        return redirect(route('room.thanks', ['room_code' => $room_code]));
    }
}
