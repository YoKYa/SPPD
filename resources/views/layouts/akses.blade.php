<div class="tab-content bg-light rounded-lg shadow p-4" id="v-pills-tabContent" @if ($role == 'Admin') hidden @endif>
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="text-center">
                <h5>Maaf Anda Tidak Punya akses untuk halaman ini <br>
                <a href="{{ Route('Dashboard') }}">Klik Disini</a> <br>
                Untuk Kembali</h5>
            </div>
        </div>
    </div>
</div>