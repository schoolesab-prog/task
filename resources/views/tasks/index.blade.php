@extends('layouts.app')

@section('title', 'Tasks')

@section('content')
    <div class="row">
        <div>
            <h1>Tasks</h1>
            <p class="muted">Create, update, and track your tasks.</p>
        </div>
        <a class="button" href="{{ route('tasks.create') }}">Create a task</a>
    </div>

    <section class="card">
        @forelse ($tasks as $task)
            <div class="task-row row">
                <div>
                    <h3><a href="{{ route('tasks.show', $task) }}">{{ $task->title }}</a></h3>
                    <span class="badge">{{ ucfirst(str_replace('_', ' ', $task->status)) }}</span>
                    @if ($task->due_date)
                        <span class="muted">Due {{ $task->due_date->format('M j, Y') }}</span>
                    @endif
                </div>
                <a href="{{ route('tasks.edit', $task) }}">Edit</a>
            </div>
        @empty
            <p class="muted">No tasks yet. Create your first task to get started.</p>
        @endforelse

        @if ($tasks->hasPages())
            <div class="pagination">{{ $tasks->links() }}</div>
        @endif
    </section>
@endsection
