<?php

namespace Tests\Feature;

use App\Models\Todo;
use App\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class TodoTest extends TestCase
{
    /**
     * 测试通知列表页
     */
    public function testTodoList()
    {
        $oUser = User::query()->where('name', 'test')->first();
        $this->actingAs($oUser)->get('/todo');
        $this->assertAuthenticated('web')
            ->assertAuthenticatedAs($oUser);  // 断言用户认证且以 $user 身份认证
    }

    /**
 * 测试新增Todo
 */
    public function testTodoAdd()
    {
        $oUser = User::query()->where('name', 'test')->first();
        $response = $this->actingAs($oUser)->post('/todo/add', [
            'todolist_id' => 1,
            'content' => '使用PHPUnit进行测试',
        ]);

        $response->assertStatus(200)
            ->assertJson([
                'code' => 1,
                'user_name' => $oUser->name,
            ])
            ->assertJsonMissing([
                'name' => '测试用户'
            ])
            ->assertJsonFragment([
                'code' => 1
            ]);
    }

    /**
     * 测试修改Todo状态
     */
    public function testTodoUpdateStatus()
    {
        $oUser = User::query()->where('name', 'test')->first();
        $oTodo = Todo::query()->orderBy('id','desc')->first();
        $response = $this->actingAs($oUser)->post('/todo/update-status', [
            'id' => $oTodo['id'],
        ]);
        $response->assertStatus(200)
            ->assertJson([
                'code' => 1,
            ])
            ->assertJsonMissing([
                'name' => '测试用户'
            ])
            ->assertJsonFragment([
                'code' => 1
            ]);
    }

    /**
     * 测试绑定好友
     */
    public function testTodoBindFriend()
    {
        $oUser = User::query()->where('name', 'test')->first();
        $oTodo = Todo::query()->orderBy('id','desc')->first();
        $response = $this->actingAs($oUser)->post('/todo/bind-friend', [
            'todolist_id' => $oTodo['todolist_id'],
            'friend_name' => "test",
            'status' => '1'
        ]);
        $response->assertStatus(200)
            ->assertJson([
                'code' => 1,
            ])
            ->assertJsonMissing([
                'name' => '测试用户'
            ])
            ->assertJsonFragment([
                'code' => 1
            ]);
    }

    /**
     * 测试删除Todo
     */
    public function testTodoDel()
    {
        $oUser = User::query()->where('name', 'test')->first();
        $oTodo = Todo::query()->orderBy('id','desc')->first();
        $response = $this->actingAs($oUser)->post('/todo/del', [
            'id' => $oTodo['id'],
        ]);

        $response->assertStatus(200)
            ->assertJson([
                'code' => 1,
            ])
            ->assertJsonMissing([
                'name' => '测试用户'
            ])
            ->assertJsonFragment([
                'code' => 1
            ]);
    }
}
