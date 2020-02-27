<?php

namespace App\Services;

use App\Entities\Options\Option as DataOption;

/**
 * Option Class (Option).
 *
 * @author Akhmad Herdian <akhmad.herdian@gmail.com>
 */
class Option
{
    protected $option;

    public function __construct()
    {
        $this->option = DataOption::all();
    }

    public function get($key, $default = '')
    {
        $option = $this->option->where('key', $key)->first();
        if ($option) {
            return $option->value;
        }

        return $default;
    }

    public function set($key, string $value)
    {
        $option = $this->option->where('key', $key)->first();

        if ($option) {
            $option->value = $value;
            $option->save();
        } else {
            $option = new DataOption();
            $option->key = $key;
            $option->value = $value;
            $option->save();
        }

        return $value;
    }
}
