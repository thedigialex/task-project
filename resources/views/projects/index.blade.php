@extends('layouts.app')

@section('content')
    <h1>Projects</h1>

    <ul>
        @foreach($projects as $project)
            <li>
                <a href="{{ route('projects.show', ['project' => $project->id]) }}">{{ $project->name }}</a>
            </li>
        @endforeach
    </ul>

    <a href="{{ route('projects.create') }}">Create New Project</a>
@endsection
