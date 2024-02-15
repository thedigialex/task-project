@extends('layouts.app')

@section('content')
    <h1>Edit Task: {{ $task->description }}</h1>

    <form action="{{ route('tasks.update', ['task' => $task->id]) }}" method="post">
        @csrf
        @method('PUT')

        <label for="description">Description:</label>
        <input type="text" name="description" value="{{ $task->description }}" required>

        <label for="status">Status:</label>
        <select name="status" required>
            <option value="todo" {{ $task->status === 'todo' ? 'selected' : '' }}>To Do</option>
            <option value="in_progress" {{ $task->status === 'in_progress' ? 'selected' : '' }}>In Progress</option>
            <option value="completed" {{ $task->status === 'completed' ? 'selected' : '' }}>Completed</option>
        </select>

        {{-- Add more form fields as needed --}}

        <button type="submit">Update Task</button>
    </form>
@endsection
