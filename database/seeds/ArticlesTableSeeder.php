<?php

use App\Article;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ArticlesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('articles')->delete();

        Article::create([
            'user_id' => 1,
            'excerpt' => 'Curabitur a lectus eget tortor condimentum imperdiet. Nulla commodo non turpis et facilisis. Maecenas posuere convallis odio sed congue. Duis dapibus purus velit, pellentesque viverra mauris pellentesque in. Duis risus tortor, interdum ut risus vel, porttitor placerat magna. Donec cursus nulla non nisl suscipit, at tristique turpis vestibulum.',
            'title' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.',
            'body' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Mauris non augue augue. Mauris imperdiet lacus eget ultricies efficitur. Donec placerat gravida nulla. Aenean at orci non metus semper aliquet ut at elit. Nullam lacinia elit sed ex imperdiet suscipit. Nam convallis elit vitae ipsum condimentum, scelerisque porta sem pellentesque. Aliquam tristique ipsum sed sodales facilisis. Ut facilisis vestibulum mi nec ornare. Vivamus eu maximus nisi, eget faucibus odio.Vestibulum ornare auctor diam, a sollicitudin leo euismod vel. Sed ac tortor ac risus vehicula iaculis vel sed orci. Aliquam condimentum nec tortor quis vehicula. Aliquam libero augue, mattis nec sodales quis, semper nec arcu. Vestibulum tincidunt rhoncus viverra. Nam efficitur turpis vitae pulvinar pulvinar. Quisque sollicitudin turpis ut velit consectetur, ut elementum metus aliquam. Donec odio lectus, accumsan sed commodo at, posuere in sem. Nulla facilisi. Vestibulum id pharetra odio, non blandit justo.Nulla mauris mi, accumsan sed urna ac, convallis sodales turpis. Phasellus purus ligula, pretium non euismod et, fringilla sit amet erat. Proin ac imperdiet lorem. Fusce et risus maximus ligula auctor porttitor ac at nunc. Nunc et ullamcorper neque. Mauris sit amet venenatis ante, eget semper felis. Integer non mauris congue, volutpat tortor vitae, semper tortor. Vestibulum laoreet sapien a felis consequat sollicitudin.',
            'published_at' => Carbon::now()
        ]);
    }
}
