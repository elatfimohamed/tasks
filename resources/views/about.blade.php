@extends('layouts.app')


@section('title')
    Tasks | About
@endsection
@section('content')
    <v-timeline>
        <v-timeline-item
                class="mr-5"
                color="red lighten-2"
                fill-dot
                right
        >
            <v-card>
                <v-card-title class="red lighten-2">
                    <v-icon
                            dark
                            size="42"
                            class="mr-3"
                    >
                        mdi-magnify
                    </v-icon>
                    <h2 class="display-1 white--text font-weight-light"> Aplicación de tareas</h2>
                </v-card-title>
                <v-container>
                    <v-layout>
                        <v-flex xs10>

                            <v-text class="display-4">WIP</v-text>
                        </v-flex>
                        <v-flex xs2>
                            <v-icon size="100" color="red">sentiment_satisfied_alt</v-icon>
                        </v-flex>
                    </v-layout>
                </v-container>
            </v-card>
        </v-timeline-item>

        <v-timeline-item
                class="ml-5"
                color="green lighten-1"
                fill-dot
                left
                small
        >
            <v-card>
                <v-card-title class="green lighten-1 justify-end">
                    <h2 class="display-1 mr-3 white--text font-weight-light">Title 2</h2>
                    <v-icon
                            dark
                            size="42"
                    >mdi-home-outline</v-icon>
                </v-card-title>
                <v-container>
                    <v-layout>
                        <v-flex xs8>
                            Lorem ipsum dolor sit amet, no nam oblique veritus. Commune scaevola imperdiet nec ut, sed euismod convenire principes at. Est et nobis iisque percipit.
                        </v-flex>
                        <v-flex xs4>
                            Lorem ipsum dolor sit amet, no nam oblique veritus.
                        </v-flex>
                    </v-layout>
                </v-container>
            </v-card>
        </v-timeline-item>

        <v-timeline-item
                class="mr-5"
                color="yellow lighten-1"
                fill-dot
                right
        >
            <v-card>
                <v-card-title class="yellow lighten-1">
                    <v-icon
                            class="mr-3"
                            dark
                            size="42"
                    >
                        mdi-email-outline
                    </v-icon>
                    <h2 class="display-1 white--text font-weight-light">Title 3</h2>
                </v-card-title>
                <v-container>
                    <v-layout>
                        <v-flex
                                v-for="n in 3"
                                :key="n"
                                xs4
                        >
                            Lorem ipsum dolor sit amet, no nam oblique veritus no nam oblique.
                        </v-flex>
                    </v-layout>
                </v-container>
            </v-card>
        </v-timeline-item>


    </v-timeline>
@endsection