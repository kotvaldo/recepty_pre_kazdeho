@extends('layouts.app')

@section('content')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"
          integrity="sha384-xrRqF5n6n1fdG5jNlIIBP2Puv5AAdNlZbPpi+u9PAzBZp2PL5ADZgV2t76c+Bct" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset('css/all_recipes.css') }}">
    <div class="container mt-5 searchbar">
        <div class="row">
            <div class="col-md-6 mx-auto">
                <div class="form-outline highlighted-search" data-mdb-input-init>
                    <input type="search" id="form1" class="form-control" placeholder="Type query" aria-label="Search"/>
                </div>
            </div>
        </div>
    </div>
    <div class="container mt-5">
        <div class="row">
            @foreach($recipes as $recipe)
                <div class="col-md-4 mb-4">
                    <a href="{{ route('recipe.show', ['recipe' => $recipe]) }}" class="link">
                        <div class="card">
                            <img
                                class="card-img-top" src="{{ asset('images/' . $recipe->image) }}" alt="Recipe Image">
                            <div class="card-body">
                                <h5 class="card-title">
                                    {{ $recipe->name }}@if ($recipe->video_url)
                                        <i class="fas fa-play"></i>
                                    @endif
                                </h5>
                                <p class="card-text">{{ $recipe->description }}</p>
                            </div>
                        </div>
                    </a>
                </div>
            @endforeach
        </div>

    </div>

@endsection
