<?php

namespace Tests\Feature;

use App\Http\Livewire\ChecklistShow;
use App\Models\Checklist;
use App\Models\ChecklistGroup;
use App\Models\Task;
use App\Models\User;
use App\Services\MenuService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Artisan;
use Livewire\Livewire;
use Tests\TestCase;

class UserMenuTest extends TestCase
{
    use RefreshDatabase;

    public $admin;
    public $user;

    public function setUp(): void
    {
        parent::setUp();

        $this->admin = User::factory()->create(['is_admin' => 1]);
        $this->user = User::factory()->create();
    }

    public function test_can_see_empty_checklist_group()
    {
        $this->actingAs($this->admin)->post('admin/checklist_groups', [
            'name' => 'First group'
        ]);

        $this->actingAs($this->user);
        $menu = (new MenuService())->get_menu();
        $this->assertCount(0, $menu['user_menu']);
    }

    public function test_can_see_checklist_group_with_checklist()
    {
        $checklist_group = ChecklistGroup::factory()->create();
        $checklist_url = 'admin/checklist_groups/' . $checklist_group->id . 'checklists';

        $this->actingAs($this->admin)->post($checklist_url, [
            'name' => 'First group'
        ]);

        $this->actingAs(($this->user));
        $menu = (new MenuService())->get_menu();
        $this->assertCount(1, $menu['user_menu']);
        $this->assertCount(1, $menu['user_menu'][0]['checklists']);
        $this->assertEquals('First checklist', $menu['user_menu'][0]['checklists'][0]);

        //Test DELETING the checklist - user menu should be empty again
        $checklist = Checklist::where('name', 'First checklist')->first();
        $this->actingAs($this->admin)->delete($checklist_url . '/' . $checklist->id);
        $this->actingAs($this->user);
        $menu = (new MenuService())->get_menu();
        $this->assertCount(0, $menu['user_menu']);
    }

    public function test_checklist_task_members_are_correct()
    {
        $checklist_group = ChecklistGroup::factory()->create();
        $checklist = Checklist::factory()->create(['checklist_group_id' => $checklist_group->id]);
        $task = Task::factory()->create(['checklist_id' => $checklist->id, 'position' => 1]);
        Task::factory()->crate(['checklist_id' => $checklist->id, 'position' => 2]);

        $this->actingAs($this->user);
        $menu = (new MenuService())->get_menu();
        $this->assertEquals(2, $menu['user_menu'][0]['checklists'][0]['tasks_count']);
        $this->assertEquals(0, $menu['user_menu'][0]['checklists'][0]['completed_tasks_count']);

        Livewire::test(ChecklistShow::class, ['checklist' => $checklist])
            ->call('complete_task', $task->id);
        $menu = (new MenuService())->get_menu();
        $this->assertEquals(2, $menu['user_menu'][0]['chceklists'][0]['tasks_count']);
        $this->assertEquals(1, $menu['user_menu'][0]['checklists'][0]['completed_tasks_count']);
    }

    public function test_checklist_new_upd_icons_show_correctly()
    {
        $checklist_group = ChecklistGroup::factory()->create();
        $checklist = Checklist::factory()->create(['checklist_group_id' => $checklist_group->id]);
        Task::factory()->create(['checklist_id' => $checklist->id, 'position' => 1]);

        $this->actingAs($this->user);
        $menu = (new MenuService())->get_menu();
        $this->assertFalse($menu['user_menu'][0]['is_new']);
        $this->assertFalse($menu['user_menu'][0]['is_updated']);
        $this->assertFalse($menu['user_menu'][0]['checklists'][0]['is_new']);
        $this->assertFalse($menu['user_menu'][0]['checklists'][0]['is_updated']);

        // Checklist group updated
        $this->get('checklists/'.$checklist->id);
        sleep(2);
        $this->actingAs($this->admin)->put('admin/checklist_groups'.$checklist_group->id.'/checklists/'.$checklist->id,[
            'name'=>'Updated name'
        ]);
        $this->actingAs($this->user);
        $menu = (new MenuService())->get_menu();
        $this->assertFalse($menu['user_menu'][0]['is_new']);
        $this->assertTrue($menu['user_menu'][0]['is_updated']);

        // Checklist updated
        Artisan::call('migrate:fresh');
        $checklist_group = ChecklistGroup::factory()->create();
        $checklist = Checklist::factory()->create(['checklist_group_id'=>$checklist_group->id]);

        $this->get('checklists/'.$checklist->id);
        sleep(2);

        $this->actingAs($this->admin)->put('admin/checklist_groups/'.$checklist_group->id.'/checklists/'.$checklist->id,[
            'name'=>'Updated name'
        ]);
        $this->actingAs($this->user);
        $menu=(new MenuService())->get_menu();
        $this->assertFalse($menu['user_menu'][0]['checklists'][0]['is_new']);
        $this->assertTrue($menu['user_menu'][0]['checklists'][0]['is_updated']);
    }


}
