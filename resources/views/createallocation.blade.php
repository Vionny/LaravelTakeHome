@extends('template')
@section('content')
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <!-- JavaScript Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <!-- Script -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <style>
        div{
            margin:15px;
            width: 400px;
        }
        label{
            margin-right: 10px
        }
    </style>

    <div>
        <label>Create Allocation</label>
    </div>
    <div>
    <form action="{{route('allocation.store')}}" method="POST">
        @csrf
        <div class="input-group">
            <label>Subject</label>
            <select class="custom-select" id="select1" name="subject" aria-label="Example select with button addon">
                <option selected>Choose...</option>
                @foreach($subjects as $subject)
                <option value="{{$subject->code}}"><td>{{$subject->code}} - {{$subject->name}}</td></option>
                @endforeach
            </select>
        </div>
        <div class="input-group">
            <label>Classroom</label>
            <select class="custom-select" id="select2" name="classroom"aria-label="Example select with button addon">
                <option selected>Choose...</option>
                @foreach($classrooms as $classroom)
                    <option value="{{$classroom->code}}"><td>{{$classroom->code}}</td></option>
                @endforeach
            </select>
        </div>
        <div class="input-group">
            <label>Lecturer</label>
            <select class="custom-select" id="select2" name="lecturer"aria-label="Example select with button addon">
                <option selected>Choose...</option>
                @foreach($lecturers as $lecturer)
                    <option value="{{$lecturer->code}}"><td>{{$lecturer->name}} ({{$lecturer->code}})</td></option>
                @endforeach
            </select>
        </div>
        <button style="padding-top:15px;padding-bottom: 10px" type="submit"  class="btn btn-primary">Submit</button>
    </form>
        <a href="{{route("allocation.index")}}"><button style="margin-top: 10px" class="alert alert-danger">Cancel</button></a>
@endsection
