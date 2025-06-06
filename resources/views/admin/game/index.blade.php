<x-layout.admin>
    <div class="d-flex align-items-center justify-content-between gap-2">
        <h1 class="fs-5 fw-bold text-dark" style="margin: 0">Games</h1>
        <div class="d-flex gap-2 justify-content-end">            
            @livewire('admin.game.generate')
            <a href="{{ route('admin.team.create') }}" class="btn btn-outline-secondary btn-sm">Add Game</a>
        </div>
    </div>
    <form action="{{ route('admin.games.update-scores') }}" method="POST">
        @csrf
        <div class="mt-5">
            @php
            $groupedGames = $games->groupBy('round');
        @endphp
        
        @foreach ($groupedGames as $round => $gamesInRound)
            <h4 class="mt-5">Round {{ $round }}</h4>
        
            @foreach ($gamesInRound as $game)
                <div class="d-flex justify-content-start align-items-stretch mt-4 gap-4">
                    <div class="team-card d-flex flex-column p-3 rounded-2 border" style="width: 49%; font-size: .9em; background: linear-gradient(20deg, #ffffff60, #ffffff40, #ffffff50);">
                        <img src="{{ asset('storage/Team/'. $game?->teamHome?->logo) }}" style="filter: grayscale(1); opacity: .5;" alt="">
                        <div class="d-flex align-items-center justify-content-between w-100">
                            <div class="d-flex align-items-center gap-3">
                                @if ($game?->teamHome?->logo)
                                    <img class="logo" src="{{ asset('storage/Team/'. $game?->teamHome?->logo) }}">
                                @endif
                                <h6 class="team-name">{{ $game?->teamHome?->name ?? '-' }}</h6>
                            </div>
                            @if ($game?->teamHome)
                                <input 
                                    type="number" 
                                    name="scores[{{ $game->id }}][home]" 
                                    class="score" 
                                    value="{{ old('scores.' . $game->id . '.home', $game->score_home ?? '0') }}" 
                                    min="0"
                                >
                            @endif
                        </div>
                    </div>
        
                    <div class="d-flex flex-column justify-content-center align-items-center text-center">
                        <h4 class="fw-bold">Vs</h4>
                        <small class="text-secondary" style="white-space: nowrap">
                            {{ \Carbon\Carbon::parse($game->game_time)->format('d M Y') }}
                        </small>
                    </div>
        
                    <div class="team-card team-card-last d-flex flex-column align-items-end p-3 rounded-2 border" style="width: 49%; font-size: .9em; background: linear-gradient(20deg, #ffffff60, #ffffff40, #ffffff50);">
                        <img src="{{ asset('storage/Team/'. $game?->teamAway?->logo) }}" style="filter: grayscale(1); opacity: .5;" alt="">
                        <div class="d-flex align-items-center justify-content-between w-100">
                            @if ($game?->teamAway)    
                                <input 
                                    type="number" 
                                    name="scores[{{ $game->id }}][away]" 
                                    class="score" 
                                    value="{{ old('scores.' . $game->id . '.away', $game->score_away ?? '0') }}" 
                                    min="0"
                                >
                            @endif
                            <div class="d-flex align-items-center gap-3">
                                <h6 class="team-name">{{ $game?->teamAway?->name ?? '-' }}</h6>
                                @if ($game?->teamAway?->logo)
                                    <img class="logo" src="{{ asset('storage/Team/'. $game?->teamAway?->logo) }}">
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        @endforeach
        </div>
        
        @if ($games->count() > 0)
            <div class="d-flex justify-content-end w-100 mt-4">
                <button type="submit" class="btn btn-primary mt-4">Save Scores</button>
            </div>
        @endif
    </form>
</x-layout.admin>
