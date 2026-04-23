@extends('admin.layouts.app')

@section('title', 'Permohonan Kerjaya')
@section('header', 'Permohonan Kerjaya')

@section('content')
<div class="flex flex-col h-full">
    {{-- Filter Bar --}}
    <div class="mb-8 p-6 bg-white rounded-2xl shadow-sm border border-gray-100 flex flex-col lg:flex-row items-center gap-6">
        <div class="flex-1 w-full">
            <h2 class="text-sm font-black text-gray-800 uppercase tracking-widest mb-1">Permohonan Masuk</h2>
            <p class="text-[10px] text-gray-400 font-medium">Seret dan lepas untuk mengemaskini status permohonan</p>
        </div>

        <div class="flex flex-col sm:flex-row flex-[2] gap-3 w-full">
            <div class="relative flex-1 group">
                <input type="text" id="search-input" placeholder="Cari nama pemohon atau jawatan..."
                       class="w-full pl-10 pr-4 py-2.5 text-sm border border-gray-100 bg-white rounded-xl focus:ring-4 focus:ring-blue-500/5 focus:border-blue-500 outline-none transition-all duration-300">
                <svg class="absolute left-3.5 top-3 w-4 h-4 text-gray-300 group-focus-within:text-blue-500 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
            </div>
        </div>
    </div>

    {{-- Kanban Board --}}
    <div class="flex flex-col lg:flex-row gap-6 items-start">
        @php
            $columns = [
                'pending' => [
                    'label' => 'Menunggu',
                    'color' => 'yellow',
                    'icon' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />'
                ],
                'reviewed' => [
                    'label' => 'Disemak',
                    'color' => 'blue',
                    'icon' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />'
                ],
                'selesai_group' => [
                    'label' => 'Selesai',
                    'color' => 'green',
                    'icon' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />'
                ],
            ];
        @endphp

        @foreach($columns as $status => $config)
        <div class="flex-1 w-full min-w-[320px] bg-gray-100/50 rounded-2xl p-4 border border-gray-200/50 flex flex-col min-h-[600px]">
            <div class="flex items-center justify-between mb-4 px-2">
                <div class="flex items-center gap-2">
                    <div class="w-8 h-8 rounded-lg bg-{{ $config['color'] }}-100 text-{{ $config['color'] }}-600 flex items-center justify-center border border-{{ $config['color'] }}-200 shadow-sm">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            {!! $config['icon'] !!}
                        </svg>
                    </div>
                    <h3 class="font-black text-xs text-gray-800 uppercase tracking-widest">{{ $config['label'] }}</h3>
                    <span class="px-2 py-0.5 rounded-full bg-white text-[10px] font-bold text-gray-400 border border-gray-200 ml-1 column-count">
                        {{ isset($applications[$status]) ? $applications[$status]->count() : 0 }}
                    </span>
                </div>
            </div>

            <div id="column-{{ $status }}" data-status="{{ $status }}" class="kanban-column flex-1 space-y-3 min-h-[100px]">
                @if(isset($applications[$status]))
                    @foreach($applications[$status] as $app)
                        <div data-id="{{ $app->id }}" 
                             data-search="{{ strtolower($app->name . ' ' . ($app->job ? $app->job->title : 'Umum')) }}"
                             class="kanban-card bg-white p-4 rounded-xl shadow-sm border border-gray-100 cursor-grab active:cursor-grabbing hover:shadow-md hover:border-{{ $config['color'] }}-200 transition group relative">
                            
                            <div class="flex justify-between items-start mb-2">
                                <span class="text-[10px] font-black text-gray-400 uppercase tracking-tighter">{{ $app->job ? $app->job->title : 'Permohonan Umum' }}</span>
                                <div class="opacity-0 group-hover:opacity-100 transition flex gap-3">
                                    <a href="{{ route('admin.kerjaya.show', $app->id) }}" class="p-3 text-gray-400 hover:text-blue-600 bg-gray-50 rounded-xl transition hover:bg-blue-50">
                                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" /><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" /></svg>
                                    </a>
                                    <button onclick="confirmDelete({{ $app->id }}, '{{ addslashes($app->name) }}')" class="p-3 text-gray-400 hover:text-red-600 bg-gray-50 rounded-xl transition hover:bg-red-50">
                                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-4v6m1-10V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4-6h4"/></svg>
                                    </button>
                                </div>
                            </div>

                            <div>
                                <h4 class="font-bold text-gray-800 text-sm leading-tight group-hover:text-{{ $config['color'] }}-600 transition">{{ $app->name }}</h4>
                                <p class="text-[10px] text-gray-400 mt-1 font-medium">{{ $app->email }}</p>
                            </div>

                            <div class="mt-3 flex items-center justify-between border-t border-gray-50 pt-3">
                                <div class="flex flex-col gap-1">
                                    <span class="text-[10px] text-gray-400 font-medium">{{ $app->created_at->format('d M Y') }}</span>
                                    
                                    {{-- Status Badge (Only for Selesai Column) --}}
                                    @if($status === 'selesai_group')
                                        @if($app->status === 'approved')
                                            <span class="status-badge inline-flex items-center px-2 py-0.5 rounded text-[8px] font-black uppercase tracking-widest bg-green-100 text-green-600 border border-green-200">Diterima</span>
                                        @else
                                            <span class="status-badge inline-flex items-center px-2 py-0.5 rounded text-[8px] font-black uppercase tracking-widest bg-red-100 text-red-600 border border-red-200">Ditolak</span>
                                        @endif
                                    @endif
                                </div>
                                <div class="flex -space-x-1">
                                    <div class="w-5 h-5 rounded-full bg-{{ $config['color'] }}-50 border border-white flex items-center justify-center text-[10px] text-{{ $config['color'] }}-600 font-bold">
                                        {{ substr($app->name, 0, 1) }}
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @endif

                {{-- Empty State for Column --}}
                @if(!isset($applications[$status]) || $applications[$status]->isEmpty())
                    <div class="empty-placeholder py-8 border-2 border-dashed border-gray-200 rounded-xl flex flex-col items-center justify-center opacity-40">
                        <svg class="w-8 h-8 text-gray-300 mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/></svg>
                        <span class="text-[10px] font-black uppercase tracking-widest text-gray-400">Kosong</span>
                    </div>
                @endif
            </div>
        </div>
        @endforeach
    </div>
