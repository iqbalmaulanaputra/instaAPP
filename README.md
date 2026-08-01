# InstaApp

Aplikasi berbagi foto ala Instagram, dibangun pakai Laravel (Blade + vanilla JS via Vite) dan Tailwind CSS.

## Fitur

- **Autentikasi**: daftar akun, masuk (via username atau email), keluar. Validasi perfield terpisah (bukan pesan gabung), selalu mengembalikan JSON untuk kebutuhan AJAX.
- **Profil**: edit nama/username/email/bio/foto profil, ganti kata sandi, wajib login buat akses halaman `/profile`.
- **Postingan**: unggah foto + caption, like, simpan (save/bookmark), lihat detail di modal gambar besar. Grid postingan di profil menampilkan jumlah suka & komentar saat kursor diarahkan ke gambar (hover overlay), sama seperti di halaman Jelajah.
- **Komentar**: komentar di post, balas langsung di thread yang sama, muncul real-time tanpa reload.
- **Follow**: ikuti/berhenti ikuti user lain, daftar saran pengguna otomatis (yang belum diikuti). Angka Pengikut/Mengikuti di profil bisa diklik untuk membuka daftar orangnya (dengan tombol follow/unfollow langsung dari situ). Follow/unfollow dari mana pun (Saran Pengguna, tab Pengikut, tab Mengikuti) langsung tersinkron ke seluruh tampilan (angka & daftar) tanpa reload halaman.
- **Stories**: unggah story (foto), otomatis hilang setelah 24 jam, viewer full-screen dengan progress bar ala Instagram, tracking siapa yang sudah melihat.
- **Jelajah (Explore)**: pencarian teks (caption & username), filter tag cepat, grid postingan dengan hover overlay jumlah suka/komentar. Bisa diakses tanpa login; aksi like/save/comment tetap terkunci untuk tamu.
- **Notifikasi**: toast sukses/gagal pakai SweetAlert2, dipicu lewat session flash message.

## Tech Stack

| Layer | Teknologi |
|---|---|
| Backend | Laravel |
| Frontend | Blade Components + Tailwind CSS |
| Interaktivitas | Vanilla JavaScript (via Vite), fetch API |
| Toast/Alert | SweetAlert2 |
| Ikon | Boxicons |
| Database | MySQL |
| Storage | Laravel Filesystem (disk `public`) |

## Instalasi

1. Clone project dan masuk ke foldernya:
   ```bash
   git clone <url-repo>
   cd instaapp
   ```

2. Install dependency PHP:
   ```bash
   composer install
   ```

3. Install dependency JavaScript:
   ```bash
   npm install
   ```

4. Salin file environment dan generate app key:
   ```bash
   cp .env.example .env
   php artisan key:generate
   ```

5. Buat database MySQL baru, lalu sesuaikan kredensialnya di `.env`:
   ```env
   DB_CONNECTION=mysql
   DB_HOST=127.0.0.1
   DB_PORT=3306
   DB_DATABASE=instaApp
   DB_USERNAME=root
   DB_PASSWORD=
   ```

6. Jalankan migrasi:
   ```bash
   php artisan migrate
   ```

7. Buat symbolic link storage (wajib, biar foto post/avatar/story bisa diakses via browser):
   ```bash
   php artisan storage:link
   ```

8. Jalankan build asset:
   ```bash
   npm run build
   ```
   Atau untuk mode development dengan hot reload:
   ```bash
   npm run dev
   ```

9. Jalankan server Laravel:
   ```bash
   php artisan serve
   ```

10. Aktifkan scheduler (dibutuhkan untuk fitur cleanup file story kedaluwarsa):
    ```bash
    php artisan schedule:work
    ```
    Biarkan perintah ini berjalan di terminal terpisah selama development. Story otomatis hilang dari tampilan setelah 24 jam walau tanpa ini — perintah ini hanya membersihkan file gambar di storage yang sudah tidak terpakai. Untuk production, jadwalkan `php artisan schedule:run` lewat cron sesuai konfigurasi server kamu.

Aplikasi bisa diakses di `http://localhost:8000` (atau sesuai port `php artisan serve`).

## Struktur Fitur Utama

```
app/
├── Http/
│   ├── Controllers/       # AuthController, PostController, LikeController,
│   │                       CommentController, SaveController, FollowController,
│   │                       StoryController, ProfileController, ExploreController
│   ├── Requests/           # Validasi form, semua extends App\Http\Requests\FormRequest
│   │                       (selalu balikin JSON, bukan redirect, untuk kebutuhan AJAX)
│   └── Middleware/
│       └── Authenticate.php  # Override redirect target untuk guest yang belum login
├── Models/                # User, Post, Like, Comment, Save, Follow, Story, StoryView
├── View/
│   └── Composers/          # StoriesComposer, SuggestionsComposer
└── Console/
    └── Commands/
        └── PruneExpiredStories.php

resources/
├── js/                     # Modul per-fitur: auth, profile, like, save, comment,
│                             follow, createPost, createStory, storyViewer, dropdown, logout
└── views/
    ├── components/
    │   ├── layout/          # sidebar, mobile-topbar, mobile-bottom-nav
    │   ├── modal/            # auth, settings, create-post, create-story, story-viewer,
    │   │                      follow-list
    │   ├── nav/               # nav-link, user-menu
    │   └── post/               # post-card, post-detail-modal, stories
    ├── profile/
    │   └── index.blade.php    # withCount likes/comments, hover overlay di grid
    ├── explore/
    │   └── index.blade.php    # pencarian teks + filter tag + hover overlay di grid
    └── layouts/
        └── app.blade.php
```

## Catatan Pengembangan

- Semua request AJAX dikirim lewat helper `window.api` (`get`/`post`/`put`/`delete`) di `resources/js/app.js`, yang otomatis menyertakan CSRF token dan header `X-Requested-With`.
- Validasi form custom (`App\Http\Requests\FormRequest`) di-override supaya **selalu** mengembalikan JSON — baik saat validasi gagal (422) maupun otorisasi gagal (403) — karena semua form di app ini dikirim via fetch, bukan submit HTML biasa.
- Guard `requireAuth()` di sisi client mencegah aksi seperti like/comment/save/follow/story dari user yang belum login, sebelum request dikirim ke server.
- Fitur "reply komentar" saat ini flat (satu thread per post), belum ada nested reply per-komentar spesifik.
- Follow/unfollow tersinkron di sisi client: daftar Pengikut/Mengikuti dan angkanya di halaman profil ter-update otomatis begitu ada aksi follow/unfollow, baik dari Saran Pengguna maupun dari modal daftar koneksi tanpa reload. Sinkronisasi ini hanya untuk aksi milik user yang sedang login (bukan realtime lintas-user; melihat orang lain follow anda tetap butuh refresh, karena belum ada broadcasting/WebSocket).
- Filter tag di halaman Jelajah adalah shortcut pencarian teks ke kolom caption/username bukan sistem hashtag/lokasi sungguhan (belum ada kolom terpisah untuk itu di database).