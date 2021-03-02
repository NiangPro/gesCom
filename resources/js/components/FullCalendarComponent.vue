<template>
<div class="container">
       <full-calendar :event-sources="eventSources"></full-calendar>
       </div>
</template>
<script>
    export default{
  data() {
    return {
      eventSources: [
        {
          events(start, end, timezone, callback) {
            axios.get('/api/getCalendar').then(response => {
              callback(response.data.events)
            })
          },
          color: 'yellow',
          textColor: 'black',
        }
      ]
    }
  }
    }
</script>
