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
        $response = $this->post(route('admin.adopsi.store'), [
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
        $response = $this->put(route('admin.adopsi.update', $adopsi), [
            'user_id' => $user->id,
            'hewan_id' => $hewan->id,
            'tanggal_adopsi' => now()->addDay()->toDateString(),
            'status' => 'diterima',
        ]);

        $response->assertStatus(302);
        $this->assertDatabaseHas('adopsi', ['id' => $adopsi->id, 'status' => 'diterima']);

        // Delete
        $response = $this->delete(route('admin.adopsi.destroy', $adopsi));
        $response->assertStatus(302);
        $this->assertDatabaseMissing('adopsi', ['id' => $adopsi->id]);
    }

    public function test_hewan_status_syncs_when_adopsi_status_changes()
    {
        $admin = User::factory()->create(['role' => 'admin']);
        $this->actingAs($admin);

        $user = User::factory()->create();
        $hewan = Hewan::factory()->create(['status' => 'tersedia']);

        // create pending
        $this->post(route('admin.adopsi.store'), [
            'user_id' => $user->id,
            'hewan_id' => $hewan->id,
            'tanggal_adopsi' => now()->toDateString(),
            'status' => 'pending',
        ]);

        $this->assertSame('tersedia', $hewan->fresh()->status);

        $adopsi = Adopsi::first();

        // accept -> hewan jadi diadopsi
        $this->put(route('admin.adopsi.update', $adopsi), [
            'user_id' => $user->id,
            'hewan_id' => $hewan->id,
            'tanggal_adopsi' => now()->addDay()->toDateString(),
            'status' => 'diterima',
        ]);
        $this->assertSame('diadopsi', $hewan->fresh()->status);

        // reject -> kembali tersedia
        $this->put(route('admin.adopsi.update', $adopsi), [
            'user_id' => $user->id,
            'hewan_id' => $hewan->id,
            'tanggal_adopsi' => now()->addDays(2)->toDateString(),
            'status' => 'ditolak',
        ]);
        $this->assertSame('tersedia', $hewan->fresh()->status);
    }

    public function test_cannot_accept_adopsi_if_hewan_already_has_active_adoption()
    {
        $admin = User::factory()->create(['role' => 'admin']);
        $this->actingAs($admin);

        $user1 = User::factory()->create();
        $user2 = User::factory()->create();
        $hewan = Hewan::factory()->create(['status' => 'tersedia']);

        // first adoption accepted
        $this->post(route('admin.adopsi.store'), [
            'user_id' => $user1->id,
            'hewan_id' => $hewan->id,
            'tanggal_adopsi' => now()->toDateString(),
            'status' => 'diterima',
        ]);

        $hewan->refresh();
        $this->assertSame('diadopsi', $hewan->status);

        // second adoption pending
        $this->post(route('admin.adopsi.store'), [
            'user_id' => $user2->id,
            'hewan_id' => $hewan->id,
            'tanggal_adopsi' => now()->toDateString(),
            'status' => 'pending',
        ]);

        $adopsiPending = Adopsi::where('user_id', $user2->id)->first();

        // attempt to accept second should fail
        $response = $this->from(route('admin.adopsi.edit', $adopsiPending))->put(route('admin.adopsi.update', $adopsiPending), [
            'user_id' => $user2->id,
            'hewan_id' => $hewan->id,
            'tanggal_adopsi' => now()->addDay()->toDateString(),
            'status' => 'diterima',
        ]);

        $response->assertStatus(302);
        $response->assertSessionHasErrors('hewan_id');
        $this->assertSame('diadopsi', $hewan->fresh()->status);
        $this->assertSame('pending', $adopsiPending->fresh()->status);
    }
}
