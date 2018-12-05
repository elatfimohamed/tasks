<template>
    <v-switch v-model="dataCompleted" :label="dataCompleted ? 'Completada' : 'Pendent'"></v-switch>
</template>

<script>
export default {
  name: 'Toggle',
  data () {
    return {
      dataCompleted: this.completed
    }
  },
  props: {
    completed: {
      type: Boolean,
      required: true
    },
    id: {
      type: Number,
      required: true
    }
  },
  watch: {
    completed (completed) {
      this.dataCompleted = completed
    },
    dataCompleted (dataCompleted, oldDataCompleted) {
      console.log('dataCompleted ha canviat')
      console.log('Nou')
      console.log(dataCompleted)
      console.log('Antic')
      console.log(oldDataCompleted)
      if (dataCompleted) {
        // LOADING I DISABLED TODO
        window.axios.post('/v1/completed_task/' + this.id) // TODO ACABAR
      } else {
        window.axios.delete('/v1/completed_task/{task}') // TODO ACABAR
      }
    }
  }
}
</script>
