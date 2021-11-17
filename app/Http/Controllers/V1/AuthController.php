<?php

namespace App\Http\Controllers\V1;

use App\Http\Requests\V1\Example\CreateExampleRequest;
use App\Http\Requests\V1\Example\StoreExampleRequest;
use App\Http\Requests\V1\Example\UpdateExampleRequest;
use App\Http\Services\ExampleService;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class ExampleController
{
    /**
     * Display a listing of the resource.
     *
     * @param ExampleService $service
     * @return JsonResponse
     */
    public function index( ExampleService $service ): JsonResponse
    {
        return response(
            $service->allUserExamples( jwt()->userId() ),
            Response::HTTP_OK
        )->json();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param CreateExampleRequest $request
     * @param ExampleService $service
     * @return JsonResponse
     */
    public function create( CreateExampleRequest $request, ExampleService $service ): JsonResponse
    {
        return response(
            $service->create( $request->all()),
            Response::HTTP_CREATED
        )->json();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreExampleRequest $request
     * @param ExampleService $service
     * @return JsonResponse
     */
    public function store( StoreExampleRequest $request, ExampleService $service  ): JsonResponse
    {
        return response(
            $service->store( $request->all() ),
            Response::HTTP_ACCEPTED
        )->json();
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @param ExampleService $service
     * @return JsonResponse
     */
    public function show(int $id, ExampleService $service): JsonResponse
    {
        return response(
            $service->find($id),
            Response::HTTP_OK
        )->json();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateExampleRequest $request
     * @param ExampleService $service
     * @return JsonResponse
     */
    public function update(UpdateExampleRequest $request, ExampleService $service): JsonResponse
    {
        return response(
            $service->update($request->get('id'), $request->all()),
            Response::HTTP_OK
        )->json();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @param ExampleService $service
     * @return JsonResponse
     */
    public function destroy(int $id, ExampleService $service): JsonResponse
    {
        $service->destroy($id);

        return response( [], Response::HTTP_NO_CONTENT )->json();
    }
}
