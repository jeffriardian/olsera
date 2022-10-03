<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Tax extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table      = "taxes";

    protected $fillable = [
        'id',
        'nama',
        'rate',
    ];

    public function items()
    {
        return $this->belongsToMany('App\Models\Item', 'item_taxes');
    }
}
