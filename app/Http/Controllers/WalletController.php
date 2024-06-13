<?php
// app/Http/Controllers/WalletController.php

namespace App\Http\Controllers;

use App\Models\Wallet;
use App\Services\WalletService;
use Illuminate\Http\Request;

class WalletController extends Controller
{
    protected $walletService;

    public function __construct(WalletService $walletService)
    {
        $this->walletService = $walletService;
    }

    public function getAllWallets()
    {
        return response()->json($this->walletService->getAllWallets(), 200);
    }

    public function getWalletDetails($id)
    {
        return response()->json($this->walletService->getWalletDetails($id), 200);
    }

    public function transfer(Request $request)
    {
        $request->validate([
            'sender_wallet_id' => 'required|integer|exists:wallets,id',
            'receiver_wallet_id' => 'required|integer|exists:wallets,id',
            'amount' => 'required|numeric|min:0.01',
        ]);

        $this->walletService->transfer(
            $request->sender_wallet_id,
            $request->receiver_wallet_id,
            $request->amount
        );

        return response()->json(['message' => 'Transfer successful'], 200);
    }
}
