@extends('layouts.app')

@section('content')

    <div class="card">
        <div class="card-header">
            {{ __("Make your long link shortener in a few clicks!") }}
        </div>
        <div class="card-body">
            <form action="{{ route('home.store') }}" method="POST">
                {{ csrf_field() }}

                <div class="mb-3">
                    <label for="url" class="form-label">{{ __("Link") }}</label>
                    <input type="text" class="form-control" id="url" name="url" placeholder="https://example.com"
                           required>
                </div>

                <div class="row">
                    <div class="col-6">
                        <div class="mb-3">
                            <label for="lifetime" class="form-label">{{ __("Lifetime in hours (max 24h)") }}</label>
                            <input type="number" max="24" min="1" class="form-control" id="lifetime" name="lifetime"
                                   placeholder="1">
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="mb-3">
                            <label for="click_limit"
                                   class="form-label">{{ __("Max number of clicks (0 - unlimited)") }}</label>
                            <input type="number" min="0" class="form-control" id="click_limit" name="click_limit"
                                   placeholder="0">
                        </div>
                    </div>
                </div>

                <button type="submit" class="btn btn-primary">{{ __("Shorten") }}</button>
            </form>
        </div>
    </div>
@endsection
