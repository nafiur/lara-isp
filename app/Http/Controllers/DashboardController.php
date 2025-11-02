<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\View\View;
use Laravel\Sanctum\PersonalAccessToken;

class DashboardController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(): View
    {
        $totalUsers = User::count();
        $newUsersThisWeek = User::whereBetween('created_at', [now()->subDays(7), now()])->count();
        $pendingVerifications = User::whereNull('email_verified_at')->count();
        $apiTokensIssued = PersonalAccessToken::count();

        $recentUsers = User::latest()->take(6)->get(['id', 'name', 'email', 'created_at', 'email_verified_at']);
        $recentTokens = PersonalAccessToken::with('tokenable')
            ->latest()
            ->take(6)
            ->get(['id', 'name', 'created_at', 'last_used_at']);

        return view('dashboard', [
            'metrics' => [
                'totalUsers' => $totalUsers,
                'newUsersThisWeek' => $newUsersThisWeek,
                'pendingVerifications' => $pendingVerifications,
                'apiTokensIssued' => $apiTokensIssued,
            ],
            'recentUsers' => $recentUsers,
            'recentTokens' => $recentTokens,
        ]);
    }
}
