<?php

namespace Tests\Feature;

use App\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class AuthTest extends TestCase
{
    /**
     * 测试注册表单页
     */
    public function testRegisterForm()
    {
        $response = $this->get('/register');

        $response->assertOk();
    }
    /**
     * 测试用户提交注册表单
     */
    public function testPostRegister()
    {
        $response = $this->post('/register', [
            'name' => 'test',
            'email' => 'test@laravel58.test',
            'password' => 'password',  // Laravel 5.8 验证表单要求密码长度不低于 8 位
            'password_confirmation' => 'password'
        ]);

        $response->assertRedirect('/');
    }

    /**
     * 测试登录表单页
     */
    public function testLoginForm()
    {
        $response = $this->get('/login');

        $response->assertSuccessful();
    }

    /**
     * 测试用户提交登录表单
     */
    public function testPostLogin()
    {
        $user = User::query()->where('name', 'test')->first();

        $response = $this->post('/login', [
            'email' => $user->email,
            'password' => 'password',
        ]);

        $response->assertRedirect('/home');  // 用户登录成功后跳转到 /home
    }

    /**
     * 测试未认证状态下访问 /home 路由
     */
    public function testHomeWithoutAuthenticated()
    {
        $response = $this->get('/home');

        $response->assertRedirect('/login');  // 用户未认证则跳转到登录页
        $this->assertGuest();  // 断言用户未认证
        // 断言给定认证凭证是否匹配
        $this->assertCredentials([
            'email' => 'test@laravel58.test',
            'password' => 'password'
        ]);
    }

    /**
     * 测试认证状态下访问 /home 路由
     */
    public function testHomeWithAuthenticated()
    {
        $user = User::query()->where('name', 'test')->first();
        $this->actingAs($user)->get('/home');
        $this->assertAuthenticated('web')
            ->assertAuthenticatedAs($user);  // 断言用户认证且以 $user 身份认证
    }
}
