<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Auth; // <-- Di sebagian versi Laravel ini bisa memicu error jika alias Auth belum terdaftar

class Admin {
    public function handle(Request $request, Closure $next){
        if (Auth::check()){
            if(Auth::user()->role == 'admin'){
                return $next($request);
            } else {
                abort(403);
            }
        } else {
            return redirect()->route('login');
        }
    }
}
```[cite: 1]

---

#### **2. Versi Lengkap & Disarankan (Sangat Direkomendasikan)**
Ubah baris `use Auth;`[cite: 1] menjadi `use Illuminate\Support\Facades\Auth;` agar kelas `Auth` dapat terbaca dengan tepat:

```php
<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth; // <-- Menggunakan namespace Facade resmi Laravel

class Admin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        // 1. Cek apakah pengguna sudah login
        if (Auth::check()) {
            // 2. Cek apakah role pengguna adalah 'admin'
            if (Auth::user()->role == 'admin') {
                return $next($request); // Lanjutkan request
            } else {
                abort(403); // Tampilkan halaman Forbidden jika bukan admin
            }
        } else {
            // 3. Jika belum login, arahkan ke halaman login
            return redirect()->route('login');
        }
    }
}
```[cite: 1]

---

### **Langkah Selanjutnya Setelah Menyimpan `Admin.php`:**

1. **Daftarkan Middleware**[cite: 2]:
   * **Laravel 11 / 12** (buka `bootstrap/app.php`)[cite: 2]:
     ```php
     ->withMiddleware(function (Middleware $middleware) {
         $middleware->alias([
             'admin' => \App\Http\Middleware\Admin::class,
         ]);
     })
     ```[cite: 2]
   * **Laravel 10 ke bawah** (buka `app/Http/Kernel.php`)[cite: 2]:
     ```php
     protected $routeMiddleware = [
         'admin' => \App\Http\Middleware\Admin::class,
     ];
     ```[cite: 2]

2. **Gunakan di `routes/web.php`**[cite: 3]:
   ```php
   Route::get('/admin', function () {
       return view('dashboard');
   })->middleware('admin');
   ```[cite: 3]