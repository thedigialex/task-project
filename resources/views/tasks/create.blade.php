@extends('layouts.app')

@section('content')
    <h1>Create New Task for Project {{ $projectId }}</h1>

    <form action="{{ route('tasks.store', ['projectId' => $projectId]) }}" method="post">
        @csrf

        <label for="description">Description:</label>
        <input type="text" name="description" required>

        <label for="status">Status:</label>
        <select name="status" required>
            <option value="todo">To Do</option>
            <option value="in_progress">In Progress</option>
            <option value="completed">Completed</option>
        </select>

        {{-- Add more form fields as needed --}}

        <button type="submit">Create Task</button>
    </form>
@endsection
