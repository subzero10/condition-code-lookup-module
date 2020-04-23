<?php

/*
 * This file is part of CarePlan Manager by CircleLink Health.
 */

namespace CircleLinkHealth\ConditionCodeLookup\Entities;

use Illuminate\Database\Eloquent\Model;

/**
 * Class ConditionCodeLookupCache.
 *
 * @property int            $id
 * @property string         $type
 * @property string         $code
 * @property string         $name
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property string         $request_url
 * @property string         $response_raw
 * @mixin \Eloquent
 */
class ConditionCodeLookupCache extends Model
{
    protected $fillable = [
        'type',
        'code',
        'name',
        'request_url',
        'response_raw',
    ];
    protected $table = 'condition_code_lookup_cache';
}
