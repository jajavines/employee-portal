<?php

namespace App\Services\ApiFilters;

use App\Services\ApiFilterService;

class EmployeeApiFilterService extends ApiFilterService 
{
    protected $allowed_parameters = [
        'status' => ['eq'],
        'hireDate' => ['eq', 'lt', 'gt']
    ];

    protected $column_map = [
        'status' => 'employment_status'
    ];
}