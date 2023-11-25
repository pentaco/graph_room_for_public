@extends('layout.common')
@section('title', 'ルーム | グラフルーム')
@section('keywords', '感情の可視化,感情のグラフ化')
@section('description', '授業や会議中の感情・反応をグラフにするwebアプリです。')
@section('noindex')
<meta name="googlebot" content="noindex">
@endsection
@section('css')
<link rel="stylesheet" href="https://unpkg.com/bulma-modal-fx/dist/css/modal-fx.min.css" />
@endsection
@include('layout.head')
@section('content')
    <section class="hero is-fullheight">
        <div class="hero-body">

            <div class="card">
                <div class="card-image p-1">
                    <div>
                        <canvas id="myChart"></canvas>
                    </div>
                </div>
                <div class="card-content">
                    <div class="media">
                        <div class="media-content">
                            <p class="title is-4">{{ $room->name }}</p>
                            <p class="subtitle is-6">{{ date('Y/m/d H:i', strtotime($room->started_at)) }} - {{ date('Y/m/d H:i', strtotime($room->ended_at)) }}</p>
                        </div>
                    </div>

                    <div class="content">
                        <div class="buttons">
                            @foreach ($buttons as $button)
                                <button class="button is-light is-fullwidth sentimentButton is-medium" data-name="{{ $button->name }}" data-id="{{ $button->id }}">{{ $button->name }}</button>
                            @endforeach
                        </div>
                        <button class="button is-light is-fullwidth modal-button"  data-target="modal-card" style="display: none" id="modalToggle"></button>
                        <input type="hidden" id="sentimentStoreUrl" value="{{ route('sentiment.store') }}">
                        <input type="hidden" id="sentimentResultUrl" value="{{ route('sentiment.result', ['room_code' => $room->code]) }}">
                        <input type="hidden" id="roomCode" value="{{ $room->code }}">
                        <input type="hidden" id="startedAt" value="{{ date('Y/m/d H:i', strtotime($room->started_at)) }}">
                        <input type="hidden" id="endedAt" value="{{ date('Y/m/d H:i', strtotime($room->ended_at)) }}">
                        <div class="has-text-centered is-fullwidth mt-5"><a href="{{route('index')}}" class="">TOP</a></div>
                    </div>
                </div>
            </div>

        </div>
    </section>
    <!--  ===============
        HERE BE MODALS
        ===============  -->
    <!-- 3dFlipVertical card tiny -->
    <div id="modal-card" class="modal modal-fx-3dSlit">
        <div class="modal-background" id="modalBg"></div>
        <div class="modal-content is-tiny">
            <!-- content -->
            <div class="card m-1">
                <div class="card-image">
                    <figure class="image">
                        <img src="{{ asset('images/room/mouad-bouallayel-Y4pvI2pFkTY-unsplash.jpg') }}" style="display: none" id="image0">
                        @foreach($images as $index => $image)
                        <img src="{{ asset('storage/' . $image->path) }}" class="reverseCard" style="display: none" id="image{{ $index + 1 }}">
                        @endforeach
                    </figure>
                </div>
            </div>
            <!-- end content -->
        </div>
        <button class="modal-close is-large" aria-label="close"></button>
    </div>
    <!-- end tiny modal card -->
@endsection
@section('js')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="{{ asset('js/room.js') }}?{{ date("Y/m/d 00:00:00") }}"></script>
    <script src="https://unpkg.com/bulma-modal-fx/dist/js/modal-fx.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.7.0.slim.min.js" integrity="sha256-tG5mcZUtJsZvyKAxYLVXrmjKBVLd6VpVccqz/r4ypFE=" crossorigin="anonymous"></script>
@endsection
@include('layout.footer')
