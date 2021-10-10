<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Course;
use App\Registration;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Carbon;

class IndexController extends Controller
{

    //лаба 11

    public function MainApi(){
        $course = Course::select()->where('ID','=',2)->first();
		return view('api')->with(['course'=>$course]);
    }

    public function ShowApi(Request $request){
        $data = Course::select()->where('id',$request->id)->first();
        $responsecode = 200;
        $header = array (
            'Content-Type' => 'application/json; charset=UTF-8',
            'charset' => 'utf-8'
            );
        return response()->json($data , $responsecode, $header, JSON_UNESCAPED_UNICODE);
    }

    public function NewApi(Request $request){
        $data = Course::create($request->all());
        $responsecode = 200;
        $header = array (
            'Content-Type' => 'application/json; charset=UTF-8',
            'charset' => 'utf-8'
            );
        return response()->json($data , $responsecode, $header, JSON_UNESCAPED_UNICODE);
    }

    public function DeleteApi(Request $request){
        Course::where('id',$request->id)->delete();
        $responsecode = 200;
        $header = array (
            'Content-Type' => 'application/json; charset=UTF-8',
            'charset' => 'utf-8'
            );
        return response()->json( 'Удалено',$responsecode, $header, JSON_UNESCAPED_UNICODE);
    }

    public function ShowCourse(Request $request){
        $course = Course::select()->where('id','=',$request->id)->first();
        return view('apiChange')->with(['course'=>$course]);
    }

    public function update(Request $request){
        $responsecode = 200;
        $header = array (
            'Content-Type' => 'application/json; charset=UTF-8',
            'charset' => 'utf-8'
            );
        $data = Course::where('id','=', $request->id)
        ->update(['name' =>$request->name,
				  'description' =>$request->description,
                  'quantity' =>$request->quantity,
                  'time'=>$request->time]);
        return response()->json($data , $responsecode, $header, JSON_UNESCAPED_UNICODE);
    }

    //лаба 10

    function Apartment(){
    	$registrations = Registration::GetCourse_Id(Auth::id());
        $x1 =array();
        foreach ($registrations as $registration) 
        {
            $x1[] = $registration['course'];
        }
        $courses = array();
        foreach ($x1 as $x)
        {
            $courses[] = Course::getCourseById($x);
        } 
        return view('apartments')->with(['courses'=>$courses]);
    }

    function Course($id) 
    {
    	if(Auth::check())
    	if(Auth::user()->is_Admin != 0)
    	{
        $course = Course::getCourseById($id);
        return view('course')->with(['course'=>$course]);
        }
        else{
            $course = Course::getCourseById($id);
            $x = Registration::RegId($id);
            return view('course')->with(['course'=>$course, 'x'=>$x]);
        }
    }

    function Main(){
    	        $courses = Course::select()->get();
                $registration = array();
                foreach ($courses as $course)
                {
                    $registration += [$course->id => Registration::CourseCount2($course)];
                }
                return view('index')->with(['courses'=>$courses, 'registration'=>$registration]);
    }

    function NewCourse(){
    	return view('new');
    }

    public function Post(Request $request) 
    {
        $this->validate($request,
        	['name' => 'required|unique:course', 
        	'description' => 'required',
            'time' => 'required',
            'quantity' => 'required']);
        $data = $request->all();
        $resume=new Course();
        $resume->fill($data);
        $resume->save();
        return redirect('/admin');
    }

    public function Delete($id) 
    {
        Course::deleteCourse($id);
        return redirect('/main');
    }


    function AdminAllCourses(){
    	$courses = Course::select()->get();
    	return view('coursesAdmin')->with(['courses'=>$courses]);
    }


    function Sort(Request $request)
    {
        $data=$request->all();
        $courses;
        if($data['select'] == 'Активен')
                $courses = Course::select()->where('time','>=', Carbon::now())->get();
        else if($data['select'] == 'Прошел')
            	$courses = Course::select()->where('time','<=', Carbon::now())->get();          
        else if($data['select'] == 'Нет мест')
                $courses = Course::select()->where('quantity','=', 0)->get();
        $registrations = Registration::select(['course_id'])->where('user_id','=',Auth::id())->get();
                $x =array();
                foreach ($registrations as $registration) 
                {
                    $x[] = $registration['course'];
                }
        return view('index')->with(['courses'=>$courses, 'x'=>$x]);
    }

    function Subscribe($Id, $Name)
    {
       return view('subs')->with(['Id'=>$Id, 'Name'=>$Name]);
    }

    function SubscribeEnd(Request $request, $Id) 
    {
		$this->validate($request,['INN' => 'required']);

        $array = $request->all();
        $array += ['user_id'=>Auth::id()];
        $array += ['course_id'=>$Id];
        $data = 
        [
            "user_id"=>Auth::id(),
        	'INN'=>$array['INN'], 
        	"course_id"=>$Id
        ];
        $resume=new Registration();
        $resume->fill($data);
        $resume->save();

        $quantity = GetQuantityMinus($Id);
        Course::UpdateQuantityMinus($Id,$quantity);
        return redirect('/');
    }

    public function DeleteC($courseId,$userId) 
    {
        $Id = Registration::GetId($userId,$courseId);
        Registration::DeleteId($Id);

        $quantity = Course::GetQuantity($courseId);
        Course::UpdateQuantity($courseId,$quantity);

        return redirect('/');
    }
    
    function MainPage()
	{
		if(Auth::check()){
            if(Auth::user()->is_Admin != 0){
            	$courses = Course::select()->get();
                $registration = array();
                foreach ($courses as $course)
                {
                    $registration += [$course->id => Registration::CourseCount($course->id)];
                }
                return view('admin')->with(['courses'=>$courses, 'registration'=>$registration]);
            }
            else
            { 
            	$registrations = Registration::RegCourse(Auth::id());
                $x =array();
                foreach ($registrations as $registration) 
                {
                    $x[] = $registration['course'];
                }
                $courses = Course::select()->get();
                $registration = array();
                foreach ($courses as $course)  
                {
                    $registration += [$course->id => Registration::CourseCount($course->id)];
                }
            	return view('index')->with(['courses'=>$courses,'x'=>$x, 'registration'=>$registration]);
            }
        }
        else
        { 
        	$courses = Course::select()->get();
        	return view('index')->with(['courses'=>$courses]);
        }
    }
}
