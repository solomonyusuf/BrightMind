<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Chat
 * 
 * @property string $id
 * @property string $user_id
 * @property string|null $messages
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property User $user
 *
 * @package App\Models
 */
class Chat extends Model
{
	protected $table = 'chats';
	public $incrementing = false;

	protected $fillable = [
		'user_id',
		'messages'
	];

	public function user()
	{
		return $this->belongsTo(User::class);
	}
}
