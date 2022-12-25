<!--=================================================
              Tweets
              ==================================================-->
<div class="parallax parallax_one text-bold text-center" data-stellar-background-ratio="0.5">
    <div class="parallax_inner">
        <!--=================================
                            Similar Album Content
                            =================================-->
        <section>
            <header>
                <div class="container">
                    <div class="row">
                        <div class="col-xs-12">
                            <h2 class="text-uppercase">@lang('front_index.advertise_here') .</h2>
                        </div>
                    </div>
                </div>
            </header>
            <!--section header-->

            <div class="container">
                <div class="row">
                    <div class="col-xs-12">
                        <div class="store-grid text-uppercase text-bold store-grid-slider">
                            @foreach (Helper::Ads() as $ad)
                                <div class="store-product">
                                    <figure>
                                        <img src="{{ $ad->ads_img_path() }}" width="265" height="265" />
                                    </figure>
                                </div>
                            @endforeach
                        </div>
                        <!--album-grid-->
                    </div>
                    <!--column-->
                </div>
                <!--row-->


                <div class="navigators text-bold text-uppercase text-center">
                    <div class="row" id="relatedAlbumsSlderNav"></div>
                </div>
            </div>
            <!--container-->

        </section>
    </div>
</div>
<!--parallax-->
<footer class="doc-footer text-uppercase text-center">
    <div class="container">
        <ul class="social-list style2 circular">
            <li><a href="#" class="fa fa-facebook"></a></li>
            <li><a href="#" class="fa fa-twitter"></a></li>
            <li><a href="#" class="fa fa-google-plus"></a></li>
            <li><a href="#" class="fa fa-tumblr"></a></li>
            <li><a href="#" class="fa fa-instagram"></a></li>
            <li><a href="#" class="fa fa-dribbble"></a></li>
            <li><a href="#" class="fa fa-tumblr"></a></li>
            <li><a href="#" class="fa fa-vimeo"></a></li>
        </ul>
        <div class="row">
            <div class="col-xs-12">
                <strong>&copy; Copyright 2023 StarFM</strong>
                <p>on StarFM you can listen to thousands songs and Programs</p>
            </div>
        </div>
    </div>
</footer>
