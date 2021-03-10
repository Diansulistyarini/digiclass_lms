@extends('layouts/main')

@section('title', 'User - List Modul')

@section('container')
<div class="page-wrapper">
    <div class="card">
        <div class="card-header">
            Digiclass Academy
        </div>
        <div class="card-body">
            <div class="rows" style="margin-left:10px;">
                <video width="300" height="200" controls style="margin-left: 5px;">
                    <source src="{{ asset('videos/sample_video.mp4')}}" type="video/mp4">
                </video>
                <video width="300" height="200" controls style="margin-left: 5px;">
                    <source src="{{ asset('videos/sample_video.mp4')}}" type="video/mp4">
                </video>
                <video width="300" height="200" controls style="margin-left: 5px;">
                    <source src="{{ asset('videos/sample_video.mp4')}}" type="video/mp4">
                </video>
            </div>

        </div>
    </div>

    <div class="card">
        <div class="card-header">
            Modul Pembelajaran
        </div>
        @foreach($modul as $m)
        <div class="card-body">
            <ul style="list-style-type:none;">
                <li>
                    <i class="fas fa-folder"></i>
                    <a href="/reading{{ $m->id }}">{{$m->subject_matter}}</a>
                </li>
            </ul>
        </div>
        @endforeach
    </div>
</div>
@endsection