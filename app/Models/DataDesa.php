<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DataDesa extends Model
{
    protected $table = 'data_desa';
    protected $primaryKey = 'id';
    protected $guarded = ['id'];

    public function count_data_desa()
    {
        return $this->hasOne(CountDataDesa::class, 'data_desa_id');
    }
}
