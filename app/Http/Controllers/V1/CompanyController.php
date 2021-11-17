<?php

namespace App\Http\Controllers\V1;

use App\Http\Controllers\Controller;
use App\Models\Company;
use App\Models\CompanyCategory;
use Symfony\Component\HttpFoundation\Response;


class CompanyController extends Controller
{
    public function index()
    {
        $companies = Company::with('categories')->get();

        return response()->json($companies, Response::HTTP_OK);
    }

    public function indexByCategory( $category )
    {
        $ids = CompanyCategory::where('category', 'like', '%'.$category.'%')
            ->get()?->pluck('company_id')->toArray();

        $companies = Company::with('categories')
            ->whereIn('id',$ids)->get();

        return response()->json($companies, Response::HTTP_OK);
    }



    public function show( $id ){

        $company = Company::with(['categories', 'rating', 'company_addresses', 'company_addresses.address'])->find($id);

        return response()->json($company, Response::HTTP_OK);
    }
}
