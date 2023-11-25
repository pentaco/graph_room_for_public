<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sentiment extends Model
{
    use HasFactory;
    protected $fillable =[
        'room_id',
        'button_id',
        'deleted_at',
    ];

    //
    // リレーション
    //-----------------------------------------------
    public function room()
    {
        return $this->belongsTo(Room::class);
    }
    public function button()
    {
        return $this->belongsTo(Bu::class);
    }

    //
    // クエリースコープ
    //-----------------------------------------------
    public function scopeActive($query)
    {
        return $query->where('deleted_at', null);
    }
}
