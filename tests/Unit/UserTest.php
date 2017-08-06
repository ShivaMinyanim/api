<?php

use Tests\TestCase;
use App\Models\User;
use App\Models\Minyan;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class UserTest extends TestCase
{
    use DatabaseMigrations;

    /** @test */
    public function a_user_cannot_attend_the_same_minyan_more_than_once()
    {
        $user = create(User::class);
        $minyan = create(Minyan::class);

        $user->attend($minyan);
        $user->attend($minyan);

        $this->assertCount(1, $user->minyanim()->get()->pluck('id'));
    }

    /** @test */
    public function a_user_can_attend_more_than_one_minyan_at_a_time()
    {
        $user = create(User::class);
        $firstMinyan = create(Minyan::class);
        $secondMinyan = create(Minyan::class);

        $user->attend($firstMinyan);
        $user->attend($secondMinyan);

        $this->assertCount(2, $user->minyanim()->get()->pluck('id'));
    }
}
