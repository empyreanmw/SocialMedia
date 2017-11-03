<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use App\Inspections\FrequentPosting;

class PostingTooFrequently implements Rule
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
        return FrequentPosting::detect();
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'You are posting too frequently!';
    }
}
