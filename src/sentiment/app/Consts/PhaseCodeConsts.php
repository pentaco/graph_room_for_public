<?php
namespace App\Consts;

class PhaseCodeConsts
{
    const BASIC = '01';
    const BUTTONS = '10';
    const IMAGES = '20';
    const CREATED = '50';
    const PHASE_CODE_LIST = [
        self::BASIC => '基本情報入力',
        self::BUTTONS => 'ボタン入力',
        self::IMAGES => '画像選択',
        self::CREATED => '作成完了'
    ];
}