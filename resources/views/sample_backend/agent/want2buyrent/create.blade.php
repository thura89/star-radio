@extends('backend.agent.layouts.app')
@section('title', 'Property Management')
@section('want2buyrent-active', 'mm-active')
@section('content')
    <div class="app-main__inner">
        <div class="app-page-title">
            <div class="page-title-wrapper">
                <div class="page-title-heading">
                    <div class="page-title-icon">
                        <i class="pe-7s-users icon-gradient bg-mean-fruit">
                        </i>
                    </div>
                    <div>Create Want2BuyRent
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
                    <form action="{{ route('agent.want2buyrent.store') }}" method="POST" id="create"
                        enctype="multipart/form-data">
                        @csrf
                        {{-- Property Type --}}
                        <div class="form-group">
                            <h5>Info</h5>
                            <hr>
                            <div class="row">
                                <div class="col-6 col-md-6 form-group">
                                    <label for="properties_type">Property Type</label>
                                    <select name="properties_type" class="property_type form-control">
                                        <option value="">Select Type</option>
                                        @foreach (config('const.property_type') as $key => $property_type)
                                            <option value="{{ $key }}">{{ $property_type }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-6 col-md-6 form-group">
                                    <label for="properties_category">Property Category</label>
                                    <select name="properties_category" class="property_category form-control">
                                        <option value="">Select Category</option>
                                        @foreach (config('const.property_category') as $key => $category)
                                            <option value="{{ $key }}">{{ $category }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-6 col-md-6 form-group">
                                    <label for="title">Title</label>
                                    <input type="text" name="title" class="form-control">
                                </div>
                                <div class="col-6 col-md-6 form-group">
                                    <label for="phone_no">Phone No</label>
                                    <input type="number" value="{{ Auth()->user()->phone }}" name="phone_no" class="form-control">
                                </div>
                            </div>
                        </div>
                        {{-- address --}}
                        <div class="form-group">
                            <h5>Address</h5>
                            <hr>
                            <div class="row">
                                <div class="col form-group">
                                    <label for="region">Region</label>
                                    <select name="region" class="region form-control">
                                        <option value="">Select Region</option>
                                        @foreach ($regions as $key => $region)
                                            <option value="{{ $region->id }}">{{ $region->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col form-group">
                                    <label for="township">Township</label>
                                    <select name="township" class="township form-control">

                                    </select>
                                </div>
                            </div>
                        </div>
                        {{-- Area Size & condition --}}
                        <div class="form-group">
                            <h5>Area Size And Condition</h5>
                            <hr>
                            <div class="row">
                                <div class="col-md-6">
                                    <label for="front_area">Measurement</label>
                                    <select name="area_unit" class="form-control">
                                        @foreach (config('const.area') as $key => $area)
                                            <option value="{{ $key }}">{{ $area }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <div class="row">
                                        <div class="col-md-6 form-group">
                                            <label for="area_width">Width</label>
                                            <input type="number" name="area_width" class="form-control">
                                        </div>
                                        <div class="col-md-6 form-group">
                                            <label for="area_length">Length</label>
                                            <input type="number" name="area_length" class="form-control">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4 hider">
                                    <div class="form-group">
                                        <label for="fence_width">Floor Level</label>
                                        <select name="floor_level" class="form-control">
                                            <option value="">Please Select</option>
                                            @foreach (config('const.floor_level') as $key => $level)
                                                <option value="{{ $key }}">{{ $level }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-4 hider">
                                    <div class="form-group">
                                        <label for="furnished_status">Furnished Status</label>
                                        <select name="furnished_status" class="form-control">
                                            <option value="">Please Select</option>
                                            @foreach (config('const.furnished_status') as $key => $f_status)
                                                <option value="{{ $key }}">{{ $f_status }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="">Completion</label>
                                        <fieldset class="position-relative mt-2 form-group">
                                            <div class="position-relative form-check">
                                                <label class="form-check-label">
                                                    <input name="completion" type="radio" value="1"
                                                        class="form-check-input">
                                                    Complete
                                                </label>
                                                <label class="ml-4 form-check-label">
                                                    <input name="completion" type="radio" value="2"
                                                        class="form-check-input">
                                                    New Launch
                                                </label>
                                            </div>
                                        </fieldset>
                                    </div>
                                </div>

                            </div>
                        </div>
                        {{-- Budget Price --}}
                        <div class="form-group">
                            <h5>Budget Price</h5>
                            <hr>
                            <div class="row">
                                <div class="col form-group">
                                    <label for="budget_from">Budget From</label>
                                    <input type="number" name="budget_from" class="form-control">
                                </div>
                                <div class="col form-group">
                                    <label for="budget_to">Budget To</label>
                                    <input type="number" name="budget_to" class="form-control">
                                </div>
                                <div class="col form-group">
                                    <label for="currency_code">Currency Code</label>
                                    <select name="currency_code" class="form-control">
                                        @foreach (config('const.currency_code') as $key => $currency)
                                            <option value="{{ $key }}">{{ $currency }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        {{-- Detail --}}
                        <div class="form-group">
                            <h5>Detail Description</h5>
                            <hr>
                            <div class="row">
                                <div class="col form-group">
                                    <textarea name="descriptions" class="form-control"></textarea>
                                </div>
                            </div>
                        </div>
                        {{-- Broker --}}
                        <div class="form-group">
                            <h5>Broker</h5>
                            <hr>
                            <div class="row">
                                <div class="col form-group">
                                    <fieldset class="position-relative">
                                        <div class="position-relative form-check">
                                            <label class="form-check-label">
                                                <input name="co_broke" type="radio" value="1" class="form-check-input"> Yes
                                            </label>
                                            <label class="ml-4 form-check-label">
                                                <input name="co_broke" type="radio" value="0" class="form-check-input"> No
                                            </label>
                                        </div>
                                    </fieldset>
                                </div>
                            </div>
                        </div>
                        {{-- Terms And Condition --}}
                        <div class="form-group">
                            <h5>Terms And Condition</h5>
                            <hr>
                            {{-- Terms & Condition --}}
                            <div class="row">
                                <div class="col-6 col-md-5 form-group">
                                    <input name="terms_condition" type="checkbox" id="agreecheck">
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
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
    {!! JsValidator::formRequest('App\Http\Requests\CreateWant2BuyRentRequest', '#create') !!}
    @include('backend.agent.property.script')
    <script>
        $(document).ready(function() {
            $('.hider').hide();
            $('.property_category').on('change', function() {
                var category = this.value;

                if (category == 3) {
                    $('.hider').show();
                } else {
                    $('.hider').hide();
                }

            });
        })
    </script>
@endsection
