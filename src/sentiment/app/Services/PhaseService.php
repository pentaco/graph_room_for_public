<?php

namespace App\Services;

use App\Consts\PhaseCodeConsts;


class PhaseService
{
    public function getCurrentPhaseURL($current_phase_code, $room_code): string
    {
        $redirect_url = "";
        switch ($current_phase_code) {
            case PhaseCodeConsts::BUTTONS:
                $redirect_url = route('button.create', ['room_code' => $room_code]);
                break;
            case PhaseCodeConsts::IMAGES:
                $redirect_url = route('image.create', ['room_code' => $room_code]);
                break;
            case PhaseCodeConsts::CREATED:
                $redirect_url = route('room', ['room_code' => $room_code]);
                break;
            default:
                $redirect_url = route('index');
                break;
        }
        return $redirect_url;
    }
}
