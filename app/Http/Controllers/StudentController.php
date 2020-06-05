<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Student;
use App\Profile;
use Illuminate\Support\Facades\DB;
class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $datas=DB::table('students')
                  ->join('profiles','students.id','=','profiles.user_id')
                  ->orderBy("students.id",'desc')
                  ->paginate(5);

        return view("index",compact("datas"))->with("i",(request()->input("page",1)-1)*5);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("create");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $this->validate($request,[
            'name'=>'required|string|min:2',
            'class'=>'required|min:1',
            'email'=>'required|unique:App\Student|email',
            'phone'=>'required|integer|min:10'

        ]);
        
        $student=Student::create($request->all());

        //here fetch user id for working of profile form
        
        $user_id=DB::table('students')->latest()->first();
        
        if( $student ){
            return back()->with("success","data added successfully. Please fill the profile form")->with("user_id", $user_id->id );
        }
        else{
            return back()->with("error","There was an error form not submitted ");
        }
        

        
    }
    /**
     * Store Profile  a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store_profile(Request $request)
    {
        //
        // if user not submit student form than this function will not working because user id is not fetch
        if($request->user_id!=""){

            $this->validate($request,[
                'image'=>'required|image|mimes:png,jpg,jpeg,gif|max:8000',
                'dob'=>'required|date',
                'hobbies'=>'required|string',
                'user_id'=>'required'
    
            ]);
            $image=$request->file('image');

            $new_image=rand().".".$image->getClientOriginalExtension();

            $image->move(public_path('images'),$new_image);

            $form_data=[
                'image'=>$new_image,
                'dob'=>$request->dob,
                'hobbies'=>$request->hobbies,
                'user_id'=>$request->user_id
            ];

            $profile=Profile::create($form_data);
            if($profile){

                return redirect('student')->with("success","student addedd successfully");
            }

        }
        else{

            return back()->with("error","Please fill the Student form first");
        }
        
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
        $student=Student::where("id",$id)->get()->first();
        // here we use one to one relationship
        $student_profile=$student->profile;

        return view("profile")->with("student_profile",$student_profile)->with("student",$student);
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
        
        $student=Student::where("id",$id)->get()->first();
        // here we use one to one relationship
        $student_profile=$student->profile;

        return view("edit")->with("student_profile",$student_profile)->with("student",$student);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $student_email=Student::where('id',$id)->get()->first();
        if($student_email->email===$request->email){

            $this->validate($request,[
                'name'=>'required|string|min:2',
                'class'=>'required',
                'email'=>'required|email',
                'phone'=>'required|integer|min:10'
    
            ]);
        }
        else{
            $this->validate($request,[
                'name'=>'required|string|min:2',
                'class'=>'required',
                'email'=>'required|unique:App\Student|email',
                'phone'=>'required|integer|min:10'
    
            ]);
        }

        $form_data=[
            'name'=>$request->name,
            'class'=>$request->class,
            'email'=>$request->email,
            'phone'=>$request->phone

        ];
        $student=Student::whereId($id)->update($form_data);
        
        if( $student ){
            return back()->with("success","data updated successfully.")->with("user_id", $id );
        }
        else{
            return back()->with("error","There was an error form not submitted ");
        }
        
    }

    public function update_profile(Request $request ,$id)
    {

            $new_image="";
            $image=$request->file("image");

            // if user select image then
            if($image!=""){
                $this->validate($request,[
                    'image'=>'required|image|mimes:png,jpg,jpeg,gif|max:8000',
                    'dob'=>'required|date',
                    'hobbies'=>'required|string',
                    'user_id'=>'required' 
                ]);
                $new_image=rand().".".$image->getClientOriginalExtension();
                $image->move(public_path('images'),$new_image);
            }
            // if user want to keep old image
            else{

                $this->validate($request,[
                    'dob'=>'required|date',
                    'hobbies'=>'required|string',
                    'user_id'=>'required' 
                ]);
                $new_image=$request->old_image;
            }

            $form_data=[
                'image'=>$new_image,
                'dob'=>$request->dob,
                'hobbies'=>$request->hobbies,
                'user_id'=>$request->user_id
            ];

            $profile=Profile::where("user_id",$id)->update($form_data);
            if($profile){

                return back()->with("success","Profile data updated successfully");
            }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $student=Student::find($id);
        if($student){
            $student->delete();
            return back()->with("success","data deleted successfully");
        }
    }
}
