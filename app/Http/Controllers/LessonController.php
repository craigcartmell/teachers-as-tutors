<?php

namespace TeachersAsTutors\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;
use TeachersAsTutors\Http\Requests;
use TeachersAsTutors\Lesson;

class LessonController extends Controller
{
    public function find($id = 0)
    {
        $lesson = Lesson::query()->findOrFail($id);

        return $lesson;
    }

    public function getByTutorId($tutorId = 0)
    {
        $lessons = Lesson::query()->where('tutor_id', $tutorId)->get();

        $data = array();

        foreach ($lessons as $lesson) {
            $data[] = [
                'id' => $lesson->getKey(),
                'title' => $lesson->parent->name,
                'start' => $lesson->started_at->format('Y-m-d H:i:s'),
                'end' => $lesson->ended_at->format('Y-m-d H:i:s'),
            ];
        }

        return $data;
    }

    /**
     * Save a lesson
     *
     * @return View
     */
    public function save(Request $request)
    {
        $lesson = new Lesson();

        $id = $request->get('id');

        if ($id) {
            $lesson->query()->findOrFail($id);
        }

        $lesson->tutor_id = $request->get('tutor_id');
        $lesson->parent_id = $request->get('parent_id');
        $lesson->started_at = $request->get('started_at');
        $lesson->ended_at = $request->get('ended_at');

        $lesson->save();

        return response($lesson, 201);
    }
}
