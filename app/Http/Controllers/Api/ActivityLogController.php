<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\ActivityLog;
use Illuminate\Http\Request;

class ActivityLogController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = ActivityLog::query();
        if ($request->filled('role')) $query->where('role', $request->role);
        if ($request->filled('account_id')) $query->where('account_id', $request->account_id);
        if ($request->filled('type')) $query->where('type', $request->type);
        if ($request->filled('from')) $query->where('time_iso', '>=', $request->from . ' 00:00:00');
        if ($request->filled('to')) $query->where('time_iso', '<=', $request->to . ' 23:59:59');

        $items = $query->orderBy('time_iso','desc')->paginate(50);
        return response()->json($items);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $log = ActivityLog::findOrFail($id);
        return response()->json($log);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        ActivityLog::findOrFail($id)->delete();
        return response()->json(['deleted' => true]);
    }

    /**
     * Export the filtered resource list.
     */
    public function export(Request $request)
    {
        $items = $this->index($request)->original; // just reuse filter
        // return JSON file
        return response()->streamDownload(function () use ($items) {
            echo json_encode($items, JSON_PRETTY_PRINT);
        }, 'user-activity-'.now()->toDateString().'.json', [
            'Content-Type' => 'application/json'
        ]);
    }
}
