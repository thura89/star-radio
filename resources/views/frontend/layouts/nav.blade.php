<nav class="navbar navbar-default">
    <div class="container">
      <div class="navbar-header">
        <a class="navbar-brand" style="width: 12%" href="{{ route('home.index') }}">
            <img src="{{ asset('starfm/assets/images/starfm_logo.jpg') }}" alt=""/>
        </a>
      </div>
      
      <div id="dl-menu" class="radio-style xv-menuwrapper responsive-menu">
          <button class="menuTrigger"><i class="fa fa-navicon"></i></button>
          <div class="clearfix"></div>
          <ul class="dl-menu">
              <li><a href="{{ route('home.index') }}">@lang('front_index.home')</a></li>
              <li><a href="{{ route('home.programs')}}">@lang('front_index.program')</a></li>
              <li class="parent"><a href="#">@lang('front_index.news')</a>
                    <ul class="dl-submenu">
                        <li><a href="{{ route('home.news.all',config('const.LocalNews'))}}">@lang('front_index.local_news')</a></li>
                        <li><a href="{{ route('home.news.all',config('const.InternationalNews'))}}">@lang('front_index.internationl_news')</a></li>
                    </ul>
              </li>
              <li class="parent"><a href="#">@lang('front_index.other_news')</a>
                <ul class="dl-submenu">
                    <li><a href="{{ route('home.news.all',config('const.Economic'))}}">@lang('front_index.economic')</a></li>
                    <li><a href="{{ route('home.news.all',config('const.Social'))}}">@lang('front_index.social')</a></li>
                    <li><a href="{{ route('home.news.all',config('const.Health'))}}">@lang('front_index.health')</a></li>
                    <li><a href="{{ route('home.news.all',config('const.TutaYata'))}}">@lang('front_index.tutayata')</a></li>
                </ul>
          </li>
              <li><a href="{{ route('home.events')}}">@lang('front_index.events')</a></li>
              <li class="parent"><a href="{{ route('home.nobles') }}">@lang('front_index.noble')</a>
                <ul class="dl-submenu">
                    <li><a href="{{ route('home.nobles.cate',config('const.DailyNewsPaper'))}}">@lang('front_index.daily_news')</a></li>
                    <li><a href="{{ route('home.nobles.cate',config('const.Book'))}}">@lang('front_index.book')</a></li>
                </ul>
              </li>
              <li><a href="{{ route('home.about')}}">@lang('front_index.about')</a></li>
              <li><a href="{{ route('home.contact')}}">@lang('front_index.contact')</a></li>
              <li><a href="{{ route('home.songRequest')}}">@lang('front_index.song_request')</a></li>
              <li class="parent"><a href="" class="green_theme">{{ Str::upper(Session::get('locale')) }}</a>
                  <ul class="dl-submenu">
                      <li><a href="" class="lang" data-id="en">EN</a></li>
                      <li><a href="" class="lang" data-id="mm">MM</a></li>
                  </ul>
              </li>
          </ul>
      </div><!-- /dl-menuwrapper -->
    </div>
</nav>

<style>
.lang{
    display: block;
    line-height: 30px;
    color: #a0a0a0;
    text-transform: capitalize;
    font-weight: 600;
    font-size: 13px;
    text-decoration: none;
    cursor: pointer;
}
</style>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
