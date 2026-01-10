<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Menu;
use Illuminate\Http\Request;

class MenuController extends Controller
{
    public function index(Request $request)
    {
        $query = Menu::where('status', 'active');

        if ($request->has('hot')) {
            $query->where('is_hot_today', true);
        }

        $menus = $query->get();

        return response()->json([
            'success' => true,
            'message' => 'Daftar Menu Sweeco Berhasil Diambil',
            'data'    => $menus
        ]);
    }

    public function show($id)
    {
        $menu = Menu::find($id);

        if (!$menu) {
            return response()->json([
                'success' => false,
                'message' => 'Menu tidak ditemukan',
            ], 404);
        }

        return response()->json([
            'success' => true,
            'message' => 'Detail Menu Berhasil Diambil',
            'data'    => $menu
        ]);
    }
}