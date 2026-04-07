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

<x-mail::button :url="route('admin.contact-messages.show', $contactMessage->id)">
Lihat Mesej di Admin Panel
</x-mail::button>

Terima kasih,<br>
Sistem {{ config('app.name') }}
</x-mail::message>
