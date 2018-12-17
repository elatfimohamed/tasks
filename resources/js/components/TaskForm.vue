<template>
    <span>
                <v-dialog v-model="createDialog" fullscreen transition="dialog-bottom-transition"
                          @keydown.esc="createDialog=false">
            <v-toolbar color="primary" class="white--text">
                <v-btn flat icon class="white--text" @click="createDialog=false">
                    <v-icon class="mr-2">close</v-icon>
                </v-btn>
                <v-card-title class="headline">Crear tasca</v-card-title>
                <v-spacer></v-spacer>
                <v-btn flat class="white--text" @click="createDialog=false">
                    <v-icon class="mr-2">exit_to_app</v-icon>
                    Sortir
                </v-btn>
                <v-btn flat class="white--text" @click="create">
                    <v-icon class="mr-2">save</v-icon>
                    Guardar
                </v-btn>
            </v-toolbar>
            <v-card>
                <v-card-text>
                    <v-form>
                        <v-text-field v-model="name" label="Nom" hint="Nom de la tasca"
                                      placeholder="Nom de la tasca"></v-text-field>
                        <v-switch v-model="completed" :label="completed ? 'Completada':'Pendent'"></v-switch>
                        <v-textarea v-model="description" label="Descripció"></v-textarea>
                        <v-autocomplete v-if="$can('tasks.index')" :items="dataUsers" label="Usuari" v-model="user" item-text="name"
                                        return-object></v-autocomplete>
                        <div class="text-xs-center">
                            <v-btn @click="createDialog=false">
                                <v-icon class="mr-2">exit_to_app</v-icon>
                                Cancel·lar
                            </v-btn>
                            <v-btn color="success" @click="create">
                                <v-icon class="mr-2">save</v-icon>
                                Guardar
                            </v-btn>
                        </div>
                    </v-form>
                </v-card-text>
            </v-card>
        </v-dialog>
        <v-btn
            @click="dialog = true"
            fab
            bottom
            right
            fixed
            color="pink"
            class="white--text"
            

        </v-btn>
    </span>
</template>
