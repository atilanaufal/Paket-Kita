@extends('layout.main_layout')

@section('title', 'Paket Kita')

@section('content')
<div class="container mt-5">

    <!-- Hasil Tracking -->
    @if(isset($trackingData))
       <div class="text-center">
            <img src="{{ asset('icon/' . strtolower($trackingData->courier) . '.png') }}" 
                 alt="{{ $trackingData->courier }}" 
                 style="width: 130px;" 
                 class="align-self-center">
            <h1 class="text-success fw-bold mb-4">{{ $trackingData->courier }}</h1>
        </div>
        <br>
        <br>
        <span class="mt-5">
            <div>
                <div class="card-body">
                    <h3 class="text-success mb-3">Informasi Paket</h3>
                    <div class="row">
                        <div class="col-md-6">
                            <p><strong>Resi:</strong> {{ $trackingData->awb }}</p>
                            <p><strong>Kurir:</strong> {{ $trackingData->courier }}</p>
                            <p><strong>Lokasi Asal:</strong> {{ $trackingData->origin }}</p>
                            <p><strong>Pengirim:</strong> {{ $trackingData->shipper }}</p>
                        </div>
                        <div class="col-md-6">
                            <p><strong>Lokasi Tujuan:</strong> {{ $trackingData->destination }}</p>
                            <p><strong>Status:</strong> {{ $trackingData->status }}</p>
                            <p><strong>Penerima:</strong> {{ $trackingData->receiver }}</p>
                        </div>
                    </div>
                </div>

                <!-- Progress Tracking -->
                <div class="progress-container mb-5 {{ $trackingData->status === 'DELIVERED' ? 'step-3' : (count($history, true) >= 2 ? 'step-2' : 'step-1') }}">
                    <div class="progress-step completed">
                        <span>1</span>
                        <p class="mt-4">Dijemput Kurir</p>
                    </div>
                    <div class="progress-step {{ count($history) >= 2 ? 'completed' : '' }}">
                        <span>2</span>
                        <p class="mt-4">Sedang Diantar</p>
                    </div>
                    <div class="progress-step {{ $trackingData->status === 'DELIVERED' ? 'completed' : '' }}">
                        <span>3</span>
                        <p class="mt-4">Pesanan Sampai</p>
                    </div>
                </div>

                <!-- History -->
                <h4 class="text-success mb-3">Riwayat Pelacakan</h4>
                <table class="table table-hover table-bordered">
                    <thead class="table-dark">
                        <tr>
                            <th>Tanggal</th>
                            <th>Keterangan</th>
                            <th>Lokasi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($history as $item)
                        <tr>
                            
                            <td>{{ $item['date'] }}</td>
                            <td>{{ $item['description'] }}</td>
                            <td>{{ $item['location'] }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>

                <!-- Map Placeholder -->
                <h4 class="text-success mt-5 mb-3">Peta Lokasi</h4>
                <div id="map" class="bg-light border rounded-3" style="height: 400px; text-align: center; line-height: 400px;"
                    data-origin="{{ $trackingData->origin }}"
                    data-destination="{{ $trackingData->destination }}">
                    <span class="text-muted">Peta interaktif akan ditampilkan di sini</span>
                </div>
            </div>
        </span>
    @else
        <p class="text-center text-danger">Tidak ada data tracking ditemukan.</p>
    @endif
</div>
@endsection
