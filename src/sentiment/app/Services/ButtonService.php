<?php

namespace App\Services;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Validator as ValidationValidator;

class ButtonService
{
    public function validate(Request $request): ValidationValidator
    {
        $validation_array = [
            'button_name1' => ['required', 'string'],
            'button_name2' => ['required', 'string'],
            'button_name3' => ['required', 'string'],
            'button_name4' => ['required', 'string'],
        ];
        // if ($is_create || $required_PDF) {
        //     $validation_array = array_merge($validation_array, ['pdf' => ['required']]);
        // }
        return Validator::make($request->all(), $validation_array);
    }

    public function getButtonArray($request): array
    {
        $data = $request->all();
        $buttons = [];

        // リクエストデータを処理
        foreach ($data as $key => $value) {
            if (preg_match('/^(\D+)(\d+)$/', $key, $matches)) {
                $name = $matches[1]; // 文字列部分
                $number = $matches[2]; // 数字部分
                if (!empty($number) && !empty($name)) {
                    $buttons[$number][$name] = $value;
                }
            }
        }
        return $buttons;
    }
}
