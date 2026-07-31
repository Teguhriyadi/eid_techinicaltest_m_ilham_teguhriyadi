<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;

class Operator extends Model
{
    use HasUuids;
    
    protected $table = "operator";

    protected $guarded = [""];

    protected $keyType = "string";

    public $primaryKey = 'id';
}
