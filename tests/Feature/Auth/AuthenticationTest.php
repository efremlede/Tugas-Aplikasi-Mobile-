<?php

namespace Tests\Feature\Auth;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AuthenticationTest extends TestCase
{
    use RefreshDatabase;

    public function test_login_screen_can_be_rendered(): void
    {
        $response = $this->get('/login');

        $response->assertStatus(200);
    }

    public function test_users_can_authenticate_using_the_login_screen(): void
    {
        $user = User::factory()->create();

        $response = $this->post('/login', [
            'email' => $user->email,
            'password' => 'password',
        ]);

        $this->assertAuthenticated();
        $response->assertRedirect('/dashboard');
    }

    public function test_cashier_can_log_in_without_email_verification(): void
    {
        $cashier = User::factory()->unverified()->create(['usertype' => 'kasir']);

        $response = $this->post('/login', [
            'email' => $cashier->email,
            'password' => 'password',
        ]);

        $this->assertAuthenticatedAs($cashier);
        $response->assertRedirect(route('cashier.index'));
        $this->get(route('cashier.index'))->assertOk()
            ->assertSee('Anda berhasil masuk sebagai kasir.');
        $this->get('/cashier')->assertRedirect(route('cashier.index'));
        $this->get('/email/verify')->assertRedirect(route('cashier.index'));
    }

    public function test_cashier_role_can_access_the_kasir_url(): void
    {
        $cashier = User::factory()->create(['role' => 'kasir']);

        $this->actingAs($cashier)->get('/kasir')->assertOk()
            ->assertSee('Anda berhasil masuk sebagai kasir.');
    }

    public function test_non_cashiers_cannot_access_the_cashier_page(): void
    {
        $user = User::factory()->create(['usertype' => 'pembeli']);

        $this->actingAs($user)->get(route('cashier.index'))->assertForbidden();
    }

    public function test_cashiers_cannot_access_admin_pages(): void
    {
        $cashier = User::factory()->create(['usertype' => 'kasir']);

        $this->actingAs($cashier)->get(route('admin.dashboard'))->assertForbidden();
    }

    public function test_users_can_not_authenticate_with_invalid_password(): void
    {
        $user = User::factory()->create();

        $this->post('/login', [
            'email' => $user->email,
            'password' => 'wrong-password',
        ]);

        $this->assertGuest();
    }

    public function test_users_can_logout(): void
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->post('/logout');

        $this->assertGuest();
        $response->assertRedirect('/');
    }
}
