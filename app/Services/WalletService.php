<?php

namespace App\Services;

use App\Models\Wallet;

class WalletService
{
    public function getAllWallets()
    {
        return Wallet::all();
    }

    public function getWalletDetails($id)
    {
        return Wallet::with('user')->findOrFail($id);
    }

    public function transfer($senderWalletId, $receiverWalletId, $amount)
    {
        $senderWallet = Wallet::findOrFail($senderWalletId);
        $receiverWallet = Wallet::findOrFail($receiverWalletId);

        if ($senderWallet->balance < $amount) {
            throw new \Exception('Insufficient balance');
        }

        $senderWallet->balance -= $amount;
        $receiverWallet->balance += $amount;

        $senderWallet->save();
        $receiverWallet->save();
    }
}
