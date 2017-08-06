<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use App\Models\Minyan;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class GetUserAttendanceTest extends TestCase
{
    use DatabaseMigrations;

    /** @test */
    public function a_user_can_get_a_list_of_the_minyanim_he_is_attending()
    {
        $user = create(User::class);
        $user->attend(
            create(Minyan::class)
        );

        $response = $this->get("api/users/{$user->id}/minyanim");

        $this->assertResultsCount(1, $response);
    }
}
