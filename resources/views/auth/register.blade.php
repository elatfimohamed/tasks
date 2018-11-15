@extends('layouts.register')
@section('title')
    Register
@endsection

@section('content')

    <v-content>
        <v-app id="inspire">
            <v-content>
                <v-container fluid fill-height>
                    <v-layout align-center justify-center>
                        <v-flex xs12 sm8 md4>
                            <v-card class="elevation-12">
                                <register-form csrf-token="{{ csrf_token() }}"></register-form>
                            </v-card>
                        </v-flex>
                    </v-layout>
                </v-container>
            </v-content>
        </v-app>
    </v-content>
@endsection