<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ReceiptTest extends TestCase
{
    use RefreshDatabase;

    public function test_receipt_page_receives_all_required_data(): void
    {
        $cashier = User::factory()->create(['usertype' => 'kasir']);

        $this->actingAs($cashier)
            ->get(route('receipt.print'))
            ->assertOk()
            ->assertSee('No. Transaksi: TRX-')
            ->assertSee('Tanggal:')
            ->assertSee('Kasir: ' . $cashier->name)
            ->assertSee('semen gersik 50kg')
            ->assertSee('Rp 65.000')
            ->assertSee('Rp 100.000')
            ->assertSee('Rp 35.000');
    }
}
