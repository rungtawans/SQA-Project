<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Auth;

class AccountPageTest extends TestCase
{
    use RefreshDatabase;

//     public function test_tc01_valid_edit_profile() {
//     //login
//         $user = User::factory()->create([
//             'email' => 'wpaweena@kku.ac.th',
//             'password' => bcrypt($password = '123456789'),
//
//         ]);
//         $role = Role::create(['name' => 'teacher', 'guard_name' => 'web']);
//         $user->assignRole('teacher');
//         Auth::login($user);
//         $response = $this->actingAs($user);
// //         ->get('dashboard');
// //         $response->assertStatus(200);
// //         $this->assertAuthenticatedAs($user);
//
//     //edit
// //         $response = $this->from('dashboard')->post('update-profile-info', [
//             $response = $this->post('adminUpdateInfo', [
//             'title_name_en' => 'Mrs.',
//             'fname_en' => 'edit_fname_en',
//             'lname_en' => 'edit_fname_en',
//             'fname_th' => 'edit_fname_th',
//             'lname_th' => 'lname_th',
//             'email' => 'lname_th',
//             'academic_ranks_en' => 'Lecturer',
//             'academic_ranks_th' => 'รองศาสตราจารย์',
//             'position_en' => 'ดร.'
//             ]);
//
//         $response->assertStatus(302);
//
//         $this->get('profile')->assertDontSee('Rungtawan')
//             ->assertSee('edit_fname_eh');
//
//     }
//
//
//         public function testAdminUpdateProfile()
//         {
//             // Assuming you have a user authenticated, you can use actingAs method.
//            $user = User::factory()->create([
//                        'email' => 'wpaweena@kku.ac.th',
//                        'password' => bcrypt($password = '123456789'),
//
//                    ]);
//             $this->actingAs($user);
//
//             // Simulate the POST request to the adminUpdateInfo route with form data
//             $response = $this->post(route('adminUpdateInfo'), [
//                 'title_name' => 'Mrs.',
//                 'fname' => 'edit_fname',
//                 'lname' => 'edit_lname',
//                 'email' => 'wpaweena@kku.ac.th',
//                 'academic_ranks' => 'Lecturer',
//                 'position' => 'ดร.'
//             ]);
//
// //             $response->assertStatus(302);
//
//             $updatedUser = User::find($user->id);
//             $this->assertEquals('edit_fname_en', $updatedUser->fname);
//
//         }

        public function testAdminUpdateProfile_02()
        {
            // Create a user
            $user = User::factory()->create([
                'email' => 'wpaweena@kku.ac.th',
                'password' => bcrypt('123456789'),
            ]);

            // Authenticate the user
            $this->actingAs($user);

            $response = $this->post(route('adminUpdateInfo'), [
                'title_name_en' => 'Mrs.',
                'fname_en' => 'edit_fname',
                'lname_en' => 'edit_lname',
                'email' => 'wpaweena@kku.ac.th',
                'academic_ranks_en' => 'Lecturer',
            ]);

            //$response->assertStatus(302);

            $updatedUser = User::find($user->id);

            $this->assertEquals('edit_fname', $updatedUser->fname_en);
            $this->assertEquals('edit_lname', $updatedUser->lname_en);
            $this->assertEquals('wpaweena@kku.ac.th', $updatedUser->email);
            $this->assertEquals('Lecturer', $updatedUser->academic_ranks_en);

        }


}
