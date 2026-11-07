@extends('fronts.edusoft-themes.layouts.app')

@section('title', $schoolDetails['meta_title'] ?: $schoolDetails['school_name'])

@section('content')
    @include('fronts.edusoft-themes.elegant.includes.header')

    <main id="main">
        @include('fronts.edusoft-themes.elegant.includes.hero')
        @include('fronts.edusoft-themes.elegant.includes.page-sections')
    </main>

    @include('fronts.edusoft-themes.elegant.includes.footer')
@endsection
