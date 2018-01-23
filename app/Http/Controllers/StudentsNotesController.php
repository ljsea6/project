<?php

namespace App\Http\Controllers;

use App\Note;
use Validator;
use App\Student;
use Carbon\Carbon;
use Illuminate\Http\Request;

class StudentsNotesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Student $student)
    {
        $notes = $student->notes;
        return view('students.notes.index')->with(['student' => $student, 'notes' => $notes]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Student $student)
    {
        return view('students.notes.create')->with(['student' => $student]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Student $student)
    {
        $validator = $this->validator($request->all());

        if ($validator->fails()) {

            return redirect()
                ->back()
                ->withInput()
                ->withErrors($validator);
        }

        $note = $this->create_student_note($request->all(), $student);

        if ($note) {
            return redirect()->to(route('students.notes.index', $student->id))->with(['status' => 'Nota agregada']);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function show(Student $student, Note $note)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function edit(Student $student, Note $note)
    {
        return view('students.notes.edit')->with(['note' => $note, 'student' => $student]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Student $student, Note $note)
    {

        $validator = $this->validator($request->all());

        if ($validator->fails()) {

            return redirect()
                ->back()
                ->withInput()
                ->withErrors($validator);
        }

        $state = false;

        if ($request->state == '1') {
            $state = true;
        }

        $note = $this->update_student_note($request->all(), $note, $state);

        if ($note) {
            return redirect()->to(route('students.notes.index', $student->id))->with(['status' => 'Nota actualizada.']);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function destroy(Student $student)
    {
        //
    }

    protected function validator(array $data)
    {
        $messages = [
            'note.required' => 'La nota es requerida',
            'note.int' => 'La nota debe ser un número',
            'note.min' => 'La nota minima es 1',
            'note.max' => 'La nota maxima es 5',
        ];

        $rules = [
            'note' => 'required|int|min:1|max:5',
        ];

        return Validator::make($data, $rules, $messages);
    }

    protected function validator_updated(array $data)
    {
        $messages = [
            'note.required' => 'La nota es requerida',
            'note.int' => 'La nota debe ser un número',
            'note.min' => 'La nota minima es 1',
            'note.max' => 'La nota maxima es 5',
            'state.required' => 'Se requiere el estado'
        ];

        $rules = [
            'note' => 'required|int|min:1|max:5',
            'state' => 'required'
        ];

        return Validator::make($data, $rules, $messages);
    }

    /**
     * Create a new student instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Student
     */
    protected function create_student_note(array $data, Student $student)
    {
        return $student->notes()->create([
            'note' => $data['note'],
            'state' => false,
        ]);
    }

    protected function update_student_note(array $data, Note $note, $state)
    {
        $note = Note::findOrFail($note->id);
        $note->note = $data['note'];
        $note->state = $state;
        $note->updated_at = Carbon::now();
        return $note->save();
    }
}
