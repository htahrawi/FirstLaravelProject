<?php

namespace App\Http\Controllers;

use App\Http\Requests\GradeRequest;
use App\Models\Grade;
use App\Traits\UploadTrait;
use Illuminate\Http\Request;

class GradeController extends Controller
{
    use UploadTrait;
    public function insert(){
        return view('grades/inserting');
    }
    public function save(GradeRequest $req){
        $image_name = $this->saveImage('grades','student',$req['image']);
        Grade::create([
            'name' => $req['name'],
            'image' => $image_name,
            'address' => $req['address'],
            'mark' => $req['mark'],
        ]);
        return redirect()->back()->with(['done'=>__('messages.grade entered')]);
    }
    public function showGrades(){
        $grades = Grade::select('id','image','name','address','mark')->get();
        return view('grades.allGrades',compact('grades'));
    }
    public function editGrade($grade_id){
        //بجي افحص الاي دي موجود او لأ
        // Grade::findOrFail($grade_id);
        $data = Grade::find($grade_id);
        if (!$data) {
            return redirect()->back();
        }
        return view('grades.editGrade',compact('data'));
    }
    public function updateGrade(GradeRequest $req, $grade_id)
    {   
        // Validation 
        //Id exist or not
        $grade = Grade::select('id','name','address','mark')->find($grade_id);
        if (!$grade) {
            return redirect()->back();
        }
        // Grade::findOrFail($grade_id);   

        $grade->update($req->all());
        return redirect()->back()->with('updated',__('messages.data updated'));
    }
    public function deleteGrade($grade_id)
    {
        $grade = Grade::find($grade_id);
        if (!$grade) {
            return redirect()
                ->back()
                ->with(['error'=>__('messages.garde does not exist')]);
        }
        $grade->delete();
        return redirect()
            ->route('grade.all')
            ->with(['success'=>__('messages.grade deleted successfully')]);
    }
}