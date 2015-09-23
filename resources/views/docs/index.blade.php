@extends('layouts.docs')

@section('body')

    <h1 class="page-header">Weber Recipe Database API Documentation</h1>

    <ul>
        <li><a href="{{ url('1.0/docs/recipes') }}"> Recipes </a></li>
        <li><a href="{{ url('1.0/docs/timestamps') }}"> Timestamps </a></li>
    </ul>

@endsection