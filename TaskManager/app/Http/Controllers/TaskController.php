<?php

namespace App\Http\Controllers;

    use App\Services\TaskService;
    use App\Http\Requests\RequestTask;
    use App\Http\Requests\UpdateTaskRequest;
    use App\Models\Task;

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
                'message' => 'les taches pour ce user est recupere',
                'data' => $tasks,
            ]);
        }

        public function store(RequestTask $request){
            
            $task = $this->service->create($request->validated());

            return response()->json([
                'success'=> true,
                'message'=> 'Task est cree avec succe',
                'data' => $task,
            ], 201);
        }

        public function update(UpdateTaskRequest $request,Task $task){

        
            $task = $this->service->modifier($request->validated(), $task);

             if(!$task){
                        return response()->json([
                            'success' => false,
                            'message' => 'vous ne pouvez pas modifier cette tache'
                        ], 403);
            }



            return response()->json([
                'success'=> true,
                'message'=> 'le task est modifier avec successe',
                'data' =>  $task,
            ], 200);
        
        }

        public function destroy(Task $task){
        
            $deleted = $this->service->supprimer($task);

            if(!$deleted){
                return response()->json([
                    'success'=> false,
                    'message'=> 'vous ne pouvez pas le droite de supprimer cette tache'
                ], 403);
            }

            return response()->json([
                'success'=> true,
                'message'=>'cette tache est supprimer avec success',

            ], 200);
        }

    }
