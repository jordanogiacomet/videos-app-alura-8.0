<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreVideoRequest;
use App\Http\Requests\UpdateVideoRequest;
use App\Services\VideoService;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\QueryException;
use Exception;

/**
 * @OA\Info(
 *     title="API de Vídeos",
 *     version="1.0.0",
 *     description="API para o gerenciamento de vídeos"
 * )
 * 
 * @OA\Schema(
 *     schema="Video",
 *     type="object",
 *     title="Video",
 *     properties={
 *         @OA\Property(
 *             property="id",
 *             type="integer",
 *             description="ID of the video"
 *         ),
 *         @OA\Property(
 *             property="title",
 *             type="string",
 *             description="Title of the video"
 *         ),
 *         @OA\Property(
 *             property="description",
 *             type="string",
 *             description="Description of the video"
 *         )
 *     }
 * )
 * 
 * @OA\Schema(
 *     schema="StoreVideoRequest",
 *     type="object",
 *     title="StoreVideoRequest",
 *     required={"title", "description"},
 *     properties={
 *         @OA\Property(
 *             property="title",
 *             type="string",
 *             description="Title of the video"
 *         ),
 *         @OA\Property(
 *             property="description",
 *             type="string",
 *             description="Description of the video"
 *         )
 *     }
 * )
 * 
 * @OA\Schema(
 *     schema="UpdateVideoRequest",
 *     type="object",
 *     title="UpdateVideoRequest",
 *     properties={
 *         @OA\Property(
 *             property="title",
 *             type="string",
 *             description="Title of the video"
 *         ),
 *         @OA\Property(
 *             property="description",
 *             type="string",
 *             description="Description of the video"
 *         )
 *     }
 * )
 */
class VideoController extends Controller
{
    protected $videoService;

    public function __construct(VideoService $videoService)
    {
        $this->videoService = $videoService;
    }

    /**
     * @OA\Get(
     *     path="/videos",
     *     summary="Retrieve a list of videos",
     *     @OA\Response(
     *         response=200,
     *         description="List of videos",
     *         @OA\JsonContent(
     *             type="array",
     *             @OA\Items(ref="#/components/schemas/Video")
     *         )
     *     ),
     *     @OA\Response(
     *         response=500,
     *         description="Server error"
     *     )
     * )
     */
    public function index()
    {
        try {
            $videos = $this->videoService->all();
            return response()->json($videos);
        } catch (QueryException $e) {
            return response()->json(['error' => 'Database error: ' . $e->getMessage()], 500);
        } catch (Exception $e) {
            return response()->json(['error' => 'Server error: ' . $e->getMessage()], 500);
        }
    }

    /**
     * @OA\Post(
     *     path="/videos",
     *     summary="Create a new video",
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(ref="#/components/schemas/StoreVideoRequest")
     *     ),
     *     @OA\Response(
     *         response=201,
     *         description="Video created successfully"
     *     ),
     *     @OA\Response(
     *         response=500,
     *         description="Server error"
     *     )
     * )
     */
    public function store(StoreVideoRequest $request)
    {
        try {
            $video = $this->videoService->create($request);
            return response()->json($video, 201);
        } catch (QueryException $e) {
            return response()->json(['error' => 'Database error: ' . $e->getMessage()], 500);
        } catch (Exception $e) {
            return response()->json(['error' => 'Server error: ' . $e->getMessage()], 500);
        }
    }

    /**
     * @OA\Put(
     *     path="/videos/{video}",
     *     summary="Update an existing video",
     *     @OA\Parameter(
     *         name="video",
     *         in="path",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(ref="#/components/schemas/UpdateVideoRequest")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Video updated successfully"
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Video not found"
     *     ),
     *     @OA\Response(
     *         response=500,
     *         description="Server error"
     *     )
     * )
     */
    public function update(UpdateVideoRequest $request, $id)
    {
        try {
            $video = $this->videoService->update($id, $request);
            return response()->json($video);
        } catch (ModelNotFoundException $e) {
            return response()->json(['error' => 'Video not found'], 404);
        } catch (QueryException $e) {
            return response()->json(['error' => 'Database error: ' . $e->getMessage()], 500);
        } catch (Exception $e) {
            return response()->json(['error' => 'Server error: ' . $e->getMessage()], 500);
        }
    }

    /**
     * @OA\Get(
     *     path="/videos/{video}",
     *     summary="Retrieve a specific video",
     *     @OA\Parameter(
     *         name="video",
     *         in="path",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Video details"
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Video not found"
     *     ),
     *     @OA\Response(
     *         response=500,
     *         description="Server error"
     *     )
     * )
     */
    public function show($id)
    {
        try {
            $video = $this->videoService->find($id);
            return response()->json($video);
        } catch (ModelNotFoundException $e) {
            return response()->json(['error' => 'Video not found'], 404);
        } catch (Exception $e) {
            return response()->json(['error' => 'Server error: ' . $e->getMessage()], 500);
        }
    }

    /**
     * @OA\Delete(
     *     path="/videos/{video}",
     *     summary="Delete a specific video",
     *     @OA\Parameter(
     *         name="video",
     *         in="path",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=204,
     *         description="Video deleted successfully"
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Video not found"
     *     ),
     *     @OA\Response(
     *         response=500,
     *         description="Server error"
     *     )
     * )
     */
    public function destroy($id)
    {
        try {
            $this->videoService->delete($id);
            return response()->json(null, 204);
        } catch (ModelNotFoundException $e) {
            return response()->json(['error' => 'Video not found'], 404);
        } catch (QueryException $e) {
            return response()->json(['error' => 'Database error: ' . $e->getMessage()], 500);
        } catch (Exception $e) {
            return response()->json(['error' => 'Server error: ' . $e->getMessage()], 500);
        }
    }
}
