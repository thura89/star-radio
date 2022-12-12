@extends('backend.agent.layouts.app')
@section('title', 'Property Management')
@section('property-active', 'mm-active')
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
                    <div>Property Create @if ($category == 2) Land For House @elseif($category == 5) Land @elseif($category == 7) Industrial Zone @endif
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
                    <form action="{{ route('agent.property.create.landhouse_land') }}" method="POST" id="create"
                        enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="property_category" value="{{ $category }}">
                        {{-- Property Type --}}
                        <div class="form-group">
                            <h5>Property Type</h5>
                            <hr>
                            <div class="row">
                                <div class="col-6 col-md-4 form-group">
                                    <label for="price">Property Type</label>
                                    <select name="property_type" class="property_type form-control">
                                        <option value="">Select Type</option>
                                        @foreach (config('const.property_type') as $key => $area)
                                            <option value="{{ $key }}">{{ $area }}</option>
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
                                    <input type="text" name="title" class="form-control">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col form-group">
                                    <label for="region">Region</label>
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
                                    <select name="township" class="township form-control">

                                    </select>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col form-group">
                                    <label for="street_name">Street Name</label>
                                    <input type="text" name="street_name" class="form-control">
                                </div>
                                <div class="col form-group">
                                    <label for="type_of_street">Type of Street</label>
                                    <select name="type_of_street" class="form-control">
                                        <option value="">Select</option>
                                        @foreach (config('const.type_of_street') as $key => $street)
                                            <option value="{{ $key }}">{{ $street }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col form-group">
                                    <label for="ward">Ward</label>
                                    <input type="text" name="ward" class="form-control">
                                </div>
                                @if ($category == 7)
                                <div class="col form-group">
                                    <label for="building_name">Industrial Name</label>
                                    <input type="text" name="building_name" class="form-control">
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
                                                <option value="{{ $key }}">{{ $area_opt }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-4 area_widthxlenght">
                                    <div class="row area_widthxlenght">
                                        <div class="col form-group">
                                            <label for="width">Width</label>
                                            <input type="number" name="width" class="form-control">
                                        </div>
                                        <div class="col form-group">
                                            <label for="length">Length</label>
                                            <input type="number" name="length" class="form-control">
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-4 area">
                                    <div class="row area">
                                        <div class="col form-group">
                                            <label for="area_size">Area Size</label>
                                            <input type="number" name="area_size" class="form-control">
                                        </div>
                                        <div class="col form-group">
                                            <label for="area_unit">Area Unit</label>
                                            <select name="area_unit" class="area form-control">
                                                <option value="">Select</option>
                                                @foreach (config('const.area') as $key => $val)
                                                    <option value="{{ $key }}">{{ $val }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        {{-- Partation --}}
                        @if ($category == 2 || $category == 7)
                        <div class="form-group">
                            <h5>Partation</h5>
                            <hr>
                            <div class="row">
                                <div class="col-6 col-md-4 form-group">
                                    <label for="width">Partation Type</label>
                                    <select name="partation_type" class="partation_type form-control">
                                        <option value="">Select</option>
                                        @foreach (config('const.partation_type') as $key => $type)
                                            <option value="{{ $key }}">{{ $type }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="col-6 col-md-4 form-group partation_hider">
                                    <label for="level">Bed Room</label>
                                    <select name="bed_room" class="form-control">
                                        <option value="">Select</option>
                                        @foreach (config('const.bed_room') as $room)
                                            <option value="{{ $room }}">{{ $room }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="col-6 col-md-4 form-group partation_hider">
                                    <label for="bath_room">Bath Room</label>
                                    <select name="bath_room" class="form-control">
                                        <option value="">Select</option>
                                        @foreach (config('const.bath_room') as $room)
                                            <option value="{{ $room }}">{{ $room }}</option>
                                        @endforeach
                                    </select>
                                </div>

                            </div>
                            {{-- <div class="row">
                                <div class="col-6 col-md-4 form-group">
                                    <label for="carpark">CarPark</label>
                                    <select name="carpark" class="form-control">
                                        <option value="">Select</option>
                                        @foreach (config('const.carpark') as $park)
                                            <option value="{{ $park }}">{{ $park }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div> --}}
                        </div>
                        @endif
                        {{-- Price --}}
                        <div class="price_sale_hider form-group">
                            <h5>Sale Price</h5>
                            <hr>
                            <div class="row">
                                <div class="col form-group">
                                    <label for="sale_price">Grand Total Price</label>
                                    <input type="number" name="sale_price" class="form-control">
                                </div>
                                <div class="col form-group">
                                    <label for="sale_area">Area Type</label>
                                    <select name="sale_area" class="form-control">
                                        <option value="">Select</option>
                                        @foreach (config('const.area') as $key => $area)
                                            <option value="{{ $key }}">{{ $area }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col form-group">
                                    <label for="sale_price_by_area">Price By Area</label>
                                    <input type="text" name="sale_price_by_area" class="form-control">
                                </div>
                                <div class="col form-group">
                                    <label for="sale_currency_code">Currency Code</label>
                                    <select name="sale_currency_code" class="form-control">
                                        <option value="">Select</option>
                                        @foreach (config('const.currency_code') as $key => $currency)
                                            <option value="{{ $key }}">{{ $currency }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        {{-- Rent --}}
                        <div class="price_rent_hider form-group">
                            <h5>Rent Price</h5>
                            <hr>
                            <div class="row">
                                <div class="col form-group">
                                    <label for="price">Grand Rent Total Price</label>
                                    <input type="number" name="price" class="form-control">
                                </div>
                                <div class="col form-group">
                                    <label for="area">Area Type</label>
                                    <select name="area" class="form-control">
                                        <option value="">Select</option>
                                        @foreach (config('const.area') as $key => $area)
                                            <option value="{{ $key }}">{{ $area }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col form-group">
                                    <label for="price_by_area">Rent Price By Area</label>
                                    <input type="number" name="price_by_area" class="form-control">
                                </div>
                                <div class="col form-group">
                                    <label for="currency_code">Currency Code</label>
                                    <select name="currency_code" class="form-control">
                                        <option value="">Select</option>
                                        @foreach (config('const.currency_code') as $key => $currency)
                                            <option value="{{ $key }}">{{ $currency }}</option>
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
                                            <option value="{{ $key }}">{{ $month }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col form-group">
                                    <label for="rent_pay_type">Pay For Rent Type</label>
                                    <select name="rent_pay_type" class="form-control">
                                        <option value="">Select</option>
                                        @foreach (config('const.rent_pay_type') as $key => $rent_pay_type)
                                            <option value="{{ $key }}">{{ $rent_pay_type }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col form-group">
                                    <label for="rent_payby_daily">Rent Pay By Daily</label>
                                    <select name="rent_payby_daily" class="form-control">
                                        <option value="">Select</option>
                                        @foreach (config('const.rent_payby_daily') as $key => $rent_payby_daily)
                                            <option value="{{ $key }}">{{ $rent_payby_daily }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
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
                                            <option value="{{ $key }}">{{ $purchase_type }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-6 form-group price_sale_hider">
                                    <label for="">Installment</label>
                                    <fieldset class="position-relative form-group">
                                        <div class="position-relative form-check">
                                            <label class="form-check-label">
                                                <input name="installment" type="radio" class="form-check-input"> Yes
                                            </label>
                                        </div>
                                        <div class="position-relative form-check">
                                            <label class="form-check-label">
                                                <input name="installment" type="radio" class="form-check-input"> No
                                            </label>
                                        </div>
                                    </fieldset>
                                </div>
                            </div>
                        </div>
                        {{-- Situation --}}
                        <div class="form-group">
                            <h5>Situation</h5>
                            <hr>
                            <div class="row">
                                <div class="col form-group">
                                    <label for="building_repairing">Repairing</label>
                                    <select name="building_repairing" class="form-control">
                                        <option value="">Select</option>
                                        @foreach (config('const.building_repairing') as $key => $repair)
                                            <option value="{{ $key }}">{{ $repair }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                {{-- Land House --}}
                                @if ($category == 2)
                                <div class="col form-group">
                                    <label for="fence_condition">Fence Condition</label>
                                    <select name="fence_condition" class="form-control">
                                        <option value="">Select</option>
                                        @foreach (config('const.fence_condition') as $key => $condition)
                                            <option value="{{ $key }}">{{ $condition }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                {{-- Land --}}
                                @elseif($category == 5)
                                <div class="col form-group">
                                    <label for="land_type">Land Type</label>
                                    <select name="land_type" class="form-control">
                                        <option value="">Select</option>
                                        @foreach (config('const.land_type') as $key => $type)
                                            <option value="{{ $key }}">{{ $type }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                {{-- Industrial --}}
                                @elseif($category == 7)
                                <div class="col form-group">
                                    <label for="industrial_type">Industrial Type</label>
                                    <select name="industrial_type" class="form-control">
                                        <option value="">Select</option>
                                        @foreach (config('const.industrial_type') as $key => $type)
                                            <option value="{{ $key }}">{{ $type }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col form-group">
                                    <label for="year_of_construction">Year Of Construction</label>
                                    <select name="year_of_construction" class="form-control">
                                        <option value="">Select</option>
                                        @for ($i=(int)date('Y');$i>=((int)date('Y') - 100);$i--)
                                            <option value='{{$i}}'>{{$i}}</option>
                                        @endfor
                                    </select>
                                </div>
                                <div class="col form-group">
                                    <label for="building_condition">Building Condition</label>
                                    <select name="building_condition" class="form-control">
                                        <option value="">Select</option>
                                        @foreach (config('const.building_condition') as $key => $condition)
                                            <option value="{{ $key }}">{{ $condition }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                @endif
                            </div>
                        </div>
                        {{-- Suppliment --}}
                        {{-- <div class="form-group">
                            <h5>Electric & Water Suppliment</h5>
                            <hr>
                            <div class="row">
                                <div class="col form-group">
                                    <label for="">Water Supply</label>
                                    <fieldset class="position-relative form-group">
                                        <div class="position-relative form-check">
                                            <label class="form-check-label">
                                                <input name="water" type="radio" value="1" class="form-check-input"> Yes
                                            </label>
                                        </div>
                                        <div class="position-relative form-check">
                                            <label class="form-check-label">
                                                <input name="water" type="radio" value="0" class="form-check-input"> No
                                            </label>
                                        </div>
                                    </fieldset>
                                </div>
                                <div class="col form-group">
                                    <label for="">Electric Supply</label>
                                    <fieldset class="position-relative form-group">
                                        <div class="position-relative form-check">
                                            <label class="form-check-label">
                                                <input name="electric" type="radio" value="1" class="form-check-input"> Yes
                                            </label>
                                        </div>
                                        <div class="position-relative form-check">
                                            <label class="form-check-label">
                                                <input name="electric" type="radio" value="0" class="form-check-input"> No
                                            </label>
                                        </div>
                                    </fieldset>
                                </div>
                            </div>
                        </div> --}}
                        {{-- Image --}}
                        <div class="form-group">
                            <h5>Images</h5>
                            <hr>
                            <div class="input-field">
                                <label class="active">Photos</label>
                                <div class="input-images-1" style="padding-top: .5rem;"></div>
                            </div>
                        </div>
                        {{-- Additional Note --}}
                        <div class="form-group">
                            <h5>Additional Note</h5>
                            <hr>
                            <div class="row">
                                <div class="col form-group">
                                    <textarea name="note" class="form-control"></textarea>
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
    {!! JsValidator::formRequest('App\Http\Requests\landHouseCreateRequest', '#create') !!}
    @include('backend.agent.property.script')
    <script>
        $('.price_sale_hider').hide();
        $('.price_rent_hider').hide();
        $('.property_type').on('change', function(){
            var type = this.value;
            if (type == 1) {
                $('.price_rent_hider').hide();
                $('.price_sale_hider').show();
            }
            if (type == 2) {
                $('.price_sale_hider').hide();
                $('.price_rent_hider').show();
            }
        });   
        $('.area').hide();
        $('.area_widthxlenght').hide();
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
    </script>
@endsection
