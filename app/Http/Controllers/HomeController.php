<?php

namespace App\Http\Controllers;

use App\Models\Card;
use App\Models\PostCard;
use App\Models\Debat;
use App\Models\Link;
use App\Models\Vote;
use App\Models\Message;

class HomeController extends Controller
{
    public function index()
    {
        $cards = Card::all();
        $post_cards = PostCard::all();
        $debates = Debat::withCount(['commentaires', 'votes'])->latest()->get();
        $links = Link::all();
        // dd($debates);

        return view('pages.index', compact('cards', 'post_cards', 'debates', 'links'));
    }


    public function sante()
    {

        $cards = Card::all();
        $post_cards = Debat::withCount(['commentaires', 'votes'])->latest()->get()->where(
            'category',
            'sante_publique'
        );
        return view('pages.sante', compact('post_cards', 'cards'));
    }

    public function droits()
    {
        $cards = Card::all();
        $post_cards = Debat::withCount(['commentaires', 'votes'])->latest()->get()->where(
            'category',
            'droits_humains_et_citoyennete'
        );
        return view('pages.droits', compact('post_cards', 'cards'));
    }

    public function technologie()
    {
        $cards = Card::all();
        $post_cards = Debat::withCount(['commentaires', 'votes'])->latest()->get()->where(
            'category',
            'technologie_et_innovation'
        );
        return view('pages.technologie', compact('post_cards', 'cards'));
    }

    public function securite_et_defense()
    {
        $cards = Card::all();
        $post_cards = Debat::withCount(['commentaires', 'votes'])->latest()->get()->where(
            'category',
            'securite_et_defense'
        );
        return view('pages.securite_et_defense', compact('post_cards', 'cards'));
    }

    public function environment()
    {
        $cards = Card::all();
        $post_cards = Debat::withCount(['commentaires', 'votes'])->latest()->get()->where(
            'category',
            'environnement_et_developpement'
        );
        return view('pages.environment', compact('post_cards', 'cards'));
    }
    public function relationInter()
    {
        $cards = Card::all();
        $post_cards = Debat::withCount(['commentaires', 'votes'])->get()->where(
            'category',
            'relations_internationale'
        );
        return view('pages.relations', compact('post_cards', 'cards'));
    }

    public function education()
    {
        $cards = Card::all();
        $post_cards = Debat::withCount(['commentaires', 'votes'])->get()->where(
            'category',
            'education'
        );
        return view('pages.education', compact('post_cards', 'cards'));
    }

    public function economie()
    {
        $cards = Card::all();
        $post_cards = Debat::withCount(['commentaires', 'votes'])->get()->where(
            'category',
            'economie_et_developpement'
        );
        return view('pages.economie', compact('post_cards', 'cards'));
    }

    public function politiques()
    {
        $cards = Card::all();
        $post_cards = Debat::withCount(['commentaires', 'votes'])->get()->where(
            'category',
            'Politique'
        );
        return view('pages.politique', compact('post_cards', 'cards'));
    }


    public function justice()
    {
        $cards = Card::all();
        $post_cards = Debat::withCount(['commentaires', 'votes'])->get()->where(
            'category',
            'Justice'
        );
        return view('pages.justice', compact('post_cards', 'cards'));
    }


    public function debats()
    {
        $cards = Card::all();
        $debats = Debat::withCount(['commentaires', 'votes'])->latest()->get();
        return view('pages.debats', compact('debats', 'cards'));
    }

    public function debat($debatId)
    {
        // Récupérer le débat avec ses relations nécessaires
        $debat = Debat::with(['chats.user', 'commentaires.user'])->withCount(['commentaires', 'votes'])->findOrFail($debatId);

        // Récupérer les derniers messages associés au débat
        $messages = $debat->chats()->latest()->get();

        // Récupérer les derniers commentaires associés au débat
        $comments = $debat->commentaires()->with('user:id,name,email')->latest()->get();
        $forComments = [];
        $againstComments = [];

        foreach ($comments as $comment) {
            $hasVotedFor = Vote::where('id_debat', $debat->id_debat)
                ->where('id_user', $comment->id_user)
                ->where('choix', true)
                ->exists();

            if ($hasVotedFor) {
                $forComments[] = $comment;
            } else {
                $againstComments[] = $comment;
            }
        }
        Auth()->user();
        $userHasVoted = Vote::where('id_debat', $debatId)
            ->where('id_user', auth()->id())
            ->where('choix', true)
            ->exists();
        $likesCount = Vote::where('id_debat', $debatId)->where('choix', true)->count();
        $dislikesCount = Vote::where('id_debat', $debatId)->where('choix', false)->count();
        // dd($comments);
        // Récupérer les 5 derniers débats récents (excluant celui actuellement affiché)
        $recent_posts = Debat::where('id_debat', '!=', $debatId)
            ->latest()
            ->take(5)
            ->get();

        // Retourner la vue avec toutes les données
        return view('pages.debat.show', compact('debat', 'likesCount', 'forComments', 'againstComments', 'dislikesCount', 'userHasVoted', 'recent_posts', 'messages', 'comments'));
    }
}
