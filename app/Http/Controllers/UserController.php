<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        $allMenus = Menu::where('status', 'active')->get();
        $hotToday = Menu::where('status', 'active')->where('is_hot_today', true)->get();
        $groupedMenus = $allMenus->groupBy('category');
        $categories = $allMenus->pluck('category')->unique();
        
        $user = auth()->user();
        
        // Calculate Stats
        $totalSpend = Order::where('customer_name', $user->name)
            ->where('status', 'completed') // Assuming only completed orders count for points/spend
            ->sum('total_amount');
            
        $totalOrders = Order::where('customer_name', $user->name)->count();
        
        $todaySpend = Order::where('customer_name', $user->name)
            ->where('status', 'completed')
            ->whereDate('created_at', today())
            ->sum('total_amount');

        // Calculate Points (5 points per transaction > 50,000)
        $completedOrders = Order::where('customer_name', $user->name)
            ->where('status', 'completed')
            ->get();
            
        $totalPoints = 0;
        foreach ($completedOrders as $order) {
            if ($order->total_amount > 50000) {
                $totalPoints += 5;
            }
        }

        // Recent Menus (from past orders)
        $recentMenus = \App\Models\OrderItem::whereHas('order', function ($query) use ($user) {
            $query->where('customer_name', $user->name);
        })
        ->with('menu')
        ->latest()
        ->get()
        ->pluck('menu')
        ->unique('id')
        ->take(8); // Show last 8 unique ordered items

        return view('user.index', [
            'hotToday' => $hotToday,
            'groupedMenus' => $groupedMenus,
            'categories' => $categories,
            'favoriteIds' => $user->favorites()->pluck('menu_id')->toArray(),
            'recentMenus' => $recentMenus,
            'stats' => [
                'total_spend' => $totalSpend,
                'total_orders' => $totalOrders,
                'today_spend' => $todaySpend,
                'points' => $totalPoints
            ]
        ]);
    }

    public function checkout(Request $request)
    {
        $request->validate([
            'items' => 'required|array',
            'items.*.id' => 'required|exists:menus,id',
            'items.*.quantity' => 'required|integer|min:1',
            'payment_method' => 'required|string',
        ]);

        try {
            \DB::beginTransaction();

            $order = Order::create([
                'user_id' => auth()->id(),
                'customer_name' => auth()->user()->name,
                'total_amount' => 0,
                'status' => 'pending',
                'payment_method' => $request->payment_method,
                'address' => auth()->user()->address,
                'order_method' => 'Delivery', // Default to Delivery for now since address is involved in COD
            ]);

            $totalAmount = 0;
            foreach ($request->items as $item) {
                $menu = Menu::find($item['id']);
                $subtotal = $menu->price * $item['quantity'];
                $totalAmount += $subtotal;

                OrderItem::create([
                    'order_id' => $order->id,
                    'menu_id' => $menu->id,
                    'quantity' => $item['quantity'],
                    'price' => $menu->price,
                ]);
            }

            $order->update(['total_amount' => $totalAmount]);

            \DB::commit();

            return response()->json([
                'success' => true,
                'message' => 'Pesanan berhasil dibuat!',
                'order_id' => $order->id
            ]);
        } catch (\Exception $e) {
            \DB::rollBack();
            return response()->json([
                'success' => false,
                'message' => 'Gagal memproses pesanan: ' . $e->getMessage()
            ], 500);
        }
    }

    public function orders()
    {
        $orders = Order::where('customer_name', auth()->user()->name)
            ->with('items.menu')
            ->latest()
            ->get();
        return view('user.orders', compact('orders'));
    }

    public function favorites()
    {
        $favorites = auth()->user()->favorites()->get();
        return view('user.favorites', compact('favorites'));
    }

    public function toggleFavorite($id)
    {
        $user = auth()->user();
        if ($user->favorites()->where('menu_id', $id)->exists()) {
            $user->favorites()->detach($id);
            $message = 'Dihapus dari favorit!';
            $status = 'removed';
        } else {
            $user->favorites()->attach($id);
            $message = 'Ditambahkan ke favorit!';
            $status = 'added';
        }

        return response()->json([
            'success' => true,
            'message' => $message,
            'status' => $status
        ]);
    }

    public function hotToday()
    {
        $hotMenus = Menu::where('status', 'active')->where('is_hot_today', true)->get();
        $favoriteIds = auth()->user()->favorites()->pluck('menu_id')->toArray();
        return view('user.hot_today', compact('hotMenus', 'favoriteIds'));
    }
}
