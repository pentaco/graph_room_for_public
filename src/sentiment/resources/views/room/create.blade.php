@extends('layout.common')
@section('title', 'ルーム作成 | グラフルーム')
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
                <form action="{{ route('room.store') }}" method="POST">
                    @csrf
                    <div class="field mb-5">
                        <label class="label">ルーム名</label>
                        <div class="control">
                            <input class="input" type="text" placeholder="例）全校集会" name="room_name">
                        </div>
                        <p class="is-size-7">未入力の場合はランダムになります。</p>
                    </div>
                    <div class="field">
                        <label class="label">開始</label>

                        <div class="control">
                            <label class="checkbox mb-3">
                                <input type="checkbox" class="mr-2" id="startCheckbox" @if (true) checked @endif>現在時刻を設定
                            </label>
                            <input class="input" type="text" name="started_at" id="startedAt" autocomplete="off" readonly=”readonly” value="{{ old('started_at') }}">
                        </div>
                        @error('started_at')
                            <p class="has-text-danger">
                                <span>{{ $message }}</span>
                            </p>
                        @enderror
                    </div>
                    <div class="field end-input-field">
                        <label class="label">終了</label>
                        <div class="control">
                            <label class="checkbox mb-3">
                                <input type="checkbox" class="mr-2" id="endCheckbox" @if (true) checked @endif>最大値を設定(2時間後)
                            </label>
                            <input class="input" type="text" name="ended_at" id="endedAt" autocomplete="off" readonly=”readonly” value="{{ old('ended_at') }}">
                        </div>
                        @error('ended_at')
                            <p class="has-text-danger">
                                <span>{{ $message }}</span>
                            </p>
                        @enderror
                    </div>
                    <button class="button is-block is-fullwidth is-primary is-medium is-rounded" type="submit">Next</button>
                </form>
            </div>
        </div>
    </section>
@endsection
@section('js')
    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    @include('include.datetimepicker')
@endsection
@include('layout.footer')
