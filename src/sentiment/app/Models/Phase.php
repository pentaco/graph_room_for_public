<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Phase extends Model
{
    use HasFactory;
    //
    // クエリースコープ
    //-----------------------------------------------
    public function scopeCode($query, $code)
    {
        return $query->where('code', $code);
    }
}
