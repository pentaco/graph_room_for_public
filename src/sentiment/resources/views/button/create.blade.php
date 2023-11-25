@extends('layout.common')
@section('title', 'グラフルーム')
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
            <div class="login">
                <form action="{{ route('button.store', ['room_code' => $room_code]) }}" id="bottonForm" method="POST">
                    @csrf
                    <h4 class="label">感情・反応</h4>
                    <p class="is-size-7">4つすべて入力してください</p>
                    <div class="field">
                        <div class="control">
                            <input class="input buttonName" type="text" placeholder="例）ためになった" name="button_name1" value="{{ old('button_name1') }}">
                        </div>
                    </div>
                    @error('button_name1')
                    <p class="has-text-danger">
                        <span>{{ $message }}</span>
                    </p>
                    @enderror
                    <div class="field mt-5">
                        <div class="control">
                            <input class="input buttonName" type="text" placeholder="例）つまらない" name="button_name2" value="{{ old('button_name2') }}">
                        </div>
                    </div>
                    @error('button_name2')
                    <p class="has-text-danger">
                        <span>{{ $message }}</span>
                    </p>
                    @enderror
                    <div class="field mt-5">
                        <div class="control">
                            <input class="input buttonName" type="text" placeholder="例）たいくつ" name="button_name3" value="{{ old('button_name3') }}">
                        </div>
                    </div>
                    @error('button_name3')
                    <p class="has-text-danger">
                        <span>{{ $message }}</span>
                    </p>
                    @enderror
                    <div class="field mt-5">
                        <div class="control">
                            <input class="input buttonName" type="text" placeholder="例）おもしろい" name="button_name4" value="{{ old('button_name4') }}">
                        </div>
                    </div>
                    @error('button_name4')
                    <p class="has-text-danger">
                        <span>{{ $message }}</span>
                    </p>
                    @enderror
                    <button class="button is-block is-fullwidth is-primary is-medium is-rounded" type="submit">Next</button>
                </form>
            </div>
        </div>
    </section>
@endsection
@section('js')
@endsection
@include('layout.footer')
