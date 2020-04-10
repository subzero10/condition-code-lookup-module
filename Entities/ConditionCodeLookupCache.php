<?php

namespace subzero10\ConditionCodeLookup\Entities;

use Illuminate\Database\Eloquent\Model;

/**
 *
 * Class ConditionCodeLookupCache
 * @package CircleLinkHealth\ConditionCodeLookup\Entities
 *
 * @property int $id
 * @property string $type
 * @property string $code
 * @property string $name
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 */
class ConditionCodeLookupCache extends Model
{
    protected $table = 'condition_code_lookup_cache';

    protected $fillable = [
        'type',
        'code',
        'name',
        'request_url',
        'response_raw',
    ];
}
