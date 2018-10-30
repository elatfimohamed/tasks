@extends('layouts.app')

@section('title')
    Editar tasca
@endsection
@section('content')
    <h1>EDITA LA TASCA</h1>

    <form action="/tasks/{{$task->id}}" method="POST">
        @csrf
        {{ method_field('PUT') }}
        <v-flex xs12 sm6 md3>
            <v-text-field
                    name="name"
                    type="text"
                    label="Nom"
                    value="{{$task->name}}"
                    required
            ></v-text-field>
            <v-btn type="submit" color="success">
                Editar
            </v-btn>
        </v-flex>
    </form>

@endsection
