<?php

namespace App\Http\Repositories\Interfaces;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Http\Request;


interface RepositoryInterface
{
    /**
     * Get all resources.
     *
     * @return JsonResource
     */
    public function all(): JsonResource;

    /**
     * Get a single resource by ID.
     *
     * @param int $id
     * @return JsonResource
     */
    public function find(int $id): JsonResource;

    /**
     * Create a new resource.
     *
     * @param Request $request
     * @return JsonResource
     */
    public function create(Request $request): JsonResource;

    /**
     * Update an existing resource by ID.
     *
     * @param int $id
     * @param Request $request
     * @return JsonResource
     */
    public function update(int $id, Request $request): JsonResource;

    /**
     * Delete a resource by ID.
     *
     * @param int $id
     * @return bool
     */
    public function delete(int $id): JsonResource;
}
