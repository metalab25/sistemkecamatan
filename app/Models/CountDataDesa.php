<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CountDataDesa extends Model
{
    protected $table = 'count_data_desa';
    protected $primaryKey = 'id';
    protected $guarded = ['id'];

    public function data_desa()
    {
        return $this->belongsTo(DataDesa::class, 'data_desa_id');
    }
}
