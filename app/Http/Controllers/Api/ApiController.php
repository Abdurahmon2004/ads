<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\AdsResource;
use App\Http\Resources\CategoryResource;
use App\Http\Resources\RegionResource;
use App\Models\Ads;
use App\Models\Category;
use App\Models\Region;
use Illuminate\Http\Request;

class ApiController extends Controller
{
    public function ads(Request $request)
    {
        $ads = Ads::query();
        if ($request->has('search')) {
            $ads->where(function ($query) use ($request) {
                $query->where('title->uz', 'like', "%{$request->search}%")
                      ->orWhere('title->ru', 'like', "%{$request->search}%")
                      ->orWhere('title->en', 'like', "%{$request->search}%");
            });
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
        $data = AdsResource::collection($ads->paginate(10));
        return $this->data(200, 'success', $data);
    }
    public function categories(){
        $categories = Category::paginate(10);
        return $this->data(200, 'success', [
            'categories' => CategoryResource::collection($categories),
            'pagination' => [
                'total' => $categories->total(),
                'per_page' => $categories->perPage(),
                'current_page' => $categories->currentPage(),
                'last_page' => $categories->lastPage(),
                'from' => $categories->firstItem(),
                'to' => $categories->lastItem(),
                'next_page_url' => $categories->nextPageUrl(),
                'prev_page_url' => $categories->previousPageUrl(),
            ]
        ]);
       }
       public function regions(){
        $regions = Region::paginate(10);
        return $this->data(200, 'success', [
            'regions' => RegionResource::collection($regions),
            'pagination' => [
                'total' => $regions->total(),
                'per_page' => $regions->perPage(),
                'current_page' => $regions->currentPage(),
                'last_page' => $regions->lastPage(),
                'from' => $regions->firstItem(),
                'to' => $regions->lastItem(),
                'next_page_url' => $regions->nextPageUrl(),
                'prev_page_url' => $regions->previousPageUrl(),
            ]
        ]);
       }
}
