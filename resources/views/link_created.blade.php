@extends('layouts.app')

@section('content')
    <div class="card">
        <div class="card-header">
            {{ __("Link created!") }}
        </div>
        <div class="card-body">

            <div class="row">
                <div class="col-6">
                    <input class = "form-control" id = "url"  disabled value="{{ route('home.short', ['code' => $link->code]) }}">
                </div>
                <div class="col-3">
                    <button type="button" class="btn btn-primary w-100" onclick="copyToClipboard()">{{ __("Copy") }}</button>
                </div>
                <div class="col-3">
                    <a href="{{ route('home.stats', ['code' => $link->code]) }}" class="btn btn-secondary w-100">{{ __("Click stats") }}</a>
                </div>
            </div>

        </div>
    </div>

    <script>
        function copyToClipboard() {
            let input = document.getElementById('url');

            console.log('copy', input.value)
            navigator.clipboard.writeText(input.value).then(function() {
                console.log('Text successfully copied to clipboard', input.value);
            }).catch(function(err) {
                console.error('Unable to copy text to clipboard', err);
            });
        }
    </script>
@endsection
