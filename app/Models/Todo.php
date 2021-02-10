<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Todo extends Model
{
    use HasFactory;

    protected $fillable = ['title','description'];
    public $timestamps = false;

    public static function rules() {
        return [
            'title' => 'required|string|max:255',
            'description' => 'required',
        ];
    }

    public static function messages(){
        return [
            'title.required' => 'You must enter the title',
            'description.required' => 'You must enter the description'
        ];
    }
}
