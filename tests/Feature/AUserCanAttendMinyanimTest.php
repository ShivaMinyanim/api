<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use App\Models\Minyan;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class AUserCanAttendMinyanimTest extends TestCase
{
    use DatabaseMigrations;

    /** @test */
    public function a_user_can_attend_a_minyan()
    {
        $user = create(User::class);
        $minyan = create(Minyan::class);

        $response = $this->put("api/users/{$user->id}/minyanim", [
            'minyan_id' => $minyan->id
        ]);

        $response->assertStatus(201);
        $this->assertContains($minyan->id, $user->minyanim()->get()->pluck('id'));
    }

    /** @test */
    public function a_user_can_cancel_attendance_at_a_minyan()
    {
        $user = create(User::class);
        $minyan = create(Minyan::class);
        $user->attend($minyan);

        $response = $this->delete("api/users/{$user->id}/minyanim/{$minyan->id}");

        $response->assertStatus(200);
        $this->assertNotContains($minyan->id, $user->minyanim()->get()->pluck('id'));
    }
}
