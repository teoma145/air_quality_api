@extends('layouts.app')

@section('content')

<section class="container">

    <h1>{{$project->name}}</h1>

    <form action="{{ route('admin.projects.update', $project->id)}}"  method="POST">

    @csrf

    @method('PUT')

        <div class="mb-3">

            <label for="title">Name</label>

            <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" id="name"

                required maxlength="200" minlength="3" value="{{ old('name') ?? $project->name }}">

            @error('name')

                <div class="invalid-feedback">{{ $message }}</div>

            @enderror

        </div>

        <div>

            <label for="body">Description</label>

            <textarea class="form-control @error('description') is-invalid @enderror" name="description" id="description" required

                 >{{ old('description') ?? $project->description }}</textarea>

            @error('description')

                <div class="invalid-feedback">{{ $message }}</div>

            @enderror

        </div>

        <div>

            <label for="image">Language</label>

            <input type="text" class="form-control @error('language') is-invalid @enderror" name="language" id="image" value="{{ old('language') ?? $project->language }}">

            @error('language')

                <div class="invalid-feedback">{{ $message }}</div>

            @enderror

        </div>

        <button type="submit" class="btn btn-success">Save</button>
        <button type="reset" class="btn btn-success">Reset</button>
    </form>
</section>

@endsection
