<?php

namespace tests\Unit;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;
use App\Models\Fund;
use App\Http\Controllers\Controller;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Auth;


class FundTest extends TestCase
{
    use RefreshDatabase;

        public function test() {
            $user = User::factory()->create([
                'email' => 'wpaweena@kku.ac.th',
                'password' => bcrypt($password = '123456789'),

            ]);
            $response = $this->actingAs($user)->get('profile');
            $response->assertStatus(200);
        }

        public function test_Fund_TC01_03() {
            $user = User::factory()->create([
                'email' => 'wpaweena@kku.ac.th',
                'password' => bcrypt($password = '123456789'),
    
            ]);
            $fund = new \App\Models\Fund;
            $fund -> fund_name = "เรียน";
            $fund -> fund_type = "ทุนภายใน";
            $fund -> support_resource = "Statistical Thai";
            $response = $this->actingAs($user)->post('funds');
            $response->assertStatus(302);
            $this->get('funds')
                ->assertSee("fund created successfully");
        }   

        public function test_Fund_TC02() {
            $user = User::factory()->create([
                'email' => 'wpaweena@kku.ac.th',
                'password' => bcrypt($password = '123456789'),
    
            ]);
            $fund = new \App\Models\Fund;
            $fund -> fund_name = "เรียน";
            $fund -> fund_type = "ทุนภายใน";
            $response = $this->actingAs($user)->post('funds');
            $response->assertStatus(302);
            $this->get('funds')
                ->assertSee("The support resource field is required.");
        }   

        public function test_Fund_TC05() {
            $user = User::factory()->create([
                'email' => 'wpaweena@kku.ac.th',
                'password' => bcrypt($password = '123456789'),
    
            ]);
            $fund = new \App\Models\Fund;
            $fund -> fund_type = "ทุนภายใน";
            $fund -> support_resource = "Statistical Thai";
            $response = $this->actingAs($user)->post('funds');
            $response->assertStatus(302);
            $this->get('funds')
                ->assertSee("The fund name field is required.");
        }   

        public function test_Fund_TC06() {
            $user = User::factory()->create([
                'email' => 'wpaweena@kku.ac.th',
                'password' => bcrypt($password = '123456789'),
    
            ]);
            $fund = new \App\Models\Fund;
            $fund -> fund_type = "ทุนภายใน";
            $response = $this->actingAs($user)->post('funds');
            $response->assertStatus(302);
            $this->get('funds')
                ->assertSee("The fund name field is required. The support resource field is required.");
        }   

        public function test_changepassword_TC01_02_03_04() {
            $user = User::factory()->create([
                'email' => 'wpaweena@kku.ac.th',
                'password' => bcrypt($password = '123456789'),
    
            ]);
            $response = $this->post('/profile', [
                'oldpassword' => '123456789',
                'newpassword' => '123456789',
                'cnewpassword' => '123456789'
            ]);
            $response = $this->actingAs($user)->get('profile');
            $response->assertStatus(200);
            $this->post('profile')
                ->assertSee("Update Password Your account is Password updated!");

        }

        public function test_changepassword_TC05() {
            $user = User::factory()->create([
                'email' => 'wpaweena@kku.ac.th',
                'password' => bcrypt($password = '123456789'),
    
            ]);
            $response = $this->post('/profile', [
                'oldpassword' => '123456789',
                'newpassword' => '12345678',
                'cnewpassword' => '12345678'
            ]);
            $response = $this->actingAs($user)->get('profile');
            $response->assertStatus(200);
            $this->post('profile')
               ->assertSee("Update Password Your account is Password updated!");
        }

        public function test_changepassword_TC06() {
            $user = User::factory()->create([
                'email' => 'wpaweena@kku.ac.th',
                'password' => bcrypt($password = '123456789'),
    
            ]);
            $response = $this->post('/profile', [
                'oldpassword' => '123456789',
                'newpassword' => '1234567',
                'cnewpassword' => '1234567'
            ]);
            $response = $this->actingAs($user)->get('profile');
            $response->assertStatus(200);
            $this->post('profile')
               ->assertSee("New password must have atleast 8 characters");

        }

        public function test_changepassword_TC07_08() {
            $user = User::factory()->create([
                'email' => 'wpaweena@kku.ac.th',
                'password' => bcrypt($password = '123456789'),
    
            ]);
            $response = $this->post('/profile', [
                'oldpassword' => '123456789',
                'newpassword' => '12345678',
                'cnewpassword' => '1234567890'
            ]);
            $response = $this->actingAs($user)->get('profile');
            $response->assertStatus(200);
            $this->post('profile')
               ->assertSee("New password and confirm new password must match");
        }

}
