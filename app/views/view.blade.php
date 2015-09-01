<?php

if (\Fdw\Core\Libraries\Helpage\Packager::enabled('cart­ebay')) {
    $ebay_categories = \Fdw\CartEbay\Models\EbayCategory::getCategoryTree($parent);
    if ($modal->id()) {
        $primary_category = $model­>ebayCategories()
            ->where('ebay_category_type', 'primary')
            ->get()
            ->first();
        $secondary_category = $model­>ebayCategories()
            ->where('ebay_category_type', 'secondary')
            ->get()
            ->first();
    }
}
?>
@extends('admin.layouts.form')

@section('content')
    {{ Form::model($model, [ 'route' => $form->getRoute(), 'role' => 'form', 'class' => 'form' ]) }}
    <div class="form-group  {{ $errors->has('media_id')? 'has-error':'' }}" >
        {{ Form::label('media_id', 'Image') }}
        {{ Form::button('Add Image') }}
    </div>

    {{ $model->getWarehouseField() }}
    @if( Input::has('id'))
        {{-- */ $category_id = Input::get('id') /* --}}
    @else
        {{-- */ $category_id = null /*--}}
    @endif
    <div class="form-group {{ $errors->has('name')?'has-error':'' }} control-required" >
        {{ Form::label('name', 'Parent Category') }}
        {{ Form::select('category_id', $form->createCategoryDropdown(), $category_id,[
            'class' => 'form-control',
            'required' => 'required'
        ]) }}
    </div>
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6" >
            <div class="form-group {{ $errors->has('name')?'has-error':'' }} control-required " >
                {{ Form::label('name', 'Category Name') }}
                {{ Form::text('name', null, [
                    'class' => 'form-control',
                    'placeholder' => 'Category Name i.e.\'Vehicles\'',
                    'required' => 'required',
                    'data-slug' => 'slug'
                ]) }}
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
            <div class="form-group {{ $errors->has('slug')?'has-error':'' }} control-required ">
                {{ Form::label('slug', 'Slug') }}
                {{ Form::text('slug', null), [
                    'class' => 'form-control',
                    'placeholder' => 'Slug i.e.\'Vehicles ...\'',
                    'required' => 'required',
                    'data-slug' => 'slug'
                ] }}
            </div>
        </div>

        @if(\Fdw\Core\Libraries\Helpage\Packager::enabled('cart­ebay'))
            <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
                <div class="form-group {{ $errors->has('name'?'has-error':'') }} ">
                    {{ Form::label('Ebay primary Category', 'Ebay primary Category') }}
                    <select name="ebayprimarycategory" data-placeholder="Select a category"
                        data-type="primary" class="chosen-select ebaycategory"
                        data-selectbox="#js-primary-sub-dropbox2">
                        @if(isset($primary_category))
                            {{-- */ $primary)category_name = $primary_category->getCategoryRouteTree() /* --}}
                            @foreach($primary_category_name as $key=>$value)
                                <option value="{{ $key }}">
                                    {{ $value }}
                                </option>
                            @endforeach
                        @endif
                        <option value="">Select Category</option>
                        @if(!$ebay_categories->isEmpty())
                            @foreach($ebay_categories as $key => $value)
                                @if(is_numeric($key))
                                    <option data-url = "{{ URL::route('fdw.admin.ebay.category.json', [
                                        'category_id' => $key
                                    ]) }}" value=" {{ $key }} "> {{ $value }}</option>
                                @endif
                            @endforeach
                        @endif
                    </select>
                    <div class="ebaysubcategories">
                    </div>
                </div>
            </div>
        @endif
        </div>
    @include('admin.partials.meta')

    <div class="form-group">
        {{ Form::submit($form->getSubmitText(), [ 'class' => 'btn btn-primary']) }}
    </div>

    {{ Form::close() }}
@stop

