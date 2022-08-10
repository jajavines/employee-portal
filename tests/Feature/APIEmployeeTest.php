<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Employee;

class APIEmployeeTest extends TestCase
{
    use RefreshDatabase;


    // [API] CRUD ------------------------------------------------------------------------------------------------------
    public function test_employee_can_be_created() 
    {
        $response = $this->post('/api/employee', $this->_data());

        $response->assertOk();

        $this->assertCount(1, Employee::all());
    }



    public function test_employee_can_be_read()
    {
        Employee::factory()->count(3)->create();
        $this->assertDatabaseCount('employees', 3);

        $emp = Employee::first();
        $response = $this->get('/api/employee/'.$emp->id);

        $response->assertOk();
        $response->assertJsonStructure();
        $this->assertIsString($response->decodeResponseJson()['first_name']);
    }



    public function test_employee_can_be_updated()
    {
        $this->post('/api/employee', $this->_data());

        $employee = Employee::first();

        $response = $this->patch('/api/employee/'.$employee->id, [
            'first_name' => 'John',
            'middle_name' => 'Saints',
            'last_name' => 'Doe'
        ]);

        $response->assertOk();

        $updated_employee = Employee::first();

        $this->assertEquals('John', $updated_employee->first_name);
        $this->assertEquals('Saints', $updated_employee->middle_name);
        $this->assertEquals('Doe', $updated_employee->last_name);
    }



    public function test_employee_can_be_deleted()
    {
        $this->post('/api/employee', $this->_data());

        $employee = Employee::first();
        $this->assertCount(1, Employee::all());

        $response = $this->delete('/api/employee/'.$employee->id);

        $response->assertOk();
        $this->assertCount(0, Employee::all());
    }


    // Validations ------------------------------------------------------------------------------------------------------
    public function test_firstname_is_required()
    {
        $no_first_name = array_merge($this->_data(), ['first_name' => '']);
        $response = $this->post('/api/employee', $no_first_name);

        $response->assertSessionHasErrors('first_name');
    }



    public function test_lastname_is_required()
    {
        $response = $this->post('/api/employee', [
            'first_name' => 'Juan',
            'middle_name' => 'Santos',
            'last_name' => ''
        ]);

        $response->assertSessionHasErrors('last_name');
    }


    // Test Helpers ---------------------------------------------------------------------------------------------------
    protected function _data() {
        return [
            'first_name' => 'Juan',
            'middle_name' => 'Santos',
            'last_name' => 'Dela Cruz'
        ];
    }
}
