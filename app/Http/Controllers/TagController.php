<?php

namespace App\Http\Controllers;

use App\Http\Resources\TagResource;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TagController extends Controller
{
    public function rules(): array {
        return [
            'name' => 'required|string|max:255',
        ];
    }
   public function index(){
    $tags = Tag::paginate(10);
    return $this->data(200, 'success', $tags);
   }
   public function store(Request $request){
    $validator = Validator::make($request->all(), $this->rules());
    if ($validator->fails()) {
        return $this->data(403, $validator->errors()->first(), null);
    }
    
    $tag = Tag::create([
       'name'=> $request->name,
    ]);
    $data = TagResource::make($tag);
    return $this->data(200,'Created successfully', $data);
   }
   public function update(Request $request, Tag $tag){
    $validator = Validator::make($request->all(), $this->rules());
    if ($validator->fails()) {
        return $this->data(403, $validator->errors()->first(), null);
    }
    $tag->update([
        'name'=> $request->name,
    ]);
    $data = TagResource::make($tag);
    return $this->data(200,'Updated successfully', $data);
   }
   public function destroy(Tag $tag) {
    $tag->delete();
    return $this->data(200, 'Deleted successfully', null);
}
}
