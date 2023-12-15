<?php

namespace Database\Seeders;

use App\Models\Permission;
use Illuminate\Database\Seeder;

class PermissionsTableSeeder extends Seeder
{
    public function run()
    {
        $permissions = [
            [
                'id'    => 1,
                'title' => 'auth_profile_edit',
            ],
            [
                'id'    => 2,
                'title' => 'user_management_access',
            ],
            [
                'id'    => 3,
                'title' => 'permission_create',
            ],
            [
                'id'    => 4,
                'title' => 'permission_edit',
            ],
            [
                'id'    => 5,
                'title' => 'permission_show',
            ],
            [
                'id'    => 6,
                'title' => 'permission_delete',
            ],
            [
                'id'    => 7,
                'title' => 'permission_access',
            ],
            [
                'id'    => 8,
                'title' => 'role_create',
            ],
            [
                'id'    => 9,
                'title' => 'role_edit',
            ],
            [
                'id'    => 10,
                'title' => 'role_show',
            ],
            [
                'id'    => 11,
                'title' => 'role_delete',
            ],
            [
                'id'    => 12,
                'title' => 'role_access',
            ],
            [
                'id'    => 13,
                'title' => 'user_create',
            ],
            [
                'id'    => 14,
                'title' => 'user_edit',
            ],
            [
                'id'    => 15,
                'title' => 'user_show',
            ],
            [
                'id'    => 16,
                'title' => 'user_delete',
            ],
            [
                'id'    => 17,
                'title' => 'user_access',
            ],
            [
                'id'    => 18,
                'title' => 'user_alert_create',
            ],
            [
                'id'    => 19,
                'title' => 'user_alert_edit',
            ],
            [
                'id'    => 20,
                'title' => 'user_alert_show',
            ],
            [
                'id'    => 21,
                'title' => 'user_alert_delete',
            ],
            [
                'id'    => 22,
                'title' => 'user_alert_access',
            ],
            [
                'id'    => 23,
                'title' => 'faq_management_access',
            ],
            [
                'id'    => 24,
                'title' => 'faq_category_create',
            ],
            [
                'id'    => 25,
                'title' => 'faq_category_edit',
            ],
            [
                'id'    => 26,
                'title' => 'faq_category_show',
            ],
            [
                'id'    => 27,
                'title' => 'faq_category_delete',
            ],
            [
                'id'    => 28,
                'title' => 'faq_category_access',
            ],
            [
                'id'    => 29,
                'title' => 'faq_question_create',
            ],
            [
                'id'    => 30,
                'title' => 'faq_question_edit',
            ],
            [
                'id'    => 31,
                'title' => 'faq_question_show',
            ],
            [
                'id'    => 32,
                'title' => 'faq_question_delete',
            ],
            [
                'id'    => 33,
                'title' => 'faq_question_access',
            ],
            [
                'id'    => 34,
                'title' => 'task_management_access',
            ],
            [
                'id'    => 35,
                'title' => 'task_status_create',
            ],
            [
                'id'    => 36,
                'title' => 'task_status_edit',
            ],
            [
                'id'    => 37,
                'title' => 'task_status_show',
            ],
            [
                'id'    => 38,
                'title' => 'task_status_delete',
            ],
            [
                'id'    => 39,
                'title' => 'task_status_access',
            ],
            [
                'id'    => 40,
                'title' => 'task_tag_create',
            ],
            [
                'id'    => 41,
                'title' => 'task_tag_edit',
            ],
            [
                'id'    => 42,
                'title' => 'task_tag_show',
            ],
            [
                'id'    => 43,
                'title' => 'task_tag_delete',
            ],
            [
                'id'    => 44,
                'title' => 'task_tag_access',
            ],
            [
                'id'    => 45,
                'title' => 'task_create',
            ],
            [
                'id'    => 46,
                'title' => 'task_edit',
            ],
            [
                'id'    => 47,
                'title' => 'task_show',
            ],
            [
                'id'    => 48,
                'title' => 'task_delete',
            ],
            [
                'id'    => 49,
                'title' => 'task_access',
            ],
            [
                'id'    => 50,
                'title' => 'task_calendar_access',
            ],
        ];

        Permission::insert($permissions);
    }
}
