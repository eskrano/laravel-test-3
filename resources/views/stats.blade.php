@extends('layouts.app')

@section('content')
    <div class="card">
        <div class="card-header">
            Link stats - {{ $link->code }}
        </div>
        <div class="card-body">
            <table class="table table-striped table-bordered">
                <thead>
                <tr>
                    <td>ID</td>
                    <td>IP</td>
                    <td>Origin</td>
                    <td>UA</td>
                    <td>Date</td>
                </tr>
                </thead>
                <tbody>
                @forelse($clicks as $item)
                    <tr>
                        <td>{{ $item->id }}</td>
                        <td>{{ $item->ip }}</td>
                        <td>{{ $item->referer }}</td>
                        <td>{{ $item->user_agent }}</td>
                        <td>{{ $item->created_at->format('Y-m-d H:i:s') }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5">No stats</td>
                    </tr>
                @endforelse
                </tbody>
            </table>

            {{ $clicks->links() }}
        </div>
    </div>
@endsection
