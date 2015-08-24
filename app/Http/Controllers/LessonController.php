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
        $lesson = Lesson::query()->with(['tutor', 'parent'])->findOrFail($id);

        return $lesson;
    }

    public function getByTutorId($tutorId = 0)
    {
        $lessons = Lesson::query()->where('tutor_id', $tutorId)->get();

        $data = [];

        foreach ($lessons as $lesson) {
            $data[] = [
                'id'    => $lesson->getKey(),
                'title' => $lesson->parent->name,
                'start' => $lesson->started_at->format('Y-m-d H:i:s'),
                'end'   => $lesson->ended_at->format('Y-m-d H:i:s'),
            ];
        }

        return $data;
    }

    /**
     * Save a lesson
     *
     * @return View
     */
    public function save(Request $request, $id = 0)
    {
        $lesson = new Lesson();

        if ($id) {
            $lesson = Lesson::query()->findOrFail($id);
        }

        $this->validate($request,
            [
                'tutor_id'   => 'required|exists:users,id',
                'parent_id'  => 'required|exists:users,id',
                'started_at' => 'required|date',
                'ended_at'   => 'required|date|after:started_at',
            ]
        );

        $lesson->tutor_id = $request->input('tutor_id');
        $lesson->parent_id = $request->input('parent_id');
        $lesson->started_at = $request->input('started_at');
        $lesson->ended_at = $request->input('ended_at');

        $lesson->save();

        return response($lesson, $id ? 200 : 201);
    }

    public function delete($id = 0)
    {
        Lesson::destroy($id);

        return response(204);
    }
}