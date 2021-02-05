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
     * @return string
     * LEJU
     * 2021/2/5
     */
    public function searchableAs()
    {
        return 'user_index';
    }

}