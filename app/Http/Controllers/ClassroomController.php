<?php

namespace App\Http\Controllers;

use App\Models\Classroom;
use Illuminate\Http\Request;

class ClassroomController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function index(Request $request)
    {
//        dd($request);
        $classrooms = Classroom::query()
            ->where('code','like','%'.request()->query('code').'%')
            ->orderBy('code','ASC')
            ->paginate(15);
        return view('classroom',compact('classrooms'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
//        dd($request);

        $request->validate([
           'name'=>'required|unique:classrooms,name|regex:/([A-Z]{2})([0-9]{2})/|string'
        ]);

        $new = new Classroom();
        $new->code=$request->input('name');
//        $new->name="Name hasn't been inserted";
        $new->save();

        return redirect()->back();
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
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request,Classroom $classroom)
    {
        $request->validate([
            'name'=>'required|unique:classrooms,code|regex:/([A-Z]{2})([0-9]{2})/|string'
        ]);

        $classroom->code=$request->name;
        $classroom->save();

        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return string
     */
    public function destroy(Classroom $classroom)
    {
//        dd($classroom);
        $classroom->delete();
        return redirect()->back() ;
    }
}
