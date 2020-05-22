@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">

            @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            @if (session('error'))
                <div class="alert alert-warning">
                    {{ session('error') }}
                </div>
            @endif

            <div class="new-button"><a href="{{ route('frontend.todo.create') }}" ><button type="button" class="btn btn-info">New record</button></a></div>
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Note</th>
                        <th scope="col">Description</th>
                        <th scope="col">Date</th>
                        <th scope="col">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($todos as $todo)
                    <tr>
                        <th scope="row">{{ $todo->id }}</th>
                        <td>{{ $todo->note }}</td>
                        <td>{{ Str::limit($todo->description, 50) }}</td>
                        <td>{{ \Carbon\Carbon::parse($todo->created_at)->format('d/m/Y') }}</td>
                        <td>
                            <div class="action-btn-group">
                                <span class="show-btn"><a href="{{ route('frontend.todo.show', ['id' => $todo->id]) }}"><i class="fa fa-eye"></i></a></span>
                                <span class="edit-btn"><a href="{{ route('frontend.todo.edit', ['id' => $todo->id]) }}"><i class="fa fa-pencil-alt"></i></a></span>
                                <span class="delete-btn">
                                    <form method="POST" action="{{ route('frontend.todo.delete') }}" onsubmit="return confirm('Are you sure you want to delete that item?')">
                                        {{ csrf_field() }}
                                        {{ method_field('DELETE') }}
                                        <input type="hidden" name="id" value="{{ $todo->id }}">
                                        <button type="submit" class="btn btn-default" aria-label="Left Align">
                                            <span class="fa fa-trash" aria-hidden="true"></span>
                                        </button>
                                    </form>
                                </span>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="align-content-md-center">{{ $todos->links() }}</div>
    </div>
</div>
@endsection