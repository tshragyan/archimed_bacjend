<?php

namespace App\Http\Controllers;

use App\Facades\TaskServiceFacade;
use App\Http\Requests\TaskCreateRequest;
use App\Http\Requests\TaskListRequest;
use App\Http\Requests\TaskUpdateRequest;
use App\Http\Resources\TaskResource;
use App\Models\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function index(TaskListRequest $request): \Illuminate\Http\JsonResponse
    {
        $tasks = TaskServiceFacade::getList($request->validated());
        $totalPages = TaskServiceFacade::getPagesCount();
        if ($tasks) {
            return response()->json([
                'success' => true,
                'tasks' => TaskResource::collection($tasks),
                'total_pages' => $totalPages,
            ]);
        }

        return response()->json([
            'success' => false
        ]);

    }

    public function create(TaskCreateRequest $request): \Illuminate\Http\JsonResponse
    {
        $data = TaskServiceFacade::create($request->validated());

        if ($data['success']) {
            return response()->json(
                [
                    'success' => true,
                    'task' => TaskResource::make($data['task']),
                ]
            );
        }

        return response()->json([
            'success' => false,
        ]);

    }

    public function update(TaskUpdateRequest $request, $id): \Illuminate\Http\JsonResponse
    {
        $success = TaskServiceFacade::update($request->validated(), $id);
        return response()->json(compact('success'));
    }

    public function get (Task $task)
    {
        return $task;
    }
}
