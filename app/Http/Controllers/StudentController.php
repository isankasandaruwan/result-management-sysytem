<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Student;
use App\Models\Batch;
use App\Models\Subject;
use App\Models\Semester;
use App\Models\SubCombine;
use App\Models\ExamResult;

class StudentController extends Controller
{
    public function adminCreateStudent()
    {
        $batches = Batch::all();
        return view('admin/studentAdd', compact('batches'));
    }

    public function studentCreate(Request $request)
    {
        $request->validate([
            'st_name' => 'required|string|max:255',
            'st_idno' => 'required|string|max:255',
            'st_index' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:students',
            'batch_id' => 'required|exists:batches,id',
        ]);

        Student::create($request->all());

        return redirect()->route('studentregister')->with('success', 'Student created successfully!');
    }

    public function showManagePage()
    {

        return view('admin.studentManage');
    }


    public function search(Request $request)
    {
        $st_index = $request->input('st_index');

        // Retrieve student data based on st_index
        $student = Student::where('st_index', $st_index)->first();

        if (!$student) {
            return redirect()->route('studentmanage')->with('error', 'There is No Student registered Under this Index');
        }

        return view('admin.studentManage', compact('student'));
    }

    public function studentUpdate(Request $request, $id)
    {
        // Retrieve the student record
        $student = Student::find($id);

        if (!$student) {
            return redirect()->back()->with('error', 'Student not found');
        }

        $hasExamResults = $student->examResults->isNotEmpty();
        if ($hasExamResults) {
            return redirect()->back()->with('error', 'This student has exam results and cannot be Edit.');
        }

        // Validate the incoming request data
        $request->validate([
            'st_name' => 'required|string',
            'email' => 'required|email',
        ]);

        // Update the student record
        $student->update([
            'st_name' => $request->input('st_name'),
            'email' => $request->input('email'),
        ]);

        // Redirect back or do whatever you need after updating
        return redirect()->back()->with('success', 'Student updated successfully');
    }

    public function delete($id)
    {
        $student = Student::find($id);

        if (!$student) {
            return redirect()->route('studentmanage')->with('error', 'Student not found.');
        }

        $hasExamResults = $student->examResults->isNotEmpty();

        if ($hasExamResults) {
            return redirect()->route('studentmanage')->with('error', 'This student has exam results and cannot be deleted.');
        }

        $student->delete();

        return redirect()->route('studentmanage')->with('success', 'Student deleted successfully.');
    }

    //add results to student


    public function showSubjectCodes(Request $request)
    {
        $semesterId = $request->input('semester_id');
        $batch_id = $request->input('batch_id');

        $students = Student::where('batch_id', $batch_id)->get(); // Fetch all students for the selected batch

        $subjectIds = SubCombine::where('semester_id', $semesterId)->pluck('subject_id');
        $subjects = Subject::whereIn('id', $subjectIds)->get();

        $semesters = Semester::all();
        $batch = Batch::all();

        $boolValue = false;

        if ($request->filled('semester_id') && $request->filled('batch_id')) {
            $boolValue = true;
        }

        return view('admin.addresults', compact('batch', 'semesters', 'students', 'subjects', 'semesterId', 'boolValue'));

        //return view('admin.addresults', compact('batch', 'semesters', 'students', 'subjects', 'semesterId'));
        //return view('admin.addresults', compact('batch', 'semesters', 'index_number', 'subjects', 'semesterId'));
        //return view('admin.addresults', compact('batch', 'semesters', 'index_number', 'subjects'));
    }

    public function saveExamResults(Request $request)
    {

        $semesterId = $request->input('semester_id');
        $studentId = $request->input('student_id');
        $subjectMarks = $request->input('subject_marks');

        foreach ($subjectMarks as $subjectId => $mark) {
            // Save the mark for each subject
            $examResult = new ExamResult();
            $examResult->student_id = $studentId;
            $examResult->semester_id = $semesterId;
            $examResult->subject_id = $subjectId;
            $examResult->mark = $mark;
            $examResult->save();
        }

        return redirect()->back()->with('success', 'Exam results saved successfully!');
    }

    //end

    //manage results

    public function showResultsForm()
    {
        $semesters = Semester::all();

        $examRes = ExamResult::all();

        return view('admin.resultsManage', compact('semesters', 'examRes'));
    }

    public function showStudentIndex(Request $request)
    {
        // Retrieve the selected semester ID from the form submission
        $semesterId = $request->input('semester');

        $semesters = Semester::where('id', $semesterId)->value('semester');

        // Fetch the student indexes for the selected semester
        $studentIndexes = ExamResult::where('semester_id', $semesterId)->pluck('student_id');

        // Fetch the corresponding student names using the student indexes
        $students = Student::whereIn('id', $studentIndexes)->pluck('st_index', 'id');

        // Pass the data to the view and return it
        return view('admin.resultsManage', compact('semesters', 'students'));
    }

    public function showExamResults(Request $request)
    {
        // Retrieve the selected student index and semester ID from the form submission
        $studentId = $request->input('Index');
        $semesterId = $request->input('semester');

        $semesters = Semester::where('id', $semesterId)->value('semester');
        $index = Student::where('id', $studentId)->value('st_index');

        $studentIndexes = ExamResult::where('semester_id', $semesterId)->pluck('student_id');
        $students = Student::whereIn('id', $studentIndexes)->pluck('st_index', 'id');

        // Fetch the subject codes and marks for the selected student index and semester
        $examResults = ExamResult::where('student_id', $studentId)
            ->where('semester_id', $semesterId)
            ->leftJoin('subjects', 'exam_results.subject_id', '=', 'subjects.id')
            ->select('subjects.subject_code', 'exam_results.mark', 'exam_results.id')
            ->get();

        // Pass the data to the view and return it
        return view('admin.resultsManage', compact('semesters', 'index', 'students', 'examResults'));
    }

    public function updateMarks(Request $request, $id)
    {

        $examResult = ExamResult::findOrFail($id);
        $examResult->mark = $request->mark;
        $examResult->save();
        return redirect()->back()->with('success', 'Marks updated successfully');
    }

}
