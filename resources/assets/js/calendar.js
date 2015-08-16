App.Calendar = {
    init: function () {
        var lesson = new App.Lesson();
        var tutorId;

        $(function () {
            tutorId = parseInt($('#calendar').data('tutor-id'));

            $('select[name=parent_id]').on('change', function () {
                lesson.parent_id = parseInt($(this).val());
            });

            $('#modal-save').on('click', function () {
                console.log(lesson);
                App.Lesson.prototype.save(lesson);
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
                eventClick: function (event) {
                    var promise = App.Lesson.prototype.get(event.id);

                    promise.then(function (response) {
                        lesson = response;
                        $('#event-modal .modal-title').html('Lesson booking for ' + lesson.parent.name);
                        $('#event-modal select#parent_id').val(lesson.parent_id);
                        $('#event-modal input#started_at').val(event.start.format('HH:mm'));
                        $('#event-modal input#ended_at').val(event.end.format('HH:mm'));
                        $('#event-modal').modal('show');
                    }, function () {
                        alert('Error fetching lesson details. Please try again.');
                    });

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