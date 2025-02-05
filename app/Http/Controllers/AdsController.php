<?php

namespace App\Http\Controllers;

use App\Http\Resources\AdsResource;
use App\Models\Ad_tag;
use App\Models\Ads;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class AdsController extends Controller
{
    public function rules(): array {
        return [ 
            'title_uz' => 'required|string|max:255',
            'title_ru' => 'required|string|max:255',
            'title_en' => 'required|string|max:255',
        
            'description_uz' => 'required|string',
            'description_ru' => 'required|string',
            'description_en' => 'required|string',
        
            'category_id' => 'required|exists:categories,id',
            'region_id' => 'required|exists:regions,id',
            'tag_ids' => 'required|exists:tags,id',
            'price' => 'nullable|numeric|min:0',
            'image'=> 'nullable|max:4096'
        ];
    }
    public function index(Request $request)
    {
        $ads = Ads::query();
        if ($request->has('search')) {
            $ads->where('title->uz', 'like', "%{$request->search}%")
                ->orWhere('title->ru', 'like', "%{$request->search}%")
                ->orWhere('title->en', 'like', "%{$request->search}%");
        }
        if ($request->has('category_id')) {
            $ads->where('category_id', $request->category_id);
        }
        if ($request->has('region_id')) {
            $ads->where('region_id', $request->region_id);
        }
        if ($request->has('price_min')) {
            $ads->where('price', '>=', $request->price_min);
        }
        if ($request->has('price_max')) {
            $ads->where('price', '<=', $request->price_max);
        }
        if ($request->has('tag_ids')) {
            $ads->whereHas('tags', function ($query) use ($request) {
                $query->whereIn('tags.id', (array) $request->tag_ids);
            });
        }
        if ($request->has('sort')) {
            $ads->orderBy('price', $request->sort == 'desc' ? 'desc' : 'asc');
        }
        return $this->data(200, 'success', $ads->paginate(10));
    }
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), $this->rules());
        if( $validator->fails() ) {
            return $this->data(403, $validator->errors()->first(), null);
        }
        $userId = Auth::user()->id;
        if($request->hasFile('image')) {
            $image = md5(rand(1111, 9999).microtime()).'.'.$request->file('image')->extension();
            $request->file('image')->storeAs('ads/', $image, 'public');
        }else{
            $image = null;
        }
        $ads = Ads::create([
            'title'=> [
                'uz'=> $request->title_uz,
                'ru'=> $request->title_ru,
                'en'=> $request->title_en,
            ],
            'description'=> [
                'uz'=> $request->description_uz,
                'ru'=> $request->description_ru,
                'en'=> $request->description_en,
            ],
            'category_id'=> $request->category_id,
            'region_id'=> $request->region_id,
            'price'=> $request->price,
            'user_id'=> $userId,
            'image'=> $image
        ]);
        foreach ($request->tag_ids as $tag_id) {
            Ad_tag::create([
                'ad_id'=> $ads->id,
                'tag_id'=> $tag_id
            ]);
        }
        return $this->data(200,'Created successfully', null);
    }
    public function show(Ads $ad)
    {
        return response()->json([
            'status' => 200,
            'message' => 'E’lon ma’lumotlari',
            'data' => $ad
        ]);
    }
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), $this->rules());
        if( $validator->fails() ) {
            return $this->data(403, $validator->errors()->first(), null);
        }
        $ads = Ads::find( $id );
        if(!$ads){
            return $this->data(404, 'Not available', null);
        }
        $userId = Auth::user()->id;
        if($request->image) {
            $image = md5(rand(1111, 9999).microtime()).'.'.$request->file('image')->extension();
            $request->file('image')->storeAs('ads/', $image, 'public');
            Storage::delete('/public/ads/'.$ads->image);
        }else{
            $image = $ads->image;
        }
        $ads->update([
            'title'=> [
                'uz'=> $request->title_uz,
                'ru'=> $request->title_ru,
                'en'=> $request->title_en,
            ],
            'description'=> [
                'uz'=> $request->description_uz,
                'ru'=> $request->description_ru,
                'en'=> $request->description_en,
            ],
            'category_id'=> $request->category_id,
            'region_id'=> $request->region_id,
            'price'=> $request->price,
            'user_id'=> $userId,
            'image'=> $image
        ]);
        Ad_tag::where('ad_id', $ads)->delete();
        foreach ($request->tag_ids as $tag_id) {
            Ad_tag::create([
                'ad_id'=> $ads->id,
                'tag_id'=> $tag_id
            ]);
        }
        return $this->data(200,'Updated successfully', null);
    }
    public function destroy($id)
    {
        $ads = Ads::find( $id );
        if(!$ads){
            return $this->data(404, 'Not available', null);
        }
        Storage::delete('/public/ads/'.$ads->image);
        $ads->delete();
        return response()->json([
            'status' => 200,
            'message' => 'E’lon muvaffaqiyatli o‘chirildi'
        ]);
    }
}
