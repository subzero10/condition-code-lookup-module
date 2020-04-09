<?php

namespace subzero10\ConditionCodeLookup;

interface ConditionCodeLookup
{
    public function icd9($value);
    public function icd10($value);
    public function snomed($value);
    public function any($value);
}
