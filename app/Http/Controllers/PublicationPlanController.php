<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Publication;
use App\Models\PublicationPlan;
use App\Models\PublicationFinal;

class PublicationPlanController extends Controller
{
    public function store(Request $request, Publication $publication)
    {
        $request->validate([
            'plan_name' => 'required|string|max:255',
            'plan_date' => 'nullable|date',
            'plan_desc' => 'nullable|string',
            'plan_file' => 'nullable|file|mimes:pdf,xlsx,xls,docx,doc|max:10240',
        ]);

        $data = $request->only(['plan_name', 'plan_date', 'plan_desc']);
        $data['publication_id'] = $publication->publication_id;

        if ($request->hasFile('plan_file')) {
            $data['plan_file'] = $request->file('plan_file')
                ->store('publication_plans', 'public');
        }

        PublicationPlan::create($data);

        return redirect()->back()->with('success', 'Rencana publikasi berhasil ditambahkan!');
    }

    public function updatePlan(Request $request, PublicationPlan $plan)
    {
        $request->validate([
            'plan_name' => 'required|string|max:255',
            'plan_date' => 'nullable|date',
            'plan_desc' => 'nullable|string',
            'plan_file' => 'nullable|file|mimes:pdf,xlsx,xls,docx,doc|max:10240',
        ]);

        $data = $request->only(['plan_name', 'plan_date', 'plan_desc']);

        if ($request->hasFile('plan_file')) {
            if ($plan->plan_file) {
                \Storage::disk('public')->delete($plan->plan_file);
            }
            $data['plan_file'] = $request->file('plan_file')
                ->store('publication_plans', 'public');
        }

        $plan->update($data);

        return redirect()->back()->with('success', 'Rencana publikasi berhasil diperbarui!');
    }

    public function updateFinal(Request $request, PublicationPlan $plan)
    {
        $request->validate([
            'actual_date' => 'required|date',
            'final_desc' => 'nullable|string',
            'final_file' => 'nullable|file|mimes:pdf,xlsx,xls,docx,doc|max:10240',
        ]);

        $final = $plan->publicationFinal ?? new PublicationFinal();
        $final->pub_plan_id = $plan->pub_plan_id;
        $final->actual_date = $request->actual_date;
        $final->final_desc = $request->final_desc;

        if ($request->hasFile('final_file')) {
            if ($final->final_file) {
                \Storage::disk('public')->delete($final->final_file);
            }
            $final->final_file = $request->file('final_file')
                ->store('publication_finals', 'public');
        }

        $final->save();

        return redirect()->back()->with('success', 'Realisasi publikasi berhasil diperbarui!');
    }

    public function destroy(PublicationPlan $plan)
    {
        if ($plan->plan_file) {
            \Storage::disk('public')->delete($plan->plan_file);
        }
        if ($plan->publicationFinal && $plan->publicationFinal->final_file) {
            \Storage::disk('public')->delete($plan->publicationFinal->final_file);
        }

        $plan->delete();

        return redirect()->back()->with('success', 'Rencana publikasi berhasil dihapus!');
    }
}