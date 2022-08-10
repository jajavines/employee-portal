<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use Illuminate\Http\Request;

class EmployeesController extends Controller
{
    // Pages -----------------------------------------------------------------------------------------------------------

    public function index()
    {

    }

    // [API] CRUD ------------------------------------------------------------------------------------------------------

    public function create()
    {
        Employee::create($this->_validateRequest());        
    }

    public function read(Employee $employee)
    {
        return $employee->toJson();
    }

    public function update(Employee $employee)
    {
        $employee->update($this->_validateRequest());     
    }

    public function delete(Employee $employee)
    {
        $employee->delete();
    }

    
    // Helper Methods -------------------------------------------------------------------------------------------------

    protected function _validateRequest()
    {
        return request()->validate([
            'first_name' => 'required',
            'middle_name' => '',
            'last_name' => 'required',
            'name_suffix' => '',
            'employment_status' => '',
            'date_hired' => '',
            'date_resigned' => ''
        ]);
    }
}
