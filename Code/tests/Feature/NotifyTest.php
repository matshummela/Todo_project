<?php

namespace Tests\Feature;

use App\User;
use Illuminate\Support\Facades\Auth;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class NotifyTest extends TestCase
{
    /**
     * 测试通知列表页
     */
    public function testNotifyList()
    {
        $oUser = User::query()->find(1);
        $this->actingAs($oUser)->get('/notify/list');
        $this->assertAuthenticated('web')
            ->assertAuthenticatedAs($oUser);  // 断言用户认证且以 $user 身份认证
    }

}
