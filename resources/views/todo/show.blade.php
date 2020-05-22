@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                @if(!is_null($todo))
                <div class="card">
                    <div class="card-header">{{ __('Show') . ' #' . $todo->id }}</div>

                    <div class="card-body">
                        <div>
                            <span>Note:</span>
                            <span>{{ $todo->note }}</span>
                        </div>
                        <div>
                            <span>Description:</span>
                            <span>{{ $todo->description }}</span>
                        </div>
                    </div>
                </div>
                @else
                <div>Record not found</div>
                @endif
                <div><a href="{{ route('frontend.todo.list') }}"><button type="button" class="btn btn-link"><< Back</button></a></div>
            </div>
        </div>
    </div>
@endsection
