<?php

namespace App\Validations;

use App\Libraries\ExceptionValidation;

class Validate{
  public array $value;

  public function __construct($data,$rules,$messages){
    $validation = \Config\Services::validation();
    $validation->reset();
    $validation->setRules($rules, $messages);

    if (!$validation->run($data)) {
      $allErrors = [];

      foreach ($rules as $field => $fieldRules) {
        $fieldErrors = [];

        $rulesArray = explode('|', $fieldRules);

        foreach ($rulesArray as $rule) {
            // Cek apakah rule punya parameter (misal min_length[3])
          if (preg_match('/(.*?)\[(.*)\]/', $rule, $match)) {
              $ruleName = $match[1];
              $ruleParam = $match[2];
          } else {
              $ruleName = $rule;
              $ruleParam = null;
          }

          if (!$validation->check($data[$field] ?? null, $rule)) {
              // Ambil pesan sesuai rule
              $errorMessages = $validation->getErrors(); // ambil semua error
              if (isset($messages[$field][$ruleName])) {
                  $error = $messages[$field][$ruleName];
              } else {
                  $error = $validation->getError($field);
              }

              if ($error && !in_array($error, $fieldErrors)) {
                  $fieldErrors[] = $error;
              }
          }
        }

        if (!empty($fieldErrors)) {
          $allErrors[$field] = $fieldErrors;
        }
      }

      // throw new ExceptionValidation($validation->getError());
      throw new ExceptionValidation($allErrors);
      
    }

    $this->value = $data;

  }
}