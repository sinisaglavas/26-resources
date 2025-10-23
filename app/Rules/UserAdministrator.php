<?php

namespace App\Rules;

use App\Models\User;
use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class UserAdministrator implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string, ?string=): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $isAdministrator = User::where('id', $value)->where('role', User::ROLE_ADMINISTRATOR)->exists();

        if (!$isAdministrator)
        {
            $fail('This user is not administrator');
        }
    }
}
