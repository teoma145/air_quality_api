@extends('layouts.app')
@section('content')
    <section class="container">
        <h1>I miei progetti</h1>
        <a href="{{ route('admin.projects.index') }}">vai</a>
    </section>
@endsection

