<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class TiktokLink implements Rule
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
        return str_starts_with($value, 'https://www.tiktok.com');
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'The tiktok link must be valid tiktok link.';
    }
}
