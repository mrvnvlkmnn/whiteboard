<?php

namespace Tests\Feature;

use App\Project;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class projectTasksTest extends TestCase
{
    use DatabaseMigrations;

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testSeeCreatePage()
    {

        $response = $this->get('/projects');

        $response->assertStatus(200);
    }
    /*
    public function testSeeAllInputFields()
    {

        $response = $this->get(route('projects.create'));
        $response->assertSee('Q200XXde');
        foreach (config('employees.programmer') as $short => $name) {
            $response->assertSee($name);
        };
        foreach (config('employees.project_manager') as $short => $name) {
            $response->assertSee($name);
        };

    }

    public function testCreateNewProject()
    {
        $this->withoutExceptionHandling();

        $response = $this->post('/projects', [

            'survey_number' => 'Q20034de',
            'programmer' => [0 => 'DS'],
            'project_manager' => [0 => 'LH'],
            'detail' => 'Lorem Ipsum',
            'feldstart' => '2020-07-25',
            'status' => 'Kick-Off'
        ]);

        $this->assertCount(1, Project::all());
    }

    public function testUpdateProject()
    {
        $response = $this->post('/projects', [
            'survey_number' => 'Q20034de',
            'programmer' => [0 => 'DS'],
            'project_manager' => [0 => 'LH'],
            'detail' => 'Lorem Ipsum',
            'feldstart' => '2020-07-25',
            'status' => 'Kick-Off'
        ]);

        $response = $this->put('projects/1', [
            'survey_number' => 'Q20034de',
            'programmer' => [0 => 'DS'],
            'project_manager' => [0 => 'LH', 1 => 'LS'],
            'detail' => 'Lorem Ipsum dolores ignum',
            'feldstart' => '2020-07-25',
            'status' => 'Kick-Off'
        ]);

        $this->assertDatabaseHas('projects', [
            'project_manager' => 'LH,LS',
            'detail' => 'Lorem Ipsum dolores ignum',
        ]);

        $this->assertCount(1, Project::all());


    }

    public function testDatabase()
    {
        $response = $this->post('/projects', [

        ]);
    }

    */
}
