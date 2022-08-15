<?php

namespace App\Services;

use Illuminate\Http\Request;

class ApiFilterService {
    protected $allowed_parameters = [];

    protected $column_map = [];    

    protected $operator_map = [
        'eq' => '=',
        'lt' => '<',
        'gt' => '>'
    ];

    public function get_filter_conditions(Request $request) : array
    {
        $conditions = [];

        foreach ($this->allowed_parameters as $parameter_name => $operators) {
            $param = $request->query($parameter_name);
            
            if (isset($param)) {
                $column = (array_key_exists($parameter_name, $this->column_map)) ? $this->column_map[$parameter_name] : $parameter_name ;  

                foreach($operators as $operator_key) {
                    if (isset($param[$operator_key])) {
                        $conditions[] = [$column, $this->operator_map[$operator_key], $param[$operator_key]];
                    }
                }
            }
        }

        return $conditions;
    }
}