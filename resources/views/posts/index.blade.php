@extends('layouts.app')

@section('title', 'Beranda')

@section('content')

    <x-stories />

    <x-post-card username="demouser" location="Bandung, Jawa Barat" filter="Vibrant" :likes="35"
        caption="Sudut rumah favorit untuk bersantai di akhir pekan🌴💙 #home #architecturedesign #weekend"
        date="30 Jul 2026">
    </x-post-card>

@endsection
