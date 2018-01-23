<?php

namespace App\Http\Controllers;

use Validator;
use App\Student;
use Illuminate\Http\Request;

class StudentsController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('students.register');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = $this->validator($request->all());


        if ($validator->fails()) {

            return redirect()
                ->back()
                ->withInput()
                ->withErrors($validator);
        }

        $student = $this->create_student($request->all());

        if ($student) {
            return redirect()->to(route('home'))->with(['status' => 'Estudiante registrado']);
        }


    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        $messages = [
            'first_name.required' => 'El nombre es requerido',
            'first_name.string' => 'El nombre solo debe contener letras',
            'last_name.required' => 'El apellido es requerido',
            'last_name.string' => 'El apellido solo debe contener letras',
            'father_name.required' => 'El nombre del padre es requerido',
            'father_name.string' => 'El nombre del padre solo debe contener letras',
            'mother_name.required' => 'El nombre de la madre es requerido',
            'mother_name.string' => 'El nombre de la madre solo debe contener letras',
            'dni.required' => 'El documento es requerido',
            'dni.unique' => 'El documento ya existe en nuestra base de datos',
            'dni.min' => 'El documento debe tener minimo 1 caracter',
            'dni.int' => 'El documento debe ser un número',
        ];

        $rules = [
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'dni' => 'required|int|min:1|unique:students,dni',
            'father_name' => 'required|string|max:255',
            'mother_name' => 'required|string|max:255',
        ];

        return Validator::make($data, $rules, $messages);
    }

    /**
     * Create a new student instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Student
     */
    protected function create_student(array $data)
    {
        return Student::create([
            'first_name' => strtolower($data['first_name']),
            'last_name' => strtolower($data['last_name']),
            'dni' => strtolower($data['dni']),
            'mother_name' => strtolower($data['father_name']),
            'father_name' => strtolower($data['mother_name']),
        ]);
    }

}
