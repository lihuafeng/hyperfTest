<?php
/**
 * @desc 楼盘模型
 * @author huafeng1@leju.com
 * 2021/9/23
 */

namespace App\Model;

use Hyperf\Database\Model\Model;
use Hyperf\Scout\Searchable;

class HouseSearch extends Model
{
    use Searchable;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'house';

    /**
     * @return string
     * LEJU
     * 2021/2/5
     */
    public function searchableAs()
    {
        return 'house';
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