<?php

namespace Tests\Feature;

use App\Todo;
use Tests\TestCase;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class TodoTest extends TestCase
{
    use RefreshDatabase;

    public function setUp(): void
    {
        parent::setUp();
        Artisan::call('migrate');
    }

    public function tearDown(): void
    {
        parent::tearDown();
    }

    /**
     * Check all required fields are requried
     *
     * @return void
     */
    /** @test */
    public function fields_are_required()
    {
        collect(['description', 'complete'])
            ->each(function ($field) {
                $response = $this->post(
                    '/api/todos',
                    array_merge($this->data(), [$field => ''])
                );

                $response->assertSessionHasErrors($field);
                $this->assertCount(0, Todo::all());
            });
    }

    /** @test */
    public function a_todo_can_be_created()
    {
        $response = $this->post(
            '/api/todos',
            $this->data()
        );

        $response->assertStatus(201);

        $todo = Todo::first();

        $this->assertTrue($todo->description === $this->data()['description']);
        $this->assertTrue($todo->complete === $this->data()['complete']);
        $this->assertTrue($todo->due_by === $this->data()['due_by']);
    }

    /** @test */
    public function a_todo_can_be_amended()
    {
        // Create todo
        $this->post(
            '/api/todos',
            $this->data()
        );

        $todo = Todo::first();

        $response = $this->patch(
            "/api/todos/$todo->id",
            ['description' => 'A different description']
        );

        $response->assertStatus(200);

        $updatedTodo = Todo::first();

        $this->assertTrue($updatedTodo->description === 'A different description');
    }

    private function data()
    {
        return [
            'description' => 'ET go home',
            'complete' => false,
            'due_by' => '2020-12-31 12:10:00',
        ];
    }
}
