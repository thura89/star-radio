@extends('backend.agent.layouts.app')
@section('title', 'Property Management')
@section('update_property-active', 'mm-active')
@section('extra-css')
    <link type="text/css" rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link type="text/css" rel="stylesheet" href="{{ asset('/backend/css/image-uploader.css') }}">
@endsection
@section('content')
    <div class="app-main__inner">
        <div class="app-page-title">
            <div class="page-title-wrapper">
                <div class="page-title-heading">
                    <div class="page-title-icon">
                        <i class="pe-7s-users icon-gradient bg-mean-fruit">
                        </i>
                    </div>
                    <div>Property Update @if ($category == 3) Apartment @endif  @if ($category == 8) Condominium @endif @if ($category == 4) Office @endif
                    </div>
                </div>
            </div>
        </div>
        <div class="mb-3">
            <button class="btn btn-primary back-btn"><i class="fas fa-chevron-circle-left"></i> Back</button>
        </div>
        <div class="content">
            <div class="card">
                <div class="card-body">
                    @include('backend.agent.layouts.flash')
                    <form action="{{ route('agent.property.update.apartcondo_office') }}" class="form" method="POST"
                        id="update" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="property_category" value="{{ $category }}">
                        <input type="hidden" name="property_type" value="{{ $property->properties_type }}">
                        <input type="hidden" name="id" value="{{ $id }}">
                        {{-- Property Type --}}
                        <div class="form-group">
                            <h5>Property Type</h5>
                            <hr>
                            <div class="row">
                                <div class="col-6 col-md-4 form-group">
                                    <label for="price">Property Type</label>
                                    <select name="property_type" class="property_type form-control" disabled>
                                        <option value="">Select Type</option>
                                        @foreach (config('const.property_type') as $key => $property_type)
                                            <option value="{{ $key }}" @if ($property->properties_type == $key) selected @endif>
                                                {{ $property_type }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        {{-- address --}}
                        <div class="form-group">
                            <h5>Address</h5>
                            <hr>
                            <div class="row">
                                <div class="col form-group">
                                    <label for="title">Title</label>
                                    <input value="{{ $property->title }}" type="text" name="title"
                                        class="form-control">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col form-group">
                                    <label for="region">Region</label>
                                    @php
                                        $region = $property->address->region()->first('name');
                                    @endphp
                                    <span class="region_old badge badge-secondary">{{ $region['name'] }}</span>
                                    <select name="region" class="region form-control">
                                        <option value="">Select Region</option>
                                        @foreach ($regions as $key => $region)
                                            <option value="{{ $region->id }}" @if (old('region') == $region->id) selected="selected" @endif>
                                                {{ $region->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col form-group">
                                    <label for="township">Township</label>
                                    @php
                                        $township = $property->address->township()->first('name');
                                    @endphp
                                    <span class="township_old badge badge-secondary">{{ $township['name'] }}</span>
                                    <select name="township" class="township form-control">

                                    </select>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col form-group">
                                    <label for="street_name">Street Name</label>
                                    <input type="text" value="{{ $property->address->street_name }}" name="street_name"
                                        class="form-control">
                                </div>
                                <div class="col form-group">
                                    <label for="type_of_street">Type of Street</label>
                                    <select name="type_of_street" class="form-control">
                                        <option value="">Select</option>
                                        @foreach (config('const.type_of_street') as $key => $street)
                                            <option value="{{ $key }}" @if ($property->address->type_of_street == $key) selected @endif>
                                                {{ $street }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col form-group">
                                    <label for="ward">Ward</label>
                                    <input value="{{ $property->address->ward }}" type="text" name="ward"
                                        class="form-control">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 form-group">
                                    <label for="Building">Building Name</label>
                                    <input value="{{ $property->address->building_name }}" type="text" name="building_name"
                                        class="form-control">
                                </div>
                                @if ($category == 3)
                                <div class="col-md-6 form-group">
                                    <label for="building_type">Building Type</label>
                                    <select name="building_type" class="form-control">
                                        <option value="">Select</option>
                                        @foreach (config('const.building_type') as $key => $street)
                                            <option value="{{ $key }}" @if ($property->address->building_type == $key) selected @endif>
                                                {{ $street }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                @endif
                            </div>
                        </div>
                        {{-- Area Size --}}
                        <div class="form-group">
                            <h5>Area Size</h5>
                            <hr>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="area_option">Area Option</label>
                                        <select name="area_option" class="area_option form-control">
                                            <option value="">Select</option>
                                            @foreach (config('const.area_option') as $key => $area_opt)
                                                <option value="{{ $key }}" @if ($property->areasize->area_option == $key) selected @endif>{{ $area_opt }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-4 area_widthxlenght">
                                    <div class="row area_widthxlenght">
                                        <div class="col form-group">
                                            <label for="width">Width</label>
                                            <input type="number" name="width" class="form-control" value="{{ $property->areasize->width }}">
                                        </div>
                                        <div class="col form-group">
                                            <label for="length">Length</label>
                                            <input type="number" name="length" class="form-control" value="{{ $property->areasize->length }}">
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-4 area">
                                    <div class="row area">
                                        <div class="col form-group">
                                            <label for="area_size">Area Size</label>
                                            <input type="number" name="area_size" class="form-control" value="{{ $property->areasize->area_size }}">
                                        </div>
                                        <div class="col form-group">
                                            <label for="area_unit">Area Unit</label>
                                            <select name="area_unit" class="area form-control">
                                                <option value="">Select</option>
                                                @foreach (config('const.area') as $key => $val)
                                                    <option value="{{ $key }}" @if ($property->areasize->area_unit == $key) selected @endif>{{ $val }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="fence_width">Floor Level</label>
                                        <select name="floor_level" class="form-control">
                                            <option value="">Please Select</option>
                                            @foreach (config('const.floor_level') as $key => $level)
                                                <option value="{{ $key }}" @if ($property->areasize->level == $key) selected @endif>{{ $level }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        {{-- Partation --}}
                        <div class="form-group">
                            <h5>Partation</h5>
                            <hr>
                            <div class="row">
                                <div class="col-6 col-md-4 form-group">
                                    <label for="width">Partation Type</label>
                                    <select name="partation_type" class="partation_type form-control">
                                        <option value="">Select</option>
                                        @foreach (config('const.partation_type') as $key => $type)
                                            <option value="{{ $key }}" @if ($property->partation->type == $key) selected @endif>
                                                {{ $type }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="col-6 col-md-4 form-group partation_hider">
                                    <label for="level">Bed Room</label>
                                    <select name="bed_room" class="form-control">
                                        <option value="">Select</option>
                                        @foreach (config('const.bed_room') as $key => $room)
                                            <option value="{{ $key }}" @if ($property->partation->bed_room == $key) selected @endif>
                                                {{ $room }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="col-6 col-md-4 form-group partation_hider">
                                    <label for="bath_room">Bath Room</label>
                                    <select name="bath_room" class="form-control">
                                        <option value="">Select</option>
                                        @foreach (config('const.bath_room') as $key => $room)
                                            <option value="{{ $key }}" @if ($property->partation->bath_room == $key) selected @endif>
                                                {{ $room }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            {{-- <div class="row">
                                <div class="col-6 col-md-4 form-group">
                                    <label for="carpark">Car Park</label>
                                    <select name="carpark" class="form-control">
                                        <option value="">Select</option>
                                        @foreach (config('const.carpark') as $key => $park)
                                            <option value="{{ $key }}" @if ($property->partation->carpark == $key) selected @endif>
                                                {{ $park }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div> --}}
                        </div>
                        {{-- For Property sale --}}
                        @if ($property->properties_type == 1)
                            {{-- Price --}}
                            <div class="form-group">
                                <h5>Sale Price</h5>
                                <hr>
                                <div class="row">
                                    <div class="col form-group">
                                        <label for="sale_price">Grand Total Price</label>
                                        <input value="{{ $property->price->price }}" type="number" name="sale_price"
                                            class="form-control">
                                    </div>
                                    <div class="col form-group">
                                        <label for="sale_area">Area Type</label>
                                        <select name="sale_area" class="form-control">
                                            <option value="">Select</option>
                                            @foreach (config('const.area') as $key => $area)
                                                <option value="{{ $key }}" @if ($property->price->area == $key) selected @endif>
                                                    {{ $area }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col form-group">
                                        <label for="sale_price_by_area">Price By Area</label>
                                        <input value="{{ $property->price->price_by_area }}" type="text"
                                            name="sale_price_by_area" class="form-control">
                                    </div>
                                    <div class="col form-group">
                                        <label for="sale_currency_code">Currency Code</label>
                                        <select name="sale_currency_code" class="form-control">
                                            <option value="">Select</option>
                                            @foreach (config('const.currency_code') as $key => $currency)
                                                <option value="{{ $key }}" @if ($property->price->currency_code == $key) selected @endif>
                                                    {{ $currency }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                        @else
                            {{-- Rent --}}
                            <div class="form-group">
                                <h5>Rent Price</h5>
                                <hr>
                                <div class="row">
                                    <div class="col form-group">
                                        <label for="price">Grand Rent Total Price</label>
                                        <input value="{{ $property->rentprice->price }}" type="number" name="price"
                                            class="form-control">
                                    </div>
                                    <div class="col form-group">
                                        <label for="area">Area Type</label>
                                        <select name="area" class="form-control">
                                            <option value="">Select</option>
                                            @foreach (config('const.area') as $key => $area)
                                                <option value="{{ $key }}" @if ($property->rentprice->area == $key) selected @endif>
                                                    {{ $area }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col form-group">
                                        <label for="price_by_area">Rent Price By Area</label>
                                        <input value="{{ $property->rentprice->price_by_area }}" type="number"
                                            name="price_by_area" class="form-control">
                                    </div>
                                    <div class="col form-group">
                                        <label for="currency_code">Currency Code</label>
                                        <select name="currency_code" class="form-control">
                                            <option value="">Select</option>
                                            @foreach (config('const.currency_code') as $key => $currency)
                                                <option value="{{ $key }}" @if ($property->rentprice->currency_code == $key) selected @endif>
                                                    {{ $currency }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col form-group">
                                        <label for="minimum_month">Minimun Month</label>
                                        <select name="minimum_month" class="form-control">
                                            <option value="">Select</option>
                                            @foreach (config('const.minimum_month') as $key => $month)
                                                <option value="{{ $key }}" @if ($property->rentprice->minimum_month == $key) selected @endif>
                                                    {{ $month }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col form-group">
                                        <label for="rent_pay_type">Pay For Rent Type</label>
                                        <select name="rent_pay_type" class="form-control">
                                            <option value="">Select</option>
                                            @foreach (config('const.rent_pay_type') as $key => $rent_pay_type)
                                                <option value="{{ $key }}" @if ($property->rentprice->rent_pay_type == $key) selected @endif>
                                                    {{ $rent_pay_type }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col form-group">
                                        <label for="rent_payby_daily">Rent Pay By Daily</label>
                                        <select name="rent_payby_daily" class="form-control">
                                            <option value="">Select</option>
                                            @foreach (config('const.rent_payby_daily') as $key => $rent_payby_daily)
                                                <option value="{{ $key }}" @if ($property->rentprice->rent_payby_daily == $key) selected @endif>
                                                    {{ $rent_payby_daily }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                        @endif
                        {{-- Payment --}}
                        <div class="form-group">
                            <h5>Payment</h5>
                            <hr>
                            <div class="row">
                                <div class="col-md-6 form-group">
                                    <label for="area">Purchase Type</label>
                                    <select name="purchase_type" class="form-control">
                                        <option value="">Select</option>
                                        @foreach (config('const.purchase_type') as $key => $purchase_type)
                                            <option value="{{ $key }}" @if ($property->payment->purchase_type == $key) selected @endif>
                                                {{ $purchase_type }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                {{-- Property type for Sale 1=sale --}}
                                @if ($property->properties_type == 1)
                                    <div class="col-md-6 form-group">
                                        <label for="">Installment</label>
                                        <fieldset class="position-relative form-group">
                                            <div class="position-relative form-check">
                                                <label class="form-check-label">
                                                    <input name="installment" type="radio" value="1"
                                                        @if ($property->payment->installment == 1) checked @endif class="form-check-input"> Yes
                                                </label>
                                            </div>
                                            <div class="position-relative form-check">
                                                <label class="form-check-label">
                                                    <input name="installment" type="radio" value="0"
                                                        @if ($property->payment->installment == 0) checked @endif class="form-check-input"> No
                                                </label>
                                            </div>
                                        </fieldset>
                                    </div>
                                @endif
                            </div>
                        </div>
                        {{-- Situation --}}
                        <div class="form-group">
                            <h5>Situation</h5>
                            <hr>
                            <div class="row">
                                <div class="col form-group">
                                    <label for="year_of_construction">Year Of Construction</label>
                                    <select name="year_of_construction" class="form-control">
                                        <option value="">Select</option>
                                        @for ($i = (int) date('Y'); $i >= (int) date('Y') - 100; $i--)
                                            <option value='{{ $i }}' @if ($property->situation->year_of_construction == $i) selected @endif>
                                                {{ $i }}</option>
                                        @endfor
                                    </select>
                                </div>
                                <div class="col form-group">
                                    <label for="building_repairing">Building Repairing</label>
                                    <select name="building_repairing" class="form-control">
                                        <option value="">Select</option>
                                        @foreach (config('const.building_repairing') as $key => $repair)
                                            <option value="{{ $key }}" @if ($property->situation->building_repairing == $key) selected @endif>
                                                {{ $repair }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col form-group">
                                    <label for="building_condition">Building Condition</label>
                                    <select name="building_condition" class="form-control">
                                        <option value="">Select</option>
                                        @foreach (config('const.building_condition') as $key => $condition)
                                            <option value="{{ $key }}" @if ($property->situation->building_condition == $key) selected @endif>
                                                {{ $condition }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        {{-- Suppliment --}}
                        @if (1 == 2)
                            <div class="form-group">
                                <h5>Electric & Water Suppliment</h5>
                                <hr>
                                <div class="row">
                                    <div class="col form-group">
                                        <label for="">Water Supply</label>
                                        <fieldset class="position-relative form-group">
                                            <div class="position-relative form-check">
                                                <label class="form-check-label">
                                                    <input name="water" type="radio" class="form-check-input" value="1"
                                                        @if ($property->suppliment->water_sys == 1) checked @endif> Yes
                                                </label>
                                            </div>
                                            <div class="position-relative form-check">
                                                <label class="form-check-label">
                                                    <input name="water" type="radio" class="form-check-input" value="0"
                                                        @if ($property->suppliment->water_sys == 0) checked @endif> No
                                                </label>
                                            </div>
                                        </fieldset>
                                    </div>
                                    <div class="col form-group">
                                        <label for="">Electric Supply</label>
                                        <fieldset class="position-relative form-group">
                                            <div class="position-relative form-check">
                                                <label class="form-check-label">
                                                    <input name="electric" type="radio" class="form-check-input" value="1"
                                                        @if ($property->suppliment->electricity_sys == 1) checked @endif> Yes
                                                </label>
                                            </div>
                                            <div class="position-relative form-check">
                                                <label class="form-check-label">
                                                    <input name="electric" type="radio" class="form-check-input" value="0"
                                                        @if ($property->suppliment->electricity_sys == 0) checked @endif> No
                                                </label>
                                            </div>
                                        </fieldset>
                                    </div>
                                </div>
                            </div>
                        @endif
                        {{-- Unit Amenities --}}
                        <div class="form-group">
                            <h5>Unit Amenities</h5>
                            <hr>
                            <div class="row">
                                <div class="col form-group">
                                    <div class="position-relative form-check">
                                        <label class="form-check-label">
                                            <input type="checkbox" name="refrigerator" value="1" @if ($property->unitAmenity->refrigerator == 1) checked @endif
                                                class="form-check-input">
                                            Refrigerator
                                        </label>
                                    </div>
                                    <div class="position-relative form-check">
                                        <label class="form-check-label">
                                            <input type="checkbox" name="washing_machine" value="1"
                                                @if ($property->unitAmenity->washing_machine == 1) checked @endif class="form-check-input">
                                            Washing Machine
                                        </label>
                                    </div>
                                    <div class="position-relative form-check">
                                        <label class="form-check-label">
                                            <input type="checkbox" name="mirowave" value="1" @if ($property->unitAmenity->mirowave == 1) checked @endif
                                                class="form-check-input">
                                            Mirowave
                                        </label>

                                    </div>
                                    <div class="position-relative form-check">
                                        <label class="form-check-label">
                                            <input type="checkbox" name="gas_or_electric_stove" value="1"
                                                @if ($property->unitAmenity->gas_or_electric_stove == 1) checked @endif class="form-check-input">
                                            Gas or Electric Stove
                                        </label>
                                    </div>
                                    <div class="position-relative form-check">
                                        <label class="form-check-label">
                                            <input type="checkbox" name="air_conditioning" value="1"
                                                @if ($property->unitAmenity->air_conditioning == 1) checked @endif class="form-check-input">
                                            Air Conditioning
                                        </label>
                                    </div>
                                </div>
                                <div class="col form-group">
                                    <div class="position-relative form-check">
                                        <label class="form-check-label">
                                            <input type="checkbox" name="tv" value="1" @if ($property->unitAmenity->tv == 1) checked @endif
                                                class="form-check-input">
                                            TV
                                        </label>
                                    </div>
                                    <div class="position-relative form-check">
                                        <label class="form-check-label">
                                            <input type="checkbox" name="cable_satellite" value="1"
                                                @if ($property->unitAmenity->cable_satellite == 1) checked @endif class="form-check-input">
                                            Cable/
                                            Satellite
                                        </label>
                                    </div>
                                    <div class="position-relative form-check">
                                        <label class="form-check-label">
                                            <input type="checkbox" name="internet_wifi" value="1" @if ($property->unitAmenity->internet_wifi == 1) checked @endif
                                                class="form-check-input">
                                            Internet
                                            Wifi
                                        </label>
                                    </div>
                                    <div class="position-relative form-check">
                                        <label class="form-check-label">
                                            <input type="checkbox" name="water_heater" value="1" @if ($property->unitAmenity->water_heater == 1) checked @endif
                                                class="form-check-input">
                                            WaterHeater
                                        </label>
                                    </div>
                                    <div class="position-relative form-check">
                                        <label class="form-check-label">
                                            <input type="checkbox" name="security_cctv" value="1" @if ($property->unitAmenity->security_cctv == 1) checked @endif
                                                class="form-check-input">
                                            Security CCTV
                                        </label>
                                    </div>
                                </div>
                                <div class="col form-group">
                                    <div class="position-relative form-check">
                                        <label class="form-check-label">
                                            <input type="checkbox" name="fire_alarm" value="1" @if ($property->unitAmenity->fire_alarm == 1) checked @endif
                                                class="form-check-input">
                                            Fire Alarm
                                        </label>
                                    </div>
                                    <div class="position-relative form-check">
                                        <label class="form-check-label">
                                            <input type="checkbox" name="dinning_table" value="1" @if ($property->unitAmenity->dinning_table == 1) checked @endif
                                                class="form-check-input">
                                            Dinning
                                            Table
                                        </label>
                                    </div>
                                    <div class="position-relative form-check">
                                        <label class="form-check-label">
                                            <input type="checkbox" name="bed" value="1" @if ($property->unitAmenity->bed == 1) checked @endif
                                                class="form-check-input">
                                            Bed
                                        </label>
                                    </div>
                                    <div class="position-relative form-check">
                                        <label class="form-check-label">
                                            <input type="checkbox" name="sofa_chair" value="1" @if ($property->unitAmenity->sofa_chair == 1) checked @endif
                                                class="form-check-input">
                                            Sofa
                                            Chair
                                        </label>
                                    </div>
                                    <div class="position-relative form-check">
                                        <label class="form-check-label">
                                            <input type="checkbox" name="private_swimming_pool" value="1"
                                                @if ($property->unitAmenity->private_swimming_pool == 1) checked @endif class="form-check-input">
                                            Private Swimming Pool
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        {{-- Building Amenities --}}
                        <div class="form-group">
                            <h5>Building Amenities</h5>
                            <hr>
                            <div class="row">
                                <div class="col form-group">
                                    <div class="position-relative form-check"><label class="form-check-label"><input
                                                type="checkbox" name="elevator" value="1" class="form-check-input"
                                                @if ($property->buildingAmenity->elevator == 1) checked @endif>Elevator</label></div>
                                    <div class="position-relative form-check"><label class="form-check-label"><input
                                                type="checkbox" name="garage" value="1" class="form-check-input"
                                                @if ($property->buildingAmenity->garage == 1) checked @endif>Garage</label></div>
                                    <div class="position-relative form-check"><label class="form-check-label"><input
                                                type="checkbox" name="fitness_center" value="1" class="form-check-input"
                                                @if ($property->buildingAmenity->fitness_center == 1) checked @endif>Fitness Center</label></div>
                                    <div class="position-relative form-check"><label class="form-check-label"><input
                                                type="checkbox" name="security" value="1" class="form-check-input"
                                                @if ($property->buildingAmenity->security == 1) checked @endif>security</label></div>
                                </div>
                                <div class="col form-group">
                                    <div class="position-relative form-check"><label class="form-check-label"><input
                                                type="checkbox" name="swimming_pool" value="1" class="form-check-input"
                                                @if ($property->buildingAmenity->swimming_pool == 1) checked @endif>Swimming Pool</label></div>
                                    <div class="position-relative form-check"><label class="form-check-label"><input
                                                type="checkbox" name="spa_hot_tub" value="1" class="form-check-input"
                                                @if ($property->buildingAmenity->spa_hot_tub == 1) checked @endif>Spa/
                                            Hot Tub</label></div>
                                    <div class="position-relative form-check"><label class="form-check-label"><input
                                                type="checkbox" name="playground" value="1" class="form-check-input"
                                                @if ($property->buildingAmenity->playground == 1) checked @endif>Playground</label></div>
                                    <div class="position-relative form-check"><label class="form-check-label"><input
                                                type="checkbox" name="garden" value="1" class="form-check-input"
                                                @if ($property->buildingAmenity->garden == 1) checked @endif>Garden</label></div>
                                </div>
                                <div class="col form-group">
                                    {{-- <div class="position-relative form-check"><label class="form-check-label"><input
                                                type="checkbox" name="carpark" value="1" class="form-check-input"
                                                @if ($property->buildingAmenity->carpark == 1) checked @endif>Carpark</label></div> --}}
                                    <div class="position-relative form-check"><label class="form-check-label"><input
                                                type="checkbox" name="own_transformer" value="1" class="form-check-input"
                                                @if ($property->buildingAmenity->own_transformer == 1) checked @endif>Own Transformer</label></div>
                                    <div class="position-relative form-check"><label class="form-check-label"><input
                                                type="checkbox" name="disposal" value="1" class="form-check-input"
                                                @if ($property->buildingAmenity->disposal == 1) checked @endif>Disposal</label></div>

                                </div>
                            </div>
                        </div>
                        {{-- Lot Features --}}
                        <div class="form-group">
                            <h5>Lot Features</h5>
                            <hr>
                            <div class="row">
                                <div class="col form-group">
                                    <div class="position-relative form-check"><label class="form-check-label"><input
                                                type="checkbox" name="cornet_lot" value="1" class="form-check-input"
                                                @if ($property->lotFeature->cornet_lot == 1) checked @endif>Cornet
                                            Lot</label></div>
                                    <div class="position-relative form-check"><label class="form-check-label"><input
                                                type="checkbox" name="view_garden" value="1" class="form-check-input"
                                                @if ($property->lotFeature->garden == 1) checked @endif>View: Garden</label></div>
                                    <div class="position-relative form-check"><label class="form-check-label"><input
                                                type="checkbox" name="view_lake" value="1" class="form-check-input"
                                                @if ($property->lotFeature->lake == 1) checked @endif>View
                                            Lake</label></div>
                                </div>
                                <div class="col form-group">
                                    <div class="position-relative form-check"><label class="form-check-label"><input
                                                type="checkbox" name="view_mountain" value="1" class="form-check-input"
                                                @if ($property->lotFeature->mountain == 1) checked @endif>View: Mountain</label></div>
                                    <div class="position-relative form-check"><label class="form-check-label"><input
                                                type="checkbox" name="view_river" value="1" class="form-check-input"
                                                @if ($property->lotFeature->river == 1) checked @endif>View:
                                            River</label></div>
                                    <div class="position-relative form-check"><label class="form-check-label"><input
                                                type="checkbox" name="view_pool" value="1" class="form-check-input"
                                                @if ($property->lotFeature->pool == 1) checked @endif>View:
                                            Pool</label></div>

                                </div>
                                <div class="col form-group">
                                    <div class="position-relative form-check"><label class="form-check-label"><input
                                                type="checkbox" name="view_sea" value="1" class="form-check-input"
                                                @if ($property->lotFeature->sea == 1) checked @endif>View:
                                            Sea</label></div>
                                    <div class="position-relative form-check"><label class="form-check-label"><input
                                                type="checkbox" name="view_city" value="1" class="form-check-input"
                                                @if ($property->lotFeature->city == 1) checked @endif>View:
                                            City</label></div>
                                    <div class="position-relative form-check"><label class="form-check-label"><input
                                                type="checkbox" name="view_pagoda" value="1" class="form-check-input"
                                                @if ($property->lotFeature->pagoda == 1) checked @endif>View:
                                            Pagoda</label></div>
                                </div>
                            </div>
                        </div>
                        {{-- Image --}}
                        <div class="form-group">
                            <h5>Images</h5>
                            <hr>
                            <div class="input-field">
                                <label class="active">Photos</label>
                                <div class="input-images-2" style="padding-top: .5rem;"></div>
                            </div>
                        </div>
                        {{-- Additional Note --}}
                        <div class="form-group">
                            <h5>Additional Note</h5>
                            <hr>
                            <div class="row">
                                <div class="col form-group">
                                    <textarea name="note"
                                        class="form-control">{{ $property->suppliment->note ?? '' }}</textarea>
                                </div>
                            </div>
                        </div>
                        {{-- Terms & Condition --}}
                        <div class="row">
                            <div class="col-6 col-md-5 form-group">
                                <input name="agreecheck" type="checkbox" id="agreecheck">
                                <label for="agreecheck">By posting this content, I agree to be contacted by affiliates</label>
                            </div>
                        </div>
                        {{-- Submit Button --}}
                        <div class="row">
                            <div class="col form-group">
                                <button class="btn btn-secondary back-btn">Back</button>
                                <button type="submit" class="btn btn-primary" id="agreebtn">Create</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection
@section('script')
    {!! JsValidator::formRequest('App\Http\Requests\ApartCondoUpdateRequest', '#update') !!}
    @include('backend.agent.property.rent_script')
    <script>
        $(document).ready(function() {
            $('.area').hide();
            $('.area_widthxlenght').hide();
            var type = $('.area_option').val();
            if (type == 1) {
                    $('.area').hide();
                    $('.area_widthxlenght').show();
                }
            if (type == 2) {
                $('.area').show();
                $('.area_widthxlenght').hide();
            }
            $('.area_option').on('change', function() {
                $('.area').hide();
                $('.area_widthxlenght').hide();
                var type = this.value;
                if (type == 1) {
                    $('.area').hide();
                    $('.area_widthxlenght').show();
                }
                if (type == 2) {
                    $('.area').show();
                    $('.area_widthxlenght').hide();
                }
            });
        });
    </script>
@endsection
