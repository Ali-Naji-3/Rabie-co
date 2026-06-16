<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class LoginController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $guestSessionId = $request->session()->getId();

        if (Auth::attempt($credentials, $request->filled('remember'))) {
            $request->session()->regenerate();

            $this->mergeGuestCart($guestSessionId, Auth::user());

            // Redirect admin to Filament, others to homepage
            if (Auth::user()->role === 'admin') {
                return redirect('/admin');
            }

            return redirect()->intended('/');
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ])->onlyInput('email');
    }

    /**
     * Transfer guest cart rows (keyed by session_id) onto the now-authenticated
     * user, merging quantities where the user already has the same product.
     */
    private function mergeGuestCart(string $sessionId, User $user): void
    {
        DB::transaction(function () use ($sessionId, $user) {
            $guestCartItems = Cart::where('session_id', $sessionId)->get();

            foreach ($guestCartItems as $guestItem) {
                $userItem = Cart::where('user_id', $user->id)
                    ->where('product_id', $guestItem->product_id)
                    ->first();

                if ($userItem) {
                    $userItem->increment('quantity', $guestItem->quantity);
                    $guestItem->delete();
                } else {
                    $guestItem->update([
                        'user_id' => $user->id,
                        'session_id' => null,
                    ]);
                }
            }
        });
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }
}
