<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $permissions = [
            'عرض-الادوار',
            'اضافة-الادوار',
            'تعديل-الادوار',
            'حذف-الادوار',
            'عرض-المسؤولين',
            'اضافة-المسؤولين',
            'تعديل-المسؤولين',
            'حذف-المسؤولين',
            'عرض-الكوبونات',
            'اضافة-الكوبونات',
            'تعديل-الكوبونات',
            'حذف-الكوبونات',
        ];

        foreach ($permissions as $permission) {
            Permission::create(['name' => $permission, 'guard_name' => 'admin']);
        }
    }
}
