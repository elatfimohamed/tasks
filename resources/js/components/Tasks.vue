<template>
    <v-card id="tasks" class="tasks container flex justify-center">
        <v-container grid-list-md text-xs-center>
            <v-layout row wrap>
                <v-flex xs12 justify-center>
                    <v-card flat>
                        <v-card-title class="justify-center">
                            <span class="headline blue-grey--text">Tasques ({{total}})</span>
                        </v-card-title>
                        <v-card-text class="px-0">
                            <v-card class="flex flex-col" flat>
                                <v-card class="flex-row" flat>
                                    <v-form>
                                        <v-text-field name="name" type="text" v-model="newTask" @keyup.enter="add"
                                                      placeholder="Nova Tasca"
                                                      required>
                                        </v-text-field>
                                        <v-btn id="button_add_task" @click="add" color="success">
                                            Afegir
                                        </v-btn>
                                    </v-form>
                                    <v-card v-if="errorMessage">Ha succeit un error: {{ errorMessage }}</v-card>
                                </v-card>
                                <!--<input :value="newTask" @input="newTask = $event.target.value">-->
                                <v-list class="list-reset">
                                    <!--<li v-for="task in tasks" v-if="task.completed"><strike>{{task.name}}</strike></li>-->
                                    <!--<li v-else>{{task.name}}</li>-->
                                    <v-list-tile v-for="task in filteredTasks" :key="task.id"
                                                 class="m-2 pl-5">
                    <span :id="'task' + task.id" :class="{strike:task.completed=='1'}">
                        <editable-text :text="task.name"
                                       @edited="editName(task, $event)">
                            <!--{{task.name}}-->
                        </editable-text>
                    </span>
                                        <svg :id="'deleteTask' + task.id" xmlns="http://www.w3.org/2000/svg"
                                             @click="remove(task)"
                                             class="h-4 w-4 cursor-pointer ml-3 mt-1 fill-current text-red"
                                             viewBox="0 0 20 20">
                                            <path d="M2.93 17.07A10 10 0 1 1 17.07 2.93 10 10 0 0 1 2.93 17.07zM11.4 10l2.83-2.83-1.41-1.41L10 8.59 7.17 5.76 5.76 7.17 8.59 10l-2.83 2.83 1.41 1.41L10 11.41l2.83 2.83 1.41-1.41L11.41 10z"/>
                                        </svg>
                                    </v-list-tile>
                                </v-list>
                                <v-card flat>
                                    <!--<h3 class="mb-1 mt-2">Filtres</h3>-->
                                    <!--Active filter: {{filter}}-->
                                    <div class="mt-2" v-show="total > 0">
                                        <v-btn @click="setFilter('all')" color="info">
                                            Totes
                                        </v-btn>
                                        <v-btn @click="setFilter('completed')" color="info">
                                            Completades
                                        </v-btn>
                                        <v-btn @click="setFilter('active')" color="info">
                                            Pendents
                                        </v-btn>
                                    </div>
                                </v-card>
                            </v-card>
                        </v-card-text>
                    </v-card>
                </v-flex>
            </v-layout>
        </v-container>
    </v-card>
</template>

<script>

import EditableText from './EditableText'
import VListTile from 'vuetify/lib/components/VList/VListTile'

var filters = {
  all: function (tasks) {
    return tasks
  },
  completed: function (tasks) {
    return tasks.filter(function (task) {
      // return task.completed
      // NO CAL
      if (task.completed === '1') return true
      else return false
    })
  },
  active: function (tasks) {
    return tasks.filter(function (task) {
      // return !task.completed
      if (task.completed === '0') return true
      else return false
    })
  }
}

export default {
  name: 'Tasks',
  components: {
    VListTile,
    'editable-text': EditableText
  },
  data () {
    return {
      filter: 'all', // All Completed Active
      newTask: '',
      dataTasks: this.tasks,
      errorMessage: null
    }
  },
  props: {
    tasks: {
      type: Array,
      default: function () {
        return []
      }
    }
  },
  computed: {
    total () {
      return this.dataTasks.length
    },
    filteredTasks () {
      // Segons el filtre actiu
      // Alternativa switch/case -> array associatiu
      return filters[this.filter](this.dataTasks)
    }
  },
  watch: {
    tasks (newTasks) {
      this.dataTasks = newTasks
    }
  },

  methods: {
    editName (task, text) {
      task.name = text
    },
    setFilter (newFilter) {
      this.filter = newFilter
    },
    add () {
      if (this.newTask === '') return
      window.axios.post('/api/v1/tasks', {
        name: this.newTask
      }).then((response) => {
        this.dataTasks.splice(0, 0, { id: response.data.id, name: this.newTask, completed: false })
        this.newTask = ''
      }).catch((error) => {
        console.log(error)
      })
    },
    remove (task) {
      // this.dataTasks.splice(this.dataTasks.indexOf(task), 1)
      window.axios.delete('/api/v1/tasks/' + task.id).then((response) => {
        this.dataTasks.splice(this.dataTasks.indexOf(task), 1)
      }).catch((error) => {
        console.log(error)
      })
    }
  },
  created () {
    // Si tinc propietat tasks no fer res
    // sino vull fer petició a la API per obtenir les tasques
    if (this.tasks.length === 0) {
      window.axios.get('/api/v1/tasks').then((response) => {
        this.dataTasks = response.data
      }).catch((error) => {
        this.errorMessage = error.response.data
      })
    }
  }
}
</script>

<style>

    .strike {
        text-decoration: line-through;
    }

    .outline-none:focus {
        outline: 0;
    }

</style>
