<?php

namespace App\Rules;

use Closure;
use Carbon\Carbon;
use Illuminate\Contracts\Validation\ValidationRule;

class TwoHoursBefore implements ValidationRule
{
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $started_at = Carbon::parse(request()->input('started_at'));
        $ended_at = Carbon::parse($value);


        if ($ended_at->diffInMinutes($started_at) > 120) {
            $fail('開始時間から2時間以内を選択してください。');
        }
    }
}
