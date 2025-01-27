<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Task;
use App\Models\Member;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $tasks = Task::where('assign_by', Auth::id())
                        ->leftJoin('members', function ($join) {
                            $join->on('tasks.assigned_to', '=', 'members.id')
                                ->where('members.assigned_by', '=', Auth::id());
                        })
                        ->select(
                            'tasks.*', 
                            'members.name as member_name'
                        )
                        ->paginate(7);
        return view('admin.Task.taskList',compact('tasks'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        $members = Member::where('assigned_by',Auth::user()->id)
                            ->where('deleted_at',null)
                            ->select('id', 'name')->get();

        return view('admin.Task.addTask',compact('members'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $request->validate([
            'task_name' => 'required|string|max:255',
            'due_date' => 'required|date',
            'priority' => 'required|in:low,medium,high',
            'status' => 'required|in:pending,in-progress,completed',
            'assigned_to' => 'required|exists:members,id',
            'assigned_by' => 'required|exists:users,id',
        ]);
    
        try {
            // Create a new task record
            $task = new Task();
            $task->task_name = $request->task_name;
            $task->planned_date = $request->due_date;
            $task->priority = $request->priority;
            $task->status = $request->status;
            $task->assigned_to = $request->assigned_to;
            $task->assign_by = $request->assigned_by;
            
            if($task->save()){
                return redirect('/tasks')->with('success', 'Task created successfully!');
            }
            return redirect()->back()->with('error', 'Failed to create task. Please try again later.');
            
        } catch (\Exception $e) {
            // Handle any errors and return an error message
            return redirect()->back()->with('error', 'Failed to create task. Please try again later.');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
       $task = \DB::table('tasks')
       ->join('members as assign_by_member', 'tasks.assign_by', '=', 'assign_by_member.id')
       ->join('members as assigned_to_member', 'tasks.assigned_to', '=', 'assigned_to_member.id')
       ->select('tasks.*', 'assigned_to_member.name as assigned_to_name')
       ->where('tasks.id', $id) 
       ->first();

        return view('admin.Task.updateTask',compact('task'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
