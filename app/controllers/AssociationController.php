<?php

class AssociationController extends \BaseController {

    public function postAdd()
    {
        $validator = with(new AssociationAddForm)->
            validate(Input::all());

        $association = Association::create(array_add(
                Input::only('name', 'type'),
                'order',
                Association::all()->count() + 1
            ))->assignWarehouses(Input::get('warehouses'));

        $association->updateAssociationValues(Input::get('value'));

        return Redirect::route('fdw.admin.cart.association')
            ->with('success', 'You have successfully created an Association.');
    }

    public function postEdit($id)
    {
        $association = Association::findOrFail($id);
        $validator = with(new AssociationEditForm($association))->
            validate(\Input:: all());
        $association->update(\Input:: only('name', 'type'));
        $association->updateWarehouses(\Input:: get('warehouses'));
        $association->updateAssociationValues(\Input:: get('value'));

        return \Redirect:: route('fdw.admin.cart.association')
            ->with('success', 'You have successfully edited an Association.');
    }

}
