@extends('layouts.app')

@section('content')
    <div class="container">
        <table id="projecy" class="table table-bordered">
            <thead>
                <tr>
                    <th>Nome</th>
                    <th>Descrizione</th>
                    <th>Linguaggi</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($projects as $project)
                    <tr>
                        <td data-th='Project'>
                            <div class="row">
                                <div class="col-sm-9">
                                    <h4 class="nomargin">
                                        {{$project->name}}
                                    </h4>
                                </div>
                            </div>
                        </td>
                        <td data-th="description">{{$project->description}}</td>
                        <td data-th="linguaggi" class="text-center">{{$project->language}}</td>
                        <td class="actions">
                            <form action="{{ route('admin.projects.destroy', $project->id) }}" method="POST" style="display: inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-outline-danger btn-sm" onclick="return confirm('Are you sure you want to delete this project?')">
                                    <i class="fa fa-trash"></i> Elimina
                                </button>
                            </form>
                            <a href="{{route('admin.projects.edit', $project->id)}}" class="btn btn-outline-success btn-sm"></i>edit</a>
                            <a href="{{route('admin.projects.show', $project->id)}}" class="btn btn-outline-success btn-sm"></i>dettagli</a>
                        </td>
                    </tr>
                @endforeach
                    <tr>
                        <a href="{{route('admin.projects.create')}}" class="my-4 btn btn-outline-success btn-sm"></i>Add new Project</a>
                    </tr>
            </tbody>
        </table>
    </div>
@endsection
