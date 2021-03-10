@extends('layouts/main')

@section('title', 'User - List Modul')

@section('container')


<div class="page-wrapper">
    <div class="page-breadcrumb">
        <div class="row">
            <div class="col-7 align-self-center">
                <div class="d-flex align-items-center">
                    <nav aria-label="breadcrumb">
                    </nav>
                </div>
            </div>
            <div class="col-5 align-self-center">
                <div class="customize-input float-right">
                    <select class="custom-select custom-select-set form-control bg-white border-0 custom-shadow custom-radius">
                        <option selected>Aug 19</option>
                        <option value="1">July 19</option>
                        <option value="2">Jun 19</option>
                    </select>
                </div>
            </div>
        </div>
    </div>
    <!-- ============================================================== -->
    <!-- End Bread crumb and right sidebar toggle -->
    <!-- ============================================================== -->
    <!-- ============================================================== -->
    <!-- Container fluid  -->
    <!-- ============================================================== -->
    @foreach($modul as $m)
    <div class="container-fluid">
        <div class="card">
            <div class="card-header">
                Video Pembelajaran | {{$m->basic_competencies}}
            </div>
            <div class="card-body">
                <center>
                <iframe width="560" height="315" src="https://www.youtube.com/embed/{{$m->video_tutorials}}" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                </center>
            </div>
        </div>

        <div class="card">
            <div class="card-header">
                {{$m->subject_matter}}
            </div>
            <div class="card-body">
                <table>
                    <tr>
                        <td>
                            <p>Due Date : </p>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <a href="/up/{id}" title="Sand Your Assignment In Here" class="btn btn-primary" id="btn-submit">
                                Submit
                            </a>
                            <button title="Read Moduls" class="btn btn-success" id="btn-PDF">
                                Read Moduls
                            </button>
                        </td>
                    </tr>
                </table>
            </div>
        </div>
        @endforeach

    </div>
</div>


@endsection