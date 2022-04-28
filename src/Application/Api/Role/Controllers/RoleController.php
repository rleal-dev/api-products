<?php

namespace App\Api\Role\Controllers;

use App\Api\Base\ApiController;
use App\Api\Role\Requests\RoleRequest;
use App\Api\Role\Resources\{RoleCollection, RoleResource};
use Domain\Role\Actions\{CreateRole, DeleteRole, GetRole, ListRoles, UpdateRole};
use Throwable;

class RoleController extends ApiController
{
    /**
     * Get the role list.
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
     * @param RoleRequest $request
     * @param CreateRole $createRole
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(RoleRequest $request, CreateRole $createRole)
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
     * @param RoleRequest  $request
     * @param int $id
     * @param UpdateRole  $updateRole
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(RoleRequest $request, int $id, UpdateRole $updateRole)
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
