<?php

namespace App\Api\Role\Controllers;

use App\Api\Base\ApiController;
use App\Api\Role\Requests\{RoleCreateRequest, RoleUpdateRequest};
use App\Api\Role\Resources\{RoleCollection, RoleResource};
use Domain\Role\Actions\{CreateRole, DeleteRole, GetRole, ListRoles, UpdateRole};
use Throwable;

class RoleController extends ApiController
{
    /**
     * Get the role list.
     *
     *  * @OA\Get(
     *   path="/roles",
     *   tags={"Role"},
     *   operationId="roleIndex",
     *   summary="List of roles",
     *   description="List of roles",
     *   @OA\Response(response=200, description="Successful Operation"),
     *   @OA\Response(response=400, description="Bad Request"),
     *   @OA\Response(response=500, description="Server Error"),
     *   security={{"bearerAuth": {}}},
     * )
     *
     * @param ListRoles $listRoles
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(ListRoles $listRoles)
    {
        return new RoleCollection($listRoles->execute());
    }

    /**
     * Store a new role.
     *
     * @OA\Post(
     *   path="/roles",
     *   tags={"Role"},
     *   operationId="roleStore",
     *   summary="Create a new role",
     *   description="Create a new role",
     *   @OA\RequestBody(
     *     @OA\MediaType(
     *       mediaType="application/json",
     *       @OA\Schema(
     *         example={
     *           "name": "Role Name",
     *           "is_active": true,
     *         }
     *       )
     *     )
     *   ),
     *   @OA\Response(response=201, description="Created Successful"),
     *   @OA\Response(response=400, description="Bad Request"),
     *   @OA\Response(response=422, description="Unprocessable Entity"),
     *   @OA\Response(response=500, description="Server Error"),
     *   security={{"bearerAuth": {}}},
     * )
     *
     * @param RoleCreateRequest $request
     * @param CreateRole $createRole
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(RoleCreateRequest $request, CreateRole $createRole)
    {
        try {
            $role = $createRole->execute($request);
        } catch (Throwable $exception) {
            throw_if(is_development(), $exception);

            return $this->responseError('Error on create role!');
        }

        return $this->responseCreated(
            'Role created successfully!',
            new RoleResource($role)
        );
    }

    /**
     * Get the role by id.
     *
     * @OA\Get(
     *   path="/roles/{id}",
     *   tags={"Role"},
     *   operationId="roleShow",
     *   summary="Show role",
     *   description="Show role",
     *   @OA\Parameter(
     *     name="id",
     *     in="path",
     *     description="Role Id",
     *     required=true,
     *     @OA\Schema(type="integer")
     *   ),
     *   @OA\Response(response=200, description="Successful Operation"),
     *   @OA\Response(response=404, description="Resource Not Found"),
     *   security={{"bearerAuth": {}}},
     * )
     *
     * @param int $id
     * @param GetRole $getRole
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(int $id, GetRole $getRole)
    {
        $role = $getRole->execute($id);

        return new RoleResource($role);
    }

    /**
     * Update a role information.
     *
     * @OA\Put(
     *   path="/roles/{id}",
     *   tags={"Role"},
     *   operationId="roleUpdate",
     *   summary="Update role",
     *   description="Update role",
     *   @OA\Parameter(
     *     name="id",
     *     in="path",
     *     description="Role Id",
     *     required=true,
     *     @OA\Schema(type="integer")
     *   ),
     *   @OA\RequestBody(
     *     @OA\MediaType(
     *       mediaType="application/json",
     *       @OA\Schema(
     *         example={
     *           "name": "New Role Name",
     *            "is_active": true,
     *          }
     *        )
     *     )
     *   ),
     *   @OA\Response(response=200, description="Successful Operation"),
     *   @OA\Response(response=404, description="Resource Not Found"),
     *   @OA\Response(response=422, description="Unprocessable Entity"),
     *   @OA\Response(response=500, description="Server Error"),
     *   security={{"bearerAuth": {}}},
     * )
     *
     * @param RoleUpdateRequest  $request
     * @param int $id
     * @param UpdateRole  $updateRole
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(RoleUpdateRequest $request, int $id, UpdateRole $updateRole)
    {
        try {
            $updateRole->execute($id, $request);
        } catch (Throwable $exception) {
            throw_if(is_development(), $exception);

            return $this->responseError('Error on update role!');
        }

        return $this->responseOk('Role updated successfully!');
    }

    /**
     * Delete a role by id.
     *
     * @OA\Delete(
     *   path="/roles/{id}",
     *   tags={"Role"},
     *   operationId="roleDestroy",
     *   summary="Destroy role",
     *   description="Destroy role",
     *   @OA\Parameter(
     *     name="id",
     *     in="path",
     *     description="Role Id",
     *     required=true,
     *     @OA\Schema(type="integer")
     *   ),
     *   @OA\Response(response=200, description="Successful Operation"),
     *   @OA\Response(response=404, description="Resource Not Found"),
     *   @OA\Response(response=422, description="Unprocessable Entity"),
     *   @OA\Response(response=500, description="Server Error"),
     *   security={{"bearerAuth": {}}},
     * )
     *
     * @param int $id
     * @param DeleteRole $deleteRole
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(int $id, DeleteRole $deleteRole)
    {
        try {
            $deleteRole->execute($id);
        } catch (Throwable $exception) {
            throw_if(is_development(), $exception);

            return $this->responseError('Error on delete role!');
        }

        return $this->responseOk('Role deleted successfully!');
    }
}
