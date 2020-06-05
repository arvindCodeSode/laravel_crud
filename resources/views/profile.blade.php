@extends("layout.app")

@section("title")


@section("content")
<a href="{{ route('student.index') }}" class="btn btn-primary mt-4 mb-3">Back </a>

<div class="jumbotron text-center container">
    <br>
    <img src="{{ URL::to('/') }}/images/{{ $student_profile->image }}" alt="{{ $student->name }}'s image"  width='180' class='img-thumbnail'>
    <h1>{{ $student->name }}</h1>
    <h2> {{ $student->email }} </h2>    
</div>

@endsection('content')

