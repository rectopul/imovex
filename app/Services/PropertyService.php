<?php 

namespace App\Services;

use App\DataTables\PropertyDataTable;
use App\Models\Property;
use Carbon\Carbon;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Cache;

class PropertyService
{
    public  static function take()
    {
        return Property::orderBy('created_at', 'desc')->limit(15)->get();
    }

    public static function paginateBookmarked($perPage, $page)
    {
        return Property::whereIn('id', collect(session('bookmarks'))->toArray())->paginate($perPage, ['*'], 'page', $page);
    }

    public static function monthlyProperties()
    {
        $startOfMonth = Carbon::now()->startOfMonth();
        $endOfMonth = Carbon::now()->endOfMonth();
        
        $monthlyProperties = Cache::remember('monthlyProperties', 1440, function() use ($startOfMonth, $endOfMonth) {
            return Property::orderBy('created_at', 'desc')->limit(15)->get();
        });

        return $monthlyProperties;
    }

    public static function paginate($searchQuery)
    {
        
        $page = request('page', 1);
        $perPage = 15;

        
        
        $cacheKey = collect($searchQuery)->filter(function($value, $key) {
            return $key != 'page';
        })->map(function($value, $key) {
            return $value;
        })->implode('_');

        //return $cacheKey;

        // $filterQuery = Cache::remember('filterQuery_'.$cacheKey, 1440, function() use ($searchQuery) {
        //     return Property::views()->get();
        // });

        $filterQuery = Property::get();

        return $filterQuery;

        

        $cities = $filterQuery->whereNotNull('cidade')->pluck('cidade')->unique()->sort();
        $descriptions = $filterQuery->whereNotNull('descricao')->pluck('descricao')->unique()->sort();
        $bedrooms = $filterQuery->whereNotNull('dormitorios')->pluck('dormitorios')->unique()->sort();

        $paginate = new LengthAwarePaginator(
            $filterQuery->forPage($page, $perPage),
            $filterQuery->count(),
            $perPage,
            $page,
            ['path' => request()->url()]
        );

        $filters = collect([
            'filters' => compact('cities', 'descriptions', 'bedrooms')
        ]);

        return $filters->merge($paginate->toArray());
    }

    public static function paginateAll()
    {
        $page = request('page', 1);
        $perPage = 15;

        $query = Property::query()->get();
        $paginate = new LengthAwarePaginator(
            $query->forPage($page, $perPage),
            $query->count(),
            $perPage,
            $page,
            ['path' => request()->url()]
        );

        $cities = $query->whereNotNull('cidade')->pluck('cidade')->unique()->sort();
        $descriptions = $query->whereNotNull('descricao')->pluck('descricao')->unique()->sort();
        $bedrooms = $query->whereNotNull('dormitorios')->pluck('dormitorios')->unique()->sort();

        $filters = collect([
            'filters' => compact('cities', 'descriptions', 'bedrooms')
        ]);

        return $filters->merge($paginate->toArray());

    }

    public static function visitorHistory()
    {
        if(session()->has('history')) {

            $history = collect(session('history')->reverse()->unique()->slice(0, 5)->flatten()->toArray());

            $properties = Property::whereIn('id', $history)
            ->limit(5)
            ->get();

            $collection = collect();
            foreach($history as $item) {
                
                $collection->push($properties->where('id', $item)->first());

            }

            return $collection->filter()->values();

        }
    }

    public static function search($searchQuery)
    {
        return Property::where('descricao_curta', 'ilike', '%'.$searchQuery.'%')
        ->orWhere('descricao_detalhada', 'ilike', '%'.$searchQuery.'%')
        ->orWhere('endereco', 'ilike', '%'.$searchQuery.'%')
        ->orWhere('cidade', 'ilike', '%'.$searchQuery.'%')
        ->orWhere('bairro', 'ilike', '%'.$searchQuery.'%')
        ->orWhere('descricao_curta', 'ilike', '%'.$searchQuery.'%')
        ->orderBy('created_at', 'desc')
        ->get();
    }

    public static function datatable()
    {
        return (new PropertyDataTable)->render();
    }
}