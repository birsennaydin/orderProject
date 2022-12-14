<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Orders extends Model
{
    use HasFactory;
    protected $primaryKey = 'id';
    protected $table = 'orders';
    protected $guarded = [];
    protected $hidden = [
        'created_at',
        'updated_at',
    ];
}
