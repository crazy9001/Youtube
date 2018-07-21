<?php

use Illuminate\Database\Seeder;

class DataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->truncate();
        DB::table('roles')->truncate();
        DB::table('role_users')->truncate();
        DB::table('activations')->truncate();
        DB::table('groups')->truncate();
        DB::table('persistences')->truncate();
        DB::table('throttle')->truncate();
        DB::table('videos')->truncate();
        DB::table('channels')->truncate();
        $role = [
            'name' => 'Super Admin',
            'slug' => 'super-admin',
            'permissions' => [
                'dashboard.index' => true,
                'group.index' => true,
                'group.create' => true,
                'access.logout' => true,
                'channel.index' => true,
                'channel.list' => true,
                'channel.store' => true,
                'channel.update.name' => true,
                'channel.update.note' => true,
                'channel.delete' => true,
                'video.index' => true,
                'list.videos' => true,
                'video.check'   =>  true,
                'video.delete'  =>  true,
                'video.move.group'  =>  true
            ]
        ];
        $adminRole = Sentinel::getRoleRepository()->createModel()->fill($role)->save();
        $admin = [
            'email'    => 'admin@youtube.com',
            'password' => 'admin',
            'first_name'    =>  'Super',
            'last_name' =>  'Admin'
        ];
        $adminUser = Sentinel::registerAndActivate($admin);
        $adminUser->roles()->attach($adminRole);

        DB::table('groups')->insert([

            [
                'name' => 'Default',
                'slug'  =>  'default',
                'user_id'   =>  1,
                'parent_id' =>  0,
                'tags'  =>  ''
            ],
            [
                'name' => 'Nhạc Hoa',
                'slug'  =>  'nhac-hoa',
                'user_id'   =>  1,
                'parent_id' =>  0,
                'tags'  =>  ''
            ],
            [
                'name' => 'Âu Thần x Hạ Mạt',
                'slug'  =>  'au-than-ha-mat',
                'user_id'   =>  1,
                'parent_id' =>  2,
                'tags'  =>  'Bong Bóng Mùa Hè 2018'
            ]

        ]);

        DB::table('channels')->insert([
            'id_channel' => 'UCnPGSZNSqsPxitx8oWYhRUA',
            'name'  =>  'Hibi',
            'images'   =>  'https://yt3.ggpht.com/-yi21LP8spdk/AAAAAAAAAAI/AAAAAAAAAAA/pv8OXpq6xBY/s288-mo-c-c0xffffffff-rj-k-no/photo.jpg',
            'description' =>  '♪ Kênh Zing Mp3: https://goo.gl/7wWBgT
                            * Fanpage:  https://www.facebook.com/windcold1109/
                            * Channel List: https://www.youtube.com/channel/hunglov3ly09'
        ]);


    }
}
