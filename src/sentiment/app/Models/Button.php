<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Button extends Model
{
    use HasFactory;
    protected $fillable =[
        'room_id',
        'name',
        'limit',
        'interval',
        'deleted_at',
    ];

    //
    // リレーション
    //-----------------------------------------------
    public function room()
    {
        return $this->belongsTo(Room::class);
    }
    public function sentiments(): HasMany
    {
        return $this->hasMany(Sentiment::class);
    }

    //
    // クエリースコープ
    //-----------------------------------------------
    public function scopeActive($query)
    {
        return $query->where('deleted_at', null);
    }
}

