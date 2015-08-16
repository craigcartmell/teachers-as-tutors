App.Calendar = {
    init: function () {
        var lesson;
        var tutorId;

        $(function () {

            tutorId = parseInt($('#calendar').data('tutor-id'));

            $('select[name=parent_id]').on('change', function () {
                lesson.parent_id = parseInt($(this).val());
                console.log(lesson);
            });

            $('#calendar').fullCalendar({
                eventStartEditable: true,
                eventSources: [

                    // your event source
                    {
                        url: window.siteUrl + '/lessons/tutor/' + tutorId,
                        type: 'GET',
                        error: function () {
                            alert('there was an error while fetching events!');
                        },
                        color: 'yellow',   // a non-ajax option
                        textColor: 'black' // a non-ajax option
                    }

                ],
                dayClick: function (moment) {
                    $('#event-modal').modal('show');
                    lesson = new App.Lesson();
                    lesson.tutor_id = $('#event-modal').data('tutor-id');
                    console.log(lesson);
                    console.log(moment.toString());
                },
                eventClick: function (e) {
                    $('#event-modal').modal('show');
                }
            });

            $('.clockpicker').clockpicker()
                .find('input').change(function () {
                    // TODO: time changed
                    console.log(this.value);
                });
        });
    }
};