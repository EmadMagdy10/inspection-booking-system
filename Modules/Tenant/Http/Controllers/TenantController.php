<?php

namespace Modules\Tenant\Http\Controllers;

use Illuminate\Http\Request;
use Modules\Tenant\Models\Tenant;
use App\Http\Controllers\Controller;

class TenantController extends Controller
{
  public function current(Request $request)
{
    $tenant = Tenant::findOrFail(auth()->user()->tenant_id);

    return response()->json($tenant);
}
}
