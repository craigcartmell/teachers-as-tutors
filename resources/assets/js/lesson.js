App.Lesson = function () {
    this.id = 0;
    this.tutor_id = 0;
    this.parent_id = 0;
    this.started_at = null;
    this.ended_at = null;
};

App.Lesson.prototype.get = function (id) {
    id = parseInt(id);

    return new Promise(function (resolve, reject) {
        $.ajax({
            url: window.siteUrl + '/lessons/' + id
        }).done(function (lesson) {
            resolve(lesson);
        }).error(function (response) {
            reject(response);
        });
    });
};

App.Lesson.prototype.save = function (lesson) {
    return new Promise(function (resolve, reject) {
        $.ajax({
            url: lesson.id ? window.siteUrl + '/lessons/' + lesson.id : window.siteUrl + '/lessons/',
            method: lesson.id ? 'PUT' : 'POST',
            data: lesson
        }).done(function (lesson) {
            resolve(lesson);
        }).error(function (response) {
            reject(response);
        });
    });
};

App.Lesson.prototype.delete = function (lesson) {
    return new Promise(function (resolve, reject) {
        $.ajax({
            url: window.siteUrl + '/lessons/' + lesson.id,
            method: 'DELETE'
        }).done(function () {
            resolve();
        }).error(function (response) {
            reject(response);
        });
    });
};