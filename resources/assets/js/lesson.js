App.Lesson = function () {
    this.id = 0;
    this.tutor_id = 0;
    this.parent_id = 0;
    this.started_at = null;
    this.ended_at = null;

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
                url: typeof lesson !== 'undefined' && lesson.id ? window.siteUrl + '/lessons/' + lesson.id : window.siteUrl + '/lessons',
                method: typeof lesson !== 'undefined' && lesson.id ? 'PUT' : 'POST',
                data: {
                    id: lesson.id,
                    tutor_id: lesson.tutor_id,
                    parent_id: lesson.parent_id,
                    started_at: lesson.started_at,
                    ended_at: lesson.ended_at
                }
            }).done(function (lesson) {
                resolve(lesson);
            }).error(function (response) {
                reject(response);
            });
        });
    };

    App.Lesson.prototype.delete = function (lesson) {
        return new Promise(function (resolve, reject) {
            if (typeof lesson === 'undefined') {
                reject('');
            }

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
};
