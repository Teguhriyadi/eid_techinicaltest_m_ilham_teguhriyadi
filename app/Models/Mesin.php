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

    public const STATUS_RUNNING = 'Running';
    public const STATUS_IDLE = 'Idle';
    public const STATUS_MAINTENANCE = 'Maintenance';
    public const STATUS_ERROR = 'Error';

    public const STATUS = [
        self::STATUS_RUNNING,
        self::STATUS_IDLE,
        self::STATUS_MAINTENANCE,
        self::STATUS_ERROR,
    ];
}
