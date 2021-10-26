<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * App\Models\UserAnswers
 *
 * @property int $id
 * @property int $user_id
 * @property int|null $answer_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Answer|null $answer
 * @property-read \App\Models\User $user
 * @method static \Database\Factories\UserAnswersFactory factory(...$parameters)
 * @method static \Illuminate\Database\Eloquent\Builder|UserAnswers newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|UserAnswers newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|UserAnswers query()
 * @method static \Illuminate\Database\Eloquent\Builder|UserAnswers whereAnswerId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserAnswers whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserAnswers whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserAnswers whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserAnswers whereUserId($value)
 * @mixin \Eloquent
 */
class UserAnswers extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'answer_id',
        'ip_address',
        'game_uuid'
    ];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = [
        'created_at',
        'updated_at'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        //
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        //
    ];

    /**
     * Get the Answer for the UserAnswers.
     */
    public function answer(): BelongsTo
    {
        return $this->belongsTo(Answer::class);
    }

    /**
     * Get the User for the UserAnswers.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
