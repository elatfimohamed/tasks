@extends('layouts.app')

@section('title')
    Sobre nosaltres
@endsection
@section('content')
    <h1>SOBRE NOSALTRES</h1>
    <v-img
            src="http://1.bp.blogspot.com/-c297IH62xeA/USY4XE1sdPI/AAAAAAAABR4/Y2mU9tQ0j2k/w1200-h630-p-k-no-nu/senyera+catalana.jpg"
    ></v-img>

    <v-card-title primary-title>
        <div>
            <h3 class="headline mb-0">Sergi Baucells</h3>
            <div align="left">Estudiant de DAM <br> Ies del Ebre <br> 2018-2019</div>
        </div>
    </v-card-title>

    <v-card-actions>
        <v-btn flat color="blue"><a href="https://github.com/SergiBaucells" style='text-decoration:none'>GitHub</a>
        </v-btn>
    </v-card-actions>
@endsection
