<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Course
 * 
 * @property string $id
 * @property string|null $image
 * @property string|null $title
 * @property string|null $description
 * @property string|null $link
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 *
 * @package App\Models
 */
class Course extends Model
{
	use HasUuids;
	protected $table = 'courses';
	public $incrementing = false;

	protected $fillable = [
		'image',
		'title',
		'description',
		'link'
	];
}
