<?php

namespace Modules\Bookings\Policies;

use App\Models\User;
use Modules\Team\Models\Team;
use Illuminate\Auth\Access\HandlesAuthorization;

class BookingPolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     */
    public function __construct() {}
        public function create(User $user, Team $team): bool
    {
        return $user->tenant_id === $team->tenant_id;
    }
}
