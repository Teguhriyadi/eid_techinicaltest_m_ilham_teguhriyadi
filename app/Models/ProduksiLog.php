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

    public const SHIFT_PAGI = 'Pagi';
    public const SHIFT_SIANG = 'Siang';
    public const SHIFT_MALAM = 'Malam';

    public const SHIFT = [
        self::SHIFT_PAGI,
        self::SHIFT_SIANG,
        self::SHIFT_MALAM,
    ];

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

    public function mesin()
    {
        return $this->belongsTo(Mesin::class, "mesin_id");
    }

    public function operator()
    {
        return $this->belongsTo(Operator::class, "operator_id");
    }
}
