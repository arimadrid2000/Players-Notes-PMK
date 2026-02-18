<?php

declare(strict_types=1);

namespace App\Repositories;

use App\Models\PlayerNote;
use Illuminate\Database\Eloquent\Collection;

class PlayerNoteRepository extends BaseRepository
{
    public function __construct(PlayerNote $model)
    {
        parent::__construct($model);
    }

    public function getNotesByPlayer(int $playerId): Collection
    {
        $notes = $this->model->with('author')
            ->where('player_id', $playerId)
            ->latest()
            ->get();

        foreach ($notes as $note) {
            $createdAt = $note->created_at;

            if ($createdAt->isToday()) {
                $note->formatted_date = 'Today at ' . $createdAt->format('H:i');
            } elseif ($createdAt->isYesterday()) {
                $note->formatted_date = 'Yesterday at ' . $createdAt->format('H:i');
            } else {
                $note->formatted_date = $createdAt->format('M d, Y');
            }
        }

        return $notes;
    }
}
