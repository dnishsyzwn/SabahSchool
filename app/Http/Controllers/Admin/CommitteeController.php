<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CommitteeMember;
use App\Models\SiteSetting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CommitteeController extends Controller
{
    // ─── Row Config Helpers ───────────────────────────────────────────────────
    private function getRowConfigs(string $type): array
    {
        $key  = $type === 'TOP' ? 'committee_top_row_configs' : 'committee_exco_row_configs';
        $raw  = SiteSetting::get($key, '{}');
        $cfg  = json_decode($raw, true) ?? [];
        return empty($cfg) ? ['0' => ['cols' => ($type === 'TOP' ? 1 : 3)]] : $cfg;
    }

    private function setRowConfigs(string $type, array $configs): void
    {
        $key = $type === 'TOP' ? 'committee_top_row_configs' : 'committee_exco_row_configs';
        SiteSetting::set($key, json_encode($configs));
    }

    // ─── INDEX ────────────────────────────────────────────────────────────────
    public function index()
    {
        $topMembers  = CommitteeMember::where('type', 'TOP')
            ->orderBy('row_index')->orderBy('sort_order')->get()->groupBy('row_index');

        $excoMembers = CommitteeMember::where('type', 'EXCO')
            ->orderBy('row_index')->orderBy('sort_order')->get()->groupBy('row_index');

        $topRowConfigs  = $this->getRowConfigs('TOP');
        $excoRowConfigs = $this->getRowConfigs('EXCO');

        if (empty($topRowConfigs))  { $topRowConfigs  = ['0' => ['cols' => 1]]; $this->setRowConfigs('TOP', $topRowConfigs); }
        if (empty($excoRowConfigs)) { $excoRowConfigs = ['0' => ['cols' => 3]]; $this->setRowConfigs('EXCO', $excoRowConfigs); }

        return view('admin.committee.index', compact('topMembers', 'excoMembers', 'topRowConfigs', 'excoRowConfigs'));
    }

    // ─── STORE ────────────────────────────────────────────────────────────────
    public function store(Request $request)
    {
        $v = $request->validate([
            'name'         => 'required|string|max:255',
            'position'     => 'required|string|max:255',
            'image_path'   => 'nullable|image|max:4096',
            'type'         => 'required|in:TOP,EXCO',
            'division'     => 'nullable|string|max:255',
            'sort_order'   => 'nullable|integer',
            'row_index'    => 'nullable|integer|min:0',
            'is_active'    => 'nullable|boolean',
            'is_highlight' => 'nullable|boolean',
        ]);

        $v['is_active']    = $request->boolean('is_active', true);
        $v['is_highlight'] = $request->boolean('is_highlight', false);
        $v['row_index']    = (int) ($v['row_index'] ?? 0);
        
        $targetIndex = null;
        if (isset($v['sort_order']) && (int)$v['sort_order'] > 0) {
            $targetIndex = (int)$v['sort_order'] - 1; // 1-based to 0-based
        }

        if ($targetIndex !== null) {
            // Shift others down to make room
            CommitteeMember::where('type', $v['type'])
                ->where('row_index', $v['row_index'])
                ->where('sort_order', '>=', $targetIndex)
                ->increment('sort_order');
            $v['sort_order'] = $targetIndex;
        } else {
            // Auto-calculate: max + 1
            $v['sort_order'] = CommitteeMember::where('type', $v['type'])
                ->where('row_index', $v['row_index'])->max('sort_order') + 1;
        }
        
        $v['created_by']   = auth()->id();

        if ($request->hasFile('image_path')) {
            $v['image_path'] = $request->file('image_path')->store('committee', 'public');
        }

        $member = CommitteeMember::create($v);
        $this->reorderRow($member->type, $member->row_index);

        if ($request->wantsJson() || $request->ajax()) {
            return response()->json(['success' => true, 'message' => 'Ahli berjaya ditambah!', 'member' => $this->memberJson($member->fresh())]);
        }
        return redirect()->route('admin.committee.index')->with('success', 'Ahli berjaya ditambah!');
    }

    // ─── EDIT ─────────────────────────────────────────────────────────────────
    public function edit(CommitteeMember $committee)
    {
        if (request()->ajax() || request()->wantsJson()) {
            return response()->json($this->memberJson($committee));
        }
        return view('admin.committee.edit', ['member' => $committee]);
    }

    // ─── UPDATE ───────────────────────────────────────────────────────────────
    public function update(Request $request, CommitteeMember $committee)
    {
        $v = $request->validate([
            'name'         => 'required|string|max:255',
            'position'     => 'required|string|max:255',
            'image_path'   => 'nullable|image|max:4096',
            'type'         => 'required|in:TOP,EXCO',
            'division'     => 'nullable|string|max:255',
            'sort_order'   => 'nullable|integer',
            'row_index'    => 'nullable|integer|min:0',
            'is_active'    => 'nullable|boolean',
            'is_highlight' => 'nullable|boolean',
        ]);

        $v['is_active']    = $request->boolean('is_active', true);
        $v['is_highlight'] = $request->boolean('is_highlight', false);
        $v['row_index']    = (int) ($v['row_index'] ?? $committee->row_index);
        $v['updated_by']   = auth()->id();

        $targetIndex = null;
        if (isset($v['sort_order']) && (int)$v['sort_order'] > 0) {
            $targetIndex = (int)$v['sort_order'] - 1; 
        }

        if ($targetIndex !== null && $targetIndex !== $committee->sort_order) {
            // Shift others down to make room
            CommitteeMember::where('type', $v['type'])
                ->where('row_index', $v['row_index'])
                ->where('id', '!=', $committee->id)
                ->where('sort_order', '>=', $targetIndex)
                ->increment('sort_order');
            $v['sort_order'] = $targetIndex;
        }

        if ($request->hasFile('image_path')) {
            if ($committee->image_path) Storage::disk('public')->delete($committee->image_path);
            $v['image_path'] = $request->file('image_path')->store('committee', 'public');
        } else {
            unset($v['image_path']);
        }

        $committee->update($v);
        $this->reorderRow($committee->type, $committee->row_index);

        if ($request->wantsJson() || $request->ajax()) {
            return response()->json(['success' => true, 'message' => 'Ahli berjaya dikemaskini!', 'member' => $this->memberJson($committee->fresh())]);
        }
        return redirect()->route('admin.committee.index')->with('success', 'Ahli berjaya dikemaskini!');
    }

    // ─── DESTROY ──────────────────────────────────────────────────────────────
    public function destroy(CommitteeMember $committee)
    {
        if ($committee->image_path) Storage::disk('public')->delete($committee->image_path);
        $committee->delete();

        if (request()->wantsJson() || request()->ajax()) {
            return response()->json(['success' => true, 'message' => 'Ahli berjaya dipadam!']);
        }
        return redirect()->route('admin.committee.index')->with('success', 'Ahli berjaya dipadam!');
    }

    // ─── REORDER MEMBERS WITHIN ROW ───────────────────────────────────────────
    public function reorder(Request $request)
    {
        $request->validate(['items' => 'required|array', 'items.*.id' => 'required|integer', 'items.*.sort_order' => 'required|integer']);
        foreach ($request->items as $item) {
            CommitteeMember::where('id', $item['id'])->update(['sort_order' => $item['sort_order']]);
        }
        return response()->json(['success' => true]);
    }

    private function reorderRow(string $type, int $rowIndex): void
    {
        $members = CommitteeMember::where('type', $type)
            ->where('row_index', $rowIndex)
            ->orderBy('sort_order')
            ->get();

        foreach ($members as $i => $m) {
            CommitteeMember::where('id', $m->id)->update(['sort_order' => $i]);
        }
    }

    // ─── MOVE MEMBER BETWEEN ROWS ─────────────────────────────────────────────
    public function moveMember(Request $request)
    {
        $request->validate([
            'id' => 'required|integer',
            'row_index' => 'required|integer|min:0',
            'type' => 'nullable|in:TOP,EXCO'
        ]);
        
        $member = CommitteeMember::findOrFail($request->id);
        $newType = $request->type ?? $member->type;
        $newSortOrder = CommitteeMember::where('type', $newType)
            ->where('row_index', $request->row_index)
            ->max('sort_order') + 1;
            
        $member->update([
            'type' => $newType,
            'row_index' => $request->row_index,
            'sort_order' => $newSortOrder
        ]);

        $this->reorderRow($newType, (int)$request->row_index);
        
        return response()->json(['success' => true]);
    }

    // ─── ADD ROW ──────────────────────────────────────────────────────────────
    public function addRow(Request $request)
    {
        $request->validate(['type' => 'required|in:TOP,EXCO', 'cols' => 'required|integer|min:1|max:3']);
        $configs  = $this->getRowConfigs($request->type);
        $newIndex = empty($configs) ? 0 : (max(array_map('intval', array_keys($configs))) + 1);
        $configs[(string) $newIndex] = ['cols' => (int) $request->cols];
        $this->setRowConfigs($request->type, $configs);
        return response()->json(['success' => true, 'row_index' => $newIndex, 'message' => 'Baris baharu ditambah!']);
    }

    // ─── DELETE ROW ───────────────────────────────────────────────────────────
    public function deleteRow(Request $request)
    {
        $request->validate(['type' => 'required|in:TOP,EXCO', 'row_index' => 'required|integer|min:0']);
        $type     = $request->type;
        $rowIndex = (int) $request->row_index;

        CommitteeMember::where('type', $type)->where('row_index', $rowIndex)->update(['row_index' => 0]);

        $configs = $this->getRowConfigs($type);
        unset($configs[(string) $rowIndex]);
        if (empty($configs)) $configs = ['0' => ['cols' => 1]];
        $this->setRowConfigs($type, $configs);

        $this->reorderRow($type, 0);

        return response()->json(['success' => true, 'message' => 'Baris berjaya dipadam!']);
    }

    // ─── UPDATE ROW COLS ──────────────────────────────────────────────────────
    public function updateRowCols(Request $request)
    {
        $request->validate(['type' => 'required|in:TOP,EXCO', 'row_index' => 'required|integer|min:0', 'cols' => 'required|integer|min:1|max:3']);
        $configs = $this->getRowConfigs($request->type);
        $configs[(string) $request->row_index]['cols'] = (int) $request->cols;
        $this->setRowConfigs($request->type, $configs);
        return response()->json(['success' => true, 'message' => 'Tetapan disimpan!']);
    }

    // ─── JSON HELPER ──────────────────────────────────────────────────────────
    private function memberJson(CommitteeMember $m): array
    {
        return [
            'id'           => $m->id,
            'name'         => $m->name,
            'position'     => $m->position,
            'type'         => $m->type,
            'division'     => $m->division,
            'sort_order'   => $m->sort_order,
            'row_index'    => $m->row_index,
            'is_active'    => $m->is_active,
            'is_highlight' => (bool) $m->is_highlight,
            'image_url'    => $m->image_path ? Storage::url($m->image_path) : asset('images/lelaki-pending.png'),
        ];
    }

    public function create() { return view('admin.committee.create'); }
}
