<template>
    <div>
        <FullCalendar :options="calendarOptions" :eventsources="eventSources"/>
    </div>
</template>

<script>
    //Fullcalendar and axios modules
    import FullCalendar from '@fullcalendar/vue'
    import dayGridPlugin from '@fullcalendar/daygrid'

    export default {
  components: {
    FullCalendar // make the <FullCalendar> tag available
  },
  data() {
    return {
      calendarOptions: {
        plugins: [ dayGridPlugin ],
        initialView: 'dayGridMonth',
        taskView : true , 

        //Dynamic Event Source
         eventSources: [
            {
              events(start, callback) {
                axios.get('/api/reunionCalendar').then(response => {
                  callback(response.data.calendardata)
                })
              },
                color: 'yellow',
                textColor: 'black',
                background:'blue'
            }
          ]

      }
    }
  }
}
</script>