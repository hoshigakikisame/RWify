@extends('layouts.sidebar')
@section('content')
<section class="">
    <div class="greeting mb-5">
        <h6>Hi Thoriq Fathurrozi,</h6>
        <h1 class="font-extrabold text-4xl">Selamat Datang di RWify</h1>
    </div>
    <div class="working flex gap-4">
        <div class="left grow">
            <div class="info flex gap-5 mb-3">
                <div class="info-element">
                    <h2>Pengajuan Dokumen</h2>
                    <div class="info-body">
                        <h1>9</h1>
                        <img src="" alt="">
                    </div>
                    <p>Terakhir diperbarui</p>
                </div>
                <div class="info-element">
                    <h2>Pengajuan Dokumen</h2>
                    <div class="info-body">
                        <h1>9</h1>
                        <img src="" alt="">
                    </div>
                    <p>Terakhir diperbarui</p>
                </div>
                <div class="info-element">
                    <h2>Pengajuan Dokumen</h2>
                    <div class="info-body">
                        <h1>9</h1>
                        <img src="" alt="">
                    </div>
                    <p>Terakhir diperbarui</p>
                </div>
            </div>
            <div class="chart grow mb-3 h-full">
                <h1>Statistik Warga</h1>
            </div>
            <div class="leaderboard">
                <h1>Leaderboard Iuran</h1>
            </div>
        </div>
        <div class="right">
            <div class="calendar">
                <h1>Calendar</h1>
            </div>
            <div class="graph">
                <h1>Graph</h1>
            </div>
        </div>
    </div>
</section>
@endsection