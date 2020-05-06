<?php

namespace App\Http\Controllers;

use App\Todo;
use Illuminate\Http\Response;
use App\Http\Resources\TodoResource;
use App\Http\Requests\StoreTodoRequest;
use App\Http\Requests\UpdateTodoRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class TodoController extends Controller
{
    public function index() : AnonymousResourceCollection
    {
        return TodoResource::collection(Todo::all());
    }

    public function store(StoreTodoRequest $request) : JsonResponse
    {
        $todo = (new Todo())->create($request->toArray());

        return (new TodoResource($todo))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function update(UpdateTodoRequest $request, Todo $todo) : JsonResponse
    {
        collect($todo->attributesToArray())->map(function($value, $attribute) use($request, $todo) {
            if(isset($request->$attribute) || $attribute == 'due_by'){
                $todo->$attribute = $request->$attribute;
            }
        });

        $todo->save();

        return (new TodoResource($todo))
            ->response()
            ->setStatusCode(Response::HTTP_OK);
    }

    public function destroy(Todo $todo)
    {
        $todo->delete();
        return response([], Response::HTTP_NO_CONTENT);
    }
}
