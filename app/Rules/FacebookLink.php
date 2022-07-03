<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class FacebookLink implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        return str_starts_with($value, 'https://fb.watch');
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'The facebook link must be valid facebook link.';
    }
}
