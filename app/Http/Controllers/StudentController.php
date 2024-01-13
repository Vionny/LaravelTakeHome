<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Symfony\Component\Console\Input\Input;

class StudentController extends Controller
{
    public function restore(Request $request)
    {
//        dd($request);
        $res = Student::withTrashed()
            ->find($request->id)
            ->restore();
//        dd($res);
//        dd($res);
//        $student->deleted_at=NULL;

        return redirect(route('student.index'));
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if(($request->exclude)==1){
//            dd($request);
            $students = Student::query()
//                ->join('users','users.id','=','user_id')
                ->where('code','like','%'.request()->query('code').'%')
                ->orWhere('email','like','%'.request()->query('code').'%')
                ->orWhere('name','like','%'.request()->query('code').'%')
                ->orderBy('name','ASC')
                ->paginate(15)
                ->withQueryString();
//            dd($students);

        }else if(($request->exclude)==0){
            $students = Student::withTrashed()
                ->where('code','like','%'.request()->query('code').'%')
                ->orWhere('email','like','%'.request()->query('code').'%')
                ->orWhere('name','like','%'.request()->query('code').'%')
                ->orderBy('name','ASC')
                ->paginate(15)
                ->withQueryString();
//            dd($students);
        }

//        dd($students);
        return view('student',compact('students'));
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

        $request->validate([
           'name'=>'required|string',
           'email'=>'required|string|unique:users,email',
        ]);
//        dd($request);
        $highest = Student::withTrashed()->max('code');
         DB::table('users')->insert([
            'users.role'=>'student',
            'users.email'=>$request->email,
            'users.password'=>bcrypt(($highest+1).($highest+1).($highest+1)),
            'users.remember_token' => Str::random(10),
            'users.email_verified_at' => now(),
        ]);


//        DB::table('users')->insert([
//            'role'=>'student',
//            'email'=>$request->email,
//            'password'=>bcrypt(($highest+1).($highest+1).($highest+1)),
//            'remember_token' => Str::random(10),
//            'email_verified_at' => now(),
//        ]);
        $id = User::withTrashed()->max('id');
        $users = User::find($id);
//        dd($users);
        $new = new Student();
        $new->belongsTo(User::class,'user_id','id','parent')->associate(User::class);
        $new->code=$highest+1;
        $new->name=$request->name;
        $new->email=$request->email;
        $new->user_id=$users->id;
//        dd($new);
        $new -> save();

//        DB::table('students')->insert([
//            'user_id'=>($id->id)+1,
//            'code'=>$highest+1,
//            'name'=>$request->name,
//            'email'=>$request->email
//        ]);

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
    public function update(Request $request, Student $student)
    {
        $request->validate([
            'name'=>'required|string',
            'email'=>'required|email|string'
        ]);
       $student->name=$request->name;
       $student->email=$request->email;
       $student->save();

       return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Student $student)
    {
        $student->delete();
        return redirect()->back();
    }
}
