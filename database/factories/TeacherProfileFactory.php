<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class TeacherProfileFactory extends Factory
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
            'title_name_en' => 'Miss',
            'fname_en' => 'Rungtawan',
            'lname_en' =>'Suttho',
            'fname_th' = 'รุ่งตะวัน',
            'lname_th' => 'สุทโธ',
            'academic_ranks_en' => 'Professor',
            'academic_ranks_th' => 'ศาสตราจารย์'
        ];
    }
}
