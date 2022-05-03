<?php

namespace Tests\Feature;
use App\Patient;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class DepartmentTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function only_logged_in_users_can_access_the_respective_departments()
    {
        $response = $this->get('/reception')

        ->assertRedirect('/login');
    }
    public function a_patient_can_be_added_to_the_system(){
      $this->actingAs(factory(Patient::class)->create());
      $response = $this->post('/patient/create',[
        'patient_name' => 'Test user',
        'contact' => '12345'
      ]);
      $this->assertCount(1,Patient::all());
    }

}
