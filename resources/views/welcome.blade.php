@extends('layout')

@section('content')

<div class="row">
<div class = "col-md-4">

<div class="card  mt-4">
  <div class="card-header">
    Senior Developer
  </div>
  <div class="card-body">

  @foreach($lead as $employee)
        <tr>
            <td>{{$employee->name}}</td><br>
            <td>{{$employee->email}}</td><br>
            <td>{{$employee->phone}}</td><br>
            <td> <a href="{{ route('employees.edit', $employee->id)}}" class="btn btn-success btn-sm">Edit</a><form action="{{ route('employees.destroy', $employee->id)}}" method="post" style="display: inline-block">
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-danger btn-sm" type="submit">Delete</button>
                  </form><td><br>
        </tr><br>
        @endforeach
  </div>
</div>
</div>
<div class = "col-md-4">

<div class="card mt-4">
  <div class="card-header">
    Junior Developer
  </div>
  <div class="card-body">
  @foreach($lead as $employee)
        <tr>
            <td>{{$employee->name}}</td><br>
            <td>{{$employee->email}}</td><br>
            <td>{{$employee->phone}}</td><br>
        </tr><br>
        @endforeach

  </div>
</div>
</div>

<div class = "col-md-4">

<div class="card  mt-4">
  <div class="card-header">
    Add Developer
  </div>
  <div class="card-body">
    @if ($errors->any())
      <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
              <li>{{ $error }}</li>
            @endforeach
        </ul>
      </div>
    @endif
   
      <form method="post" action="{{ route('employees.store') }}">
       @foreach($lead as $employee)
        <input type="hidden" name="id" value="{{++$employee->id}}" />
        @endforeach
          <div class="form-group">
              @csrf
              <label for="name">Name</label>
              <input type="text" class="form-control" name="name"/>
          </div>
          <div class="form-group">
              <label for="email">Email</label>
              <input type="email" class="form-control" name="email"/>
          </div>
          <div class="form-group">
              <label for="phone">Phone</label>
              <input type="tel" class="form-control" name="phone"/>
          </div>
          <button type="submit" class="btn btn-block btn-primary">Add</button>
      </form>
  </div>
</div>

</div>
</div>


@endsection