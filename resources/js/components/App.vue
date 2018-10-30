<script>
export default{
  el: '#app',
  name: 'App',
  data: () => ({
    drawer: null,
    items: [
      {
        icon: 'keyboard_arrow_up',
        'icon-alt': 'keyboard_arrow_down',
        text: 'Tasques',
        model: true,
        children: [
          { icon: 'assignment', text: 'Tasques PHP', url: '/tasks' },
          { icon: 'assignment', text: 'Tasques Vue', url: 'tasks_vue' }
        ]
      },
      { icon: 'account_box', text: 'Sobre nosaltres', url: '/about' },
      { icon: 'date_range', text: 'Calendari', url: '/calendari' }
    ]
  }),
  props: {
    source: String
  }
}
</script>
