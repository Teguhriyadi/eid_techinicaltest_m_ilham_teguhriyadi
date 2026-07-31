<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;

class Mesin extends Model
{
    use HasUuids;
    
    protected $table = "mesin";

    protected $guarded = [""];

    protected $keyType = "string";

    public $primaryKey = 'id';
}
