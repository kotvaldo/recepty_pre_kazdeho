@extends('layouts.app')

@section('content')

    <link rel="stylesheet" href="{{ asset('css/all_recipes.css') }}">

    <div class="container mt-5 searchbar text-center">
        <h1>Recepty</h1>
        <div class="row">
            <div class="col-md-6 mx-auto">
                <div class="form-outline highlighted-search" data-mdb-input-init>
                    <input type="search" id="myInput" oninput="loadRecipes()" class="form-control"
                           placeholder="Search..." aria-label="Search"/>
                </div>
            </div>
        </div>


        <div class="container recipes-container" id="recipes-container">
            <div class="row">
            </div>
        </div>

    </div>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script src="{{ asset('js/ajaxLoad.js') }}"></script>
    <script>
        $(document).ready(function () {
            loadRecipes(); // Načítanie receptov pri prvom načítaní stránky
        });
    </script>

@endsection
