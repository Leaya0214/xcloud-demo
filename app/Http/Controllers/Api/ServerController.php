<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreServerRequest;
use App\Http\Requests\UpdateServerRequest;
use App\Models\Server;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class ServerController extends Controller
{
    // List servers with filtering, search, sort, pagination
    public function index(Request $request)
    {
        $query = Server::query();

        // Search by name or IP
        if ($search = $request->input('search')) {
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%$search%")
                    ->orWhere('ip_address', 'like', "%$search%");
            });
        }

        // Filter by provider/status
        if ($provider = $request->input('provider')) {
            $query->where('provider', $provider);
        }
        if ($status = $request->input('status')) {
            $query->where('status', $status);
        }

        // Sorting
        $sortBy = $request->input('sortBy', 'created_at');
        $sortOrder = $request->input('sortOrder', 'desc');
        $query->orderBy($sortBy, $sortOrder);

        // Paginate
        $perPage = $request->input('perPage', 10);
        return response()->json($query->paginate($perPage));
    }

    // Create server
    public function store(StoreServerRequest $request)
    {
        // dd($request->all());
        $server = Server::create($request->validated());
        return response()->json([
            'message' => 'Server created successfully!',
            'data' => $server
        ], 201);
    }

    // Show server
    public function show(Server $server)
    {
        return response()->json($server);
    }

    // Update server
    public function update(UpdateServerRequest $request, Server $server)
    {
        $server->update($request->validated());
        return response()->json($server);
    }

    // Delete server
    public function destroy(Server $server)
    {
        $server->delete();
        return response()->json(['message' => 'Server deleted']);
    }

    // Bulk delete (bonus)
    public function bulkDelete(Request $request)
    {
        $ids = $request->input('ids', []);
        Server::whereIn('id', $ids)->delete();
        return response()->json(['message' => 'Servers deleted']);
    }

    public function bulkUpdateStatus(Request $request)
    {
        $request->validate([
            'ids' => 'required|array',
            'ids.*' => 'integer|exists:servers,id',
            'status' => 'required|in:active,inactive,maintenance',
        ]);

        Server::whereIn('id', $request->ids)->update(['status' => $request->status]);

        return response()->json(['message' => 'Servers updated successfully!']);
    }
}
