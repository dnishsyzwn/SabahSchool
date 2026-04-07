<?php

namespace App\Http\Controllers;

use App\Models\CommitteeMember;
use App\Models\SiteSetting;
use Illuminate\Http\Request;

class CommitteePublicController extends Controller
{
    private function getRowConfigs(string $type): array
    {
        $key  = $type === 'TOP' ? 'committee_top_row_configs' : 'committee_exco_row_configs';
        $json = SiteSetting::get($key, '{}');
        $cfg  = json_decode($json, true) ?? [];
        return empty($cfg) ? ['0' => ['cols' => ($type === 'TOP' ? 1 : 3)]] : $cfg;
    }

    public function index()
    {
        $topRows  = CommitteeMember::where('type', 'TOP')->where('is_active', true)
            ->orderBy('row_index')->orderBy('sort_order')->get()->groupBy('row_index');

        $excoRows = CommitteeMember::where('type', 'EXCO')->where('is_active', true)
            ->orderBy('row_index')->orderBy('sort_order')->get()->groupBy('row_index');

        $topRowConfigs  = $this->getRowConfigs('TOP');
        $excoRowConfigs = $this->getRowConfigs('EXCO');

        return view('pages.ahli-tertinggi-exco', compact('topRows', 'excoRows', 'topRowConfigs', 'excoRowConfigs'));
    }
}
