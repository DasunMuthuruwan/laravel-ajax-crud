@extends('layouts.app')
@section('content')
<div class="container">
    <div class="d-flex bd-highlight mb-4">
        <div class="p-2 w-100 bd-highlight">
            <h3>Laravel AJAX Example</h3>
        </div>
    </div>
    <form action="/savetodo" method="post">
        @csrf
        <div class="form-group">
            <input name="title" type="text" class="form-control {{ $errors->has('title') ? 'error' : '' }}" value="">
              <!-- Error -->
                @if ($errors->has('title'))
                    <div class="alert alert-primary">
                        {{ $errors->first('title') }}
                    </div>
                @endif
        </div>
        <div class="form-group">
            <input name="description" type="text" class="form-control {{$errors->has('description') ? 'error' : '' }}">
                @if($errors->has('description'))
                    <div class="alert alert-primary">
                        {{ $errors->first('description') }}
                    </div>
                @endif
        </div>
        <input type="submit" value="submit">
    </form>
</div>
@endsection
