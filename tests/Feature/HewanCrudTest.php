<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\User;
use App\Models\Hewan;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

class HewanCrudTest extends TestCase
{
    use RefreshDatabase;

    public function test_admin_can_create_update_and_delete_hewan()
    {
        Storage::fake('public');

        // buat admin
        $admin = User::factory()->create(['role' => 'admin']);

        $this->actingAs($admin);

        // Create
        $response = $this->post(route('hewan.store'), [
            'nama' => 'Kucing Test',
            'jenis' => 'Kucing',
            'ras' => 'Persia',
            'usia' => 2,
            'status' => 'tersedia',
            'deskripsi' => 'Kucing lucu untuk testing',
            'foto' => UploadedFile::fake()->create('cat.jpg', 100, 'image/jpeg'),
        ]);

        $response->assertStatus(302);
        $response->assertSessionHasNoErrors();
        $this->assertDatabaseHas('hewan', ['nama' => 'Kucing Test']);

        $hewan = Hewan::where('nama', 'Kucing Test')->first();
        $this->assertNotNull($hewan);

        // Update
        $response = $this->put(route('hewan.update', $hewan->id), [
            'nama' => 'Kucing Test Updated',
            'jenis' => 'Kucing',
            'ras' => 'Persia',
            'usia' => 3,
            'status' => 'tersedia',
            'deskripsi' => 'Diupdate',
        ]);

        $response->assertStatus(302);
        $this->assertDatabaseHas('hewan', ['nama' => 'Kucing Test Updated']);

        // Delete
        $response = $this->delete(route('hewan.destroy', $hewan->id));
        $response->assertStatus(302);
        $this->assertDatabaseMissing('hewan', ['nama' => 'Kucing Test Updated']);
    }
}
