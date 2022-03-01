<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTaskRequest;
use App\Http\Requests\UpdateTaskRequest;
use App\Models\Task;
use App\Services\GetAllTasksServices;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Log;

class TaskController extends Controller
{

    /**
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        try {
            return response()->json([
                'success' => true,
                'message' => 'Se han listado todas las tareas con éxito',
                'data' => (new GetAllTasksServices())->run()
            ], 200);
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Hubo un problema en el registro. Intentelo nuevamente.'
            ], 500);
        }
    }

    /**
     * @param StoreTaskRequest $request
     * @return JsonResponse
     */
    public function store(StoreTaskRequest $request): JsonResponse
    {
        try {
            $user = $request->user();
            $tasks = $user->tasks()->create($request->all());
            return response()->json([
                'success' => true,
                'message' => 'Se registro con éxito',
                'data' => [
                    'task_id' => $tasks->id
                ]
            ], 201);
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Hubo un problema en el registro. Intentelo nuevamente.'
            ], 500);
        }
    }

    /**
     * @param $id
     * @return JsonResponse
     */
    public function show($id): JsonResponse
    {
        if ($task = Task::find($id)) {
            return response()->json([
                'success' => true,
                'message' => 'Se obtuvo el registro con éxito.',
                'data' => [
                    'task' => $task
                ]
            ], 200);
        }
        return response()->json([
            'success' => false,
            'message' => 'La tarea en consulta no existe.'
        ], 404);
    }

    /**
     * @param UpdateTaskRequest $request
     * @param $id
     * @return JsonResponse
     */
    public function update(UpdateTaskRequest $request, $id): JsonResponse
    {
        try {
            if (!($task = Task::find($id))) {
                return response()->json([
                    'success' => false,
                    'message' => 'La tarea en consulta no existe.'
                ], 404);
            }
            $task->update($request->all());
            return response()->json([
                'success' => true,
                'message' => 'Se actualizo la tarea con éxito.',
                'data' => [
                    'task' => $task
                ]
            ], 201);
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Hubo un problema en el registro. Intentelo nuevamente.'
            ], 500);
        }
    }

}
