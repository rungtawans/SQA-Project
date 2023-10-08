<?php

namespace Database\Factories;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProfileFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    protected $model = User::class;

    public function definition()
    {
        return [
            'email' => $this->faker->unique()->safeEmail,
            'email_verified_at' => now(),
//             'title_name_en' => 'Miss',
//             'fname_en' => 'Rungtawan',
//             'lname_en' =>'Suttho',
//             'fname_th' = 'รุ่งตะวัน',
//             'lname_th' => 'สุทโธ'
        ];
    }
}
