<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class StudentController extends Controller
{
  public function index()
  {
    $students = Student::all();

    if ($students->isEmpty()) {
      return response()->json([
        'message' => "No hay estudiantes",
        'statusCode' => 404
      ], 404);
    }

    return response()->json($students, 200);
  }

  public function store(Request $request)
  {
    $validator = validator::make($request->all(), [
      'name' => 'required|max:255',
      'email' => 'required|email|unique:students',
      'phone' => 'required',
      'language' => 'required'
    ]);

    if ($validator->fails()) {
      $data = [
        'message' => "Error en la validación de datos",
        'errors' => $validator->errors(),
        'status' => 400
      ];

      return response()->json($data, 400);
    }

    $student = Student::create([
      'name' => $request->name,
      'email' => $request->email,
      'phone' => $request->phone,
      'language' => $request->language
    ]);

    if (!$student) {
      $data = [
        'message' => "Error al crear estudiante",
        'status' => 500
      ];

      return response()->json($data, 500);
    }

    return response()->json($student);
  }

  public function show($id)
  {
    $student = Student::find($id);

    if (!$student) {
      $data = [
        'message' => "Usuario con id: " . $id . ' no encontrado',
        'status' => 404
      ];

      return response()->json($data, 404);
    }

    return response()->json($student);
  }

  public function destroy($id)
  {
    $student = Student::find($id);

    if (!$student) {
      $data = [
        'message' => "Usuario con id: " . $id . ' no encontrado',
        'status' => 404
      ];

      return response()->json($data, 404);
    }

    $student->delete();

    return $student;
  }

  public function update(Request $request, $id)
  {
    $student = Student::find($id);

    if (!$student) {
      $data = [
        'message' => "Usuario con id: " . $id . ' no encontrado',
        'status' => 404
      ];

      return response()->json($data, 404);
    }

    $validator = validator::make($request->all(), [
      'name' => 'max:255',
      'email' => 'email|unique:students',
      'phone' => '',
      'language' => ''
    ]);

    if ($validator->fails()) {
      $data = [
        'message' => "Error en la validación de datos",
        'errors' => $validator->errors(),
        'status' => 400
      ];

      return response()->json($data, 400);
    }

    foreach ($request->all() as $key => $value) {
      $student[$key] = $value;
    }

    $student->save();
    return response()->json($student);
  }
}
