@extends('layouts.app')

@section('title', $task->title)

@section('content')
    <div class="row">
        <div>
            <h1>{{ $task->title }}</h1>
            <span class="badge">{{ ucfirst(str_replace('_', ' ', $task->status)) }}</span>
        </div>
        <div class="actions">
            <a class="button secondary" href="{{ route('tasks.edit', $task) }}">Edit</a>
            <form action="{{ route('tasks.destroy', $task) }}" method="POST" onsubmit="return confirm('Delete this task?')">
                @csrf
                @method('DELETE')
                <button class="button danger" type="submit">Delete</button>
            </form>
        </div>
    </div>

    <section class="card" style="margin-top: 22px">
        <h2>Details</h2>
        <p>{{ $task->description ?: 'No description provided.' }}</p>
        <p><strong>Due date:</strong>
            {{ $task->due_date?->format('F j, Y') ?? 'No due date' }}
        </p>
        <p class="muted">Created {{ $task->created_at->format('F j, Y') }}</p>
    </section>

    <p><a href="{{ route('tasks.index') }}">Back to all tasks</a></p>
@endsection
