<?php

namespace App\Models;

use App\Models\Province;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Config extends Model
{
    protected $table = 'configs';
    protected $primaryKey = 'id';
    protected $guarded = ['id'];

    public function provinsi(): BelongsTo
    {
        return $this->belongsTo(Province::class, 'provinsi_id');
    }
}
