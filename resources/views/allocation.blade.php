@extends('template')
@section('content')
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <!-- JavaScript Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <!-- Script -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
{{--    <script src='https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js' type='text/javascript'></script>--}}
{{--    <link href='https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css' rel='stylesheet' type='text/css'>--}}

    <div style="display: flex; flex-direction: column">
        <div style="margin-left: 20px;">
            <a href="{{route('allocation.create')}}"><button type="button" class="btn btn-primary">+ Create</button></a>
        </div>
        <div style="display:inline-flex; margin: 10px">
            <form method="GET" style="margin-left: 10px ">
                <div>
                <input type="text" name="search" class="form-control" placeholder="Search...">
                <div style="display: inline-flex">
                    <div class="input-group" style="width: 200px">
                        <select class="select" name="select" id="Select">
                            <option selected value="0">Semester</option>
                            <option value="0">All</option>
                            <option value="1">Semester 1</option>
                            <option value="2">Semester 2</option>
                            <option value="3">Semester 3</option>
                            <option value="4">Semester 4</option>
                            <option value="5">Semester 5</option>
                            <option value="6">Semester 6</option>
                            <option value="7">Semester 7</option>
                            <option value="8">Semester 8</option>
                        </select>
                    </div>
                </div>
                <input style="margin: 10px" type="checkbox" name="exclude" value="1" @if((old('exclude'))=='1') checked="checked" @endif />
                <label>Exclude deleted students</label>
            </form>
        </div>
    </div>

    <div>
        <table class="table table-striped">
        <thead class="table-primary">
        <tr>
            <th>Subject</th>
            <th>Classroom</th>
            <th>Lecturer</th>
            <th>Created At</th>
            <th></th>
            <th></th>
        </tr>
        </thead>
        <tbody>
        @foreach($allocations as $allocation)
            @if($allocation->semester == request()->query('select')|| 0 ==request()->query('select'))
            @if(($allocation->deleted_at)!==NULL)
                <tr style="background-color :#F08080;">
            @else
                <tr style="background-color :whitesmoke;">
            @endif
                <td>{{$allocation->subject_code}} - {{$allocation->subject_name}}</td>
                <td>{{$allocation->class}}</td>
                <td>{{$allocation->lecturer}}</td>
                <td>{{$allocation->created_at}}</td>
                <td>
                    <form action="{{route('allocation.update',$allocation->id)}}" method="POST" >
{{--                        <input>--}}
                        <button>Update</button>
                    </form>
                <td>
                @if($allocation->trashed())
                    <form action="{{route("restoreAllocation")}}" method="POST">
                          @csrf
                          <input type="hidden" name="id" value="{{$allocation->id}}">
                          <button>Restore</button>
                    </form>
                    @else
                    <form action="{{route('allocation.destroy',$allocation->id)}}" method="POST" >
                        @method("DELETE")
                        @csrf
{{--                        <input type="hidden" name="id" value="{{$allocation->id}}">--}}
                        <button type="submit">Delete</button>
                    </form>
                    @endif
                </td>


            </tr>
                @endif
        @endforeach
        </tbody>
    </table>
    <div>
        {{$allocations->withQueryString()->links()}}
    </div>
@endsection
