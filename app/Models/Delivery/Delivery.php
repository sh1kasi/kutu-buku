<?php

namespace App\Models\Delivery;

use App\Models\Indoregion\Regency;
use App\Models\Indoregion\District;
use App\Models\Indoregion\Province;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Delivery extends Model
{
    use HasFactory;

    protected $table = 'deliveries';

    protected $guarded = '';

    public function province()
    {
        return $this->belongsTo(Province::class);
    }

    public function regency()
    {
        return $this->belongsTo(Regency::class);
    }

    public function district()
    {
        return $this->belongsTo(District::class);
    }
}
