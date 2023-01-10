@extends('front.layouts.master')
@section('title'){{$pageData->page_title}} | {{$gs->title}} @endsection
@section('content')

<section class="breadcrums">
    <div class="container" style="max-width: 1223px;">
        <h2>{{$pageData->page_title}}</h2>    
    </div>
</section>

<?= $pageData->page_content; ?>

@endsection