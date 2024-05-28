<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Album;
use App\Models\Order;
use App\Models\Comment;
use Illuminate\Http\Request;

class StatsController extends Controller
{
    public function showStatistics()
    {
        $totalUsers = User::count();
        $totalAlbums = Album::count();
        $totalOrders = Order::count();
        $totalComments = Comment::count();

        $topAlbums = Album::withCount('orders')
                        ->orderBy('orders_count', 'desc')
                        ->take(5)
                        ->get();

        $topUsers = User::withCount('orders')
                        ->orderBy('orders_count', 'desc')
                        ->take(5)
                        ->get();

        return view('albums.stats', compact(
            'totalUsers', 'totalAlbums', 'totalOrders',
            'totalComments', 'topAlbums', 'topUsers'
        ));
    }
}
