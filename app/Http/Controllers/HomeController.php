<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\Users\GetUsersService;
use Illuminate\Pagination\LengthAwarePaginator;

class HomeController extends Controller
{
    public function index(Request $request)
    {
        //Get list
        $service = GetUsersService::fetchUsers();

        //Handle the pagination
        if(!is_null($service)){
            $countAll = count($service);
            $currentPage = LengthAwarePaginator::resolveCurrentPage();
            $Collection = collect($service);
            $perPage = 5;
            $currentPageCollection = $Collection->slice(($currentPage * $perPage) - $perPage, $perPage)->all();
            $paginatedCollection = new LengthAwarePaginator($currentPageCollection , count($Collection), $perPage);
            $paginatedCollection->setPath($request->url());

        }
        return view('welcome', ['collection' => $paginatedCollection ?? null,'results'=>$countAll?? null]);
    }


}
