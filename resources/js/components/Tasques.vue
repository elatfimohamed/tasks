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

        <v-dialog v-model="editDialog" fullscreen transition="dialog-bottom-transition" @keydown.esc="editDialog=false">
            <v-toolbar color="primary" class="white--text">
                <v-btn flat icon class="white--text" @click="editDialog=false">
                    <v-icon class="mr-2">close</v-icon>
                </v-btn>
                <v-card-title class="headline">Editar tasca</v-card-title>
                <v-spacer></v-spacer>
                <v-btn flat class="white--text" @click="editDialog=false">
                    <v-icon class="mr-2">exit_to_app</v-icon>
                    Sortir
                </v-btn>
                <v-btn flat class="white--text" @click="update">
                    <v-icon class="mr-2">save</v-icon>
                    Guardar
                </v-btn>
            </v-toolbar>
            <v-card>
                <v-card-text>
                    <v-form>
                        <v-text-field v-model="taskBeingUpdated.name" label="Nom" hint="Nom de la tasca"
                                      placeholder="Nom de la tasca"></v-text-field>
                        <v-switch v-model="taskBeingUpdated.completed"
                                  :label="taskBeingUpdated.completed ? 'Completada':'Pendent'"></v-switch>
                        <v-textarea v-model="taskBeingUpdated.description" label="Descripció"></v-textarea>
                        <v-autocomplete v-if="$can('tasks.index')" :items="dataUsers" v-model="taskBeingUpdated.user" label="Usuari"
                                        item-text="name" :return-object="true"></v-autocomplete>
                        <div class="text-xs-center">
                            <v-btn @click="editDialog=false">
                                <v-icon class="mr-2">exit_to_app</v-icon>
                                Cancel·lar
                            </v-btn>
                            <v-btn color="success" @click="update">
                                <v-icon class="mr-2">save</v-icon>
                                Guardar
                            </v-btn>
                        </div>
                    </v-form>
                </v-card-text>
            </v-card>
        </v-dialog>

        <v-dialog v-model="showDialog" fullscreen transition="dialog-bottom-transition" @keydown.esc="showDialog=false">
            <v-toolbar color="primary" class="white--text">
                <v-btn flat icon class="white--text" @click="showDialog=false">
                    <v-icon class="mr-2">close</v-icon>
                </v-btn>
                <v-card-title class="headline">Mostrar tasca</v-card-title>
                <v-spacer></v-spacer>
                <v-btn flat class="white--text" @click="showDialog=false">
                    <v-icon class="mr-2">exit_to_app</v-icon>
                    Sortir
                </v-btn>
            </v-toolbar>
            <v-card>
                <v-card-text>
                    <v-form>
                        <v-text-field v-model="takeTask.name" label="Nom" hint="Nom de la tasca"
                                      readonly></v-text-field>
                        <v-switch v-model="takeTask.completed" :label="takeTask.completed ? 'Completada':'Pendent'"
                                  readonly></v-switch>
                        <v-textarea v-model="takeTask.description" label="Descripció" readonly></v-textarea>
                        <v-autocomplete :items="dataUsers" label="Usuari" v-model="takeTask.user" item-text="name"
                                        return-object readonly></v-autocomplete>
                        <div class="text-xs-center">
                            <v-btn @click="showDialog=false">
                                <v-icon class="mr-2">exit_to_app</v-icon>
                                Sortir
                            </v-btn>
                        </div>
                    </v-form>
                </v-card-text>
            </v-card>
        </v-dialog>

        <v-toolbar color="blue">
            <v-menu>
                <v-btn slot="activator" icon dark>
                    <v-icon>more_vert</v-icon>
                </v-btn>
                <v-list>
                    <v-list-tile @click="opcio1">
                        <v-list-tile-title>Opció 1</v-list-tile-title>
                    </v-list-tile>
                    <v-list-tile href="http://www.google.com">
                        <v-list-tile-title>Google</v-list-tile-title>
                    </v-list-tile>
                </v-list>
            </v-menu>
            <v-toolbar-title class="white--text">Tasques</v-toolbar-title>
            <v-spacer></v-spacer>
            <v-btn icon class="white--text">
                <v-icon>settings</v-icon>
            </v-btn>
            <v-btn icon class="white--text" @click="refresh" :loading="loading" :disabled="loading">
                <v-icon>refresh</v-icon>
            </v-btn>
        </v-toolbar>
        <v-card>
            <v-card-title>
                <v-layout row wrap>
                    <v-flex lg3 class="pr-2">
                        <v-select
                                label="Filtres"
                                :items="filters"
                                v-model="filter"
                        ></v-select>
                    </v-flex>
                    <v-flex lg4 class="pr-2">
                        <v-select
                                label="Usuari"
                                :items="dataUsers"
                                v-model="user"
                                item-text="name"
                                clearable
                        ></v-select>
                    </v-flex>
                    <v-flex lg5>
                        <v-text-field
                                append-icon="search"
                                label="Buscar"
                                v-model="search"
                        ></v-text-field>
                    </v-flex>
                </v-layout>
            </v-card-title>
            <v-data-table
                    :headers="headers"
                    :items="dataTasks"
                    :search="search"
                    no-results-text="No s'ha trobat cap registre coincident"
                    no-data-text="No hi han dades disponibles"
                    rows-per-page-text="Tasques per pàgina"
                    :rows-per-page-items="[5,10,25,50,100,{'text':'Tots','value':-1}]"
                    :loading="loading"
                    :pagination.sync="pagination"
                    class="hidden-md-and-down"
            >
                <v-progress-linear slot="progress" color="blue" indeterminate></v-progress-linear>
                <template slot="items" slot-scope="{item:task}">
                    <tr>
                        <td>{{task.id}}</td>
                        <td>
                            <span :title="task.description">{{ task.name }}</span>
                        </td>
                        <td>
                            <v-avatar :title="task.user_name">
                                <img :src="task.user_gravatar" alt="avatar">
                            </v-avatar>
                        </td>
                        <td>
                            <task-completed-toggle :task="task"></task-completed-toggle>
                            <!--<toggle :completed="task.completed" :id="task.id"></toggle>-->
                        </td>
                        <td>
                            <span :title="task.created_at_formatted">{{ task.created_at_human }}</span>
                        </td>
                        <td>
                            <span :title="task.updated_at_formatted">{{ task.updated_at_human }}</span>
                        </td>
                        <td>
                            <v-btn v-if="$can('tasks.show', task)" :loading="showing" :disabled="showing" icon
                                   color="primary" flat
                                   title="Mostrar la tasca" @click="showTask(task)">
                                <v-icon>visibility</v-icon>
                            </v-btn>
                            <v-btn v-if="$can('user.tasks.update', task)" :loading="editing" :disabled="editing" icon
                                   color="success" flat
                                   title="Actualitzar la tasca" @click="showUpdate(task)">
                                <v-icon>edit</v-icon>
                            </v-btn>
                            <v-btn v-if="$can('user.tasks.destroy', task)" :loading="removing === task.id" :disabled="removing === task.id" icon
                                   color="error"
                                   flat
                                   title="Eliminar la tasca" @click="destroy(task)">
                                <v-icon>delete</v-icon>
                            </v-btn>
                        </td>
                    </tr>
                </template>
            </v-data-table>
            <v-data-iterator
                    class="hidden-lg-and-up"
                    :items="dataTasks"
                    :search="search"
                    no-results-text="No s'ha trobat cap registre coincident"
                    no-data-text="No hi han dades disponibles"
                    rows-per-page-text="Tasques per pàgina"
                    :rows-per-page-items="[5,10,25,50,100,{'text':'Tots','value':-1}]"
                    :loading="loading"
                    :pagination.sync="pagination"
            >
                <v-flex
                        slot="item"
                        slot-scope="{item:task}"
                        xs12
                        sm6
                        md4
                >
                    <v-card class="mb-1">
                        <v-card-title v-text="task.name"></v-card-title>
                        <v-list dense>
                            <v-list-tile>
                              <v-list-tile-content>Completed:</v-list-tile-content>
                              <v-list-tile-content class="align-end">{{ task.completed }}</v-list-tile-content>
                            </v-list-tile>
                            <v-list-tile>
                              <v-list-tile-content>User:</v-list-tile-content>
                              <v-list-tile-content class="align-end">{{ task.user_id }}</v-list-tile-content>
                            </v-list-tile>
                        </v-list>
                    </v-card>
                </v-flex>
            </v-data-iterator>
        </v-card>
        <v-btn v-if="$can('user.tasks.store', tasks)" fab bottom right color="purple accent-2" fixed class="white--text"
               @click="showCreate()">
            <v-icon>add</v-icon>
        </v-btn>
    </span>
