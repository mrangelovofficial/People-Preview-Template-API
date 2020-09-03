<?php

namespace App\Http\Controllers;

use App\Services\Users\GetUsersService;
use App\Http\Requests\ValidateUserPageRequest;
use Illuminate\Pagination\LengthAwarePaginator;

class HomeController extends Controller
{
    public function index(ValidateUserPageRequest $request)
    {

        //Get list | Default value of fetchUsers is 1000
        $Users = GetUsersService::fetchUsers(1500);

        //Pagination
        if(!is_null($Users)){
            $countAll = count($Users);
            $currentPage = LengthAwarePaginator::resolveCurrentPage();
            $Collection = collect($Users);
            $perPage = $request->perPage ?? 5;
            $currentPageCollection = $Collection->slice(($currentPage * $perPage) - $perPage, $perPage)->all();
            $paginatedCollection = new LengthAwarePaginator($currentPageCollection , count($Collection), $perPage);
            $paginatedCollection->setPath($request->url());

        }
        return view('welcome', ['collection' => $paginatedCollection ?? null,'results'=>$countAll?? null]);
    }


}
