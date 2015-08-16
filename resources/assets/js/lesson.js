App.Lesson = function (id) {
    id = parseInt(id);

    this.id = id ? id : 0;
    this.tutorId = 0;
    this.parentId = 0;
    this.startedAt = null;
    this.endedAt = null;
    this.isComplete = null;

    if (this.id) {
        App.Lesson.prototype.get(this.id);
    }
};

App.Lesson.prototype.get = function (id) {
    id = parseInt(id);

    $.ajax($('body').data('site-url') + '/');
};

App.Lesson.prototype.save = function () {
    $.ajax()
};