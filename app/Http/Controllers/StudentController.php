<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $students = Student::latest()->paginate(5);
        return view('students.index', compact('students'))->with(request()->input('page'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('students.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //validate the input
        $request->validate([
            'name'=> 'required',
            'Age'=> 'required',
            'detail'=>'required',
        ]);

        //create a new student
        Student::create($request->all());

        //redirect the user and send a friendly message
        return redirect()->route('students.index')->with('success', 'Student created successfully');

    }

    /**
     * Display the specified resource.
     */
    public function show(Student $student)
    {
        return view('students.show', compact('student'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Student $student)
    {
        return view('students.edit', compact('student'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Student $student)
    {
         //validate the input
         $request->validate([
            'name'=> 'required',
            'age'=> 'required',
            'detail'=>'required',
        ]);

        //create a new student
        $student->update($request->all());

        //redirect the user and send a friendly message
        return redirect()->route('students.index')->with('success', 'Student updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Student $student)
    {
        //delete the student

        $student->delete();

        //redirect the user and display the success message

        return redirect()->route('students.index')->with('success', 'Student deleted successfully');

    }
}
