@extends('backend.layouts.app')
@section('title', 'Create Agent User')
@section('property-active', 'mm-active')
@section('content')
    <div class="app-main__inner">
        <div class="app-page-title">
            <div class="page-title-wrapper">
                <div class="page-title-heading">
                    <div class="page-title-icon">
                        <i class="pe-7s-users icon-gradient bg-mean-fruit">
                        </i>
                    </div>
                    <div>Create Property
                    </div>
                </div>
            </div>
        </div>
        <div class="content">
            <div class="card">
                <div class="card-body">
                    <h5>Property</h5>
                    <hr>
                    <form action="{{ route('admin.property.create') }}" method="get" id="create">
                    <div class="row">
                        
                        <div class="col form-group">
                            <label for="property_category">Property</label>
                            <select name="property_category" class="property_category form-control">
                                <option value="">Select</option>
                                @foreach (config('const.property_category') as $key => $category)
                                    <option value="{{ $key }}">{{ $category }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col form-group">
                            <label for="property_type">Property Type</label>
                            <select name="property_type" class="property_type form-control">
                                <option value="">Select</option>
                                @foreach (config('const.property_type') as $key => $type)
                                    <option value="{{ $key }}">{{ $type }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col form-group">    
                            <button class="btn btn-secondary back-btn">Back</button>
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </div>
                </form>
                </div>
            </div>
        </div>
        <br/>
    </div>
@endsection
@section('script')
    @include('backend.property.create.script')
@endsection
