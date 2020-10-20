<?php

namespace Database\Seeders;

use App\Models\Post;
use App\Models\PostUpload;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        Post::create([
            'body'=>'Hello Guys This Is coool woow (:',
            'user_id'=>1
        ]);
        Post::create([
            'user_id'=>1
        ]);
        Post::create([
            'body'=>'Take A look To This Pic',
            'user_id'=>1
        ]);
        Post::create([
            'body'=>'this is awesome',
            'user_id'=>1
        ]);

//post 1
        PostUpload::create([
            'path'=>'https://cdn.hipwallpaper.com/i/77/4/gIx0SV.jpg',
            'post_id'=>1,
            'type'=>'image'
        ]);
        PostUpload::create([
            'path'=>'https://cdn.hipwallpaper.com/m/68/13/89TVSN.jpg',
            'post_id'=>1,
            'type'=>'image'
        ]);
        PostUpload::create([
            'path'=>'https://cdn.hipwallpaper.com/i/16/42/jd9vIg.jpg',
            'post_id'=>1,
            'type'=>'image'
        ]);
        PostUpload::create([
            'path'=>'https://cdn.hipwallpaper.com/i/96/61/uASzwm.jpg',
            'post_id'=>1,
            'type'=>'image'
        ]);
        PostUpload::create([
            'path'=>'https://cdn.hipwallpaper.com/i/9/91/m7weFU.jpg',
            'post_id'=>1,
            'type'=>'image'
        ]);
        PostUpload::create([
            'path'=>'https://cdn.hipwallpaper.com/i/44/68/0FUaXk.jpg',
            'post_id'=>1,
            'type'=>'image'
        ]);

    //post 1
        PostUpload::create([
            'path'=>'https://cdn.hipwallpaper.com/i/21/77/SPdlZq.jpg',
            'post_id'=>2,
            'type'=>'image'
        ]);
        PostUpload::create([
            'path'=>'https://cdn.hipwallpaper.com/i/14/69/W4vfYg.jpg',
            'post_id'=>2,
            'type'=>'image'
        ]);
        PostUpload::create([
            'path'=>'https://cdn.hipwallpaper.com/m/11/98/rcLpe8.jpg',
            'post_id'=>2,
            'type'=>'image'
        ]);

        //post 3
        PostUpload::create([
            'path'=>'https://cdn.hipwallpaper.com/m/7/48/xPGuA1.jpg',
            'post_id'=>3,
            'type'=>'image'
        ]);
        PostUpload::create([
            'path'=>'https://cdn.hipwallpaper.com/m/28/49/Ih0ljS.jpg',
            'post_id'=>3,
            'type'=>'image'
        ]);
        PostUpload::create([
            'path'=>'https://cdn.hipwallpaper.com/m/11/98/rcLpe8.jpg',
            'post_id'=>3,
            'type'=>'image'
        ]);
        PostUpload::create([
            'path'=>'https://cdn.hipwallpaper.com/m/88/94/riu3AR.jpg',
            'post_id'=>3,
            'type'=>'image'
        ]);
        PostUpload::create([
            'path'=>'https://cdn.hipwallpaper.com/m/90/0/iQhPq6.jpg',
            'post_id'=>3,
            'type'=>'image'
        ]);
        PostUpload::create([
            'path'=>'https://cdn.hipwallpaper.com/m/93/81/OL6AIc.jpg',
            'post_id'=>3,
            'type'=>'image'
        ]);
        PostUpload::create([
            'path'=>'https://cdn.hipwallpaper.com/m/11/1/lMZJWO.jpg',
            'post_id'=>3,
            'type'=>'image'
        ]);
        PostUpload::create([
            'path'=>'https://cdn.hipwallpaper.com/m/5/66/AYptck.jpg',
            'post_id'=>3,
            'type'=>'image'
        ]);
        PostUpload::create([
            'path'=>'https://cdn.hipwallpaper.com/m/85/32/6RZAct.jpg',
            'post_id'=>3,
            'type'=>'image'
        ]);

        //post 4 vid
        PostUpload::create([
            'path'=>'https://s77.vidbem.com/6jmnv7kgreazsalriwlabj7jjb6rj7d6hfxdioso2gvwi7wyzlg53jv5dcxa/v.mp4',
            'post_id'=>4,
            'type'=>'video'
        ]);
    }
}
