<?php

namespace App\Models;

use App\Models\Sppd;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Tempat extends Model
{
    protected $table = 'tempat';
    protected $guarded = ['id'];

    public function sppd()
    {
        return $this->BelongsTo(Sppd::class);
    }
}
