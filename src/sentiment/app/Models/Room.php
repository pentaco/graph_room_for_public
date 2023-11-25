<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Room extends Model
{
    use HasFactory;
    protected $fillable =[
        'phase_id',
        'name',
        'code',
        'started_at',
        'ended_at',
        'deleted_at',
    ];

    //
    // リレーション
    //-----------------------------------------------
    public function buttons(): HasMany
    {
        return $this->hasMany(Button::class);
    }
    public function sentiments(): HasMany
    {
        return $this->hasMany(Sentiment::class);
    }
    public function images(): HasMany
    {
        return $this->hasMany(Image::class);
    }

    //
    // クエリースコープ
    //-----------------------------------------------
    public function scopeActive($query)
    {
        return $query->where('deleted_at', null);
    }
    public function scopeCode($query, $code)
    {
        return $query->where('code', $code);
    }
    // 公開期間に該当するデータのみに限定する（ended_atはnullでもよい）
    public function scopeOpen($query)
    {
        $now = date('Y-m-d H:i:s');
        return $query->where('started_at', '<=', $now)->where(function ($q) use ($now) {
            $q->where('ended_at', '>', $now)->orWhereNull('ended_at');
        });
    }
}
