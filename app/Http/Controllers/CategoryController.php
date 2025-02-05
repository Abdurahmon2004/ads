<?php

namespace App\Http\Controllers;

use App\Http\Resources\CategoryResource;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CategoryController extends Controller
{
    public function rules(): array {
        return [
            'uz' => 'required|string|max:255',
            'ru' => 'required|string|max:255',
            'en' => 'required|string|max:255',
        ];
    }
   public function index(){
    $categories = Category::paginate(10);
    return $this->data(200, 'success', $categories);
   }
   public function store(Request $request){
    $validator = Validator::make($request->all(), $this->rules());
    if ($validator->fails()) {
        return $this->data(403, $validator->errors()->first(), null);
    }
    
    $category = Category::create([
        'name'=> [
            'uz'=> $request->uz,
            'ru'=> $request->ru,
            'en'=> $request->en,
        ],
    ]);
    $data = CategoryResource::make($category);
    return $this->data(200,'Created successfully', $data);
   }
   public function update(Request $request, Category $category){
    $validator = Validator::make($request->all(), $this->rules());
    if ($validator->fails()) {
        return $this->data(403, $validator->errors()->first(), null);
    }
    $category->update([
        'name'=> [
            'uz'=> $request->uz,
            'ru'=> $request->ru,
            'en'=> $request->en,
        ],
    ]);
    $data = CategoryResource::make($category);
    return $this->data(200,'Updated successfully', $data);
   }
   public function destroy(Category $category) {
    $category->delete();
    return $this->data(200, 'Deleted successfully', null);
}
}
