@extends('layout.common')
@section('title', 'ようこそ | グラフルーム')
@section('keywords', '感情の可視化,感情のグラフ化')
@section('description', '授業や会議中の感情・反応をグラフにするwebアプリです。')
@section('css')
<link rel="stylesheet" href="https://unpkg.com/bulma-modal-fx/dist/css/modal-fx.min.css" />
@endsection
@include('layout.head')
@section('content')
    <section class="hero is-fullheight">
        <div class="hero-body has-text-centered">
            <div class="login">
                {{-- <h3 class="mb-5">グラフルーム</h3> --}}
                <form action="{{ route('room.login') }}" method="POST">
                    @csrf
                    <div class="field">
                        <div class="control">
                            <input class="input is-medium is-rounded" type="text" placeholder="room code" required name="room_code" inputmode="url"/>
                        </div>
                    </div>
                    <br />
                    <button class="button is-block is-fullwidth is-primary is-medium is-rounded"
                        type="submit">Login</button>
                </form>
                <nav class="level">
                    <div class="level-item has-text-centered mb-5">
                        <div>
                            <a href="{{ route('room.create') }}">Create Room</a>
                        </div>
                    </div>
                    <div class="level-item has-text-centered mb-5">
                        <div>
                            <a tabindex="-1" class="modal-button" data-target="modal-card">How To Use</a>
                        </div>
                    </div>
                    <div class="level-item has-text-centered mb-5">
                        <div>
                            <a href="https://forms.gle/UjbULN5CPkgKELKX6" target="_blank" rel="noopener noreferrer">Contact</a>
                        </div>
                    </div>
                </nav>
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
                        <img src="{{ asset('images/room/mouad-bouallayel-Y4pvI2pFkTY-unsplash.jpg') }}" id="image0">
                    </figure>
                </div>
                <div class="card-content">
                    <div class="content">
                        <strong>このアプリ「グラフルーム」とは？</strong><br>
                        感じたことや思ったことを可視化するアプリです。<br>
                        例えば、授業、セミナー、全校集会、朝礼などの人が集まる場面でのリアクションをタップで計測しグラフ化します。<br>
                        <br>
                        <strong>Create Room</strong><br>
                        ルームの新規作成ができます。計測したい感情などを4つ登録できます。<br>
                        リバースカードはおまけ要素です。まずは画像を登録してみてください。<br>
                        ルーム作成後にルームURLとコードが表示されます。URLを共有すればルームに招待することができます。<br>
                        <br><br>
                        <strong>Login</strong><br>
                        ルームコードを入力してルームにログインすることができます。<br>
                        ルームURLから直接ログインすることもできます。<br>
                        <br><br>
                        <strong>Contact</strong><br>
                        ご不明点や要望などをお問合せください。<br>
                        感想をいただけると、とても嬉しいです。<br>
                    </div>
                </div>
            </div>
            <!-- end content -->
        </div>
        <button class="modal-close is-large text-primary" aria-label="close"></button>
    </div>
    <!-- end tiny modal card -->
@endsection

@section('js')
    <script src="https://unpkg.com/bulma-modal-fx/dist/js/modal-fx.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.7.0.slim.min.js" integrity="sha256-tG5mcZUtJsZvyKAxYLVXrmjKBVLd6VpVccqz/r4ypFE=" crossorigin="anonymous"></script>
@endsection
@include('layout.footer')
