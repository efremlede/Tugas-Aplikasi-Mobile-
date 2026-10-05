<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * Jalur/route default setelah pengguna berhasil login.
     */
    public const HOME = '/dashboard';

    public function register(): void
    {
        //
    }

    public function boot(): void
    {
        //
    }
}
```[cite: 14]

4. Daftarkan file provider tersebut di **`bootstrap/providers.php`** (file yang sedang Anda buka pada gambar)[cite: 17]:

```php
<?php

use App\Providers\AppServiceProvider;
use App\Providers\RouteServiceProvider;

return [
    AppServiceProvider::class,
    RouteServiceProvider::class, // <-- Tambahkan baris ini
];
```[cite: 17]