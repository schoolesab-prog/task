<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class TaskController extends Controller
{
    public function dashboard(): View
    {
        return view('dashboard', [
            'totalTasks' => Task::count(),
            'pendingTasks' => Task::where('status', 'pending')->count(),
            'inProgressTasks' => Task::where('status', 'in_progress')->count(),
            'completedTasks' => Task::where('status', 'completed')->count(),
            'recentTasks' => Task::latest()->take(5)->get(),
        ]);
    }

    public function index(): View
    {
        return view('tasks.index', [
            'tasks' => Task::latest()->paginate(10),
        ]);
    }

    public function create(): View
    {
        return view('tasks.create', [
            'task' => new Task(),
        ]);
    }

    public function store(Request $request): RedirectResponse
    {
        Task::create($this->validatedTask($request));

        return redirect()->route('tasks.index')->with('status', 'Task created successfully.');
    }

    public function show(Task $task): View
    {
        return view('tasks.show', compact('task'));
    }

    public function edit(Task $task): View
    {
        return view('tasks.edit', compact('task'));
    }

    public function update(Request $request, Task $task): RedirectResponse
    {
        $task->update($this->validatedTask($request));

        return redirect()->route('tasks.show', $task)->with('status', 'Task updated successfully.');
    }

    public function destroy(Task $task): RedirectResponse
    {
        $task->delete();

        return redirect()->route('tasks.index')->with('status', 'Task deleted successfully.');
    }

    /**
     * @return array{title: string, description: ?string, status: string, due_date: ?string}
     */
    private function validatedTask(Request $request): array
    {
        return $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'status' => ['required', 'in:pending,in_progress,completed'],
            'due_date' => ['nullable', 'date'],
        ]);
    }
}
