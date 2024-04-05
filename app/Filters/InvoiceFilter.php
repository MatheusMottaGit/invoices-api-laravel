<?php

namespace App\Filters;
use App\Filter\Filter;
use DeepCopy\Exception\PropertyException;
use Illuminate\Http\Request;

class InvoiceFilter extends Filter {
  protected array $allowedOperatorsFields = [
    'value' => ['gt', 'eq', 'lt', 'gte', 'lte', 'ne'],
    'type' => ['eq', 'ne', 'in'],
    'isPaid' => ['eq', 'ne'],
    'payment_date' => ['gt', 'eq', 'lt', 'gte', 'lte', 'ne'],
  ];

  // public function filter(Request $request) {
  //   $where = [];
  //   $whereIn = [];

  //   if(empty($this->allowedOperatorsFields)) {
  //     throw new PropertyException("Property allowedOperatorsFields is should not be empty.");
  //   }
  // }
}