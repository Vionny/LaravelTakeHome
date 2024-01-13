@extends('template')
@section('content')
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <!-- JavaScript Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <!-- Script -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src='https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js' type='text/javascript'></script>
    <link href='https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css' rel='stylesheet' type='text/css'>

    {{--    pop up create   --}}
    {{--    <form>--}}
    <div style="display: flex; flex-direction: column">
        <div style="margin-left: 20px;">
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#createModal" >+ Create</button>
        </div>
        <div style="display:inline-flex; margin: 10px">
                <form method="GET" style="margin-left: 10px ">
                    <input type="text" name="code" class="form-control" placeholder="Search...">
                    <input style="margin: 10px" type="checkbox" name="exclude" value="1" @if((old('exclude'))=='1') checked="checked" @endif />
                    <label>Exclude deleted students</label>
                </form>
        </div>
    </div>
    <div>

    </div>
    <div style="margin-top: 20px" class="modal fade" id="createModal" tabindex="-1" aria-labelledby="createModal" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-body">
                    <h4 style="margin-top: 15px">Create Student</h4>
                    <div class="modal-body" style="text-align:center">
                        <form action="{{route('student.store')}}" method="POST">
                            @csrf
                            <div>
                                <div>
                                    <input style="margin-bottom:10px; padding: 8px; width: 450px" type="text" name="name" placeholder="Name">
                                </div>
                                <div>
                                    <input style="margin-top:10px; padding: 8px; width: 450px" type="text" name="email" placeholder="Email">
                                </div>
                                @error('name')
                                <div class="alert alert-danger" role="alert" style="margin-top:20px;width:450px">
                                    {{$message}}
                                </div>
                                @enderror
                                @error('email')
                                <div class="alert alert-danger" role="alert" style="margin-top:20px;width:450px">
                                    {{$message}}
                                </div>
                                @enderror
                                <div>
                                    <button style="margin-top:10px;width:450px" class="btn btn-primary">Submit</button>
                                </div>

                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>


    {{--    </form>--}}
    <table class="table table-striped">
        <thead class="table-primary">
        <tr>
            <th>Name</th>
            <th>Email</th>
            <th>Student Code</th>
            <th>Created At</th>
{{--            <th>Deleted At</th>--}}
            <th></th>
            <th></th>
        </tr>
        </thead>
        <tbody>
        @foreach($students as $student)
            @if(($student->deleted_at)!==NULL)
                <tr style="background-color :#F08080;">
            @else
                <tr style="background-color :whitesmoke;">
            @endif
                <td>{{$student->name}}</td>
                <td>{{$student->email}}</td>
                <td>{{$student->code}}</td>
                <td>{{$student->created_at}}</td>
{{--                <td>{{$student->deleted_at}}</td>--}}
                <td>
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#{{$student->id}}" >Update</button>
                    {{--    update--}}
                    <div style="margin-top: 20px" class="modal fade" id="{{$student->id}}" tabindex="-1" aria-labelledby="updateModal" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-body">
                                    <h4 style="margin-top: 15px">Update Student</h4>
                                    <div class="modal-body" style="text-align:center">
                                        <form action="{{route('student.update', compact('student'))}}" method="POST">
                                            @csrf
                                            @method("PATCH")
                                            <div>
                                                <div>
                                                    <input style="margin-bottom:5px; padding: 8px; width: 450px" type="text" name="name" placeholder="Name" value="{{$student->name}}">
                                                </div>
                                                <div>
                                                    <input style="margin-top:10px; padding: 8px; width: 450px" type="text" name="email" placeholder="Name" value="{{$student->email}}">
                                                </div>
                                                <div>
                                                    <button style="margin-top:10px;width:450px" class="btn btn-primary">Submit</button>
                                                </div>
                                                @error('name')
                                                <div class="alert alert-danger" role="alert" style="margin-top:20px;width:450px">
                                                    {{$message}}
                                                </div>
                                                @enderror
                                            </div>
                                        </form>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </td>
                <td>
                @if($student->trashed())
                    <form action="{{route("restoreStudent")}}" method="POST">
                        @csrf
                        <input type="hidden" name="id" value="{{$student->id}}">
                         <button>Restore</button>
                    </form>
                @else
                    <form action="{{route("student.destroy",compact("student"))}}" method="POST">
                         @method('DELETE')
                         @csrf
                         <button >Delete</button>
                    </form>
                @endif
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
    <div>
        {{$students->links()}}
    </div>
@endsection
