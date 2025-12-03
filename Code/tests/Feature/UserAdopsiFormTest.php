<?php

namespace Tests\Feature;

use App\Models\Hewan;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class UserAdopsiFormTest extends TestCase
{
    use RefreshDatabase;

    public function test_user_can_access_adopsi_form_and_submit()
    {
        $user = User::factory()->create(['role' => 'user']);
        $hewan = Hewan::factory()->create(['status' => 'tersedia']);

        $this->actingAs($user);

        $this->get(route('hewan.adopsi.form', $hewan))
            ->assertStatus(200)
            ->assertSee('Ajukan Adopsi');

        $this->post(route('hewan.adopsi.request', $hewan), [
            'tanggal_adopsi' => now()->addDays(3)->toDateString(),
        ])->assertRedirect(route('user.adopsi', absolute: false));

        $this->assertDatabaseHas('adopsi', [
            'user_id' => $user->id,
            'hewan_id' => $hewan->id,
            'status' => 'pending',
        ]);
    }
}
