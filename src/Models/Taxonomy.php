<?php
/**
 * Contains the Taxonomy class.
 *
 * @copyright   Copyright (c) 2018 Attila Fulop
 * @author      Attila Fulop
 * @license     MIT
 * @since       2017-08-25
 */

namespace Vanilo\Category\Models;

use Cviebrock\EloquentSluggable\Sluggable;
use Cviebrock\EloquentSluggable\SluggableScopeHelpers;
use Illuminate\Database\Eloquent\Model;
use Vanilo\Category\Contracts\Taxonomy as TaxonomyContract;

class Taxonomy extends Model implements TaxonomyContract
{
    use Sluggable, SluggableScopeHelpers;

    protected $table = 'taxonomies';

    protected $guarded = ['id', 'created_at', 'updated_at'];

    public function rootLevelTaxons()
    {
        return TaxonProxy::where('taxonomy_id', $this->id)
                         ->where('parent_id', null)
                         ->get();
    }

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'name'
            ]
        ];
    }
}
