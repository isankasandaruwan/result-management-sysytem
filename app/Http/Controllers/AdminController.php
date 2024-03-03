<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Batch;
use App\Models\Semester;
use App\Models\Subject;
use App\Models\SubCombine;
use App\Models\Student;
use App\Models\ExamResult;

class AdminController extends Controller
{
    //home page

    public function homeView()
    {
        $semester = Semester::all();
        return view('welcome', ['semester' => $semester]);
    }

    public function showResults(Request $request)
    {

        // Retrieve form inputs
        $st_index = $request->input('st_index');
        $semesterId = $request->input('semester');

        // Retrieve student information
        $student = Student::where('st_index', $st_index)->first();

        // Retrieve exam results for the specified semester
        $results = ExamResult::where('semester_id', $semesterId)
            ->whereHas('student', function ($query) use ($st_index) {
                $query->where('st_index', $st_index);
            })
            ->with('subject')
            ->get();

        // Pass the data to the view
        return view('showResults', compact('student', 'results'));
    }




    //admin login 

    public function loginview()
    {
        return view('admin/login');
    }

    public function loginsubmit(Request $request)
    {

        $request->validate([
            'email' => 'required',
            'password' => 'required'
        ]);
        if (\Auth::attempt($request->only('email', 'password'))) {
            return redirect('/home');
        }
        return redirect('login')->withError('Password and email not match');
    }

    public function logout()
    {
        \Session::flush();
        \Auth::logout();
        return redirect('/');
    }

    public function adminHome()
    {
        $batchCount = Batch::count();
        $studentCount = Student::count();
        $subjectCount = Subject::count();

        return view('admin/home', compact('batchCount', 'studentCount', 'subjectCount'));
    }

    //end

    //batch view function

    public function adminBatch()
    {
        $batches = Batch::orderBy('created_at', 'desc')->get();
        return view('admin/batch', ['batches' => $batches]);
    }

    public function createBatch(Request $request)
    {

        $request->validate([
            'batchname' => 'required|string|max:255',
        ]);

        Batch::create([
            'batchname' => $request->batchname,
        ]);

        return redirect()->route('batch')->with('success', 'Batch created successfully!');
    }

    public function deleteBatch($id)
    {
        $batch = Batch::findOrFail($id);

        // Check if the batch has no associated students
        if ($batch->students->isEmpty()) {
            // If no students associated, delete the batch
            $batch->delete();
            return redirect()->route('batch')->with('success', 'Batch deleted successfully.');
        } else {
            // If students are associated, return with an error message
            return redirect()->route('batch')->with('error', 'Cannot delete batch with associated students.');
        }
    }

    //end

    // semester view function

    public function adminSemester()
    {
        // $semesters = Semester::all();
        // return view('admin/semester', ['semesters' => $semesters]);

        // Retrieve all semesters with their subjects eager loaded
        $semesters = Semester::with('subjects')->get();

        // Pass the retrieved semesters to the admin/semester view
        return view('admin/semester', ['semesters' => $semesters]);
    }

    public function createSemester(Request $request)
    {
        $request->validate([
            'semester' => 'required|string|max:255',
        ]);

        Semester::create([
            'semester' => $request->semester,
        ]);

        return redirect()->route('semester')->with('success', 'Semester created successfully!');
    }

    public function deleteSemester($id)
    {
        $semester = Semester::findOrFail($id);

        // Check if the subject count is 0
        if ($semester->subjects->count() == 0) {
            $semester->delete();
            return redirect()->route('semester')->with('success', 'Semester deleted successfully.');
        } else {
            return redirect()->route('semester')->with('error', 'Semester cannot be deleted because it has associated subjects.');
        }
    }

    //end

    //subject view function

    public function adminSubjects()
    {

        $subjects = Subject::with('semesters')->orderBy('created_at', 'desc')->get();
        return view('admin.subjectsAdd', ['subjects' => $subjects]);
    }

    public function createSubjects(Request $request)
    {
        $request->validate([
            'subject_code' => 'required|string|max:255',
            'subject_name' => 'required|string|max:255',
        ]);

        Subject::create([
            'subject_code' => $request->subject_code,
            'subject_name' => $request->subject_name,
        ]);

        return redirect()->route('subjectsAdd')->with('success', 'Semester created successfully!');
    }

    public function editSubject(Subject $subject)
    {
        return view('admin.editSubject', compact('subject'));
    }

    public function updateSubject(Request $request, Subject $subject)
    {
        $request->validate([
            'subject_code' => 'required|string|max:255',
            'subject_name' => 'required|string|max:255',
        ]);

        $subject->update([
            'subject_code' => $request->subject_code,
            'subject_name' => $request->subject_name,
        ]);

        return redirect()->route('subjectsAdd')->with('success', 'Subject updated successfully.');
    }

    public function deleteSubject(Subject $subject)
    {
        $subject->delete();
        return redirect()->route('subjectsAdd')->with('success', 'Subject deleted successfully.');
    }

    //end

    //subject combinations

    public function adminSubjectCombine()
    {

        // Retrieve subjects not in sub_combines table
        $subjects = Subject::whereNotIn('id', function ($query) {
            $query->select('subject_id')->from('sub_combines');
        })->get();

        //$subjects = Subject::all();
        $semesters = Semester::all();

        return view('admin/subjectCombine', ['subjects' => $subjects, 'semesters' => $semesters]);
    }

    public function subjectCombine(Request $request)
    {
        $request->validate([
            'semester_id' => 'required|exists:semesters,id',
            'subject_id' => 'required|exists:subjects,id',
        ]);

        SubCombine::create([
            'semester_id' => $request->semester_id,
            'subject_id' => $request->subject_id,
        ]);

        return redirect()->route('subjectcombine')->with('success', 'Subject added to semester successfully!');
    }

    //end

}
