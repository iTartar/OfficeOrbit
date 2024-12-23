<?php
namespace App\Http\Controllers;

use DB;
use App\Models\notification;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Builder;


class NotificationController extends Controller
{
    public function index(Request $request)
    {
        $perPage = $request->input('per_page', 10); // Default 10 if no input
        $notifications = notification::with('user')->paginate($perPage)->withPath('/notification');
        $users = User::all();
        $orderColumn = request('order_column', 'type');
        if (! in_array($orderColumn, ['id', 'message', 'type'])) { 
            $orderColumn = 'type';
        } 
        $orderDirection = request('order_direction', 'desc');
        if (! in_array($orderDirection, ['asc', 'desc'])) { 
            $orderDirection = 'desc';
        } 
        
        $users = User::query()
        ->when(request('search'), function (Builder $query) {
            $query->where('nama', 'type', '%' . request('search') . '%')
                ->orWhere('nama', 'type', '%' . request('search') . '%')
                ->orWhere('nama', 'type', '%' . request('search') . '%');
        })
        ->when(request('nama'), function (Builder $query) {
            $query->where('nama', request('nama'));
        })
        ->orderBy($orderColumn, $orderDirection)
        ->paginate(10);
        if ($request->ajax()) {
            return view('notification.table', compact('notifications'))->render();
        }
       
        return view('notification', compact('users', 'notifications'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'type' => 'required|in:Announcement,Notification',
            'message' => 'required|string',
        ]);

        notification::create($validatedData);

        return redirect()->route('notification.index')->with('success', 'notification created successfully.');
    }


    public function update(Request $request, notification $notification)
    {
        $validatedData = $request->validate([
            'type' => 'required|in:Announcement,Notification',
            'message' => 'required|string',
        ]);
        $notification->update($validatedData);
        return redirect()->route('notification.index')->with('success', 'notification updated successfully.');
    }

    public function destroy(notification $notification)
    {
        try {
            DB::beginTransaction();
            
            $notification = Notification::findOrFail($notification);
            
            // You could add additional checks here if needed
            // For example, check if user has permission to delete
            
            $notification->delete();
            
            DB::commit();
            return response()->json(['message' => 'Notification deleted successfully']);
            
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            DB::rollBack();
            return response()->json(['error' => 'Notification not found or already deleted'], 404);
            
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['error' => 'Failed to delete notification'], 500);
        }
    }
}
