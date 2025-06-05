<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Game;
use Illuminate\Http\Request;

class GameController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.game.index', [
            'games' => Game::all()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Game $game)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Game $game)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Game $game)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Game $game)
    {
        //
    }
    
    public function updateScores(Request $request)
    {
        $data = $request->validate([
            'scores' => 'required|array',
            'scores.*.home' => 'nullable|integer|min:0',
            'scores.*.away' => 'nullable|integer|min:0',
        ]);

        foreach ($data['scores'] as $gameId => $score) {
            $game = Game::find($gameId);
            if ($game) {
                $game->score_home = $score['home'] ?? null;
                $game->score_away = $score['away'] ?? null;
                $game->save();
            }
        }

        // Ambil round yang sudah diupdate
        $updatedRounds = Game::whereIn('id', array_keys($data['scores']))
            ->pluck('round')
            ->unique();

        foreach ($updatedRounds as $round) {
            // Cek apakah semua match round ini sudah terisi skor lengkap dan tidak ada skor seri
            $incompleteScoresCount = Game::where('round', $round)
                ->where(function ($query) {
                    $query->whereNull('score_home')
                        ->orWhereNull('score_away');
                })->count();

            $drawScoresCount = Game::where('round', $round)
                ->whereNotNull('score_home')
                ->whereNotNull('score_away')
                ->whereColumn('score_home', 'score_away')
                ->count();

            if ($incompleteScoresCount === 0 && $drawScoresCount === 0) {
                // Semua match sudah terisi skor dan tidak ada skor seri, generate next round
                $this->fillNextRoundBrackets($round);
            }
            // Kalau belum lengkap atau ada seri, tidak generate next round
        }

        return redirect()->back()->with('success', 'Scores updated and next round brackets filled if applicable.');
    }

    protected function fillNextRoundBrackets(int $currentRound)
    {
        $nextRound = $currentRound + 1;

        // Ambil semua game ronde sekarang yang sudah punya skor lengkap
        $games = Game::where('round', $currentRound)
            ->whereNotNull('score_home')
            ->whereNotNull('score_away')
            ->get();

        $winners = [];

        foreach ($games as $game) {
            if ($game->score_home > $game->score_away) {
                $winners[] = $game->team_home_id;
            } elseif ($game->score_away > $game->score_home) {
                $winners[] = $game->team_away_id;
            } else {
                // Jika seri, tentukan pemenang default (misal home team)
                $winners[] = $game->team_home_id;
            }
        }

        if (count($winners) < 1) {
            return; // Tidak ada pemenang, batal generate ronde selanjutnya
        }

        // Ambil semua pertandingan ronde berikutnya yang belum lengkap
        $nextRoundGames = Game::where('round', $nextRound)
            ->where(function($query) {
                $query->whereNull('team_home_id')
                    ->orWhereNull('team_away_id');
            })
            ->orderBy('id')
            ->get();

        $winnerIndex = 0;

        foreach ($nextRoundGames as $game) {
            if ($winnerIndex >= count($winners)) break;

            if (is_null($game->team_home_id)) {
                $game->team_home_id = $winners[$winnerIndex++];
                $game->save();
                if ($winnerIndex >= count($winners)) break;
            }

            if (is_null($game->team_away_id) && $winnerIndex < count($winners)) {
                $game->team_away_id = $winners[$winnerIndex++];
                $game->save();
            }
        }
    }
}