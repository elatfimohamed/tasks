@extends('layouts.app')

@section('title')
    Sobre nosaltres
@endsection
@section('content')
    <h1>Sobre mi </h1>
    <v-img
            src=""
    ></v-img>

    <v-card-title primary-title>
        <div>
            <h3 class="headline mb-0">Mohamed Elatfi</h3>
            <div align="left">Estudiant de DAM <br> Ies del Ebre <br> 2018-2019</div>
        </div>
    </v-card-title>

    <v-card-actions>
        <v-btn flat color="blue"><a href="https://" style='text-decoration:none'>GitHub</a>
        </v-btn>
    </v-card-actions>
@endsection
