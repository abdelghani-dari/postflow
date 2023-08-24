<?php

namespace App\Http\Controllers;

use App\Http\Requests\PostRequest;
use App\Models\Post;
use App\Repositories\PostRepository;
use Illuminate\Http\Request;

class PostController extends Controller
{
  protected $postRepository;
  protected $nbrPerPage=4;
 public function __construct(PostRepository $postRepository)
  {
    $this->middleware('auth', ['except'=>'index']);
   $this->middleware('admin', ['only'=>'destroy']);
$this->postRepository=$postRepository;
  } 
  
public function index()
{
    $posts = $this->postRepository->getPaginateOrderedByDate($this->nbrPerPage);
    $links = $posts->render();
    return view('posts.liste', compact('posts', 'links'));
}

public function edit($id) {
    $post = Post::findOrFail($id);
    return view('posts.edit', compact('post'));
}
public function update($id,PostRequest $request) {
    $post = Post::findOrFail($id);
    $post->titre = $request->titre ;
    $post->contenu = $request->contenu;
    $post->save();
    return redirect('/post');
}

  public function create()
  {
    return view('posts.add');
  }
 public function store(PostRequest $request)
  {
    $inputs=array_merge($request->all(), ['user_id'=>$request->user()->id]);
    $this->postRepository->store($inputs);
    return redirect(route('post.index'));
  }
  public function destroy($id)
  {
    $this->postRepository->destroy($id);
    return redirect()->back();
  }
}
