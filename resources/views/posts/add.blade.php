@extends('template.layout')
@section('content')
<br>
<div class="container" style="height:85vh;">
    <div class="row h-100 justify-content-center align-items-center">
        <div class="col-md-6">
            <div class="card border border-3 border-success rounded-3">
                <div class="card-header bg-success text-white">Ajout d'un article</div>
                <div class="card-body">
                    {!! Form::open(['route'=>'post.store']) !!}
                    <div class="mb-3 {!! $errors->has('titre') ? 'has-error' : '' !!}">
                        {!! Form::label('titre', 'Titre', ['class' => 'form-label']) !!}
                        {!! Form::text('titre', null, ['class'=>'form-control', 'placeholder'=>'Titre']) !!}
                        {!! $errors->first('titre', '<small class="help-block">:message</small>') !!}
                    </div>
                    <div class="mb-3 {!! $errors->has('contenu') ? 'has-error' : '' !!}">
                        {!! Form::label('contenu', 'Contenu', ['class' => 'form-label']) !!}
                        {!! Form::textarea('contenu', null, ['class'=>'form-control', 'placeholder'=>'Contenu']) !!}
                        {!! $errors->first('contenu', '<small class="help-block">:message</small>') !!}
                    </div>
                    {!! Form::submit('Envoyer !', ['class'=>'btn btn-success float-end']) !!}
                    {!! Form::close() !!}
                </div>
            </div>
            <a href="javascript:history.back()" class="btn btn-success mt-3">
                <span class="glyphicon glyphicon-circle-arrow-left"></span> Retour
            </a>
        </div>
    </div>
</div>
@endsection
