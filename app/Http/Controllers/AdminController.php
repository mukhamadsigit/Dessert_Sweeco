<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Menu;
use App\Models\Order;
use Carbon\Carbon;

class AdminController extends Controller
{
    public function index()
    {
        // Calculate Stats
        $todayRevenue = Order::whereDate('created_at', Carbon::today())->sum('total_amount');
        $totalOrders = Order::whereDate('created_at', Carbon::today())->count();
        $totalUsers = \App\Models\User::where('role', 'user')->count();

        $stats = [
            'revenue' => 'Rp ' . number_format($todayRevenue, 0, ',', '.'),
            'orders' => $totalOrders,
            'users' => $totalUsers,
        ];

        // Chart Data (Last 7 Days)
        $revenueData = Order::selectRaw('DATE(created_at) as date, SUM(total_amount) as total')
            ->where('created_at', '>=', Carbon::now()->subDays(7))
            ->groupBy('date')
            ->orderBy('date')
            ->get();

        $chartLabels = [];
        $chartData = [];

        // Fill in missing days
        for ($i = 6; $i >= 0; $i--) {
            $date = Carbon::now()->subDays($i)->format('Y-m-d');
            $label = Carbon::now()->subDays($i)->format('d M');
            
            $dayRevenue = $revenueData->firstWhere('date', $date);
            
            $chartLabels[] = $label;
            $chartData[] = $dayRevenue ? $dayRevenue->total : 0;
        }

        // Recent Orders
        $recentOrders = Order::latest()->take(5)->get();

        // Hot Today Menus
        $hotTodayMenus = Menu::where('is_hot_today', true)->get();

        // Fetch Menus
        $menuItems = Menu::all();

        return view('admin.dashboard', compact('stats', 'menuItems', 'chartLabels', 'chartData', 'recentOrders', 'hotTodayMenus'));
    }

    public function users()
    {
        $users = \App\Models\User::where('role', 'user')->latest()->paginate(10);
        return view('admin.users.index', compact('users'));
    }

    public function hotToday()
    {
        $menus = Menu::all();
        return view('admin.hot_today.index', compact('menus'));
    }

    public function toggleHotToday($id)
    {
        $menu = Menu::findOrFail($id);
        $menu->is_hot_today = !$menu->is_hot_today;
        $menu->save();

        return back()->with('success', 'Status Hot Today berhasil diperbarui');
    }

    public function toggleUserStatus($id)
    {
        $user = \App\Models\User::findOrFail($id);
        $user->status = $user->status === 'active' ? 'banned' : 'active';
        $user->save();

        return back()->with('success', 'Status user berhasil diperbarui');
    }

    public function deleteUser($id)
    {
        $user = \App\Models\User::findOrFail($id);
        $user->delete();

        return back()->with('success', 'User berhasil dihapus');
    }

    public function showOrder($id)
    {
        $order = Order::with('items.menu')->findOrFail($id);
        return view('admin.orders.show', compact('order'));
    }

    public function orders()
    {
        $orders = Order::latest()->paginate(10);
        return view('admin.orders.index', compact('orders'));
    }

    public function menu()
    {
        $menus = Menu::latest()->paginate(10);
        return view('admin.menu.index', compact('menus'));
    }

    public function createMenu()
    {
        return view('admin.menu.create');
    }

    public function storeMenu(Request $request)
    {
        $data = $request->validate([
            'name' => 'required',
            'category' => 'required',
            'price' => 'required|numeric',
            'status' => 'required',
            'is_hot_today' => 'nullable|boolean',
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048'
        ]);

        $data['is_hot_today'] = $request->has('is_hot_today');

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('menus', 'public');
        }

        Menu::create($data);

        return redirect()->route('admin.menu.index')->with('success', 'Menu berhasil ditambahkan');
    }

    public function editMenu($id)
    {
        $menu = Menu::findOrFail($id);
        return view('admin.menu.edit', compact('menu'));
    }

    public function updateMenu(Request $request, $id)
    {
        $menu = Menu::findOrFail($id);

        $data = $request->validate([
            'name' => 'required',
            'category' => 'required',
            'price' => 'required|numeric',
            'status' => 'required',
            'is_hot_today' => 'nullable|boolean',
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048'
        ]);

        $data['is_hot_today'] = $request->has('is_hot_today');

        if ($request->hasFile('image')) {
            // Delete old image
            if ($menu->image) {
                \Illuminate\Support\Facades\Storage::disk('public')->delete($menu->image);
            }
            $data['image'] = $request->file('image')->store('menus', 'public');
        }

        $menu->update($data);

        return redirect()->route('admin.menu.index')->with('success', 'Menu berhasil diupdate');
    }

    public function destroyMenu($id)
    {
        $menu = Menu::findOrFail($id);
        $menu->delete();

        return redirect()->route('admin.menu.index')->with('success', 'Menu berhasil dihapus');
    }

    public function profile()
    {
        $user = auth()->user();
        return view('admin.profile', compact('user'));
    }
}
