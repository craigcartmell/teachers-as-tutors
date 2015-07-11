<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        $this->call(UserPermissionsTableSeeder::class);
        $this->call(UsersTableSeeder::class);
        $this->call(PagesTableSeeder::class);
        $this->call(ResourcesTableSeeder::class);
        $this->call(ReportsTableSeeder::class);

        Model::reguard();
    }
}

class UserPermissionsTableSeeder extends Seeder
{
    public function run()
    {
        \TeachersAsTutors\UserPermission::create([
            'name' => 'Admin',
            'desc' => 'Administrators are granted full access to creating, editing and deleting content as well as managing users.'
        ]);
        \TeachersAsTutors\UserPermission::create([
            'name' => 'Tutor',
            'desc' => 'Tutors are granted access to resources and billing information.'
        ]);
        \TeachersAsTutors\UserPermission::create([
            'name' => 'Parent',
            'desc' => 'Parents are granted access to pupil progress reports.'
        ]);
    }
}

class UsersTableSeeder extends Seeder
{
    public function run()
    {
        factory(TeachersAsTutors\User::class, 'admin', 1)->create([
            'name'     => 'Admin',
            'email'    => env('APP_ADMIN_EMAIL'),
            'password' => bcrypt(env('APP_ADMIN_PASSWORD'))
        ]);
        factory(TeachersAsTutors\User::class, 'tutor', 1)->create();
        factory(TeachersAsTutors\User::class, 'parent', 1)->create();
    }
}

class PagesTableSeeder extends Seeder
{
    public function run()
    {
        factory(TeachersAsTutors\Page::class, 1)->create([
            'name' => 'Home',
            'uri'  => '/',
        ]);
        factory(TeachersAsTutors\Page::class, 1)->create([
            'name' => 'Tuition',
            'uri'  => 'tuition',
        ]);
        factory(TeachersAsTutors\Page::class, 1)->create([
            'name' => 'Tutors',
            'uri'  => 'tutors',
        ]);
        factory(TeachersAsTutors\Page::class, 1)->create([
            'name' => 'Blog',
            'uri'  => 'blog',
        ]);
        factory(TeachersAsTutors\Page::class, 'blog-post', 10)->create();
    }
}

class ResourcesTableSeeder extends Seeder
{
    public function run()
    {
        factory(TeachersAsTutors\Resource::class, 10)->create();
    }
}

class ReportsTableSeeder extends Seeder
{
    public function run()
    {
        factory(TeachersAsTutors\Report::class, 10)->create();
    }
}