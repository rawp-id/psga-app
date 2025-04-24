@extends('layouts.app')
@section('content')
    <div class="card card-layout borderless shadow" style="border-radius: 15px;">
        <div class="card-body">
            <div id="iframe-container" style="position: relative; width: 100%; height: 100%;">
                <!-- Placeholder loading -->
                <div id="loading"
                    style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; display: flex; align-items: center; justify-content: center; background: #ffffff; z-index: 10;">
                    <div class="spinner-border" role="status">
                        <span class="visually-hidden">Loading...</span>
                    </div>
                </div>

                <!-- Iframe -->
                <iframe src="https://psga.uin-malang.ac.id/" frameborder="0" width="100%" height="100%"
                    onload="document.getElementById('loading').style.display='none';">
                </iframe>
            </div>

        </div>
    </div>
@endsection
