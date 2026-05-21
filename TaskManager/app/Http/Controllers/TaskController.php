<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\TaskService;

class TaskController extends Controller
{

    private TaskService $service;

    public function __construct(TaskService $service){
        $this->service = $service;
    }

    public function index(){
        //afficher tous les tasks
        $tasks = $this->service->getAllTasks();

        return response()->json([
            'success'=> true,
            'data' => $tasks
        ]);
    }

    public function getTaskByUser(){
        //afficher les task pour le user authentifie;
        $tasks = $this->service->getTaskUser();

        return response()->json([
            'success'=> true,
            'messsage' => 'les taches pour ce user est recupere',
            'data' => $tasks,
        ]);
    }

    public function store(){
        //create noveua task
    }

    public function update(){
        //mis a jour d'un task;
    }

    public function destroy(){
        //supprimer une task;
    }

}
