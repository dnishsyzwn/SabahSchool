<x-mail::message>
# Permohonan Kerjaya Baru

Anda telah menerima permohonan kerjaya baru melalui laman web STU.

**Maklumat Pemohon:**
- **Nama:** {{ $application->name }}
- **Alamat:** {{ $application->alamat ?: 'Tiada' }}
- **Emel:** {{ $application->email }}
- **No. Telefon:** {{ $application->phone }}
- **Jawatan:** {{ $application->job ? $application->job->title : 'Permohonan Umum' }}

**Mesej/Nota Tambahan:**
{{ $application->message ?: 'Tiada' }}

@if($application->resume_path)
Resume pemohon telah dilampirkan bersama emel ini.
@endif

<x-mail::button :url="url('/admin/kerjaya/' . $application->id)">
Lihat Permohonan di Admin Panel
</x-mail::button>

Terima kasih,<br>
Sistem {{ config('app.name') }}
</x-mail::message>
