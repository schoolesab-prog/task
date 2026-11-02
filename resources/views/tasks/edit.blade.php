@extends('layouts.app')

@section('title', 'Edit task')

@section('content')
    <h1>Edit task</h1>
    <p class="muted">Update the task details below.</p>

    <form class="card" action="{{ route('tasks.update', $task) }}" method="POST">
        @csrf
        @method('PUT')
        @include('tasks._form')
        <div class="actions" style="margin-top: 20px">
            <button class="button" type="submit">Save changes</button>
            <a class="button secondary" href="{{ route('tasks.show', $task) }}">Cancel</a>
        </div>
    </form>
@endsection
