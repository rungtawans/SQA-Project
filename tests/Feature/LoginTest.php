<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Auth;

class LoginTest extends TestCase
{
    use RefreshDatabase;

        public function test_user_can_view_login_page() {
            $response = $this->get('login');

            $response->assertStatus(200);
            $response->assertViewIs('auth.login');
            $response->assertSee('Account Login');
        }

        public function test_unauthenticated_user_cannot_access_dashboard() {
            $response = $this->get('dashboard');

            $response->assertStatus(302);
            $response->assertRedirect('login');
        }

         public function test_authenticated_user_can_access_dashboard() {
                $user = User::factory()->create([
                    'email' => 'wpaweena@kku.ac.th',
                    'password' => bcrypt($password = '123456789')
                ]);
                Auth::login($user);
                $response = $this->actingAs($user)->get('dashboard');

                $this->assertAuthenticatedAs($user);
                $response->assertStatus(200);
                $response->assertSee('Research Information Management System');
        }

        public function test_authenticated_user_cannot_view_login_page() {
            $user = User::factory()->create([
                'email' => 'wpaweena@kku.ac.th',
                'password' => bcrypt($password = '123456789')
            ]);
            $role = Role::create(['name' => 'teacher', 'guard_name' => 'web']);

            Auth::login($user);
            $user->assignRole('teacher');
            $response = $this->actingAs($user)->from('login')->get('login');

            $this->assertAuthenticatedAs($user);
            $response->assertStatus(302);
            $response->assertRedirect('dashboard');
        }

        public function test_tc05_incorrect_email() {
            $response = $this->from('login')->post('login', [
                'username' => 'incorrect_email@kku.ac.th',
                'password' => '123456789'
            ]);

            $response->assertStatus(302);
            $response->assertRedirect('login');

            $this->get('login')->assertSee('Login Failed: Your user ID or password is incorrect');
            $this->get('login')->assertSee('Account Login');
            $this->get('login')->assertDontSee('Valid email is required : ex.abc.xyz');
            $this->get('login')->assertDontSee('Please fill out this field.');

        }
        public function test_tc06_incorrect_password() {
            $response = $this->from('login')->post('login', [
                'username' => 'wpaweena@kku.ac.th',
                'password' => 'incorrectpsw',
            ]);

            $response->assertStatus(302);
            $response->assertRedirect('login');

            $this->get('login')->assertSee('Login Failed: Your user ID or password is incorrect');
            $this->get('login')->assertSee('Account Login');
            $this->get('login')->assertDontSee('Valid email is required : ex.abc.xyz');
            $this->get('login')->assertDontSee('Please fill out this field.');
        }

        public function test_tc08_incorrect_email_and_password() {

            $response = $this->from('login')->post('login', [
                'username' => 'incorrect_email@kku.ac.th',
                'password' => 'incorrect_password',
            ]);

            $response->assertStatus(302);
            $response->assertRedirect('login');

            $this->get('login')->assertSee('Login Failed: Your user ID or password is incorrect');
            $this->get('login')->assertSee('Account Login');
            $this->get('login')->assertDontSee('Valid email is required : ex.abc.xyz');
            $this->get('login')->assertDontSee('Please fill out this field.');
        }

        public function test_tc09_email_wrong_format() {

            $response = $this->from('login')->post('login', [
                'username' => 'emailkkacom',
                'password' => '123456789',
            ]);

            $response->assertStatus(500);
//             $response->assertRedirect('login');

//             $this->get('login')->assertDontSee('Login Failed: Your user ID or password is incorrect');
            $this->get('login')->assertSee('Account Login');
            $this->get('login')->assertDontSee('Valid email is required : ex.abc.xyz');
//             $this->get('login')->assertDontSee('please fill out this field');
        }

//             public function test_tc10_blank_email() {
//
//                 $response = $this->post('/login', [
//                     'username' => '',
//                     'password' => '123456789'
//                 ]);

//                $response->assertStatus(302);
//                $response->assertRedirect('login');

//                $this->get('login')->assertSee('Login Failed: Your user ID or password is incorrect');
//                $this->get('login')->assertSee('Account Login');
//                $this->get('login')->assertDontSee('Valid email is required : ex.abc.xyz');
//                $this->get('login')->assertSee('Please fill out this field.');
//             }

//             public function test_tc11_blank_password() {
//
//                 $response = $this->post('/login', [
//                     'username' => 'wpaweena@kku.ac.th',
//                     'password' => ''
//                 ]);

//                $response->assertStatus(302);
//                $response->assertRedirect('login');

//                $this->get('login')->assertDontSee('Login Failed: Your user ID or password is incorrect');
//                $this->get('login')->assertSee('Account Login');
//                $this->get('login')->assertDontSee('Valid email is required : ex.abc.xyz');
//                $this->get('login')->assertSee('Please fill out this field.');
//             }
}
