<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class MaxUserPoint implements Rule
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
        //
        return Auth::check() && $value <= Auth::user()->points;

    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return '您尚未有足夠點數可以折抵';
    }
}
