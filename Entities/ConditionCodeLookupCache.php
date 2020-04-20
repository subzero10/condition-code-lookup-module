<?php

namespace subzero10\ConditionCodeLookup\Entities;

use Illuminate\Database\Eloquent\Model;

/**
 * Class ConditionCodeLookupCache
 *
 * @package CircleLinkHealth\ConditionCodeLookup\Entities
 * @property int $id
 * @property string $type
 * @property string $code
 * @property string $name
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property string $request_url
 * @property string $response_raw
 * @method static \Illuminate\Database\Eloquent\Builder|\subzero10\ConditionCodeLookup\Entities\ConditionCodeLookupCache newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\subzero10\ConditionCodeLookup\Entities\ConditionCodeLookupCache newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\subzero10\ConditionCodeLookup\Entities\ConditionCodeLookupCache query()
 * @method static \Illuminate\Database\Eloquent\Builder|\subzero10\ConditionCodeLookup\Entities\ConditionCodeLookupCache whereCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\subzero10\ConditionCodeLookup\Entities\ConditionCodeLookupCache whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\subzero10\ConditionCodeLookup\Entities\ConditionCodeLookupCache whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\subzero10\ConditionCodeLookup\Entities\ConditionCodeLookupCache whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\subzero10\ConditionCodeLookup\Entities\ConditionCodeLookupCache whereRequestUrl($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\subzero10\ConditionCodeLookup\Entities\ConditionCodeLookupCache whereResponseRaw($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\subzero10\ConditionCodeLookup\Entities\ConditionCodeLookupCache whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\subzero10\ConditionCodeLookup\Entities\ConditionCodeLookupCache whereUpdatedAt($value)
 * @mixin \Eloquent
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
