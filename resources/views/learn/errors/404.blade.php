@extends('learn.layout')

@section('content')
    <style type="text/css">
        .breadcrumb-section {
            background-image: url({{asset('learn/assets/images/logo/breadcrumb.png')}});
        }
        .vh{
            height: 70vh;
        }
        .display-center-bread{
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;

        }

    </style>
    <!-- Breadcrumb Section start -->
    <section class="breadcrumb-section " >
        <div class="container">
            <div class="row">
                <div class="col-md-12">

                    <!-- breadcrumb Section Start -->
                    <div class="display-center-bread vh">
                    <div class="breadcrumb-content">
                        @php
                        $page_title = 404
                        @endphp
                        <h1>{{$page_title}}</h1>
                        <p style="color: #000">Page Not Found!!</p>
                    </div>
                    </div>
                    <!-- Breadcrumb section End -->
                </div>
            </div>
        </div>
    </section>
    <!-- Breadcrumb Section End -->
    @stop