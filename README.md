# 📨 Aplikasi SPPD – Sistem Surat Perintah Perjalanan Dinas

Aplikasi **SPPD (Surat Perintah Perjalanan Dinas)** adalah sistem berbasis web untuk mempermudah pengelolaan SPPD pada instansi pemerintahan. Sistem ini mendukung proses pembuatan surat perjalanan dinas mulai dari penginputan data pegawai, pembuatan SPT/SPPD, manajemen approval berdasarkan jabatan, hingga pencetakan surat final.

---

## ✅ Fitur Utama

### 👤 Manajemen Role & User
| Role | Akses |
|------|------|
| Admin | Pengelolaan sistem penuh (user, pegawai, SPPD, pengaturan instansi) |
| Kepala Bidang | Melihat & menyetujui SPPD pada bidangnya |
| Kepala Seksi | Monitoring SPPD |
| Staff / Pegawai | Melihat SPPD pribadi, data profil |

---

### 📌 Fungsi Sistem
- Login dengan **Nama atau NIP** (autocomplete)
- Manajemen data pegawai
- Input & pembuatan **SPT / SPPD**
- Daftar SPPD berdasarkan user / jabatan
- Export / cetak dokumen SPPD siap pakai
- Menu **Pengaturan Instansi** untuk:
  - Nomor surat
  - Tahun surat
  - SKPD / Bidang
  - Program & Kegiatan
  - Rekening
  - Dasar SPPD

---

## 🖥️ Dashboard Dinamis
Dashboard setiap role berbeda sesuai hak akses:
- Statistik total pegawai
- SPPD berjalan
- Jumlah data berdasarkan jabatan

---

## 🛠️ Teknologi
| Komponen | Teknologi |
|----------|-----------|
| Framework Backend | Laravel |
| UI/Frontend | Blade + Bootstrap |
| Database | MySQL / MariaDB |

---

## 🚀 Instalasi

```bash
# Clone repo
git clone https://github.com/YoKYa/SPPD.git
cd SPPD

# Install dependency
composer install

# Copy environment
cp .env.example .env

# Generate key
php artisan key:generate

# Setting database pada .env kemudian jalankan migrate
php artisan migrate --seed

# Jalankan aplikasi
php artisan serve
```

Buka pada browser:
```
http://localhost:8000
```

---

## 🔑 Akun Login (Seeder)

| Role | NIP Contoh |
|------|-----------|
| Admin | 1000000000 |
| Kepala Bidang | 2000000000 |
| Kepala Seksi | 3000000000 |
| Staff | 4000000000 |

> Saat login cukup ketik Nama / NIP, sistem otomatis menampilkan pilihan.

---

## 📄 Lisensi
Aplikasi ini bersifat open source dan dapat digunakan atau dikembangkan untuk kebutuhan instansi.

---

Jika aplikasi ini bermanfaat, jangan lupa ⭐ repository ini di GitHub!
