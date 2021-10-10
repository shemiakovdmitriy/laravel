<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    protected $table = 'course';
    public $timestamps =  false;
    protected $fillable=['name','description','quantity','time'];

    public function Count(){
        return Registration::select()->where("course_id", $this->id)->count();
    }
    public static function getCourseById($id) {
        return self::select()->where('id','=',$id)->first();
    }
    public static function deleteCourse($id){
        Course::select()->where('id','=', $id)->delete();
    }
    public static function GetQuantity($courseId){
        return self::select()->where('id','=',$courseId)->first()->quantity;
    }
    public static function UpdateQuantity($courseId,$quantity){
        Course::where('id','=',$courseId)->update(['quantity'=> $quantity+1]);
    }
    public static function GetQuantityMinus($Id){
        return self::select()->where('id','=',$Id)->first()->quantity;
    }
    public static function UpdateQuantityMinus($Id,$quantity){
        Course::where('id','=',$Id)->update(['quantity'=> $quantity-1]);
    }
}
