<?php
namespace App\Services;
use App\Models\Task;
use Illuminate\Support\Facades\Auth;


class TaskService {

    public function getAllTasks(){
        
        return Task::all();
    }

    public function getTaskUser(){
        $user = Auth::user();

        $tasks = Task::where('user_id', $user->id)->get();
        return $tasks;
    }

   public function create(array $data){

    $user = Auth::user();

    return Task::create([
        'title' => $data['title'],
        'description' => $data['description']??  null,
        'status' => $data['status'],
        'due_date' => $data['due_date'] ?? null,
        'user_id' => $user->id
    ]);
}

    public function modifier(array $data, Task $task){

    $user = Auth::user();

    if($task->user_id !== $user->id){
        return null;
    }

    $task->update($data);

    return $task;
}

    public function supprimer(Task $task){

            $user = Auth::user();

            if($task->user_id !== $user->id){
                return false;
            }
            $task->delete();

            return true;
        }    
}