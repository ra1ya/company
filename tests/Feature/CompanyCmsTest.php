<?php

namespace Tests\Feature;

use App\Models\Admin;
use App\Models\About;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CompanyCmsTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        $this->withoutVite();
    }

    public function test_public_homepage_renders_successfully(): void
    {
        $response = $this->get('/');

        $response->assertOk();
        $response->assertSee('شركة جيتك برو', false);
    }

    public function test_public_admin_registration_is_not_available(): void
    {
        $this->get('/admin/register')->assertNotFound();
        $this->post('/admin/register', [
            'name' => 'Unexpected Admin',
            'email' => 'unexpected@example.com',
            'password' => 'password',
            'password_confirmation' => 'password',
            'mobile' => '0000000000',
        ])->assertNotFound();

        $this->assertDatabaseCount('admin', 0);
    }

    public function test_admin_dashboard_requires_admin_authentication(): void
    {
        $this->get('/admin/dashboard')->assertRedirect('/admin/login');
    }

    public function test_admin_can_authenticate_with_dedicated_guard(): void
    {
        $admin = Admin::create([
            'name' => 'Demo Admin',
            'email' => 'admin@test.local',
            'password' => 'password',
            'mobile' => '0000000000',
        ]);

        $response = $this->post('/admin/login', [
            'email' => 'admin@test.local',
            'password' => 'password',
        ]);

        $response->assertRedirect('/admin/dashboard');
        $this->assertAuthenticatedAs($admin, 'admin');
    }

    public function test_admin_profile_update_is_scoped_to_admin_model(): void
    {
        $admin = Admin::create([
            'name' => 'Old Name',
            'email' => 'old@example.com',
            'password' => 'password',
            'mobile' => '1111111111',
        ]);

        $response = $this->actingAs($admin, 'admin')->patch('/admin/profile', [
            'name' => 'Updated Admin',
            'email' => 'updated@example.com',
            'mobile' => '2222222222',
        ]);

        $response->assertRedirect('/admin/profile');
        $this->assertDatabaseHas('admin', [
            'id' => $admin->id,
            'name' => 'Updated Admin',
            'email' => 'updated@example.com',
            'mobile' => '2222222222',
        ]);
    }

    public function test_about_content_requires_validation_and_can_be_created_by_admin(): void
    {
        $admin = Admin::create([
            'name' => 'CMS Admin',
            'email' => 'cms@example.com',
            'password' => 'password',
            'mobile' => '0000000000',
        ]);

        $this->actingAs($admin, 'admin')
            ->post('/admin/about', [])
            ->assertSessionHasErrors(['des_ar', 'des_en']);

        $this->actingAs($admin, 'admin')
            ->post('/admin/about', [
                'des_ar' => 'نبذة تجريبية عن الشركة',
                'des_en' => 'A fictional company profile for testing.',
            ])
            ->assertRedirect('/admin/about');

        $this->assertDatabaseHas('about', [
            'des_ar' => 'نبذة تجريبية عن الشركة',
        ]);
        $this->assertSame(1, About::count());
    }

    public function test_contact_endpoint_validates_input(): void
    {
        $this->post('/forms/contact.php', [])->assertSessionHasErrors([
            'name',
            'email',
            'subject',
            'message',
        ]);
    }
}
