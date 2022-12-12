@extends('backend.agent.layouts.app')
@section('title', 'AGent Analytic Dashboard')
@section('dashboard-active', 'mm-active')
@section('content')
<div class="app-main__inner">
    <div class="app-page-title">
        <div class="page-title-wrapper">
            <div class="page-title-heading">
                <div class="page-title-icon">
                    <i class="pe-7s-wallet icon-gradient bg-plum-plate">
                    </i>
                </div>
                <div>Dashboard Boxes
                    <div class="page-title-subheading">Highly configurable boxes best used for showing numbers in an user friendly way.
                    </div>
                </div>
            </div>
        </div>
    </div>            
    <div class="">
        <div class="row">
            <div class="col-lg-6 col-xl-4">
                <div class="card mb-3 widget-content bg-night-fade">
                    <div class="widget-content-wrapper text-white">
                        <div class="widget-content-left">
                            <div class="widget-heading">Properties</div>
                            <div class="widget-subheading">Total Last Update Count</div>
                        </div>
                        <div class="widget-content-right">
                            <div class="widget-numbers text-white"><span>{{ count($properties)}}</span></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 col-xl-4">
                <div class="card mb-3 widget-content bg-premium-dark">
                    <div class="widget-content-wrapper text-white">
                        <div class="widget-content-left">
                            <div class="widget-heading">Want To Buy & Rent</div>
                            <div class="widget-subheading">Total Want To Buy & Rent Count</div>
                        </div>
                        <div class="widget-content-right">
                            <div class="widget-numbers text-warning"><span>{{ count($WantToBuyRents)}}</span></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
       
        

        

        
        
    </div>
</div>
@endsection
