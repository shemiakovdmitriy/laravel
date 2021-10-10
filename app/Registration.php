<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Registration extends Model
{
    protected $table = 'registration';
    public $timestamps =  false;
    protected $fillable = ['user_id', 'phone', 'course_id'];
    public static function CourseCount($id)
    {
        return self::select()->where('course_id',$id)->get()->count();
    }
    public static function RegId($id){
        return self::select()->where('course_id','=',$id)->first();
    }
    public static function RegCourse($id){
        return self::select(['course_id'])->where('user_id','=',$id)->get();
    }
    public static function GetId($userId,$courseId){
        return self::select()->where('user','=',$userId)->where('course','=',$courseId)->first()->id;
    }
    public static function DeleteId($id){
        Registration::select()->where('id','=',$Id)->delete();
    }
    public static function CourseCount2($course)
    {
        return self::select()->where('course_id','=', $course->id)->count();
    }
    public static function GetCourse_Id($id){
        return self::select(['course_id'])->where('user_id','=',$id)->get();
    }
}
