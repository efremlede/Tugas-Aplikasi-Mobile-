<?php

namespace Tests\Feature;

use App\Models\Transaction;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class TransactionHistoryTest extends TestCase
{
    use RefreshDatabase;

    public function test_cashier_can_open_transaction_history(): void
    {
        $cashier = User::factory()->create(['usertype' => 'kasir']);
        Transaction::create([
            'transaction_number' => 'TRX-20261106-001',
            'user_id' => $cashier->id,
            'subtotal' => 150000,
            'discount' => 0,
            'tax' => 0,
            'other_fee' => 0,
            'grand_total' => 150000,
            'paid_amount' => 200000,
            'change_amount' => 50000,
            'payment_method' => 'tunai',
            'status' => 'completed',
        ]);

        $this->actingAs($cashier)
            ->get(route('cashier.riwayat'))
            ->assertOk()
            ->assertSee('Riwayat Transaksi')
            ->assertSee('TRX-20261106-001')
            ->assertSee($cashier->name)
            ->assertSee('Rp 150.000');
    }

    public function test_transaction_history_shows_an_empty_state(): void
    {
        $cashier = User::factory()->create(['usertype' => 'kasir']);

        $this->actingAs($cashier)
            ->get(route('cashier.riwayat'))
            ->assertOk()
            ->assertSee('Belum ada transaksi yang tercatat.');
    }
}