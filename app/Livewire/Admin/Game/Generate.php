<?php

namespace App\Livewire\Admin\Game;

use App\Models\Game;
use App\Models\Team;
use Livewire\Component;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class Generate extends Component
{
    public $type = 'deadmatch';
    public $teams;
    public $start_match;
    public $avail = [];
    
    public function mount()
    {
        $this->teams = Team::all();
        
        foreach ($this->teams as $team) {
            for ($i=1; $i <= 7; $i++) { 
                $this->avail[$team->id][] = (string)$i;
            }
        }        
    }
    
    public function updatedAvail($id, $value)
    {
        $team_id = explode('.', $value)[0] ?? 0;
        $key = explode('.', $value)[1] ?? 0;

        // Jika nilai '8' dipilih, reset array dan sisakan hanya '8'
        if (in_array('8', $this->avail[$team_id] ?? [])) {
            $this->avail[$team_id] = ['8'];
        } else {
            // Jika nilai selain 8 dipilih dan '8' sudah ada, hapus '8'
            if (($key != '8') && in_array('8', $this->avail[$team_id] ?? [])) {
                $this->avail[$team_id] = array_filter(
                    $this->avail[$team_id],
                    fn ($val) => $val !== '8'
                );
            }
        }
    }
    
    public function close()
    {
        $this->dispatch('reload-page');
    }
    
    public function roll()
    {
        // Reset game bracket
        DB::table('games')->delete();

        // Ambil tim sesuai filter availability (contoh)
        $teams = Team::all()->filter(function ($team) {
            $avail = $this->avail[$team->id] ?? [];
            return !in_array(8, $avail);
        })->values();

        if ($teams->count() < 2) {
            return back()->with('error', 'Tim tidak cukup untuk membuat game.');
        }

        $usedTeamIds = [];
        $start = Carbon::parse($this->start_match ?? now());
        $dayMap = [
            1 => 'Monday', 2 => 'Tuesday', 3 => 'Wednesday', 4 => 'Thursday',
            5 => 'Friday', 6 => 'Saturday', 7 => 'Sunday',
        ];

        $gamesRound1 = [];

        // Generate round 1 (deadmatch example)
        if ($this->type === 'deadmatch') {
            foreach ($teams as $team) {
                if (in_array($team->id, $usedTeamIds)) continue;

                $availableDaysA = array_filter($this->avail[$team->id] ?? [], fn($d) => in_array($d, range(1,7)));

                $found = false;
                foreach ($teams as $opponent) {
                    if ($team->id === $opponent->id || in_array($opponent->id, $usedTeamIds)) continue;

                    $availableDaysB = array_filter($this->avail[$opponent->id] ?? [], fn($d) => in_array($d, range(1,7)));

                    $commonDays = array_intersect($availableDaysA, $availableDaysB);
                    if (!empty($commonDays)) {
                        $dayNum = intval(collect($commonDays)->random());
                        $dayName = $dayMap[$dayNum] ?? 'Monday';

                        $gamesRound1[] = [
                            'team_home_id' => $team->id,
                            'team_away_id' => $opponent->id,
                            'game_time' => $start->copy()->next($dayName)->setTime(rand(9, 18), 0),
                            'round' => 1,
                        ];

                        $usedTeamIds[] = $team->id;
                        $usedTeamIds[] = $opponent->id;
                        $found = true;
                        break;
                    }
                }

                if (!$found) {
                    $opponent = $teams->first(fn($t) => $t->id !== $team->id && !in_array($t->id, $usedTeamIds));
                    if ($opponent) {
                        $randomDayNum = rand(1, 7);
                        $dayName = $dayMap[$randomDayNum];
                        $gamesRound1[] = [
                            'team_home_id' => $team->id,
                            'team_away_id' => $opponent->id,
                            'game_time' => $start->copy()->next($dayName)->setTime(rand(9, 18), 0),
                            'round' => 1,
                        ];

                        $usedTeamIds[] = $team->id;
                        $usedTeamIds[] = $opponent->id;
                    }
                }
            }
        }

        // Simpan pertandingan ronde 1
        foreach ($gamesRound1 as $game) {
            Game::create($game);
        }

        // Hitung jumlah tim untuk round berikutnya
        // Jumlah tim di round 1 = jumlah match * 2 (karena tiap match ada 2 tim)
        $round1MatchCount = count($gamesRound1);
        $teamsNextRound = $round1MatchCount; // pemenang tiap match lanjut ke round berikutnya

        // Generate ronde kosong mulai ronde 2
        $this->generateEmptyRounds($teamsNextRound, $start, $dayMap);

        return redirect()->route('admin.game.index')->with('success', 'Game bracket berhasil digenerate.');
    }

    protected function generateEmptyRounds(int $teamsLeft, Carbon $start, array $dayMap, int $startRound = 2, int $weekOffset = 1)
    {
        $round = $startRound;

        while ($teamsLeft > 1) {
            $matchCount = (int) floor($teamsLeft / 2);

            for ($i = 0; $i < $matchCount; $i++) {
                $randomDayNum = rand(1, 7);
                $dayName = $dayMap[$randomDayNum];

                Game::create([
                    'team_home_id' => null,
                    'team_away_id' => null,
                    'game_time' => $start->copy()->addWeeks($weekOffset)->next($dayName)->setTime(rand(9, 18), 0),
                    'round' => $round,
                ]);
            }

            // Update jumlah tim untuk ronde berikutnya
            $teamsLeft = $matchCount;

            $round++;
            $weekOffset++;
        }
    }

    protected function getCommonDay($teamAId, $teamBId)
    {
        $daysA = $this->avail[$teamAId] ?? [];
        $daysB = $this->avail[$teamBId] ?? [];

        if (in_array(8, $daysA) || in_array(8, $daysB)) {
            return rand(1, 7); // fallback: random hari
        }

        $commonDays = array_intersect($daysA, $daysB);

        return !empty($commonDays) ? collect($commonDays)->random() : rand(1, 7);
    }
        
    public function render()
    {
        return view('livewire.admin.game.generate');
    }
}
