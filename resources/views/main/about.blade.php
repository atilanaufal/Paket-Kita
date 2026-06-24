@extends('layout.main_layout')

@section('title', 'PaketKita')

@section('content')
    <!-- Tentang Kami -->
    <div class="  bg-light  rounded-1">
        <div class="container-fluid d-flex flex-column flex-md-row align-items-center justify-content-between py-5 px-4">
            <img src="{{asset('icon/logo2.2.png')}}" style="width: 240px;
            class="" alt="Logo PaketKita" >
            <div class="text-center text-md-start ms-lg-3">
                <h1 class="fw-bold text-success mb-3">Tentang Kami</h1>
                <p class="fs-5">
                    <span class="text-success fw-bold">Paket Kita</span> adalah platform terpercaya untuk pelacakan paket Anda! Kami memahami betapa pentingnya setiap pengiriman bagi Anda, baik untuk keperluan pribadi maupun bisnis.
                    Dengan teknologi canggih dan antarmuka yang ramah pengguna, kami berkomitmen memberikan pengalaman pelacakan yang cepat, akurat, dan efisien.
                </p>
            </div>
        </div>
    </div>

    <!-- Misi dan Layanan -->
    <div class="container mt-5">
        <div class="row g-4">
            <!-- Misi -->
            <div class="col-md-6">
                <div class="card h-100 shadow-sm border-0 rounded-4">
                    <div class="card-body text-center">
                        <img src="{{ asset('icon/goal.png') }}" alt="Misi" class="mb-3" style="width: 80px;">
                        <h5 class="fw-bold text-success">Misi Kami</h5>
                        <p class="text-muted">
                            Misi kami adalah menyederhanakan proses pelacakan paket dengan menyediakan informasi yang jelas dan real-time.
                            Kami memastikan Anda mendapatkan pembaruan terkini, sehingga Anda dapat merencanakan lebih baik dan mengurangi kekhawatiran terkait pengiriman.
                        </p>
                    </div>
                </div>
            </div>

            <!-- Layanan -->
            <div class="col-md-6">
                <div class="card h-100 shadow-sm border-0 rounded-4">
                    <div class="card-body text-center">
                        <img src="{{ asset('icon/services.png') }}" alt="Layanan" class="mb-3" style="width: 80px;">
                        <h5 class="fw-bold text-success">Layanan Kami</h5>
                        <p class="text-muted">
                            Kami menawarkan layanan pelacakan untuk berbagai penyedia jasa pengiriman, termasuk JNE, JNT, Shopee Express, SiCepat, dan lainnya.
                            Cukup masukkan nomor resi untuk melacak paket Anda dengan mudah.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Kenapa Memilih Kami -->
    <div class="card shadow bg-white text-light rounded-4 mt-5 mx-4">
        <div class="container-fluid d-flex flex-column flex-md-row align-items-center justify-content-between py-5 px-4">
            <div class="text-center text-md-start w-100">
                <h2 class="fw-bold text-dark mb-3 text-center">Kenapa Memilih Kami?</h2>
                <ul class="list-unstyled fs-5 text-muted">
                    <li><strong class="text-success">Akurasi Tinggi:</strong> Sistem kami terintegrasi dengan penyedia jasa pengiriman untuk informasi akurat dan terkini.</li>
                    <li><strong class="text-success">Antarmuka Mudah:</strong> Desain intuitif memudahkan Anda melacak paket tanpa kesulitan.</li>
                    <li><strong class="text-success">Dukungan Pelanggan:</strong> Tim kami siap membantu dengan pertanyaan atau masalah selama proses pelacakan.</li>
                </ul>
            </div>
        </div>
    </div>

    <!-- Ajakan Bergabung -->
    <div class="text-center py-5 mt-3">
        <h2 class="fw-bold text-dark">Bergabunglah dengan Kami</h2>
        <p class="text-muted fs-5 mt-3">
            Ribuan pengguna telah mempercayakan pelacakan paket mereka kepada <span class="text-theme">Paket Kita</span>.
            Dengan kami, Anda tidak akan pernah kehilangan jejak paket Anda lagi!
        </p>

    </div>
@endsection
