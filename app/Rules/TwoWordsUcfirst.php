<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class TwoWordsUcfirst implements Rule
{
    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        // if a string consist of 2 words and each starts with uppercase
        // letter, - then validation passes
        return 2 === count(explode(' ', $value))
            && ucfirst($value) === $value;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'The :attribute must consist of 2 words, each starting with uppercase letter.';
    }
}
