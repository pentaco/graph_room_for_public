@extends('layout.common')
@section('title', 'ルーム作成完了 | グラフルーム')
@section('keywords', '感情の可視化,感情のグラフ化')
@section('description', '授業や会議中の感情・反応をグラフにするwebアプリです。')
@section('noindex')
<meta name="googlebot" content="noindex">
@endsection
@section('css')
@endsection
@include('layout.head')
@section('content')
    <section class="hero is-fullheight">
        <div class="hero-body">
            <div class="card is-shady">
                <div class="card-image">
                    <figure class="image is-4by3">
                        <img src="{{ asset('images/room/mouad-bouallayel-Y4pvI2pFkTY-unsplash.jpg') }}">
                    </figure>
                </div>
                <div class="card-content">
                    <div class="has-text-right">
                        <div class="line-it-button" data-lang="ja" data-type="share-b" data-env="REAL" data-url="{{ route('room', ['room_code'=>$room_code]) }}" data-color="default" data-size="small" data-count="false" data-ver="3" style="display: none;"></div><script src="https://www.line-website.com/social-plugins/js/thirdparty/loader.min.js" async="async" defer="defer"></script>
                    </div>
                    <div class="content">
                        <h4>Thank you!</h4>
                        <p>新しいルームを作成しました。</p>
                        <p>ルームコードをシェアして参加してもらいましょう！</p>
                        <strong>ルームコード</strong>
                        <p>{{ $room_code }}</p>
                        <div class="has-text-centered">
                            <a class="button" href="{{ route('room', ['room_code'=>$room_code]) }}">Login</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
@section('js')
@endsection
@include('layout.footer')
