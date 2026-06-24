@extends('layout.main_layout')

@section('title', 'Paket Kita')

@section('content')
  <!-- Gap - Invisble Element -->
<br class='mt-5 d-lg-block d-none'>
<br class='mt-5 d-lg-block d-none'>
<br class='mb-5 d-lg-block d-none'>
<br class='mt-5 '>
<br class='mt-5 '>
        <!-- Gap - Invisble Element-->
           <!-- Success Snackbar -->
            @if (session('success'))
                <div class="container mt-3">
                    <div class="alert alert-success alert-dismissible fade show text-center" role="alert">
                        {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                </div>
            @endif
<div class="container mt-5 ">
    <h1 class="text-center text-success fw-bold mb-4">Lacak Paket Anda</h1>
    <p class="text-muted text-center mb-4">Masukkan nomor resi dan nama kurir untuk melacak status pengiriman paket Anda secara real-time.</p>

    <!-- Form Tracking -->
    <form action="/" method="POST" class="row g-3 justify-content-center">
        @csrf
        <div class="col-md-5">
            <div class="input-group">
                <input type="text" class="form-control" name="awb" placeholder="Nomor Resi"  required>
                <!-- Dropdown Courier -->
                <select id="courier" class="form-control form-select" name="courier" required>
                    <option selected disabled>Pilih Kurir</option>
                </select>
            </div>
        </div>

        <div class="col-md-2 text-center">
            <button type="submit" class="btn btn-success w-100"><i class="bi bi-search"></i> Lacak</button>
        </div>
    </form>

    <!-- Hasil Tracking -->
    <?php if (isset($trackingData)): ?>
        <?php if ($trackingData['status'] === 200): ?>
        <span class="mt-5 ">
            <div >
                <div class="card-body">
                    <h3 class="text-success mb-3">Informasi Paket</h3>
                    <div class="row">
                        <div class="col-md-6">
                            <p><strong>Resi:</strong> <?= htmlspecialchars($trackingData['data']['summary']['awb']) ?></p>
                            <p><strong>Kurir:</strong> <?= htmlspecialchars($trackingData['data']['summary']['courier']) ?></p>
                            <p><strong>Lokasi Asal:</strong> <?= htmlspecialchars($trackingData['data']['detail']['origin']) ?></p>
                            <p><strong>Pengirim:</strong> <?= htmlspecialchars($trackingData['data']['detail']['shipper']) ?></p>
                        </div>
                        <div class="col-md-6">
                            <p><strong>Lokasi Tujuan:</strong> <?= htmlspecialchars($trackingData['data']['detail']['destination']) ?></p>
                            <p><strong>Status:</strong> <?= htmlspecialchars($trackingData['data']['summary']['status']) ?></p>
                            <p><strong>Penerima:</strong> <?= htmlspecialchars($trackingData['data']['detail']['receiver']) ?></p>


                    </div>
                </div>
            </div>

            <!-- Progress Tracking -->
            <div class="progress-container mb-5 <?= $trackingData['data']['summary']['status'] === 'DELIVERED' ? 'step-3' : (count($trackingData['data']['history']) >= 2 ? 'step-2' : 'step-1') ?>">
                <div class="progress-step completed">
                    <span>1</span>
                    <p class="mt-4">Dijemput Kurir</p>
                </div>
                <div class="progress-step <?= count($trackingData['data']['history']) >= 2 ? 'completed' : '' ?>">
                    <span>2</span>
                    <p class="mt-4">Sedang Diantar</p>
                </div>
                <div class="progress-step <?= $trackingData['data']['summary']['status'] === 'DELIVERED' ? 'completed' : '' ?>">
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
                    <?php foreach ($trackingData['data']['history'] as $item): ?>
                    <tr>
                        <td><?= htmlspecialchars($item['date']) ?></td>
                        <td><?= htmlspecialchars($item['desc']) ?></td>
                        <td><?= htmlspecialchars($item['location']) ?></td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>

            <!-- Map Placeholder -->
            <h4 class="text-success mt-5 mb-3">Peta Lokasi</h4>
            <div id="map" class="bg-light border rounded-3" style="height: 400px; text-align: center; line-height: 400px;"
            data-origin="<?= htmlspecialchars($trackingData['data']['detail']['origin'] ?? '') ?>"
            data-destination="<?= htmlspecialchars($trackingData['data']['detail']['destination'] ?? '') ?>"
            >
                <span class="text-muted">Peta interaktif akan ditampilkan di sini</span>
            </div>
        </div>
        <?php else: ?>
        <div class="alert alert-danger mt-4" role="alert">
            <?= htmlspecialchars($trackingData['message']) ?>
        </div>
        <?php endif; ?>
    <?php elseif (isset($errorMessage)): ?>
    <div class="alert alert-warning mt-4" role="alert">
        <?= htmlspecialchars($errorMessage) ?>
    </div>
    <?php endif; ?>
</div>
<br class='mb-5 d-lg-block d-none'>
<br class='mb-5 d-lg-block d-none'>
<br class='mb-5 d-lg-block d-none'>
<br class='mb-5 d-lg-block d-none'>
<br class='mb-5 d-lg-block d-none'>
<br class='mb-5 '>
<br class='mb-5 '>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const alert = document.querySelector('.alert');
            if (alert) {
                setTimeout(() => {
                    alert.classList.remove('show');
                    alert.classList.add('fade');
                    setTimeout(() => {
                        alert.remove(); // Menghapus elemen dari DOM
                    }, 150); // Waktu tambahan untuk menyelesaikan animasi fade
                }, 3000); // Alert hilang otomatis setelah 3 detik
            }
        });
    </script>
@endsection

