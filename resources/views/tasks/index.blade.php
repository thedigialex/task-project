@extends('layouts.app')

@section('content')
    <h1>Tasks for Project {{ $projectId }}</h1>

    <ul>
        @foreach($tasks as $task)
            <li>
                <a href="{{ route('tasks.show', ['task' => $task->id]) }}">{{ $task->description }}</a>
            </li>
        @endforeach
    </ul>

    <a href="{{ route('tasks.create', ['projectId' => $projectId]) }}">Create New Task</a>
@endsection
