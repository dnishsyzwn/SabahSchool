<x-mail::message>
# Pesanan Hubungi Kami Baru

Anda telah menerima pesanan baru melalui borang Hubungi Kami di laman web STU.

**Maklumat Pengirim:**
- **Nama:** {{ $contactMessage->name }}
- **Emel:** {{ $contactMessage->email }}
- **No. IC:** {{ $contactMessage->ic ?: 'Tiada' }}
- **No. Telefon:** {{ $contactMessage->phone ?: 'Tiada' }}
- **Sekolah/Organisasi:** {{ $contactMessage->school ?: 'Tiada' }}

**Mesej:**
{{ $contactMessage->message }}

{{-- Pautan admin disembunyikan jika menggunakan domain .test untuk mengelakkan ralat SPAM SMTP --}}
@if(!str_contains(config('app.url'), '.test'))
<x-mail::button :url="route('admin.contact-messages.show', $contactMessage->id)">
Lihat Mesej di Admin Panel
</x-mail::button>
@else
<p style="font-size: 11px; color: #666; font-style: italic;">
    Nota: Pautan Dashboard disembunyikan dalam mod percubaan (stu.test) untuk mengelakkan ralat sekatan SPAM oleh pembekal emel anda.
</p>
@endif

Terima kasih,<br>
Sistem {{ config('app.name') }}
</x-mail::message>
