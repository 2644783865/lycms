<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class EachRequired implements Rule
{
    /**
     * Determine if the validation rule passes.
     *
     * @param  string $attribute
     * @param  mixed $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        if (empty($value)) {
            $values = [];
        } elseif (is_string($value)) {
            $values = explode(',', $value);
        } elseif (is_array($value)) {
            $values = $value;
        } else {
            return false;
        }
        foreach ($values as $item) {
            if (strlen($item) == 0) {
                return false;
            }
        }
        return true;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return ':attribute 不能为空。';
    }
}
