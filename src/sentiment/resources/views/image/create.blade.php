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
                <form action="{{ route('image.store', ['room_code' => $room_code]) }}" method="POST">
                    @csrf
                    <h4 class="label">リバースカード</h4>
                    <p class="is-size-7">アップロードは任意です</p>
                    @foreach (['upfile1', 'upfile2', 'upfile3'] as $key => $upfile_name)
                    <div class="field mt-5">
                        <div class="control">
                            <div class="file has-name is-right is-fullwidth">
                                <label class="file-label">
                                  <input class="file-input fileInput" type="file" id="{{ $upfile_name }}" ccept="image/*">
                                  <span class="file-cta">
                                    <span class="file-icon">
                                      <i class="fas fa-upload"></i>
                                    </span>
                                  </span>
                                  <span class="file-name" id="span_{{ $upfile_name }}"></span>
                                </label>
                            </div>
                        </div>
                    </div>
                    <input type="hidden" name="base64_upfiles[]" class="base64Upfile" id="base64_{{ $upfile_name }}" value="">
                    @endforeach
                    <button class="button is-block is-fullwidth is-primary is-medium is-rounded" type="submit">Create</button>
                </form>
            </div>
        </div>
    </section>
@endsection
@section('js')
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/browser-image-compression@2.0.0/dist/browser-image-compression.js"></script>
<script src="{{ asset('js/upload-image.js') }}"></script>
@endsection
@include('layout.footer')
