<template>
    <v-form action="/register" method="POST">
        <v-toolbar dark color="primary">
            <v-spacer></v-spacer>
            <v-toolbar-title>Register</v-toolbar-title>
            <v-spacer></v-spacer>
        </v-toolbar>
        <v-card-text>

            <input type="hidden" name="_token" :value="csrfToken">
            <v-text-field
                    prepend-icon="person"
                    name="name"
                    label="Name"
                    type="text"
                    v-model="name"
                    :error-messages="nameErrors"
                    @input="$v.name.$touch()"
                    @blur="$v.name.$touch()"
            ></v-text-field>
            <v-text-field
                    prepend-icon="mail_outline"
                    name="email"
                    label="Email"
                    type="text"
                    v-model="dataEmail"
                    :error-messages="emailErrors"
                    @input="$v.dataEmail.$touch()"
                    @blur="$v.dataEmail.$touch()"
            ></v-text-field>
            <v-text-field
                    id="password"
                    prepend-icon="lock"
                    name="password"
                    label="Password"
                    type="password"
                    v-model="password"
                    :error-messages="passwordErrors"
                    @input="$v.password.$touch()"
                    @blur="$v.password.$touch()"
            ></v-text-field>
            <v-text-field
                    id="password_confirmation"
                    prepend-icon="lock"
                    name="password_confirmation"
                    label="Confirm Password"
                    type="password"
                    v-model="password_confirmation"
                    :error-messages="password_confirmationErrors"
                    @input="$v.password_confirmation.$touch()"
                    @blur="$v.password_confirmation.$touch()"
            ></v-text-field>

        </v-card-text>
        <v-card-actions>
            <v-spacer></v-spacer>
            <v-btn color="primary" type="submit" :disabled="$v.$invalid">Register</v-btn>
            <v-spacer></v-spacer>
        </v-card-actions>
    </v-form>
</template>
<script>
import { validationMixin } from 'vuelidate'
import { required, email, minLength, sameAs } from 'vuelidate/lib/validators'
export default {
  mixins: [validationMixin],
  validations: {
    name: { required },
    dataEmail: { required, email },
    password: { required, minLength: minLength(6) },
    password_confirmation: { sameAsPassword: sameAs('password') }
  },
  name: 'RegisterForm',
  data () {
    return {
      dataEmail: this.email,
      name: '',
      password: '',
      password_confirmation: ''
    }
  },
  props: {
    'email': '',
    'csrfToken': ''
  },
  computed: {
    emailErrors () {
      const errors = []
      if (!this.$v.dataEmail.$dirty) return errors
      !this.$v.dataEmail.required && errors.push('El email és obligatori')
      !this.$v.dataEmail.email && errors.push('El email ha de tindre un format vàlid')
      return errors
    },
    nameErrors () {
      const errors = []
      if (!this.$v.name.$dirty) return errors
      !this.$v.name.required && errors.push('El nom és obligatori')
      return errors
    },
    passwordErrors () {
      const errors = []
      if (!this.$v.password.$dirty) return errors
      !this.$v.password.minLength && errors.push('El password ha de tindre una mida mínima de 6 caràcters')
      !this.$v.password.required && errors.push('El password és obligatori')
      return errors
    },
    password_confirmationErrors () {
      const errors = []
      if (!this.$v.password_confirmation.$dirty) return errors
      !this.$v.password_confirmation.sameAsPassword && errors.push('Les password no son iguals')
      return errors
    }
  }
}
</script>
