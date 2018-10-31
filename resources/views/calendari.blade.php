@extends('layouts.app')

@section('title')
    Calendari
@endsection
@section('content')
    <h1>CALENDARI</h1>

    <v-date-picker v-model="picker" :landscape="landscape" :reactive="reactive"></v-date-picker>
@endsection
