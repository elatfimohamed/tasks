<template>
    <div class="container flex justify-center">
        <div class="flex flex-col">
            <h1 class="text-center text-red-light pb-3 pt-8">Tasques ({{total}})</h1>
            <div class="flex-row">
                <input type="text" v-model="newTask" @keyup.enter="add" placeholder="Nova Tasca"
                       class="m-3 mt-5 p-2 pl-5 shadow border rounded focus:outline-none focus:shadow-outline text-grey-darker">
                <!--<button @click="add">Afegir</button>-->
                <svg @click="add" class="h-4 w-4 cursor-pointer fill-current text-green"
                     xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                    <path d="M11 9h4v2h-4v4H9v-4H5V9h4V5h2v4zm-1 11a10 10 0 1 1 0-20 10 10 0 0 1 0 20zm0-2a8 8 0 1 0 0-16 8 8 0 0 0 0 16z"/>
                </svg>
            </div>
            <!--<input :value="newTask" @input="newTask = $event.target.value">-->
            <ul class="list-reset">
                <!--<li v-for="task in tasks" v-if="task.completed"><strike>{{task.name}}</strike></li>-->
                <!--<li v-else>{{task.name}}</li>-->
                <li v-for="task in filteredTasks" :key="task.id" class="text-grey-darker m-2 pl-5">
                    <span :class="{strike:task.completed=='1'}">
                        <editable-text :text="task.name" @edited="editName(task, $event)">
                            <!--{{task.name}}-->
                        </editable-text>
                    </span>

                    <svg xmlns="http://www.w3.org/2000/svg" @click="remove(task)"
                         class="h-4 w-4 cursor-pointer ml-3 mt-1 fill-current text-red" viewBox="0 0 20 20">
                        <path d="M2.93 17.07A10 10 0 1 1 17.07 2.93 10 10 0 0 1 2.93 17.07zM11.4 10l2.83-2.83-1.41-1.41L10 8.59 7.17 5.76 5.76 7.17 8.59 10l-2.83 2.83 1.41 1.41L10 11.41l2.83 2.83 1.41-1.41L11.41 10z"/>
                    </svg>
                </li>
            </ul>
            <div>
                <h3 class="mb-3 mt-2">Filtros</h3>
                Active filter: {{filter}}
                <div class="mt-4">
                    <button @click="setFilter('all')">Totes</button>
                    <button @click="setFilter('completed')" class="ml-3 mr-3">Completades</button>
                    <button @click="setFilter('active')">Pendents</button>
                </div>
            </div>
        </div>
    </div>
</template>

<script>

    import EditableText from './EditableText'

    var filters = {
        all: function (tasks) {
            return tasks
        },
        completed: function (tasks) {
            return tasks.filter(function (task) {
                return task.completed
                // NO CAL
                // if (task.completed) return true
                // else return false
            })
        },
        active: function (tasks) {
            return tasks.filter(function (task) {
                return !task.completed
            })
        },
    }

    export default {
        name: 'Tasks',
        components: {
            'editable-text': EditableText
        },
        data() {
            return {
                filter: 'all', // All Completed Active
                newTask: '',
                dataTasks: this.tasks
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
            total() {
                return this.dataTasks.length
            },
            filteredTasks() {
                // Segons el filtre actiu
                // Alternativa switch/case -> array associatiu
                return filters[this.filter](this.dataTasks)
            }
        },
        watch: {
            tasks(newTasks) {
                this.dataTasks = newTasks
            }
        },

        methods: {
            editName(task, text) {
                task.name = text
            },
            setFilter(newFilter) {
                this.filter = newFilter
            },
            add() {
                this.dataTasks.splice(0, 0, {name: this.newTask, completed: false})
                this.newTask = ''
            },
            remove(task) {
                this.dataTasks.splice(this.dataTasks.indexOf(task), 1)
            }
        },
        created() {
            // console.log('Component Tasks ha estat creat');
        }
    }
</script>

<style>

    .strike {
        text-decoration: line-through;
    }

</style>