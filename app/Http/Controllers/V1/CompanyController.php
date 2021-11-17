<?php

namespace App\Http\Controllers\V1;

use App\Http\Controllers\Controller;
use App\Models\Company;
use Symfony\Component\HttpFoundation\Response;


class CompanyController extends Controller
{
    public function index()
    {
        $companies = Company::with('categories')->get();

        return response()->json($companies, Response::HTTP_OK);
    }

    public function show( $id ){

        $company = Company::with(['categories', 'rating'])->find($id);

        return response()->json($company, Response::HTTP_OK);
    }
}
