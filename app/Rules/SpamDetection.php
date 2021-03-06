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
    protected $model;

    public function __construct(Spam $spam, $model)
    {
        $this->spam = $spam;
        $this->model = $model;
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
        return $this->spam->check($value, $this->model);
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
