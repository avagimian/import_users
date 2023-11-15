<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Import
 *
 * @property int $id;
 * @property string $type;
 * @property string $status;
 *
 */

class Import extends Model
{
    public const USER_TYPE = 'user';
    public const SUCCESS = 'success';
    public const IN_PROGRESS = 'in_progress';
    public const ERROR = 'error';

    protected $table = 'imports';

    protected $fillable = [
        'error_message',
        'status',
        'exists_counts',
        'new_counts',
        'all_counts',
        'type',
    ];

    public static function create(string $type, string $status): Import
    {
        $import = new Import();

        $import->setType($type);
        $import->setStatus($status);

        return $import;
    }

    public function setType(string $type): void
    {
        $this->type = $type;
    }

    public function setStatus(string $status): void
    {
        $this->status = $status;
    }
}
