@extends('layout.main_layout')

@section('title', 'Paket Kita')

@section('content')
<div class="container mt-5">
    <h1 class="text-center text-success fw-bold mb-4">Riwayat Paket</h1>
    <p class="text-muted text-center mb-4">Menyimpan jejak tracking paket anda ke dalam riwayat</p>

    <!-- Form Tracking -->
    <form class="row g-3 justify-content-center">
        <div class="col-md-5">
            <div class="input-group">
                <input type="text" id="search-input" class="form-control" placeholder="Cari Jejak Tracking">
            </div>
        </div>
    </form>

    <div class="bg-white rounded-1">
        <div class="container-fluid d-flex flex-column align-items-start py-5 px-4">
            <div class="text-center text-md-start">
                <h5 class="text-success mb-3">Riwayat</h5>
            </div>
            <p id="no-results" class="text-danger my-5 text-center align-self-center" style="display: none;">
                Tidak ada hasil yang ditemukan.
            </p>

@if(Auth::check())
    @if($trackingData->isEmpty())
        <p class="text-muted text-center align-self-center my-5">Tidak ditemukan jejak tracking paket untuk saat ini.</p>
    @else
        <div class="container mt-5">
            <div class="row g-4" id="card-container">
                @foreach($trackingData as $track)
                 @if($track->user_id == Auth::id())
                    <div class="col-md-4 track-card" data-courier="{{ strtolower($track->courier) }}" data-awb="{{ $track->awb }}">
                        <div class="card h-100 shadow-sm border-0 rounded-4 position-relative">
                            <!-- Tombol hapus dengan posisi absolute -->
                            <form action="{{ route('erase.track', ['id' => $track->track_id]) }}" method="POST" class="z-3 position-absolute top-0 end-0 m-2">
                                @csrf
                                @method('DELETE')
                                <button type="submit" 
                                        class="btn" 
                                        style="width: 40px; height: 40px;"
                                        onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')">
                                    <i class="bi bi-trash text-muted"></i>
                                </button>
                            </form>
                    
                            <div class="card-body text-center">
                                <img src="{{ asset('icon/' . strtolower($track->courier) . '.png') }}" alt="{{ $track->courier }}" class="icon-image mb-3">
                                <h5 class="fw-bold text-success">{{ strtoupper($track->courier) }}</h5>
                                <p class="text-muted">{{ $track->awb }}</p>
                                <a href="{{ route('track-view', ['id' => $track->track_id]) }}" class="stretched-link"></a>
                            </div>
                        </div>
                    </div>
                    @endif
                @endforeach
            </div>
        </div>
    @endif
@else
    <p class="text-muted text-center align-self-center my-5">Anda harus login untuk melihat riwayat tracking paket.</p>
@endif
        </div>
    </div>
</div>

<!-- Script untuk mencari secara realtime -->
<script>
    document.getElementById('search-input').addEventListener('input', function() {
        const searchValue = this.value.toLowerCase();
        const cards = document.querySelectorAll('.track-card');
        let hasResults = false;

        cards.forEach(card => {
            const courier = card.getAttribute('data-courier').toLowerCase();
            const awb = card.getAttribute('data-awb').toLowerCase();

            if (courier.includes(searchValue) || awb.includes(searchValue)) {
                card.style.display = 'block';
                hasResults = true;
            } else {
                card.style.display = 'none';
            }
        });

        // Tampilkan pesan "Tidak ada hasil" jika tidak ada kartu yang cocok
        const noResultsMessage = document.getElementById('no-results');
        if (searchValue === "") {
            noResultsMessage.style.display = 'none'; // Sembunyikan pesan saat search box kosong
        } else if (hasResults) {
            noResultsMessage.style.display = 'none'; // Sembunyikan pesan jika ada hasil
        } else {
            noResultsMessage.style.display = 'block'; // Tampilkan pesan jika tidak ada hasil
        }
    });
</script>
@endsection
