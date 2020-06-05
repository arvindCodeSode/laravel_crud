@extends("layout.app")

@section("title",'Student: Home')


@section("content")

    @if(\Session::get('success'))

        <div class="alert alert-success">
            {{ \Session::get("success") }}
        </div>

    @endif

    @if($error=session("error"))

        <div class="alert-alert-danger">
            
            {{ $error }}

        </div>

    @endif

    <a href="student/create" class="btn btn-primary m-3">Add Student</a>

    <table class="table table-stiped table-bordered table-hover">
        <thead class='bg-dark  text-center text-white'> 
            <tr>
                <th>Name</th>
                <th>Class</th>
                <th>Email</th>
                <th>Image</th>
                <th>Hobbies</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach($datas as $data)

            <tr>
                <td>{{ $data->name }}</td>
                <td> {{ $data->class }} </td>
                <td> {{ $data->email }}  </td>
                <td> <img src="{{ URL::to('/') }}/images/{{ $data->image }}" alt="{{ $data->name }}'s image" class="img-thumbnail" width='75'> </td>
                <td> {{ $data->hobbies  }} </td>
                <td>
                    <!-- show Profile -->
                    <a href="{{ action('StudentController@show', $data->id) }}" class="btn btn-success">Profile</a>
                    <!-- edit profile -->
                    <a href="{{ route('student.edit',$data->id) }}" class="btn btn-primary">Edit</a>
                    
                    <!-- delete student -->
                    <form action="{{  route('student.destroy',$data->id) }}" class="form-inline" style='display:inline' method='post'>
                        @csrf
                        @method("DELETE")
                        <button type='submit' class="btn btn-danger">Delete</button>
                    </form>
                </td>
            </tr>

            @endforeach
        </tbody>


    </table>

{!! $datas->links() !!}
@endsection('content')

