<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;

class ProduksiLog extends Model
{
    use HasUuids;
    
    protected $table = "produksi_log";

    protected $guarded = [""];

    protected $keyType = "string";

    public $primaryKey = 'id';
}
