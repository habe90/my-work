<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Job;
use App\Models\Bid;

class BidController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        $userBids = collect();
    
        if ($user->user_type == 'company') {
            // Logika za korisnike čiji je user_type 'company'
            $userBids = Bid::where('user_id', $user->id)
                ->with('job')
                ->paginate(6);
        } elseif ($user->user_type == 'client') {
            // Logika za korisnike čiji je user_type 'client'
            $userJobs = Job::where('user_id', $user->id)->pluck('id')->toArray();
    
            $userBids = Bid::whereIn('job_id', $userJobs)
                ->with('job')
                ->paginate(6);
        }
    
        return view('frontend.bids.index', compact('userBids'));
    }
    

    public function show($jobId)
    {
        $job = Job::with('bids')->findOrFail($jobId);

      
        return view('frontend.bids.show', compact('job'));
    }

    public function edit(Bid $bid)
    {
        if (auth()->id() !== $bid->user_id || $bid->edit_count >= 3) {
            return redirect()->back()->with('error', 'Sie sind nicht berechtigt, dieses Gebot zu bearbeiten, oder Sie haben Ihr Bearbeitungslimit überschritten.');
        }

        // Führen Sie weitere Validierungen nach Bedarf durch

        return view('frontend.bids.edit', compact('bid'));
    }

    public function update(Request $request, Bid $bid)
    {
        if (auth()->id() !== $bid->user_id) {
            return redirect()->back()->with('error', 'Sie sind nicht berechtigt, dieses Gebot zu bearbeiten.');
        }
    
        if ($bid->edit_count >= 3) {
            return redirect()->back()->with('error', 'Sie haben Ihr Bearbeitungslimit für dieses Gebot überschritten.');
        }
    
        // Validieren Sie die Anfrage
        $validatedData = $request->validate([
            // Hinzufügen der Validierungsregeln
        ]);
    
        // Aktualisieren Sie das Gebot mit neuen Daten
        $bid->update($validatedData);
    
        // Inkrementieren Sie den Bearbeitungszähler des Gebots
        $bid->increment('edit_count');
    
        return redirect()->route('IhrZielort')->with('success', 'Ihr Gebot wurde erfolgreich aktualisiert.');
    }

}
