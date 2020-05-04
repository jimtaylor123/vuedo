<?php

namespace App\Http\Controllers;

use App\Todo;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Resources\TodoResource;
use App\Http\Requests\StoreTodoRequest;

class TodoController extends Controller
{
    public function index()
    {
        return TodoResource::collection(Todo::all());
    }

    public function store(StoreTodoRequest $request)
    {
        $todo = (new Todo())->create($request->toArray());

        return (new TodoResource($todo))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function update()
    {

    }

    public function destroy()
    {

    }
}
