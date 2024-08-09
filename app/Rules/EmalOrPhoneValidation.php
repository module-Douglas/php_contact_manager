<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class EmailOrPhoneRequired implements Rule
{
    public function passes($attribute, $value)
    {
        return request()->input('email') || request()->input('phone');
    }

    public function message()
    {
        return 'O campo :attribute é obrigatório quando o email ou o telefone não estão presentes.';
    }
}