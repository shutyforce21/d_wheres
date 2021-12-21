<?php

namespace App\Http\Requests\Rule;

trait PasswordValidationRules
{
    /**
     * Get the validation rules used to validate passwords.
     *
     * @return array
     */
    protected function passwordRules()
    {
        return ['required', 'string', (new Password)->requireNumeric()->requireUppercase()];
    }
}
