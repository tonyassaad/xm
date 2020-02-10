<?php

namespace App\Validators;

class CompanyFormValidator extends BaseValidator
{
    public $rules = [
        'company_symbol' => ['required', 'string', 'max:255'],
        'email' => ['required', 'string', 'max:255'],
    ];

}