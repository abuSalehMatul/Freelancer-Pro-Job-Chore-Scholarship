@extends('job.front-end.master', ['body_class' => 'wt-innerbgcolor'])
@push('stylesheets')
    <link href="{{ asset('css/owl.carousel.min.css') }}" rel="stylesheet">
@endpush
@section('title'){{ trans('lang.freelancers') }} @stop
@section('description', 'This is freelancer view description tag')
@section('content')
    @php $breadcrumbs = Breadcrumbs::generate('searchResults'); @endphp
    <div class="wt-haslayout wt-innerbannerholder">
        <div class="container">
            <div class="row justify-content-md-center">
                <div class="col-xs-12 col-sm-12 col-md-8 push-md-2 col-lg-6 push-lg-3">
                    <div class="wt-innerbannercontent">
                        <div class="wt-title">
                            <h2>{{ trans('lang.freelancers') }}</h2>
                        </div>
                        @if (count($breadcrumbs))
                            <ol class="wt-breadcrumb">
                                @foreach ($breadcrumbs as $breadcrumb)
                                    @if ($breadcrumb->url && !$loop->last)
                                        <li><a href="{{{ $breadcrumb->url }}}">{{{ $breadcrumb->title }}}</a></li>
                                    @else
                                        <li class="active">{{{ $breadcrumb->title }}}</li>
                                    @endif
                                @endforeach
                            </ol>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
    @if (!empty($categories) && $categories->count() > 0)
        <div class="wt-categoriesslider-holder wt-haslayout">
            <div class="wt-title">
                <h2>{{ trans('lang.browse_job_cats') }}</h2>
            </div>
            <div id="wt-categoriesslider" class="wt-categoriesslider owl-carousel">
                @foreach ($categories as $cat)
                    @php
                        $category = \App\JobModel\JobCategory::find($cat->id);
                        $active = (!empty($_GET['category']) && in_array($cat->id, $_GET['category'])) ? 'active-category' : '';
                        $active_wrapper = ( !empty($_GET['category']) && in_array($cat->id, $_GET['category'])) ? 'active-category-wrapper' : '';
                    @endphp
                    <div class="wt-categoryslidercontent item {{$active_wrapper}}">
                        <figure><img src="{{{ asset(Helper::getCategoryImage($cat->image)) }}}" alt="{{{ $cat->title }}}"></figure>
                        <div class="wt-cattitle">
                        <h3><a href="{{{url('Job/search-results?type=job&category%5B%5D='.$cat->slug)}}}" class="{{$active}}">{{{ $cat->title }}}</a></h3>
                            <span>Items: {{{$category->jobs->count()}}}</span>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    @endif
    <div class="wt-haslayout wt-main-section" id="user_profile">
        @if (Session::has('payment_message'))
            @php $response = Session::get('payment_message') @endphp
            <div class="flash_msg">
                <flash_messages :message_class="'{{{$response['code']}}}'" :time ='5' :message="'{{{ $response['message'] }}}'" v-cloak></flash_messages>
            </div>
        @endif
        <div class="wt-haslayout">
            <div class="container">
                <div class="row">
                    <div id="wt-twocolumns" class="wt-twocolumns wt-haslayout">
                        <div class="col-xs-12 col-sm-12 col-md-5 col-lg-5 col-xl-4 float-left">
                            @include('job.front-end.freelancers.filters')
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-7 col-lg-7 col-xl-8 float-left">
                            <div class="wt-userlistingholder wt-userlisting wt-haslayout">
                                <div class="wt-userlistingtitle">
                                    @if (!empty($users))
                                        <span>{{ trans('lang.01') }} {{$users->count()}} of {{\App\User::role('freelancer')->count()}} results @if (!empty($keyword)) for <em>"{{{$keyword}}}"</em> @endif</span>
                                    @endif
                                </div>
                                @if (!empty($users))
                                    @foreach ($users as $key => $freelancer)
                                        @php
                                            $user_image = !empty($freelancer->profile->avater) ?
                                                            '/uploads/users/'.$freelancer->id.'/'.$freelancer->profile->avater :
                                                            'images/user.jpg';
                                            $flag = !empty($freelancer->location->flag) ? Helper::getLocationFlag($freelancer->location->flag) :
                                                    '/images/img-01.png';
                                            $avg_rating = \App\Review::where('receiver_id', $freelancer->id)->sum('avg_rating');
                                            $rating  = $avg_rating != 0 ? round($avg_rating/\App\Review::count()) : 0;
                                            $reviews = \App\Review::where('receiver_id', $freelancer->id)->get();
                                            $stars  = $reviews->sum('avg_rating') != 0 ? $reviews->sum('avg_rating')/20*100 : 0;
                                            $feedbacks = \App\Review::select('feedback')->where('receiver_id', $freelancer->id)->count();
                                            $verified_user = \App\User::select('user_verified')->where('id', $freelancer->id)->pluck('user_verified')->first();
                                            $save_freelancer = !empty(auth()->user()->profile->saved_freelancer) ? unserialize(auth()->user()->profile->saved_freelancer) : array();
                                            $badge = Helper::getUserBadge($freelancer->id);
                                            $feature_class = (!empty($badge) && $freelancer->expiry_date >= $current_date) ? 'wt-featured' : 'wt-exp';
                                            $badge_color = !empty($badge) ? $badge->color : '';
                                            $badge_img  = !empty($badge) ? $badge->image : '';
                                        @endphp
                                        <div class="wt-userlistinghold {{ $feature_class }}">
                                            @if ($freelancer->expiry_date >= $current_date && !empty($freelancer->badge_id))
                                                <span class="wt-featuredtag" style="border-top: 40px solid {{ $badge_color }};">
                                                    @if (!empty($badge_img))
                                                        <img src="{{{ asset(Helper::getBadgeImage($badge_img)) }}}" alt="{{ trans('lang.is_featured') }}" data-tipso="Plus Member" class="template-content tipso_style">
                                                    @else
                                                        <i class="wt-expired fas fa-bold"></i>
                                                    @endif
                                                </span>
                                            @endif
                                            <figure class="wt-userlistingimg">
                                                <img src="{{{ asset($user_image) }}}" alt="{{ trans('lang.img') }}">
                                            </figure>
                                            <div class="wt-userlistingcontent">
                                                <div class="wt-contenthead">
                                                    <div class="wt-title">
                                                        <a href="{{{ url('Job/profile/'.$freelancer->slug) }}}">
                                                            @if ($verified_user == 1)
                                                                <i class="fa fa-check-circle"></i>
                                                            @endif
                                                            {{{ Helper::getUserName($freelancer->id) }}}
                                                        </a>
                                                        @if (!empty($freelancer->profile->tagline))
                                                            <h2><a href="{{{ url('Job/profile/'.$freelancer->slug) }}}">{{{ $freelancer->profile->tagline }}}</a></h2>
                                                        @endif
                                                    </div>
                                                    <ul class="wt-userlisting-breadcrumb">
                                                        @if (!empty($freelancer->profile->hourly_rate))
                                                            <li><span><i class="far fa-money-bill-alt"></i>
                                                                {{ (!empty($symbol['symbol'])) ? $symbol['symbol'] : '$' }}{{{ $freelancer->profile->hourly_rate }}} {{ trans('lang.per_hour') }}</span>
                                                            </li>
                                                        @endif
                                                        @if (!empty($freelancer->location))
                                                            <li><span><img src="{{{ asset($flag)}}}" alt="Flag"> {{{ !empty($freelancer->location->title) ? $freelancer->location->title : '' }}}</span></li>
                                                        @endif
                                                        @if (in_array($freelancer->id, $save_freelancer))
                                                            <li class="wt-btndisbaled">
                                                                <a href="javascrip:void(0);" class="wt-clicksave wt-clicksave">
                                                                    <i class="fa fa-heart"></i>
                                                                    {{ trans('lang.saved') }}
                                                                </a>
                                                            </li>
                                                        @else
                                                            <li v-cloak>
                                                                <a href="javascrip:void(0);" class="wt-clicklike" id="freelancer-{{$freelancer->id}}" @click.prevent="add_wishlist('freelancer-{{$freelancer->id}}', {{$freelancer->id}}, 'saved_freelancer', '{{trans("lang.saved")}}')">
                                                                    <i class="fa fa-heart"></i>
                                                                    <span class="save_text">{{ trans('lang.click_to_save') }}</span>
                                                                </a>
                                                            </li>
                                                        @endif
                                                    </ul>
                                                </div>
                                                <div class="wt-rightarea">
                                                    <span class="wt-stars"><span style="width: {{ $stars }}%;"></span></span>
                                                    <span class="wt-starcontent">{{{ $rating }}}<sub>{{ trans('lang.5') }}</sub> <em>({{{ $feedbacks }}} {{ trans('lang.feedbacks') }})</em></span>
                                                </div>
                                            </div>
                                            @if (!empty($freelancer->profile->description))
                                                <div class="wt-description">
                                                    <p>{{{ str_limit($freelancer->profile->description, 180) }}}</p>
                                                </div>
                                            @endif
                                            @if (!empty($freelancer->skills))
                                                <div class="wt-tag wt-widgettag">
                                                    @foreach($freelancer->skills as $skill)
                                                        <a href="{{{url('Job/search-results?type=job&skills%5B%5D='.$skill->slug)}}}">{{{ $skill->title }}}</a>
                                                    @endforeach
                                                </div>
                                            @endif
                                        </div>
                                    @endforeach
                                    @if ( method_exists($users,'links') )
                                        {{ $users->links('pagination.custom') }}
                                    @endif
                                @else
                                    @include('job.errors.no-record')
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @push('scripts')
        <script src="{{ asset('js/owl.carousel.min.js') }}"></script>
        <script>
            jQuery("#wt-categoriesslider").owlCarousel({
                item: 6,
                loop:true,
                nav:false,
                margin: 0,
                autoplay:false,
                center: true,
                responsiveClass:true,
                responsive:{
                    0:{items:1,},
                    481:{items:2,},
                    768:{items:3,},
                    1440:{items:4,},
                    1760:{items:6,}
                }
            });
        </script>
    @endpush
@endsection
