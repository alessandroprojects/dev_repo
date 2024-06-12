<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Vacante;
use Illuminate\Auth\Access\Response;

class VacantePolocy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        //
        return $user->rol===2;
    }

    /**
     * Determine whether the user can view the model.
     */


    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        //
        return $user->rol===2;
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Vacante $vacante): bool
    {
        //
        return $user->id === $vacante->user_id;
    }

    /**
     * Determine whether the user can delete the model.
     */


    /**
     * Determine whether the user can restore the model.
     */

    /**
     * Determine whether the user can permanently delete the model.
     */
   /**
 * Determine whether the user can view the model.
 */
public function view(User $user, Vacante $vacante): bool
{
    // Por ejemplo, puedes permitir que el usuario vea la vacante solo si es el propietario
    return $user->id === $vacante->user_id;
}

}
