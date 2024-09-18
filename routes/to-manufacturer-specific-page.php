<?php
    //NOW ONTO MANUFACTURERS 2
    //ROUTE TO REDIRECT TO MANUFATURER SPECIFIC PAGE
    Route::get('to_manufacturer_specific_page_action/{manufacturer_id}/{manufacturer_name}', function ($manufacturer_id, $manufacturer_name) {

        $getbicycles_from_manufacturer = "select bicycles.*, manufacturers.* from bicycles, manufacturers
                                                   where manufacturers.manufacturer_id = bicycles.bicycle_manufacturer_ID
                                                   and manufacturers.manufacturer_id = ?";

        $list_by_manufacturer = DB::select($getbicycles_from_manufacturer, array($manufacturer_id));


        return view('manufacturer-specific-items') //RETURNS THIS PAGE BUT RETAINS ITS ROUTE NAME IN URL
        ->with('fromthismanufacturer', $list_by_manufacturer)
            ->with('themanuf_name', $manufacturer_name);
    })->name('to_manufacturer_specific_page_action');

?>
