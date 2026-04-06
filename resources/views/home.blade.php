@extends('layouts.admin')

@section('content')
<h1>Te damos la bienvenido {{ auth()->user()->name }}</h1>
@endsection
