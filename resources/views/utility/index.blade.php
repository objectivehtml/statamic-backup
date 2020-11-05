@extends('statamic::layout')
@section('title', __('Git Config'))

@section('content')

    <header class="mb-3">

        @include('statamic::partials.breadcrumb', [
            'url' => cp_route('utilities.index'),
            'title' => __('Utilities')
        ])
        <div class="flex items-center justify-between">
            <h1>{{ __('Git Backups') }}</h1>

            <form method="POST" action="{{ cp_route('utilities.git-backup.init') }}">
                @csrf
                <button class="btn-primary">{{ __('Install Git') }}</button>
            </form>
        </div>
    </header>

    <div class="card p-0">
        <div class="p-2">
            @if($repository->isBare())
                <p><em>This project does not contain a Git repository.</em></p>
            @endif
        </div>
    </div>

@stop
