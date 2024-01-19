@extends('layouts.app')

@section('content')
    <link rel="stylesheet" href="{{ asset('css/all_recipes.css') }}">
    <div class="container mt-5 searchbar">
        <div class="row">
            <div class="col-md-6 mx-auto">
                <div class="form-outline highlighted-search" data-mdb-input-init>
                    <input type="search" id="myInput" oninput="loadRecipes()" class="form-control" placeholder="Search..." aria-label="Search"/>
                </div>
            </div>
        </div>
    </div>
    <div class="container recipes-container" id="recipes-container">
        <div class="row">
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script src="{{ asset('js/ajaxLoadVideoRecipes.js') }}"></script>
    <script>
        $(document).ready(function () {
            loadRecipes();
        });
    </script>
@endsection
