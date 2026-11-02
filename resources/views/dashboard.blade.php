@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
    <div class="row">
        <div>
            <h1>Task dashboard</h1>
            <p class="muted">A simple place to keep track of your work.</p>
        </div>
        <a class="button" href="{{ route('tasks.create') }}">Create a task</a>
    </div>

    <div class="cards">
        <div class="stat">All tasks<strong>{{ $totalTasks }}</strong></div>
        <div class="stat">Pending<strong>{{ $pendingTasks }}</strong></div>
        <div class="stat">In progress<strong>{{ $inProgressTasks }}</strong></div>
        <div class="stat">Completed<strong>{{ $completedTasks }}</strong></div>
    </div>

    <section class="card">
        <div class="row">
            <h2>Recent tasks</h2>
            <a href="{{ route('tasks.index') }}">View all</a>
        </div>
        @forelse ($recentTasks as $task)
            <div class="task-row row">
                <div>
                    <h3><a href="{{ route('tasks.show', $task) }}">{{ $task->title }}</a></h3>
                    <span class="badge">{{ ucfirst(str_replace('_', ' ', $task->status)) }}</span>
                </div>
                @if ($task->due_date)
                    <span class="muted">Due {{ $task->due_date->format('M j, Y') }}</span>
                @endif
            </div>
        @empty
            <p class="muted">No tasks yet. Create your first task to get started.</p>
        @endforelse
    </section>
@endsection
