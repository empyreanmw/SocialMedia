<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use App\Inspections\Spam;

class SpamDetection implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     * 
     */
    protected $spam;

    public function __construct(Spam $spam)
    {
        $this->spam = $spam;
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
        return $this->spam->check($value);
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'Your post contains spam!';
    }
}
