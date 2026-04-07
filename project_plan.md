# 📋 STU Website — Project Plan & Checklist

## Phase 1 — Database ✅ DONE
- [x] Reka bentuk skema database (dbdiagram)
- [x] Cipta semua migration files (18 jadual)
- [x] Jalankan `migrate:fresh`

---

## Phase 2 — Models & Seeders ✅ DONE
- [x] Cipta Eloquent Models dengan relationships
  - [x] [User](file:///Volumes/Jimin/Document/freelance/stu/app/Models/User.php#12-51)
  - [x] [SiteSetting](file:///Volumes/Jimin/Document/freelance/stu/app/Models/SiteSetting.php#7-32)
  - [x] [ClaimSection](file:///Volumes/Jimin/Document/freelance/stu/app/Models/ClaimSection.php#7-17), [ClaimMedia](file:///Volumes/Jimin/Document/freelance/stu/app/Models/ClaimMedia.php#7-14)
  - [x] [CommitteeMember](file:///Volumes/Jimin/Document/freelance/stu/app/Models/CommitteeMember.php#7-19)
  - [x] [Activity](file:///Volumes/Jimin/Document/freelance/stu/app/Models/Activity.php#8-26), [ActivityImage](file:///Volumes/Jimin/Document/freelance/stu/app/Models/ActivityImage.php#7-13)
  - [x] [GalleryImage](file:///Volumes/Jimin/Document/freelance/stu/app/Models/GalleryImage.php#7-15)
  - [x] [NewsCategory](file:///Volumes/Jimin/Document/freelance/stu/app/Models/NewsCategory.php#8-16), [NewsPost](file:///Volumes/Jimin/Document/freelance/stu/app/Models/NewsPost.php#11-26), [NewsImage](file:///Volumes/Jimin/Document/freelance/stu/app/Models/NewsImage.php#7-13)
  - [x] [FormType](file:///Volumes/Jimin/Document/freelance/stu/app/Models/FormType.php#7-17), [FormSubmission](file:///Volumes/Jimin/Document/freelance/stu/app/Models/FormSubmission.php#7-23)
  - [x] [ContactMessage](file:///Volumes/Jimin/Document/freelance/stu/app/Models/ContactMessage.php#7-23)
  - [x] [Job](file:///Volumes/Jimin/Document/freelance/stu/app/Models/Job.php#8-23), [JobApplication](file:///Volumes/Jimin/Document/freelance/stu/app/Models/JobApplication.php#7-23), [JobAttachment](file:///Volumes/Jimin/Document/freelance/stu/app/Models/JobAttachment.php#7-13)
  - [x] [ActivityLog](file:///Volumes/Jimin/Document/freelance/stu/app/Models/ActivityLog.php#7-35), `Notification`
- [x] Cipta Seeder — superadmin pertama (`superadmin@stu.my` / `Admin@1234`)
- [x] Cipta Seeder — admin (`admin@stu.my` / `Admin@1234`)

---

## Phase 3 — Admin Authentication ✅ DONE
- [x] Setup Laravel Auth (login/logout untuk admin sahaja)
- [x] Middleware [AdminMiddleware](file:///Volumes/Jimin/Document/freelance/stu/app/Http/Middleware/AdminMiddleware.php#10-35) — redirect jika bukan admin
- [x] Middleware [RoleMiddleware](file:///Volumes/Jimin/Document/freelance/stu/app/Http/Middleware/RoleMiddleware.php#10-38) — kawalan akses berdasarkan role
- [x] Halaman Login Admin (`/admin/login`)
- [x] Redirect ke dashboard selepas login

---

## Phase 4 — Admin Panel

### Dashboard ✅ DONE
- [x] Halaman Dashboard (`/admin/dashboard`)
  - [x] Kiraan mesej hubungi belum baca
  - [x] Kiraan penyertaan borang pending
  - [x] Kiraan permohonan kerja baru
  - [x] Artikel berita terbaru

### Berita
- [x] Senarai artikel (`/admin/news`)
- [x] Tambah artikel baru
- [x] Edit & padam artikel
- [x] Upload gambar artikel
- [x] Publish / archive artikel

### AJK (Ahli Jawatankuasa) ✅ DONE
- [x] Senarai ahli (`/admin/committee`)
- [x] Tambah, edit, padam ahli
- [x] Upload gambar ahli
- [x] Susun susunan (sort order)

### Aktiviti
- [x] Senarai aktiviti (`/admin/activities`)
- [x] Tambah, edit, padam aktiviti
- [x] Upload gambar aktiviti
- [x] Publish / archive aktiviti

### Bukti Tuntutan
- [ ] Urus bahagian & media (`/admin/claims`)
- [ ] Upload gambar / PDF / video
- [ ] Susun susunan kandungan

### Borang
- [x] Senarai jenis borang (`/admin/forms`)
- [x] Upload fail borang (PDF)
- [x] Senarai penyertaan (`/admin/form-submissions`)
- [x] Tukar status penyertaan
- [x] Catat nota admin

### Hubungi
- [x] Senarai mesej (`/admin/contacts`)
- [x] Tandai baca / belum baca
- [x] Dashboard tunjuk kiraan belum baca

### Kerjaya
- [x] Senarai jawatan kosong (`/admin/jobs`)
- [x] Tambah, edit, padam jawatan
- [x] Senarai permohonan (`/admin/job-applications`)
- [x] Tukar status permohonan
- [x] Muat turun lampiran permohonan

### Tetapan Tapak
- [ ] Edit kandungan global (`/admin/settings`)
  - [ ] Teks & gambar hero
  - [ ] Maklumat footer
  - [ ] Emel & nombor telefon

### Pengurusan Pengguna *(Superadmin sahaja)*
- [ ] Senarai admin (`/admin/users`)
- [ ] Tambah, edit, disable akaun admin
- [ ] Tetapkan role

### Audit Log *(Superadmin sahaja)*
- [ ] Lihat log aktiviti (`/admin/logs`)

---

## Phase 5 — Public Forms (Tanpa Login)
- [ ] Halaman Hubungi — simpan ke DB + email admin
- [ ] Halaman Hantar Borang — simpan ke DB + email admin
- [ ] Halaman Permohonan Kerja — simpan ke DB + email admin

---

## Phase 6 — Email Notifikasi
- [ ] Setup mailer (SMTP)
- [ ] Hantar email kepada admin bila ada mesej hubungi baru
- [ ] Hantar email kepada admin bila ada penyertaan borang baru
- [ ] Hantar email kepada admin bila ada permohonan kerja baru
- [ ] Queue untuk hantar email (supaya tidak slow)

---

## Phase 7 — File Uploads & Storage
- [ ] Setup `storage:link`
- [ ] Config disk untuk gambar, PDF
- [ ] Validasi saiz & jenis fail
- [ ] Padam fail lama bila dikemaskini

---

## Phase 8 — Polish & Security
- [ ] Rate limiting untuk public forms (anti-spam)
- [ ] CSRF protection (Laravel default)
- [ ] Audit log auto-record setiap aksi admin
- [ ] Pagination untuk semua senarai dalam admin
- [ ] Responsive admin panel (mobile-friendly)
- [ ] Test semua aliran awam & admin
