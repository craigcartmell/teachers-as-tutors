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
        factory('TeachersAsTutors\User', 'admin', 1)->create([
            'name'     => 'Admin',
            'email'    => env('APP_ADMIN_EMAIL'),
            'password' => bcrypt(env('APP_ADMIN_PASSWORD'))
        ]);
        factory('TeachersAsTutors\User', 'tutor', 1)->create();
        factory('TeachersAsTutors\User', 'parent', 1)->create();
        factory('TeachersAsTutors\User', 1)->create();
    }
}

class PagesTableSeeder extends Seeder
{
    public function run()
    {
        factory('TeachersAsTutors\Page', 1)->create([
            'name' => 'Home',
            'uri'  => '/',
        ]);
        factory('TeachersAsTutors\Page', 1)->create([
            'name'           => 'Tuition',
            'uri'            => 'tuition',
            'hero_image_uri' => env('APP_URL') . '/img/heroes/hero_reading.jpg'
        ]);
        factory('TeachersAsTutors\Page', 1)->create([
            'name'           => 'Tutors',
            'uri'            => 'tutors',
            'hero_image_uri' => env('APP_URL') . '/img/heroes/hero_coffee.jpg'
        ]);
    }
}