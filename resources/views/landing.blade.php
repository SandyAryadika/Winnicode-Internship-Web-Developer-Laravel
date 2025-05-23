@extends('layouts.app')

@section('title', 'Winnicode')

@section('content')
    @include('partials.header')
    @include('partials.navbar')
    @include('partials.berita-terkini')
    @include('partials.berita-utama')
    @include('partials.sorotan')
    @include('partials.pilihan-penulis')
    @include('partials.kontributor')
    @include('partials.newsletter')
    @include('partials.footer')
@endsection
