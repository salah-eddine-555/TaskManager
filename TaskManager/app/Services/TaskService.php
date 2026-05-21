<?php
namespace App\Services;
use App\Models\Task;


class TaskService {

    public function getAllTasks(){
        
        return Task::all();
    }

    public function getTaskUser(){
        $user = Auth::user();

        $tasks = Task::where('user_id', $user->id)->get();
        return $tasks;
    }

    public function create($data){
        
    } 

    public function modifer($data, Task $task){



    }

    public function supprimer(Task $task){
        //supprimer une tache a partire a son createur de ce tache il n'est pas le droit de supprimer autre tache 
    }

    // ce ci le service pour le controller TaskController dans ce  controller on va fait les actions 
    // pour les action CRUD qui fait a partire de utilsateur  a authentiier 
    //


    
}