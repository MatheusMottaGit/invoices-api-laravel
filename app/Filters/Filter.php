<?php

  namespace App\Filter;
  use DeepCopy\Exception\PropertyException;
  use Exception;
  use Illuminate\Http\Request;

  abstract class Filter {
    protected array $allowedOperatorsFields = [];

    protected array $translateOperators = [
      'gt' => '>',
      'gte' => '>=',
      'lt' => '<',
      'lte' => '<=',
      'eq' => '=',
      'ne' => '!=',
      'in' => 'in',
    ];

    public function filter(Request $request) {
      $where = [];
      $whereIn = [];

      if(empty($this->allowedOperatorsFields)) {
        throw new PropertyException("Property allowedOperatorsFields should not be empty.");
      }

      foreach ($this->allowedOperatorsFields as $key => $operators) {
        $queryOperator = $request->query($key);

        if($queryOperator) {
          foreach ($queryOperator as $operator => $value) {
            if (!in_array($operator, $operators)) {
              throw new Exception("Error"); // melhorar essa mensagem
            }

            if(str_contains($value, '[')) {
              $whereIn[] = [
                $key,
                explode(',', str_replace(['[', ']'], ['', ''], $value)),
                $value
              ];
            }else{
              $where[] = [
                $key,
                $this->translateOperators[$operator],
                $value
              ];
            }
          }
        }
      }

      if(empty($where) && empty($whereIn)) {
        return [];
      }

      return [
        'where' => $where,
        'whereIn' => $whereIn
      ];
    }
  }