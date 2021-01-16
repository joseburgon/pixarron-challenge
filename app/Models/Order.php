<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $casts = [
        'shipped' => 'boolean',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    public function getUpdatedAtAttribute($value) {

        return Carbon::parse($value, 'UTC')->format(DATE_RFC2822);

    }
    public function getCreatedAtAttribute($value) {

        return Carbon::parse($value, 'UTC')->format(DATE_RFC2822);

    }

    public function products()
    {
        return $this->belongsToMany(Product::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
