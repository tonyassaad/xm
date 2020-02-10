<?php

namespace App\Validators;

use Illuminate\Support\MessageBag;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Validation\Factory as IlluminateValidator;

abstract class BaseValidator
{
    protected $validator;

    protected $messageBag;

    public function __construct(IlluminateValidator $validator, MessageBag $messageBag)
    {
        $this->validator = $validator;

        $this->messageBag = $messageBag;

    }

    public function validate(array $data, array $rules = [], array $customErrors = [])
    {
        if (empty($rules) && !empty($this->rules) && is_array($this->rules)) {
            $rules = $this->rules;
        }

        $validation = $this->validator->make($data, $rules, $customErrors);
 
        if ($validation->fails()) {

            $this->messageBag->add('error', $validation->errors(), 'message', $validation->errors()->all()[0]);
             
         return(  $validation->errors()->all()[0]); 
         throw new \Illuminate\Validation\ValidationException($this, $this->messageBag);
        }

        return true;
    }
}