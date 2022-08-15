<?php

namespace App\Http\Controllers;

use App\Http\Resources\EmployeeCollection;
use App\Http\Resources\EmployeeResource;
use App\Models\Employee;
use App\Services\ApiFilters\EmployeeApiFilterService;
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

    public function readAll()
    {
        $request = request();
        $filter = new EmployeeApiFilterService();
        $conditions = $filter->get_filter_conditions($request);
        // dd($conditions);
        // dd(Employee::where($conditions)->toSql());
        $conditions = [
            ['employment_status', '=', 1]
        ];
        if (count($conditions) > 0) {
            return new EmployeeCollection(Employee::where($conditions)->paginate());
        } else {
            return new EmployeeCollection(Employee::paginate());
        }
    }

    public function read(Employee $employee)
    {
        return new EmployeeResource($employee);
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
