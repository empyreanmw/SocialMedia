<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Trend;
use App\User;

class TrendsController extends Controller
{
    public function index()
    {
        $search = request('name');
        $trends;
		$result = Trend::get($search)->each(function($trend) use(&$trends){
            $trends[] =  
            [
                'name' => $trend->name,
                'post_count' => $trend->post_count,
                'trend_link' => 'socialmedia.app/trending/'.$trend->name,
                'posts' => $trend->posts              
            ];
        });

        return $trends;
    }
}
