<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Intervention\Image\ImageManagerStatic as Image;
use Illuminate\Support\Facades\Storage;
use \App\Models\DepartmentUser;
use \App\Models\User;

class Department extends Model
{
    use \Backpack\CRUD\app\Models\Traits\CrudTrait;
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'logo',
    ];


    public function setLogoAttribute($value)
    {
        $attribute_name = "logo";
        $disk = "uploads";
        $destination_path = "/";       
        $this->uploadFileToDisk($value, $attribute_name, $disk, $destination_path);
    }

    public function user()
    {
        //$userID = $this->hasMany(DepartmentUser::class, 'departments_id');
        return $this->hasMany(DepartmentUser::class, 'departments_id');
        /*return ($this->hasManyThrough(
            User::class,
            DepartmentUser::class,
            'user_id', 
            'id', 
            'departments_id',
            'id'
        ));*/
    }
}