App.Calendar = {
    init: function () {
        var lesson = new App.Lesson();
        var lessonDate;
        var tutorId;

        $(function () {
            tutorId = parseInt($('#calendar').data('tutor-id'));

            $('select[name=parent_id]').on('change', function () {
                lesson.parent_id = parseInt($(this).val());
            });

            $('#modal-save').on('click', function () {
                var promise = App.Lesson.prototype.save(lesson);

                $('.alert').html('').addClass('hidden');

                promise.then(function (response) {
                    lesson = response;
                    $('#event-modal').modal('hide');
                    $('#calendar').fullCalendar('refetchEvents');
                }, function (response) {
                    var errors = JSON.parse(response.responseText);
                    var display = '';

                    $.each(errors, function (key, value) {
                        display = display + '<p>' + value + '</p>';
                    });

                    $('.alert').html(display).removeClass('hidden');
                });
            });

            $('#modal-delete').on('click', function () {
                var c = confirm('Are you sure you wish to delete this lesson?');

                if (!c) {
                    return;
                }

                var promise = App.Lesson.prototype.delete(lesson);

                $('.alert').html('').addClass('hidden');

                promise.then(function () {
                    $('#event-modal').modal('hide');
                    $('#calendar').fullCalendar('refetchEvents');
                }, function (response) {
                    var errors = JSON.parse(response.responseText);
                    var display = '';

                    $.each(errors, function (key, value) {
                        display = display + '<p>' + value + '</p>';
                    });

                    $('.alert').html(display).removeClass('hidden');
                });
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
                    lessonDate = moment;
                    lesson = new App.Lesson();

                    lesson.tutor_id = $('#calendar').data('tutor-id');

                    $('#event-modal select#parent_id').val(0);
                    $('#event-modal input#started_at').val('');
                    $('#event-modal input#ended_at').val('');

                    $('#modal-title').html('Lesson Booking - ' + lessonDate.format('MMMM Do YYYY'));
                    $('#modal-delete').addClass('hidden');
                    $('#event-modal').modal('show');
                },
                eventClick: function (event) {
                    lessonDate = event.start;

                    var promise = App.Lesson.prototype.get(event.id);

                    promise.then(function (response) {
                        lesson = response;
                        $('#event-modal select#parent_id').val(lesson.parent_id);
                        $('#event-modal input#started_at').val(event.start.format('HH:mm'));
                        $('#event-modal input#ended_at').val(event.end.format('HH:mm'));

                        $('#modal-title').html('Lesson Booking - ' + lessonDate.format('MMMM Do YYYY'));
                        $('#modal-delete').removeClass('hidden');
                        $('#event-modal').modal('show');
                    }, function () {
                        $('.alert').html('Error fetching lesson details. Please close and try again.').removeClass('hidden');
                    });

                }
            });

            $('.clockpicker').clockpicker()
                .find('input#started_at, input#ended_at').change(function () {
                    var id = $(this).attr('id');
                    lesson[id] = lessonDate.format('YYYY-MM-DD') + ' ' + $(this).val() + ':00';
                })
        });
    }
};