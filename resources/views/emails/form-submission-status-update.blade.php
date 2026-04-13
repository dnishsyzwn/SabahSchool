@component('mail::message')
# Status Borang Anda Telah Dikemaskini

Salam sejahtera **{{ $submission->name }}**,

Borang anda yang bertajuk **"{{ $submission->subject }}"** telah selesai disemak oleh pihak pentadbir Sabah Teachers Union (STU).

## Keputusan:
@if($submission->status === 'approved')
<div style="padding: 20px; background-color: #f0fdf4; border: 1px solid #16a34a; border-radius: 12px; color: #166534; font-weight: 800; text-align: center; text-transform: uppercase; letter-spacing: 0.1em;">
    LULUS / SELESAI
</div>
@else
<div style="padding: 20px; background-color: #fef2f2; border: 1px solid #dc2626; border-radius: 12px; color: #991b1b; font-weight: 800; text-align: center; text-transform: uppercase; letter-spacing: 0.1em;">
    DITOLAK
</div>
@endif

@if($submission->admin_notes)
### Nota Pentadbir:
> {{ $submission->admin_notes }}
@endif

Terima kasih kerana berurusan dengan kami.

Salam Hormat,<br>
**Pentadbir Sabah Teachers Union (STU)**
@endcomponent
