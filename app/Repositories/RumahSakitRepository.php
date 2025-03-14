<?php

namespace App\Repositories;

use App\Models\RumahSakit;
use App\Repositories\BaseRepository;

/**
 * Class RumahSakitRepository
 * @package App\Repositories
 * @version February 14, 2025, 2:52 am UTC
*/

class RumahSakitRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'rumahsakit'
    ];

    /**
     * Return searchable fields
     *
     * @return array
     */
    public function getFieldsSearchable()
    {
        return $this->fieldSearchable;
    }

    /**
     * Configure the Model
     **/
    public function model()
    {
        return RumahSakit::class;
    }
}
