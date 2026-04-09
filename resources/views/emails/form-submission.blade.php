<x-mail::message>
# Penghantaran Borang Baru

Anda telah menerima penghantaran borang baru melalui laman web STU.

**Maklumat Pengirim:**
- **Nama/Emel:** {{ $submission->name }}
- **Emel:** {{ $submission->email }}
- **Jenis Borang:** {{ $submission->formType ? $submission->formType->name : 'N/A' }}
- **Subjek:** {{ $submission->subject }}

**Mesej/Nota Tambahan:**
{{ $submission->message ?: 'Tiada' }}

@if($submission->file_path)
Dokumen borang telah dilampirkan bersama emel ini.
@endif

<x-mail::button :url="url('/admin/borang-pintar/' . $submission->id)">
Lihat di Admin Panel
</x-mail::button>

Terima kasih,<br>
Sistem {{ config('app.name') }}
</x-mail::message>
