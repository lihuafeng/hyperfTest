<?php
/**
 * LEJU
 * 2021/2/4
 */

namespace App\Model;

use Hyperf\Database\Model\Model;
use Hyperf\Scout\Searchable;

class UserSearch extends Model
{
    use Searchable;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'user';

    public $timestamps = false;
    /**
     * @return string
     * LEJU
     * 2021/2/5
     */
    public function searchableAs()
    {
        return 'user_index';
    }

    /**
     * Get the indexable data array for the model.
     *
     * @return array
     */
    public function toSearchableArray()
    {
        $array = $this->toArray();

        // Customize array...

        return $array;
    }


}