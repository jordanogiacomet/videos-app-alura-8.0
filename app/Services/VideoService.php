<?php

namespace App\Services;

use App\Http\Repositories\VideoRepository;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class VideoService
{
    protected $videoRepository;

    public function __construct(VideoRepository $videoRepository)
    {
        $this->videoRepository = $videoRepository;
    }

    public function all()
    {
        return $this->videoRepository->all();
    }

    public function find(int $id)
    {
        return $this->videoRepository->find($id);
    }

    public function create(Request $request)
    {
        return $this->videoRepository->create($request);
    }

    public function update(int $id, Request $request)
    {
        return $this->videoRepository->update($id, $request);
    }

    public function delete(int $id)
    {
        $video = $this->videoRepository->find($id);
        if (!$video) {
            throw new ModelNotFoundException('Video not found');
        }
        return $this->videoRepository->delete($id);
    }
}