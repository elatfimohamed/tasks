<template>
    <v-card>
        <v-card-title class="grey darken-3 white--text"><h4>Tema</h4></v-card-title>
            <p>Color principal</p>
            <swatches v-model="colorPrincipal" inline></swatches>
            <p>Color secundario</p>
         <swatches v-model="colorSecundario" inline></swatches>

    </v-card>
</template>

<script>
import Swatches from 'vue-swatches'
// Import the styles too, globally
import 'vue-swatches/dist/vue-swatches.min.css'

export default {
  name: 'Tema',
  components: { Swatches },
  data () {
    return {
      colorPrincipal: window.localStorage.getItem('PRIMARY_COLOR_KEY'),
      colorSecundario: window.localStorage.getItem('SECONDARY_COLOR_KEY')
    }
  },
  watch: {
    colorPrincipal () {
      window.localStorage.setItem('PRIMARY_COLOR_KEY', this.colorPrincipal)
    },
    colorSecundario () {
      window.localStorage.setItem('SECONDARY_COLOR_KEY', this.colorSecundario)
    }
  }
}
</script>

<style scoped>
</style>
