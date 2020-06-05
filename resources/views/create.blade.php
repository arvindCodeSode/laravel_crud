<!--import main file  -->
@extends('layout.app')


@section('title','Student: Register')

@section('content')

<!-- this is for all error message -->

@if($errors->any())

    @foreach($errors->all() as $error)

            <div class="alert alert-danger ">
                {{  $error }}
            </div>
    @endforeach

@endif

<!-- this is for success message -->
@if($message=Session::get('success'))

        <div class="alert alert-success">
            {{ $message }}
        </div>
@endif

<!-- this is for error message -->

@if($error=Session::get('error'))

        <div class="alert alert-danger">
            {{ $error }}
        </div>
@endif

<div class="row">
    <!-- student detail form -->
    <div class="col-md-5  border p-3">
        <h3 class="text-center">Student </h3>
        <form action="{{ route('student.store') }}" method='post' >
        @csrf
            <div class="form-group">
                
                <label for="name">Full Name</label>
                <input type="text" name="name" value="{{ old('name') }}"  id="class" class="form-control">
            
            </div>
            <div class="form-group">
               
                <label for="class">Standered</label>
                <input type="text" name="class"  value="{{ old('class') }}" id="class" class="form-control">
            
            </div>
            <div class="form-group">
                
                <label for="email">Email</label>
                <input type="text" name="email" id="email"  value="{{ old('email') }}" class="form-control">
            
            </div>
            <div class="form-group">
            
                <label for="phone">Phone Number</label>
                <input type="text" name="phone" id="phone"  value="{{ old('phone') }}" class="form-control">
            
            </div>

            <div class="form-group">
            
                <button type='submit' id='submit'  class="btn btn-primary" >
                save
                </button>
            </div>
        </form>
    </div>
    <!-- student  profile form -->
    <div class="col-md-1"></div>
    
    <div class="col-md-5 border p-3">
        
        <form action="{{ route('store_profile') }}" id='profile_form' method='Post' enctype="multipart/form-data">
        @csrf
            <h3 class="text-center">Profile</h3>
            
            <div class="form-group mt-2">
                
                <label for="image">Select Image</label>
                    <div class="custom-file">
                        <input type="file" name="image" id="image" class="custom-file-input">
                        <label for="image" class="custom-file-label">
                         choose file</label>
                    </div>
            
            </div>
            <br />
            <!-- here we use user_id which is coming from student form and this is  use in profile table as as foreign key -->
            <input type="hidden" id='user_id' name="user_id" 
            value="
            @if($user_id = session('user_id'))
                {{ $user_id }}
            @else
            {{ old('user_id') }}
            @endif
            ">

            <div class="form-group">
            
                <label for="hobbies">Hobbies</label>
                <input type="text" name="hobbies"  value="{{ old('hobbies') }}" id="hobbies" class="form-control">
            
            </div>
            <br />
            <div class="form-group">
                
                <label for="dob">Dob</label>
                <input type="date"  value="{{ old('date') }}" name="dob" id="dob" class="form-control">
            
            </div>
            <br />
            <div class="form-group">
            
                <button type='submit' class="btn btn-primary" >
                Save
                </button>
            </div>
        </form>
    </div>
</div>


@endsection('content')
