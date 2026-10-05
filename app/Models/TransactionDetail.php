<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransactionDetail extends Model
{
    use HasFactory;

    /**
     * Menentukan nama tabel secara eksplisit sesuai dengan migration
     */
    protected $table = 'transaction_details';

    /**
     * Mengosongkan $guarded agar semua data item produk dapat disimpan sekaligus
     */
    protected $guarded = [];

    /**
     * Relasi balik ke header transaksi (Belongs-to)
     */
    public function transaction()
    {
        return $this->belongsTo(Transaction::class);
    }

    /**
     * Relasi ke data produk utama (Belongs-to)
     */
    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}