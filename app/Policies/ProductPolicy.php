<?php

namespace App\Policies;

use App\Models\Product;
use App\Models\User;

class ProductPolicy
{
    /**
     * Menentukan apakah user dapat memperbarui produk.
     */
    public function update(User $user, Product $product): bool
    {
        // Hanya admin yang bisa mengedit produk
        return $user->usertype === 'admin';
    }

    /**
     * Menentukan apakah user dapat menghapus produk.
     */
    public function delete(User $user, Product $product): bool
    {
        // Hanya admin yang bisa menghapus produk
        return $user->usertype === 'admin';
    }
}