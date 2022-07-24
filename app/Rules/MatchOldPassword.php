<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use Illuminate\Support\Facades\Hash;

class MatchOldPassword implements Rule
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
        if (auth('manager')->user() != null) {
            return Hash::check($value, auth('manager')->user()->password);
        } elseif (auth('admin')->user() != null) {
            return Hash::check($value, auth('admin')->user()->password);
        } elseif (auth('assets')->user() != null) {
            return Hash::check($value, auth('assets')->user()->password);
        } else {
            return Hash::check($value, auth()->user()->password);
        }
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'The :attribute is match with old password.';
    }
}
