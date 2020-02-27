<?php

namespace App\Http\Controllers;

use App\Task;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    /**
     * @return mixed
     */
    public function fetchAll(){
        $tasks = Task::all();
        //return response()->json($tasks);
        return $tasks;
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function store(Request $request){
        $task = Task::create($request->all());
        broadcast(new TaskCreated($task));
        return response()->json("added");
    }

    /**
     * @param $id
     * @return JsonResponse
     */
    public function delete($id){
        $task = Task::find($id);
        broadcast(new TaskRemoved($task));
        Task::destroy($id);
        return response()->json("deleted");
    }
}
