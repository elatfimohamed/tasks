<template>
    <v-autocomplete
            :items="dataUsers"
            v-model="selectedUser"
            item-value="id"
            clearable
            :label="label"
    >
        <template slot="selection" slot-scope="data">
            <v-chip>
                <v-avatar :title="data.item.name">
                    <img :src="data.item.avatar" :alt="data.item.name">
                </v-avatar>
                {{ data.item.name }}
            </v-chip>
        </template>
        <template slot="item" slot-scope="{ item: user }">
            <v-list-tile-avatar>
                <v-avatar :title="user.name">
                    <img :src="user.gravatar" alt="avatar">
                </v-avatar>
            </v-list-tile-avatar>
            <v-list-tile-content>
                <v-list-tile-title v-text="user.name"></v-list-tile-title>
                <v-list-tile-sub-title v-text="user.email"></v-list-tile-sub-title>
            </v-list-tile-content>
        </template>
    </v-autocomplete>
</template>

<script>
export default {
  name: 'UserSelect',
  data () {
    return {
      dataUsers: [],
      selectedUser: null
    }
  },
  props: {
    users: {
      type: Array
    },
    url: {
      type: String,
      default: '/api/v1/users'
    },
    label: {
      type: String,
      default: 'Usuaris'
    }
  },
  watch: {
    selectedUser (newValue) {
      this.$emit('selected', newValue)
    }
  },
  created () {
    if (this.users) this.dataUsers = this.users
    else {
      window.axios.get(this.url).then(response => {
        this.dataUsers = response.data
      }).catch(error => {
        console.log(error)
        // this.$snackbar.showError(error)
      })
    }
  }
}
</script>
