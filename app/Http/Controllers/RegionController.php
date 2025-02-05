<?php

namespace App\Http\Controllers;

use App\Http\Resources\RegionResource;
use App\Models\Region;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class RegionController extends Controller
{
    public function rules(): array {
        return [
            'uz' => 'required|string|max:255',
            'ru' => 'required|string|max:255',
            'en' => 'required|string|max:255',
        ];
    }
   public function index(){
    $regions = Region::paginate(10);
    return $this->data(200, 'success', $regions);
   }
   public function store(Request $request){
    $validator = Validator::make($request->all(), $this->rules());
    if ($validator->fails()) {
        return $this->data(403, $validator->errors()->first(), null);
    }
    
    $region = Region::create([
        'name'=> [
            'uz'=> $request->uz,
            'ru'=> $request->ru,
            'en'=> $request->en,
        ],
    ]);
    $data = RegionResource::make($region);
    return $this->data(200,'Created successfully', $data);
   }
   public function update(Request $request, Region $region){
    $validator = Validator::make($request->all(), $this->rules());
    if ($validator->fails()) {
        return $this->data(403, $validator->errors()->first(), null);
    }
    $region->update([
        'name'=> [
            'uz'=> $request->uz,
            'ru'=> $request->ru,
            'en'=> $request->en,
        ],
    ]);
    $data = RegionResource::make($region);
    return $this->data(200,'Updated successfully', $data);
   }
   public function destroy(Region $region) {
    $region->delete();
    return $this->data(200, 'Deleted successfully', null);
}
}
