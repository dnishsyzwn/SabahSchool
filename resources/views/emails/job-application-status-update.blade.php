@component('mail::message')
# Status Permohonan Kerjaya Anda

Salam sejahtera **{{ $application->name }}**,

Kami ingin memaklumkan bahawa permohonan anda untuk jawatan **"{{ $application->job ? $application->job->title : 'Permohonan Umum' }}"** telah selesai disemak.

## Keputusan:
@if($application->status === 'approved')
<div style="padding: 20px; background-color: #f0fdf4; border: 1px solid #16a34a; border-radius: 12px; color: #166534; font-weight: 800; text-align: center; text-transform: uppercase; letter-spacing: 0.1em;">
    DITERIMA / TEMUDUGA
</div>

Sila tunggu maklum balas seterusnya daripada pihak kami untuk proses temuduga atau langkah selanjutnya.
@else
<div style="padding: 20px; background-color: #fef2f2; border: 1px solid #dc2626; border-radius: 12px; color: #991b1b; font-weight: 800; text-align: center; text-transform: uppercase; letter-spacing: 0.1em;">
    TIDAK BERJAYA / DITOLAK
</div>

Dukacita dimaklumkan bahawa permohonan anda tidak berjaya buat masa ini. Kami menghargai minat anda terhadap Sabah Teachers Union.
@endif

@if($application->admin_notes)
### Nota Pentadbir:
> {{ $application->admin_notes }}
@endif

Terima kasih.

Salam Hormat,<br>
**Unit Sumber Manusia Sabah Teachers Union (STU)**
@endcomponent
