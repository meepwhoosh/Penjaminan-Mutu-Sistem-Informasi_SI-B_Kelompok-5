<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\User;
use App\Models\Hewan;

class UserCanRequestAdopsiTest extends TestCase
{
    use RefreshDatabase;

    public function test_user_can_view_public_hewan_and_submit_adopsi_request()
    {
        // buat user dan hewan tersedia
        $user = User::factory()->create(['role' => 'user']);
        $hewan = Hewan::factory()->create(['status' => 'tersedia', 'nama' => 'Kucing Publik']);

        // user melihat daftar publik
        $this->actingAs($user);
        $response = $this->get(route('hewan.index'));
        $response->assertStatus(200);
        $response->assertSee('Kucing Publik');

        // user mengajukan adopsi
        $response = $this->post(route('hewan.adopsi.request', $hewan));
        $response->assertStatus(302);

        $this->assertDatabaseHas('adopsi', [
            'user_id' => $user->id,
            'hewan_id' => $hewan->id,
            'status' => 'pending',
        ]);
    }
}
