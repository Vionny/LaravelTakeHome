@extends('template')
@section('content')
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <table class="table table-striped">
        <thead class="table-primary">
        <tr>
            <th>Name</th>
            <th>Email</th>
            <th>Lecturer Code</th>
            <th>Created At</th>
            <th></th>
            <th></th>
        </tr>
        </thead>
        <tbody>
        @foreach($lecturers as $lecturer)
            <tr class="table table-dark table-hover">
                <td>{{$lecturer->name}}</td>
                <td>{{$lecturer->email}}</td>
                <td>{{$lecturer->code}}</td>
                <td>{{$lecturer->created_at}}</td>
            </tr>
        @endforeach
        </tbody>
    </table>
    <div>
        {{$allocations->withQueryString()->links()}}
    </div>
@endsection
