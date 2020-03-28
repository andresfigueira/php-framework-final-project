<?php

namespace Traits;

trait Validation
{
    public function validateParams(array $params, array $constraints): array
    {
        $errors = [];

        foreach ($params as $key => $value) {
            if ($constraints[$key]['required'] && (is_null($value) || empty($value))) {
                $errors[$key] = 'Campo requerido';
            } else if (
                $constraints[$key]['pattern'] &&
                !preg_match($constraints[$key]['pattern'], $value)
            ) {
                $errors[$key] = 'Formato incorrecto';
            }
        }

        return [
            'errors' => $errors,
            'valid' => empty($errors),
        ];
    }
}
