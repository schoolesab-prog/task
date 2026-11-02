@extends('layouts.app')

@section('title', 'Create task')

@section('content')
    <h1>Create a task</h1>
    <p class="muted">Add a title and any details you need.</p>

    <form class="card" action="{{ route('tasks.store') }}" method="POST">
        @csrf
        @include('tasks._form')
        <div class="actions" style="margin-top: 20px">
            <button class="button" type="submit">Save task</button>
            <a class="button secondary" href="{{ route('tasks.index') }}">Cancel</a>
        </div>
    </form>
@endsection