</template>

<script>
    import TaskCompletedToggle from './TaskCompletedToggle'
    import Toggle from './Toggle'
    export default {
        name: 'Tasques',
        components: {
            'task-completed-toggle': TaskCompletedToggle,
            'toggle': Toggle
        },
        data () {
            return {
                dataUsers: this.users,
                description: '',
                completed: false,
                name: '',
                createDialog: false,
                editDialog: false,
                showDialog: false,
                takeTask: '',
                user: '',
                taskBeingUpdated: '',
                usersold: [
                    'Sergi Baucells',
                    'Jordi baucells',
                    'Carmen Rodríguez'
                ],
                filter: 'Totes',
                filters: [
                    'Totes',
                    'Completades',
                    'Pendents'
                ],
                search: '',
                pagination: {
                    rowsPerPage: 25
                },
                removing: null,
                creating: false,
                loading: false,
                deleting: false,
                showing: false,
                editing: false,
                dataTasks: this.tasks,
                headers: [
                    { text: 'Id', value: 'id' },
                    { text: 'Nom', value: 'name' },
                    { text: 'Usuari', value: 'user_id' },
                    { text: 'Completat', value: 'completed' },
                    { text: 'Creat', value: 'created_at_timestamp' },
                    { text: 'Modificat', value: 'updated_at_timestamp' },
                    { text: 'Accions', sortable: false, value: 'full_search' }
                ]
            }
        },
        props: {
            tasks: {
                type: Array,
                required: true
            },
            users: {
                type: Array,
                required: true
            },
            uri: {
                type: String,
                required: true
            }
        },
        methods: {
            refresh () {
                this.loading = true
                window.axios.get(this.uri).then(response => {
                    // SHOW SNACKBAR MISSATGE OK
                    this.dataTasks = response.data
                    // this.showMessage("S'ha refrescat correctament")
                    this.$snackbar.showMessage("S'ha refrescat correctament")
                    this.loading = false
                }).catch(error => {
                    this.$snackbar.showError(error.message)
                    this.loading = false
                    // SHOW SNACKBAR ERROR
                })
            },
            opcio1 () {
                console.log('TODO OPCIÓ 1')
            },
            removeTask (task) {
                this.dataTasks.splice(this.dataTasks.indexOf(task), 1)
            },
            async destroy (task) {
                // ES6 async await
                let result = await this.$confirm('Les tasques esborrades no es poden recuperar!',
                    {
                        title: 'Esteu segurs?',
                        buttonFalseText: 'Cancel·lar',
                        buttonTrueText: 'Eliminar',
                        color: 'error'
                    })
                if (result) {
                    // OK tirem endevant
                    this.removing = task.id
                    window.axios.delete(this.uri + '/' + task.id).then(() => {
                        this.removeTask(task)
                        task = null
                        this.$snackbar.showMessage("S'ha esborrat correctament")
                        this.removing = null
                    }).catch(error => {
                        this.$snackbar.showError(error.message)
                        this.removing = null
                    })
                }
            },
            create () {
                this.creating = true
                window.axios.post(this.uri, {
                    user_id: this.user.id,
                    name: this.name,
                    completed: this.completed,
                    description: this.description
                }).then(() => {
                    this.refresh()
                    this.createDialog = false
                    this.$snackbar.showMessage("S'ha creat correctament")
                    this.creating = false
                }).catch((error) => {
                    this.$snackbar.showError(error.message)
                    this.creating = false
                })
            },
            update () {
                this.editing = true
                window.axios.put(this.uri + '/' + this.taskBeingUpdated.id,
                    {
                        user_id: this.taskBeingUpdated.user.id,
                        name: this.taskBeingUpdated.name,
                        completed: this.taskBeingUpdated.completed,
                        description: this.taskBeingUpdated.description
                    }
                ).then(() => {
                    this.editDialog = false
                    this.taskBeingRemoved = null
                    this.$snackbar.showMessage("S'ha actualitzat correctament")
                    this.editing = false
                }).catch(error => {
                    this.$snackbar.showError(error.message)
                    this.editing = false
                })
            },
            showUpdate (task) {
                this.editDialog = true
                this.taskBeingUpdated = task
            },
            showTask (task) {
                this.takeTask = task
                this.showDialog = true
            },
            showCreate () {
                this.createDialog = true
            }
        }
    }
</script>
