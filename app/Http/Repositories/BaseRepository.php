<?php

namespace App\Http\Repositories;

use App\Http\Repositories\Interfaces\RepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Database\Eloquent\Model;

class BaseRepository implements RepositoryInterface
{
    protected $model;

    public function __construct(Model $model)
    {
        $this->model = $model;
    }

    public function all(): JsonResource
    {
        return JsonResource::collection($this->model->all());
    }

    public function find(int $id): JsonResource
    {
        $model = $this->model->find($id);
        return new JsonResource($model);
    }

    public function create(Request $request): JsonResource
    {
        $model = $this->model->create($request->all());
        return new JsonResource($model);
    }

    public function update(int $id, Request $request): JsonResource
    {
        $model = $this->model->find($id);
        $model->update($request->all());
        return new JsonResource($model);
    }

    public function delete(int $id): JsonResource
    {
        $model = $this->model->find($id);
        $model->delete();
        return new JsonResource($model);
    }
}