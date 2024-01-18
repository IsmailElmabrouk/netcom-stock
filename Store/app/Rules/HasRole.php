<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use Illuminate\Support\Facades\Auth;

class HasRole implements Rule
{
    protected $role;

    /**
     * Create a new rule instance.
     *
     * @param string $role
     */
    public function __construct($role)
    {
        $this->role = $role;
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param string $attribute
     * @param mixed $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        $user = Auth::user();

        // Check if the authenticated user has the specified role
        return $user && $user->hasRole($this->role);
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'The authenticated user does not have the required role.';
    }
}
