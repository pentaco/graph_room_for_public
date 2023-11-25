<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Image extends Model
{
    use HasFactory;
    protected $fillable =[
        'room_id',
        'path',
        'deleted_at',
    ];

    //
    // リレーション
    //-----------------------------------------------
    public function room()
    {
        return $this->belongsTo(Room::class);
    }
    //
    // クエリースコープ
    //-----------------------------------------------
    public function scopeActive($query)
    {
        return $query->where('deleted_at', null);
    }
}
