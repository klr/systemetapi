<?php
class Product extends Eloquent
{
    /**
     * The database table used by the model.
     * @var string
     */
    protected $table = 'product';

    /**
     * Soft deletes
     * @var boolean
     */
    protected $softDeletes = true;

    /**
     * Guarded
     * @var array
     */
    protected $guarded = [];

    /**
     * Get volume attribute
     * @param  string $value
     * @return float
     */
    public function getVolumeAttribute($value)
    {
        return (float) $value;
    }

    /**
     * Get price attribute
     * @param  string $value
     * @return float
     */
    public function getPriceAttribute($value)
    {
        return (float) $value;
    }

    /**
     * Get price per liter attribute
     * @param  string $value
     * @return float
     */
    public function getPricePerLiterAttribute($value)
    {
        return (float) $value;
    }

    /**
     * Get alcohol attribute
     * @param  string $value
     * @return float
     */
    public function getAlcoholAttribute($value)
    {
        return (float) $value;
    }

    /**
     * Get APK attribute
     * @param  string $value
     * @return float
     */
    public function getApkAttribute($value)
    {
        return (float) $value;
    }

    /**
     * Get ecological attribute
     * @param  integer $value
     * @return boolean
     */
    public function getEcologicalAttribute($value)
    {
        return (bool) $value;
    }

    /**
     * Get koscher attribute
     * @param  integer $value
     * @return boolean
     */
    public function getKoscherAttribute($value)
    {
        return (bool) $value;
    }

    /**
     * Calculate APK
     * @param  float $alcohol
     * @param  float $pricePerLiter
     * @return float
     */
    public static function calculateApk($alcohol, $pricePerLiter)
    {
        if ($pricePerLiter <= 0 || $alcohol <= 0) {
            return 0;
        }

        return ($alcohol * 1000) / $pricePerLiter;
    }

    /**
     * Tags
     * @return Size
     */
    public function tags()
    {
        return $this->belongsToMany('Tag', 'product_tag');
    }

    /**
     * Tag
     * @param  array $tags
     * @return void
     */
    public function tag($stringTags)
    {
        foreach ($stringTags as $stringTag) {
            $tag = Tag::getByName($stringTag);

            if (empty($tag)) {
                $tag = Tag::create(['name' => $stringTag]);
            }

            ProductTag::create([
                'product_id' => $this->id,
                'tag_id'     => $tag->id
            ]);
        }
    }
}