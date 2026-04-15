<x-mail::message>
# Sahkan Alamat Emel Baru

Hai,

Kami telah menerima permintaan untuk menukar alamat emel akaun anda kepada **{{ $newEmail }}**.

Sila klik butang di bawah untuk mengesahkan pertukaran ini. Pautan ini akan tamat tempoh dalam masa 60 minit.

<x-mail::button :url="$url">
Sahkan Perubahan Emel
</x-mail::button>

Jika anda tidak membuat permintaan ini, tiada tindakan lanjut diperlukan. Alamat emel anda akan kekal seperti sedia kala.

Terima kasih,<br>
{{ config('app.name') }}
</x-mail::message>
