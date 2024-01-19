@extends('layouts.app')

@section('content')
    <link rel="stylesheet" href="{{ asset('css/recipes.css') }}">
    <div class="container mt-5">
        <div class="card">
            <img src="{{ asset('images/' . $recipe->image) }}" class="card-img-top" alt="{{ $recipe->name }} Image">
            <div class="card-body">
                <h1 class="card-title">{{ $recipe->name }}</h1>

                <h3>Ingrediencie:</h3>
                <p class="card-text">{{ $recipe->ingredients }}</p>

                <h3>Postup:</h3>
                <p class="card-text">{{ $recipe->instructions }}</p>

                <div class="container next-info">
                    <h3 class>Kategória: {{ $recipe->category->name }}</h3>
                    @foreach($difficulties as $d)
                        @if($recipe->difficulty == $d->id)
                            <h3>Obtiažnosť receptu: {{$d->name}}</h3>
                        @endif
                    @endforeach

                    <h3>Čas Prípravy: {{ $recipe->cooking_time }} minút</h3>

                </div>
                @if($recipe->video_url)
                    <div>
                        <div class="container video-title">
                            <h3>Video:</h3>
                        </div>
                        <div class="">
                            <iframe id="youtubeVideoFrame" width="600" height="400"
                                    allowfullscreen></iframe>
                            <script>
                                var videoLink = "{{ $recipe->video_url }}";

                            </script>
                            <script src="{{ asset('js/video_embed.js') }}"></script>


                        </div>
                    </div>
                @endif

                <a href="{{ route('recipes') }}" class="btn btn-primary mt-3 back-btn">Back to Homepage</a>
            </div>
        </div>
    </div>
@endsection
