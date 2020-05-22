@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    @if(!is_null($todo))
                    <div class="card-header">{{ __('Edit ') . '#' . $todo->id }}</div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('frontend.todo.updatePost', ['id' => $todo->id]) }}">

                            @method('PUT')
                            @csrf

                            <div class="form-group row">
                                <label for="note" class="col-md-4 col-form-label text-md-right">{{ __('Note') }}</label>

                                <div class="col-md-6">
                                    <input id="note" type="note" class="form-control @error('note') is-invalid @enderror" name="note" value="{{ old('note') ? old('note') : $todo->note }}" required autocomplete="note">

                                    @error('note')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="description" class="col-md-4 col-form-label text-md-right">{{ __('Description') }}</label>

                                <div class="col-md-6">
                                    <textarea id="description" type="description" class="form-control @error('description') is-invalid @enderror" name="description" required>{{ old('description') ? old('description') : $todo->description }}</textarea>

                                    @error('description')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('Update') }}
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                    @else
                        <div>Record not found</div>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection