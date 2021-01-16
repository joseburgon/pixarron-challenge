<?php

namespace App\Http\Controllers\api\v1\post;

use App\Http\Controllers\Controller;
use App\Http\Resources\PostCollection;
use App\Models\Post;

class PostController extends Controller
{
    public function index()
    {

        return PostCollection::make(Post::paginate());

    }
}
