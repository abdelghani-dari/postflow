<?php
namespace App\Repositories;

use App\Models\Post as ModelsPost; 
class PostRepository
{
  protected $post;
  public function __construct(ModelsPost $post)
  {
    $this->post=$post;
  }
/*  public function getPaginate($n)
  {
    return $this->post->with('user')
    ->orderBy('posts.created_at', 'desc')
    ->paginate($n);
  } */
 public function store($inputs)
  {
    $this->post->create($inputs);
  }
 public function destroy($id)
  {
    $this->post->findOrFail($id)->delete();
  }
  public function getPaginateOrderedByDate($perPage)
{
    return ModelsPost::orderBy('created_at', 'desc')->paginate($perPage);
}
}
