@extends('template')
@section('content')
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <!-- JavaScript Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

{{--    <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.0.0-alpha/css/bootstrap.css" rel="stylesheet">--}}

    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <!-- Script -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src='https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js' type='text/javascript'></script>
    {{--    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"> </script>--}}
{{--    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-modal/0.9.1/jquery.modal.min.js"></script>--}}


    <!-- Font Awesome JS -->
{{--    <script defer src="https://use.fontawesome.com/releases/v5.0.13/js/solid.js" integrity="sha384-tzzSw1/Vo+0N5UhStP3bvwWPq+uvzCMfrN1fEFe+xBmv1C/AtVX5K0uZtmcHitFZ" crossorigin="anonymous"> </script>--}}
{{--    <script defer src="https://use.fontawesome.com/releases/v5.0.13/js/fontawesome.js" integrity="sha384-6OIrr52G08NpOFSZdxxz1xdNSndlD4vdcf/q2myIUVO0VsqaGHJsB0RaBE01VTOY" crossorigin="anonymous"> </script>--}}

    <link href='https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css' rel='stylesheet' type='text/css'>


    {{--    pop up create   --}}
{{--    <form>--}}
    <div style="display: inline-flex; margin: 10px">

        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#createModal" >+ Create</button>
        <form method="GET" style="margin-left: 10px ">
            <input type="text" name="code" class="form-control" placeholder="Search...">
        </form>
    </div>

    <div style="margin-top: 20px" class="modal fade" id="createModal" tabindex="-1" aria-labelledby="createModal" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-body">
                    <h4 style="margin-top: 15px">Create Classroom</h4>
                <div class="modal-body" style="text-align:center">
                        <form action="{{route('classrooms.store')}}" method="POST">
                            @csrf
                            <div>
                                <div>
                                    <input style="margin:0px; padding: 8px; width: 450px" type="text" name="name" placeholder="Name">
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


{{--    </form>--}}
    <table class="table table-striped">
        <thead class="table-primary">
        <tr>
            <th>Name</th>
            <th>Created At</th>
            <th></th>
            <th></th>
        </tr>
        </thead>
        <tbody>
        @foreach($classrooms as $classroom)
            <tr >
                <td>{{$classroom->code}}</td>
                <td>{{$classroom->created_at}}</td>
                <td>
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#{{$classroom->id}}" >Update</button>
                    {{--    update--}}
                    <div style="margin-top: 20px" class="modal fade" id="{{$classroom->id}}" tabindex="-1" aria-labelledby="updateModal" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-body">
                                    <h4 style="margin-top: 15px">Update Classroom</h4>
                                    <div class="modal-body" style="text-align:center">
                                        <form action="{{route('classrooms.update', compact('classroom'))}}" method="POST">
                                            @csrf
                                            @method("PATCH")
                                            <div>
                                                <div>
                                                    <input style="margin:0px; padding: 8px; width: 450px" type="text" name="code" placeholder="Name" value="{{$classroom->code}}">
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
                    <form action="{{route("classrooms.destroy",compact("classroom"))}}" method="POST">
                    @method('DELETE')
                    @csrf
                    <button >Delete</button>
                   </form>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
    <div>
        {{$classrooms->withQueryString()->links()}}
    </div>
@endsection
