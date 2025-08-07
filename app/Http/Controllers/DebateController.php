<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Debat;
use Illuminate\Support\Facades\View;
class DebateController extends Controller
{
    //

    public function search(Request $request)
    {
        $query = $request->input('q');

        $debates = Debat::withCount(['commentaires', 'votes'])
            ->whereNotIn('statut', ['En attente', 'Rejeté'])
            ->where(function ($qBuilder) use ($query) {
                foreach (explode(' ', $query) as $word) {
                    $qBuilder->orWhere('titre', 'LIKE', "%{$word}%");
                }
                $qBuilder->orWhere('description', 'LIKE', "%{$query}%")
                    ->orWhere('category', 'LIKE', "%{$query}%");
            })
            ->latest()
            ->get();

        if ($request->ajax()) {
            $html = View::make('partials.debate-results', [
                'debates' => $debates,
                'searchTerm' => $query,
            ])->render();

            return response()->json(['html' => $html]);
        }

        // If not AJAX, fall back to normal page load
        $cards = \App\Models\Card::all();
        $post_cards = \App\Models\PostCard::all();
        $links = \App\Models\Link::all();

        return view('pages.index', compact('cards', 'post_cards', 'debates', 'links'))
            ->with('searchTerm', $query);
    }
}
