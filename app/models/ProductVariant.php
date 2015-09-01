<?php

namespace Fdw\Cart\Models;

use Fdw\Cart\Models\ProductInventory;
use Fdw\Cart\Models\Traits\ProductDimensionTrait;
use Fdw\Cart\Models\Traits\ProductPriceTrait;
use Fdw\Cart\Models\Traits\ProductQuantityTrait;
use Fdw\Cart\Models\Traits\ProductStockTrait;
use Fdw\Core\Models\Traits\SortableTrait;
use Fdw\Core\Models\BaseModel;
use Illuminate\Database\Eloquent\SoftDeletingTrait;

class ProductVariant extends BaseModel
{
    use SoftDeletingTrait, SortableTrait, ProductDimensionTrait;
    use ProductPriceTrait, ProductQuantityTrait, ProductStockTrait;

    protected $table = 'product_variant';

    protected $namespace = 'Fdw\Cart\Models\ProductVariant';

    public $timestamps = true;

    protected $dates = ['deleted_at'];

    protected $fillable = ['sku', 'product_id', 'title', 'slug', 'quantity', 'order'];

    public $filterable = ['slug'];

    public $sortable = 'order';

    public function product()
    {
        return $this->belongsTo('Fdw\Cart\Models\Product');
    }

    public function images()
    {
        return $this->hasMany('\Fdw\Cart\Models\ProductImage');
    }

    public function cart_items()
    {
        return $this->hasMany('\Fdw\Cart\Models\CartItem', 'variant_id');
    }

    public function attachments()
    {
        return $this->hasMany('\Fdw\Cart\Models\ProductAttachment');
    }

    public function getAttachments($enabled = true)
    {
        $query = $this0 > attachments();
        if ($enabled) {
            $query = $query->enabled();
        }
        return $query->get();
    }

    public function attribute()
    {
        return $this->hasMany('Fdw\Cart\Models\ProductAttribute');
    }

    public function getAttributes()
    {
        $returnArray = [];
        $product_attributes = $this->attribute()->get();
        foreach ($product_attributes as $product_attribute) {
            $attributes = $product_attribute->attribute()->get()->first();
            $attribute_values = $attributes->attributeValue()->lists('value');
            $returnArray [$attributes->name] = $attribute_values;
        }
        return $returnArray;
    }

    public function hasAttribute($variant, $attribute)
    {
        foreach ($variant->attribute()->get() as $variant_attribute) {
            if ($attribute->value == $variant_attribute->value && $attribute
                    ->attribute_id == $variant_attribute->attribute_id
            ) {
                return true;
            }
        }
        return false;
    }

    public function checkAttr($attribute)
    {
        if (ProductAttribute::where('product_variant_id', $this->id)
            ->where('attribute_id', $attribute->attribute_id)
            ->where('value', $attribute->value)->get()->count()
        ) {
            return 1;
        } else {
            $product_variants = ProductAttribute:: where('product_variant_id', $this->id)->get();
            $keeper = [];
            $other_variants = \DB::table('product_attribute')
                ->join('product_variant', 'product_attribute.product_variant_id', '=', 'product_variant.id')
                ->where('product_attribute.product_variant_id', '!=', $this->id)
                ->where('product_variant.product_id', '=', $this->product_id)
                ->where('product_variant.deleted_at', '=', null)->get();
            foreach ($product_variants as $product_variant) {
                foreach ($other_variants as $other_variant) {
                    if ($product_variant->attribute_id == $other_variant->attribute_id
                        && ($product_variant->value == $other_variant->value || $attribute
                                ->value == $other_variant->value)
                    ) {
                        if (isset ($keeper [$other_variant->product_variant_id])) {
                            $keeper [$other_variant->product_variant_id]++;
                        } else {
                            $keeper [$other_variant->product_variant_id] = 1;
                        }
                    }
                }
            }
            if (!empty ($keeper)) {
                foreach ($keeper as $key => $value) {
                    if ($product_variants->
                        count() == $value
                    ) {
                        return ProductVariant:: find($key)->slug;
                    }
                }
                return 2;
            } else {
                return 2;
            }
        }
    }

    public function checkAttribute($key, $value)
    {
        if (ProductAttribute::where('product_variant_id', $this->id)
            ->where('key', $key)->where('value', $value)->get()
            ->count()
        ) {
            return true;
        } else {
            return false;
        }
    }

    public function getFeaturedImage()
    {
        if ($image = $this->images()->where('is_feature', 1)->first()) {
            return $image;
        } else {
            if ($image = $this->images()->first()) {
                return $image;
            } else {
                return $this->product()->first()->getFeaturedImage();
            }
        }
    }

    public function reOrderAlert()
    {
        $site_name = \Site::settings('website_title') ? \Site::settings('website_title') : 'Fox Digital Web';
        $data = [
            'sku' => $this->sku,
            'name' => $this->product()->first()->name,
            'slug' => $this->slug,
            'quantity' => $this->quantity,
            'link' => \URL:: route('fdw.product', [
                $this->product()->first()->slug,
                $this->slug
            ]),
            'SITE_NAME' => \Site::settings('website_title') ? \Site::settings('website_title') : 'Fox Digital Web'
        ];
        \Mail::send(\Site::templateResolver('cart::%s.emails.reorder'), $data, function ($message) use ($data) {
            $message->to(\Site::settings('email_address'), \Site:: settings('email_name'))
                ->subject(\Site:: settings('website_title') . ': ReorderLevel Reached');
        });
    }
}

ProductVariant:: deleting(function ($variant) {
    $variant->cart_items()->delete();
});
