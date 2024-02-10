<?php

namespace App\Services;

use App\Enums\TaskSortEnum;
use App\Enums\TaskStatusEnum;
use App\Facades\UserServiceFacade;
use App\Models\Task;
use App\Models\User;
use Illuminate\Support\Facades\Log;

class TaskService
{
    public function create(array $data): array
    {
        try {
            $user = User::where('email', $data['email'])
                ->where('name', $data['name'])
                ->first();

            if (!$user) {
                $user = UserServiceFacade::create(['name' => $data['name'], 'email' => $data['email']]);
            }

            $task = new Task();
            $task->text = $data['text'];
            $task->status = TaskStatusEnum::NOT_DONE;
            $task->user_id = $user->id;
            $task->save();
            return [
                'task' => $task,
                'success' => true,
            ];

        } catch (\Throwable $e) {
            Log::error($e->getMessage() . ' ' . $e->getFile() . ' ' . $e->getLine());

            return [
                'success' => false,
            ];
        }

    }

    public function update(array $data, $id): bool
    {
        try {
            $task = Task::find($id);
            if ($data['text'] !== $task->text) {
                $task->is_changed = true;
                $task->text = $data['text'];
            }

            if ($data['status'] !== $task->status) {
                $task->is_changed = true;
                $task->status = $data['status'];
            }

            $task->save();

            return true;

        } catch (\Throwable $e) {
            Log::error($e->getMessage() . ' ' . $e->getFile() . ' ' . $e->getLine());
            return false;
        }
    }

    public function getList(array $data): \Illuminate\Database\Eloquent\Collection|array|bool
    {
        try {
            $page = $data['page'];
            $offset = ($page - 1) * Task::LIST_LIMIT;
            $query = Task::query();

            if (isset($data['sort'])) {
                $query->leftJoin('users', 'tasks.user_id', '=', 'users.id');
                if ($data['sort'] === TaskSortEnum::NAME->value) {
                    $query->orderBy('users.name', $data['order']);
                } else if ($data['sort'] === TaskSortEnum::EMAIL->value) {
                    $query->orderBy('users.email', $data['order']);
                } else {
                    $query->orderBy('status', $data['order']);
                }
            }

            return $query->offset($offset)
                ->limit(Task::LIST_LIMIT)
                ->get();
        } catch (\Throwable $e) {
            Log::error($e->getMessage() . ' ' . $e->getFile() . ' ' . $e->getLine());
            return false;
        }
    }

    public function getPagesCount(): int
    {
        return ceil(Task::all()->count() / Task::LIST_LIMIT);
    }
}
