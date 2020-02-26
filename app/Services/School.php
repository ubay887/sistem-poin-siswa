<?php

namespace App\Services;

use App\Entities\Options\School as DataSchool;

/**
 * School Class (School).
 *
 * @author Akhmad Herdian <akhmad.herdian@gmail.com>
 */
class School
{
    protected $school;

    public function __construct()
    {
        $this->school = DataSchool::all();
    }

    public function get($key, $default = '')
    {
        $school = $this->school->where('key', $key)->first();
        if ($school) {
            return $school->value;
        }

        return $default;
    }

    public function set($key, string $value)
    {
        $school = $this->school->where('key', $key)->first();

        if ($school) {
            $school->value = $value;
            $school->save();
        } else {
            $school = new DataSchool();
            $school->key = $key;
            $school->value = $value;
            $school->save();
        }

        return $value;
    }
}
