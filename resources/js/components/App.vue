<script>
export default {
  el: '#app',
  name: 'App',
  data: () => ({
    drawer: null,
    drawerRight: null,
    items: [
      { icon: 'home', text: 'Welcome', url: '/' },
      {
        icon: 'keyboard_arrow_up',
        'icon-alt': 'keyboard_arrow_down',
        text: 'Tasques',
        model: true,
        children: [
          { icon: 'assignment', text: 'Tasques_PHP', url: '/tasks' },
          { icon: 'assignment', text: 'Tasques_Tailwind', url: 'tasks_vue' },
          { icon: 'assignment', text: 'Tasques', url: 'tasques' }

        ]
      },

      { icon: 'help', text: 'Contacte', url: '/contact' },
      { icon: 'account_box', text: 'about', url: '/about' },
      { icon: 'date_range', text: 'Calendari', url: '/calendari' }
    ]
  }),
  methods: {
    impersonate (user) {
      console.log('IMPERSONATE')
      console.log('user:')
      console.log(user)
      if (user) {
        window.location.href = '/impersonate/take/' + user
      } else {
        console.log('CACA')
      }
    }
  }
}

</script>
