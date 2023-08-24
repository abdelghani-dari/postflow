@extends('template.layout')

@section('header')
<header class="jumbotron">
  <div class="container d-flex align-items-center justify-content-between p-4 rounded-2 mb-3"
    style="height:11em;">
    <h1 class="display-4">
      <a href="{{ route('post.index') }}" class="text-decoration-none fw-semibold text-success">
{{--         <img src="/images/accessoire (1).png" class="accessoire" alt=""> --}}
        <img src="/images/line.svg" class="line-svg" alt="">
{{--         <img src="/images/line.svg" class="line-svg2" alt=""> --}}
        MY-Blog</a>
    </h1>

    @if(Auth::check())
    <div class=" align-self-end">
      {!! link_to_route('post.create', 'New post', [], ['class' => 'btn btn-success']) !!}
      {{-- <form id="logout-form" action="{{ route('logout') }}" method="POST">
        @csrf
        {!! Form::submit('Logout', ['class' => 'btn btn-danger']) !!}
      </form> --}}
    </div>
    @else
    {!! link_to('login', 'Login', ['class' => 'btn btn-success align-self-end float-end']) !!}
    @endif
  </div>
</header>

@endsection

@section('content')
@if(isset($info))
<div class="row alert alert-info">{{ $info }}</div>
@endif

<div class="py-5 d-flex justify-content-center align-items-center">
  {!! $links !!}
</div>

@foreach($posts as $post)
<article class="row rounded-2 justify-content-center text-light">
  <div class="col-md-10 ">
    <header> 
      <div class="post-header py-2 px-3 bg-gradient rounded-top {{ (Auth::check()) && Auth::user()->email == $post->user->email ? 'bg-success bg-opacity-100' : 'bg-dark bg-opacity-75'  }}  d-flex justify-content-between">
        <span class="d-flex align-items-center"> {{ $post->user->name }}
          <span
          class="ms-3 bi bi-pencil-fill "></span></span>
          <div class="dropdown">
            <button class="btn text-light" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown">
              <span>•••</span>
              <img     
              style='{{ (Auth::check()) && Auth::user()->email == $post->user->email ? 'filter: saturate(100%) hue-rotate(20deg);' : 'filter: saturate(0%) hue-rotate(20deg);'  }}'
              src="/images/accessoire (1).png" class="wave-svg" alt="">
            </button>
            <ul class="dropdown-menu">
              @if((Auth::check()) && Auth::user()->email == $post->user->email)
            <li>
              <a class="dropdown-item" href="{{ route('post.edit', ['id' => $post->id]) }}">Update</a>
            </li>
            @endif 
          @if(Auth::check() && Auth::user()->admin)
          {!! Form::open(['method' => 'DELETE', 'route' => ['post.destroy', $post->id]]) !!}
          {!! Form::submit('Delete', ['class' => 'dropdown-item', 'onclick' => "return confirm('Vraiment supprimer cet article ?')"]) !!}
            {!! Form::close() !!}
            @endif
            <li style="cursor:pointer"><span class="dropdown-item"  onclick='navigator.clipboard.writeText((this.parentElement.parentElement.parentElement.parentElement.parentElement.nextElementSibling.firstElementChild.innerText))'>Copy Text</span></li> 
          </ul>
        </div>
      </div>
    </header> 
    <section>
      <div style="user-select:none;" class="post-content p-3 text-dark bg-light border-start {{ (Auth::check()) && Auth::user()->email == $post->user->email ? 'border-success' : 'border-secondary'  }} border-end bg-gradient bg-opacity-75">
        <h3>{{ $post->titre }}</h3>
        <p>{{ $post->contenu }}</p>
      </div> 
      <span class="float-end rounded-bottom bg-gradient pe-3 text-light w-100 {{ (Auth::check()) && Auth::user()->email == $post->user->email ? 'bg-success bg-opacity-100' : 'bg-dark bg-opacity-50'  }}  p-2">
        @php
        $timeSinceCreation = $post->created_at->diffForHumans(null, true);
        @endphp
        <div class="float-end">
          {{ $timeSinceCreation . ' ago' }}
        </div>
      </span>
    </section>
  </div>
</article>
<br>
<hr class="mb-5 m-4 text-light w-100">
@endforeach
<div class="py-5 d-flex justify-content-center align-items-center">
  {!! $links !!}
</div> 

@endsection