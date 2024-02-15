@extends('layouts.app')

@section('content')
    <h1>{{ $task->description }}</h1>

    <p>Status: {{ $task->status }}</p>

    <a href="{{ route('tasks.edit', ['task' => $task->id]) }}">Edit Task</a>
@endsection
