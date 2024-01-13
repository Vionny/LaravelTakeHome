<?php

namespace App\Http\Controllers;

use App\Models\Allocation;
use App\Models\Classroom;
use App\Models\Lecturer;
use App\Models\Subject;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use phpDocumentor\Reflection\Types\AbstractList;
use Symfony\Component\Console\Helper\Table;

class AllocationController extends Controller
{
    public function restore(Request $request)
    {
        Allocation::withTrashed()
            ->find($request->id)
            ->restore();

        return redirect(route('allocation.index'));
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function index(Request $request)
    {
//        dd($request);
        if(($request->exclude)==1){
            $allocations= Allocation::query()
                ->join('subjects','subjects.id','=','allocations.subject_id')
                ->join('classrooms','classrooms.id','=','allocations.classroom_id')
                ->join('lecturers','lecturers.id','=','allocations.lecturer_id')
//                ->where('semester','=','%'.request()->query('custom-select').'%')
                ->where('subjects.name','like','%'.request()->query('search').'%')
                ->orWhere('classrooms.code','like','%'.request()->query('search').'%')
                ->orWhere('lecturers.name','like','%'.request()->query('search').'%')
                ->where('allocations.semester','=','%'.request()->query('select').'%')
                ->select('subjects.code as subject_code','subjects.name as subject_name','classrooms.code as class','lecturers.name as lecturer','allocations.semester','allocations.created_at','allocations.id as id','allocations.deleted_at')
                ->paginate(15);
        }else{
            $allocations= Allocation::withTrashed()
                ->join('subjects','subjects.id','=','allocations.subject_id')
                ->join('classrooms','classrooms.id','=','allocations.classroom_id')
                ->join('lecturers','lecturers.id','=','allocations.lecturer_id')
//                ->where('allocations.semester','=','%'.request()->query('select').'%')
                ->where('subjects.name','like','%'.request()->query('search').'%')
                ->orWhere('classrooms.code','like','%'.request()->query('search').'%')
                ->orWhere('lecturers.name','like','%'.request()->query('search').'%')
                ->select('subjects.code as subject_code','subjects.name as subject_name','classrooms.code as class','lecturers.name as lecturer','allocations.semester','allocations.created_at','allocations.id as id','allocations.deleted_at')

                ->paginate(15);
        }

//        dd($allocations);
//        return $request;
        return view('allocation',compact('allocations'));
    }
    public function create2(){
//        $all = Allocation::query()->join('Lecturer')->whereBelongsTo()

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function create()
    {
        $subjects = \App\Models\Subject::all();
        $classrooms=Classroom::all();
        $lecturers=\App\Models\Lecturer::all();
        return view('createallocation',compact('subjects','classrooms','lecturers')) ;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Http\Response|\Illuminate\Routing\Redirector
     */
    public function store(Request $request)
    {
//        dd($request);
        $sub = Subject::query()->where('code','=',$request->subject)->pluck('id');
//        $subid=$sub->search($id);
//        dd($sub);
        $class=Classroom::query()->where('code','=',$request->classroom)->pluck('id');
//        dd($class);
        $lect=Lecturer::query()->where('code','=',$request->lecturer)->pluck('id');
//        dd($lect);

        $new=new Allocation();
        $new->belongsTo(Subject::class,'subject_id','id','parent');
        $new->belongsTo(Classroom::class,'classroom_id','id','parent');
        $new->belongsTo(Lecturer::class,'lecturer_id','id','parent');
        $new->subject_id=$sub[0];
        $new->classroom_id=$class[0];
        $new->lecturer_id=$lect[0];
        $new->semester='8';
//        dd($new);
        $new->save();
         return redirect(route('allocation.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
//        dd($id);
        $allocations= Allocation::query()->find($id);
//        dd($allocations);
        $allocations->delete();
//        $allocation2=$allocation;
//        $allocation2->delete();
//        $allocation->where('id','=',$request->id);
        return redirect()->back();
    }
}
