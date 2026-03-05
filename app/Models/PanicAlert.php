<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PanicAlert extends Model
{
    protected $table = 'panic_alerts';

    protected $guarded = ['id'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
