@extends('layouts.app')

@section('content')
    <!-- Page header -->
    <div class="page-header d-print-none">
        <div class="container-xl">
        <div class="row g-2 align-items-center">
            <div class="col">
            <h2 class="page-title">
                Inline Player
            </h2>
            </div>
        </div>
        </div>
    </div>
    <!-- Page body -->
    <div class="page-body">
        <div class="container-xl">
        <div class="row row-cards">
            <div class="col-lg-6">
            <div class="card">
                <div class="card-body">
                <h3 class="card-title">Youtube Player</h3>
                <div id="player-youtube" data-plyr-provider="youtube" data-plyr-embed-id="bTqVqk7FSmY"></div>
                </div>
            </div>
            </div>
            <div class="col-lg-6">
            <div class="card">
                <div class="card-body">
                <h3 class="card-title">Vimeo Player</h3>
                <div id="player-charlotte" style="background: url('{{}}')"></div>
                </div>
            </div>
            </div>
        </div>
        </div>
    </div>
@endsection