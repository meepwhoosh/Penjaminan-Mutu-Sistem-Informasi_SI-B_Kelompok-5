<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\User;
use App\Models\Hewan;
use App\Models\Adopsi;

class AdopsiCrudTest extends TestCase
{
    use RefreshDatabase;

    public function test_admin_can_create_update_and_delete_adopsi()
    {
        // buat admin
        $admin = User::factory()->create(['role' => 'admin']);
        $this->actingAs($admin);

        $user = User::factory()->create();
        $hewan = Hewan::factory()->create(['status' => 'tersedia']);

        // Create
        $response = $this->post(route('adopsi.store'), [
            'user_id' => $user->id,
            'hewan_id' => $hewan->id,
            'tanggal_adopsi' => now()->toDateString(),
            'status' => 'pending',
        ]);

        $response->assertStatus(302);
        $this->assertDatabaseHas('adopsi', ['user_id' => $user->id, 'hewan_id' => $hewan->id]);

        $adopsi = Adopsi::where('user_id', $user->id)->where('hewan_id', $hewan->id)->first();
        $this->assertNotNull($adopsi);

        // Update
        $response = $this->put(route('adopsi.update', $adopsi), [
            'user_id' => $user->id,
            'hewan_id' => $hewan->id,
            'tanggal_adopsi' => now()->addDay()->toDateString(),
            'status' => 'diterima',
        ]);

        $response->assertStatus(302);
        $this->assertDatabaseHas('adopsi', ['id' => $adopsi->id, 'status' => 'diterima']);

        // Delete
        $response = $this->delete(route('adopsi.destroy', $adopsi));
        $response->assertStatus(302);
        $this->assertDatabaseMissing('adopsi', ['id' => $adopsi->id]);
    }
}