</div>

@push('styles')
<style>
    .kanban-column.sortable-ghost {
        background-color: rgba(239, 246, 255, 0.5);
        border: 2px dashed #bfdbfe;
        border-radius: 0.75rem;
    }
    .kanban-card.sortable-ghost {
        opacity: 0.1;
        transform: scale(0.95);
    }
    .kanban-card.sortable-drag {
        box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.25);
        outline: 4px solid rgba(59, 130, 246, 0.1);
        transform: rotate(2deg);
    }
</style>
@endpush

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://cdn.jsdelivr.net/npm/sortablejs@1.15.0/Sortable.min.js"></script>
<script>
    // Initialize Sortable for each column
    document.querySelectorAll('.kanban-column').forEach(column => {
        new Sortable(column, {
            group: 'kanban',
            animation: 150,
            ghostClass: 'sortable-ghost',
            dragClass: 'sortable-drag',
            onMove: function (evt) {
                const statusOrder = {
                    'pending': 1,
                    'reviewed': 2,
                    'selesai_group': 3
                };
                const fromStatus = evt.from.getAttribute('data-status');
                const toStatus = evt.to.getAttribute('data-status');
                
                // Block moving backwards
                if (statusOrder[toStatus] < statusOrder[fromStatus]) {
                    return false;
                }
            },
            onEnd: function (evt) {
                const itemEl = evt.item;
                const newStatus = evt.to.getAttribute('data-status');
                const oldStatus = evt.from.getAttribute('data-status');
                const applicationId = itemEl.getAttribute('data-id');

                if (newStatus !== oldStatus) {
                    if (newStatus === 'selesai_group') {
                        promptLulusTolak(applicationId, itemEl, evt.from);
                    } else {
                        updateApplicationStatus(applicationId, newStatus, itemEl);
                        updateCounters();
                    }
                }
            }
        });
    });

    function promptLulusTolak(id, element, fromColumn) {
        Swal.fire({
            title: 'Keputusan Permohonan',
            text: "Adakah permohonan ini diterima atau ditolak?",
            icon: 'question',
            showDenyButton: true,
            showCancelButton: true,
            confirmButtonText: 'Terima',
            denyButtonText: `Tolak`,
            cancelButtonText: 'Batal',
            confirmButtonColor: '#10b981',
            denyButtonColor: '#ef4444',
            customClass: {
                popup: 'rounded-2xl shadow-2xl',
                confirmButton: 'rounded-lg px-6 py-2.5 text-xs uppercase font-black tracking-widest',
                denyButton: 'rounded-lg px-6 py-2.5 text-xs uppercase font-black tracking-widest',
                cancelButton: 'rounded-lg px-6 py-2.5 text-xs uppercase font-black tracking-widest'
            }
        }).then((result) => {
            if (result.isConfirmed) {
                updateApplicationStatus(id, 'approved', element);
            } else if (result.isDenied) {
                updateApplicationStatus(id, 'rejected', element);
            } else {
                fromColumn.appendChild(element);
                updateCounters();
            }
        });
    }

    async function updateApplicationStatus(id, status, element) {
        try {
            const response = await fetch(`/admin/kerjaya/${id}/status`, {
                method: 'PATCH',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                    'X-Requested-With': 'XMLHttpRequest'
                },
                body: JSON.stringify({ status: status })
            });

            const data = await response.json();
            
            if (data.success) {
                const badgeContainer = element.querySelector('.flex-col.gap-1');
                let existingBadge = badgeContainer.querySelector('.status-badge');
                if (status === 'approved' || status === 'rejected') {
                    if (!existingBadge) {
                        existingBadge = document.createElement('span');
                        badgeContainer.appendChild(existingBadge);
                    }
                    existingBadge.className = `status-badge inline-flex items-center px-2 py-0.5 rounded text-[8px] font-black uppercase tracking-widest ${status === 'approved' ? 'bg-green-100 text-green-600 border border-green-200' : 'bg-red-100 text-red-600 border border-red-200'}`;
                    existingBadge.innerText = status === 'approved' ? 'Diterima' : 'Ditolak';
                } else if (existingBadge) {
                    existingBadge.remove();
                }

                const Toast = Swal.mixin({
                    toast: true,
                    position: 'top-end',
                    showConfirmButton: false,
                    timer: 3000,
                    timerProgressBar: true,
                });
                Toast.fire({
                    icon: 'success',
                    title: 'Status dikemaskini'
                });
                updateCounters();
            }
        } catch (error) {
            console.error('Error:', error);
            Swal.fire('Ralat', 'Gagal mengemaskini status.', 'error');
            window.location.reload();
        }
    }

    function updateCounters() {
        document.querySelectorAll('.kanban-column').forEach(column => {
            const count = column.querySelectorAll('.kanban-card').length;
            const counter = column.closest('.flex-1').querySelector('.column-count');
            if (counter) counter.innerText = count;

            const emptyPlaceholder = column.querySelector('.empty-placeholder');
            if (count > 0 && emptyPlaceholder) {
                emptyPlaceholder.style.display = 'none';
            } else if (count === 0 && emptyPlaceholder) {
                emptyPlaceholder.style.display = 'flex';
            }
        });
    }

    function confirmDelete(id, name) {
        Swal.fire({
            title: 'Padam Permohonan?',
            html: `Adakah anda pasti ingin memadam permohonan daripada <strong>"${name}"</strong>?`,
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#ef4444',
            confirmButtonText: 'Ya, Padam!',
            cancelButtonText: 'Batal',
            reverseButtons: true,
            customClass: {
                popup: 'rounded-2xl shadow-2xl',
                confirmButton: 'rounded-lg px-6 py-2.5 text-xs uppercase font-black tracking-widest',
                cancelButton: 'rounded-lg px-6 py-2.5 text-xs uppercase font-black tracking-widest'
            }
        }).then((result) => {
            if (result.isConfirmed) {
                const form = document.createElement('form');
                form.method = 'POST';
                form.action = `/admin/kerjaya/${id}`;
                form.innerHTML = `@csrf @method('DELETE')`;
                document.body.appendChild(form);
                form.submit();
            }
        });
    }

    document.getElementById('search-input').addEventListener('input', function(e) {
        const term = e.target.value.toLowerCase();
        document.querySelectorAll('.kanban-card').forEach(card => {
            const isVisible = card.getAttribute('data-search').includes(term);
            card.style.display = isVisible ? '' : 'none';
        });
        updateCounters();
    });

    updateCounters();
</script>
@endpush
@endsection
