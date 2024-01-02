@extends('layouts.app')

@section('content')
    <link rel="stylesheet" href="{{ asset('css/user.css') }}">
    @auth
        <div class="container text-center mt-5">
            <img src="{{asset($model['profile_photo']) }}" alt="Profile Image" class="rounded-circle"
                 style="width: 100px; height: 100px; object-fit: cover;">
            <h4 class="mt-3">{{@$model->name}}</h4>
            <span class="mt-3">{{@$model->email}}</span>

        </div>

        <hr class="my-4">

        <div class="container d-flex justify-content-center editing" role="group">
            <a href="{{ route('user.edit', @$model ) }}" class="btn btn-primary">Edit Profile</a>

            <form action="{{ route('user.destroy', @$model ) }}" method="post" class="form-delete">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this user?')">Delete Profile</button>
            </form>
        </div>

    @else

    @endauth
@endsection
