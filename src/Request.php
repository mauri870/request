<?php

namespace Mauri870\Request;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Validator;

/**
 * Class Request
 * @package Mauri870\Request
 */
abstract class Request extends FormRequest {
    /**
     * Call the parent constructor and initialize the validator instance
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Register the validate* methods found in the class
     */
    public function autoRegister()
    {
        $methods = get_class_methods($this);

        foreach ($methods as $method) {
            $this->registerCustomRule($method);
        }
    }

    /**
     * Register a custom rule in the class.
     *
     * If the method matches the pattern validate*, then it will be registered like an validator extension
     *
     * @param string $method
     */
    private function registerCustomRule($method)
    {
        if( ! preg_match('/^validate.+/', $method))
            return;

        $validation = snake_case(substr($method, 8));

        Validator::extend($validation, function($attribute, $value, $parameters) use ($method) {
            return $this->$method($attribute, $value, $parameters);
        });
    }

    /**
     * Call the autoRegister method to register the custom rules and trigger the parent validate method.
     */
    public function validate()
    {
        $this->autoRegister();
        parent::validate();
    }

    /**
     * Call the autoRegister method to register the custom rules and trigger the parent validate method.
     */
    public function validateResolved()
    {
        $this->autoRegister();
        parent::validateResolved();
    }

}
