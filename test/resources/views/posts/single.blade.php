
    <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <title>{{$post->title}}</title>

    <link rel="stylesheet" type="text/css" href={{asset("app/css/fonts.css")}}>
    <link rel="stylesheet" type="text/css" href={{asset("app/css/crumina-fonts.css")}}>
    <link rel="stylesheet" type="text/css" href={{asset("app/css/normalize.css")}}>
    <link rel="stylesheet" type="text/css" href={{asset("app/css/grid.css")}}>
    <link rel="stylesheet" type="text/css" href={{asset("app/css/styles.css")}}>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">


    <!--Plugins styles-->

    <link rel="stylesheet" type="text/css" href={{asset("app/css/jquery.mCustomScrollbar.min.css")}}>
    <link rel="stylesheet" type="text/css" href={{asset("app/css/swiper.min.css")}}>
    <link rel="stylesheet" type="text/css" href={{asset("app/css/primary-menu.css")}}>
    <link rel="stylesheet" type="text/css" href={{asset("app/css/magnific-popup.css")}}>

    <!--Styles for RTL-->

    <!--<link rel="stylesheet" type="text/css" href="app/css/rtl.css">-->

    <!--External fonts-->

    <link href='https://fonts.googleapis.com/css?family=Varela+Round' rel='stylesheet' type='text/css'>
    <style>
        .padded-50{
            padding: 40px;
        }
        .text-center{
            text-align: center;
        }

    </style>

</head>


<body class=" ">

<header class="header" id="site-header">
    <div class="container">
        <div class="header-content-wrapper">

            <nav id="primary-menu" class="primary-menu">
                <a href='javascript:void(0)' id="menu-icon-trigger" class="menu-icon-trigger showhide">
                            <span id="menu-icon-wrapper" class="menu-icon-wrapper" style="visibility: hidden">
                                <svg width="1000px" height="1000px">
                                    <path id="pathD" d="M 300 400 L 700 400 C 900 400 900 750 600 850 A 400 400 0 0 1 200 200 L 800 800"></path>
                                    <path id="pathE" d="M 300 500 L 700 500"></path>
                                    <path id="pathF" d="M 700 600 L 300 600 C 100 600 100 200 400 150 A 400 380 0 1 1 200 800 L 800 200"></path>
                                </svg>
                            </span>
                </a>
                <ul class="primary-menu-menu" style="overflow: hidden;">
                    <li class="">
                        <a href="{{route('posts')}}">Posts</a>
                    </li>
                    <li class="">
                        <a href="{{route('post.create')}}">Create a new post</a>
                    </li>
                </ul>
            </nav>
            <ul class="nav-add">
                <li class="nav-item dropdown">
                    <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="{{ route('logout') }}"
                           onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                            {{ __('Logout') }}
                        </a>

                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>
                    </div>

                </li>
            </ul>
        </div>
    </div>
</header>

<div class="content-wrapper">


    <div class="stunning-header stunning-header-bg-lightviolet">
        <div class="stunning-header-content">
            <h1 class="stunning-header-title">{{$post->title}}</h1>
        </div>
    </div>


    <div class="container">
        <div class="row medium-padding120">
            <main class="main">
                <div class="col-lg-10 col-lg-offset-1">
                    <article class="hentry post post-standard-details">

                        <div class="post-thumb">
                            <img src={{asset($post->image)}} alt="seo">
                        </div>

                        <div class="post__content">

                            <div class="post__content-info">
                                <p class="post__text"> {{$post->contents}}
                                </p>
                            </div>

                            <div class="post-additional-info">

                                <div class="post__author author vcard">
                                    Posted by

                                    <div class="post__author-name fn">
                                        <a href="#" class="post__author-link">Admin</a>
                                    </div>

                                </div>

                                <span class="post__date">

                                <i class="seoicon-clock"></i>

                                <time class="published" datetime="2016-03-20 12:00:00">
                                    {{$post->created_at}}
                                </time>

                                </span>

                                <button id="toggle">Comment</button>

                                <div id="comment">
                                    <br>
                                    <form action="{{route('comment.store')}}" method="post" enctype="multipart/form-data">
                                    {{ csrf_field() }}
                                    <input type="hidden" name="post_id" value="{{$post->id}}">
                                    <div class="card">
                                        <div class="card-body">
                                            <div class="form-group" >
                                                <textarea style="border-color: #0b0b0b" name="comment" id="" cols="30" rows="10"></textarea>
                                            </div>
                                            <div class="input-group mb-3">
                                                <input type="file" class="form-control" name="image">
                                                <button class="btn btn-secondary" type="submit">Comment</button>
                                            </div>
                                        </div>
                                    </div>
                                    </form>
                                </div>

                            </div>

                        </div>
                        <div id="comments" class="comments">

                            <div class="heading text-center">
                                <h4 class="h1 heading-title">Comments</h4>
                                <div  class="heading-line">
                                    <span class="short-line"></span>
                                    <span class="long-line"></span>
                                    <div class="card">
                                        <div class="card-body">
                                            <table class="table table-hover">

                                                <tbody>
                                                    @foreach($post->comments as $comment)
                                                        <tr>
                                                            <td>
                                                                {{\App\Models\User::getName($comment->user_id)}}
                                                                <br><br>
                                                                {{$comment->comment}}

                                                            </td>
                                                            <td>
                                                                <img src="{{asset($comment->image)}}" alt=" {{''}}" width="150px" height="200px">

                                                            </td>

                                                            <td>
                                                                <a href="{{route('comment.edit',['id'=>$comment->id])}}" class="btn btn-xs btn-info">
                                                                    Edit
                                                                </a>
                                                            </td>
                                                            <td>
                                                                <a href="{{route('comment.delete',['id'=>$comment->id])}}" class="btn btn-xs btn-danger">
                                                                    Delete
                                                                </a>
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>

                                        </div>
                                    </div>

                                </div>
                            </div>

                        </div>


                    </article>


                    <div class="pagination-arrow">
                        @if($previous)
                            <a href="{{route('single_post',['slug'=>$previous->slug])}}" class="btn-prev-wrap">
                                <div class="btn-content">
                                    <div class="btn-content-title">Previous Post</div>
                                    <p class="btn-content-subtitle">{{$previous->title}}</p>
                                </div>
                                <svg class="btn-prev">
                                    <use xlink:href="#arrow-left"></use>
                                </svg>
                            </a>
                        @endif

                        @if($next)
                            <a href="{{route('single_post',['slug'=>$next->slug])}}" class="btn-next-wrap">
                                <div class="btn-content">
                                    <div class="btn-content-title">Next Post</div>
                                    <p class="btn-content-subtitle">{{$next->title}}</p>
                                </div>
                                <svg class="btn-next">
                                    <use xlink:href="#arrow-right"></use>
                                </svg>
                            </a>
                        @endif


                    </div>



                </div>


            </main>
        </div>
    </div>

</div>

<svg style="display:none;">
    <symbol id="arrow-left" viewBox="122.9 388.2 184.3 85">
        <path d="M124.1,431.3c0.1,2,1,3.8,2.4,5.2c0,0,0.1,0.1,0.1,0.1l34.1,34.1c1.6,1.6,3.7,2.5,5.9,2.5s4.3-0.9,5.9-2.4
        c1.6-1.6,2.4-3.7,2.4-5.9s-0.9-3.9-2.4-5.5l-19.9-19.5h11.1c1.5,0,2.7-1.5,2.7-3c0-1.5-1.2-3-2.7-3h-17.6c-1.1,0-2.1,0.6-2.5,1.6
        c-0.4,1-0.2,2.1,0.6,2.9l24.4,24.4c0.6,0.6,0.9,1.3,0.9,2.1s-0.3,1.6-0.9,2.1c-0.6,0.6-1.3,0.9-2.1,0.9s-1.6-0.3-2.1-0.9
        l-34.2-34.2c0,0,0,0,0,0c-0.6-0.6-0.8-1.4-0.9-1.9c0,0,0,0,0,0c0-0.2,0-0.4,0-0.6c0.1-0.6,0.3-1.1,0.7-1.6c0-0.1,0.1-0.1,0.2-0.2
        l34.1-34.1c0.6-0.6,1.3-0.9,2.1-0.9s1.6,0.3,2.1,0.9c0.6,0.6,0.9,1.3,0.9,2.1s-0.3,1.6-0.9,2.1l-24.4,24.4c-0.8,0.8-1,2-0.6,3
        c0.4,1,1.4,1.7,2.5,1.7h125.7c1.5,0,2.7-1,2.7-2.5c0-1.5-1.2-2.5-2.7-2.5H152.6l19.9-20.1c1.6-1.6,2.4-3.8,2.4-6s-0.9-4.4-2.4-6
        c-1.6-1.6-3.7-2.5-5.9-2.5s-4.3,0.9-5.9,2.4l-34.1,34.1c-0.2,0.2-0.3,0.3-0.5,0.5c-1.1,1.2-1.8,2.8-2,4.4
        C124.1,430.2,124.1,430.8,124.1,431.3C124.1,431.3,124.1,431.3,124.1,431.3z"></path>
        <path d="M283.3,427.9h14.2c1.7,0,3,1.3,3,3c0,1.7-1.4,3-3,3H175.1c-1.5,0-2.7,1.5-2.7,3c0,1.5,1.2,3,2.7,3h122.4
        c4.6,0,8.4-3.9,8.4-8.5c0-4.6-3.8-8.5-8.4-8.5h-14.2c-1.5,0-2.7,1-2.7,2.5C280.7,426.9,281.8,427.9,283.3,427.9z"></path>
    </symbol>
    <symbol id="arrow-right" viewBox="122.9 388.2 184.3 85">
        <path d="M305.9,430.2c-0.1-2-1-3.8-2.4-5.2c0,0-0.1-0.1-0.1-0.1l-34.1-34.1c-1.6-1.6-3.7-2.5-5.9-2.5c-2.2,0-4.3,0.9-5.9,2.4
        c-1.6,1.6-2.4,3.7-2.4,5.9s0.9,4.1,2.4,5.7l19.9,19.6h-11.1c-1.5,0-2.7,1.5-2.7,3c0,1.5,1.2,3,2.7,3h17.6c1.1,0,2.1-0.7,2.5-1.7
        c0.4-1,0.2-2.2-0.6-2.9l-24.4-24.5c-0.6-0.6-0.9-1.3-0.9-2.1s0.3-1.6,0.9-2.1c0.6-0.6,1.3-0.9,2.1-0.9c0.8,0,1.6,0.3,2.1,0.9
        l34.2,34.2c0,0,0,0,0,0c0.6,0.6,0.8,1.4,0.9,1.9c0,0,0,0,0,0c0,0.2,0,0.4,0,0.6c-0.1,0.6-0.3,1.1-0.7,1.6c0,0.1-0.1,0.1-0.2,0.2
        l-34.1,34.1c-0.6,0.6-1.3,0.9-2.1,0.9s-1.6-0.3-2.1-0.9c-0.6-0.6-0.9-1.3-0.9-2.1s0.3-1.6,0.9-2.1l24.4-24.4c0.8-0.8,1-1.9,0.6-2.9
        c-0.4-1-1.4-1.6-2.5-1.6H158.1c-1.5,0-2.7,1-2.7,2.5c0,1.5,1.2,2.5,2.7,2.5h119.3l-19.9,20c-1.6,1.6-2.4,3.7-2.4,6s0.9,4.4,2.4,5.9
        c1.6,1.6,3.7,2.5,5.9,2.5s4.3-0.9,5.9-2.4l34.1-34.1c0.2-0.2,0.3-0.3,0.5-0.5c1.1-1.2,1.8-2.8,2-4.4
        C305.9,431.3,305.9,430.8,305.9,430.2C305.9,430.2,305.9,430.2,305.9,430.2z"></path>
        <path d="M146.7,433.9h-14.2c-1.7,0-3-1.3-3-3c0-1.7,1.4-3,3-3h122.4c1.5,0,2.7-1.5,2.7-3c0-1.5-1.2-3-2.7-3H132.4
        c-4.6,0-8.4,3.9-8.4,8.5c0,4.6,3.8,8.5,8.4,8.5h14.2c1.5,0,2.7-1,2.7-2.5C149.3,434.9,148.1,433.9,146.7,433.9z"></path>
    </symbol>
    <symbol id="to-top" viewBox="0 0 32 32">
        <path d="M17,22 L25.0005601,22 C27.7616745,22 30,19.7558048 30,17 C30,14.9035809 28.7132907,13.1085075 26.8828633,12.3655101
         L26.8828633,12.3655101 C26.3600217,9.87224935 24.1486546,8 21.5,8 C20.6371017,8 19.8206159,8.19871575 19.0938083,8.55288165
         C17.8911816,6.43144875 15.6127573,5 13,5 C9.13400656,5 6,8.13400656 6,12 C6,12.1381509 6.00400207,12.275367 6.01189661,12.4115388
          L6.01189661,12.4115388 C4.23965876,13.1816085 3,14.9491311 3,17 C3,19.7614237 5.23249418,22 7.99943992,22 L16,22 L16,16 L12.75,19.25
           L12,18.5 L16.5,14 L21,18.5 L20.25,19.25 L17,16 L17,22 L17,22 Z M16,22 L16,27 L17,27 L17,22 L16,22 L16,22 Z" id="cloud-upload"></path>
    </symbol>



    <script src={{asset("app/js/jquery-2.1.4.min.js")}}></script>
    <script src={{asset("app/js/crum-mega-menu.js")}}></script>
    <script src={{asset("app/js/swiper.jquery.min.js")}}></script>
    <script src={{asset("app/js/theme-plugins.js")}}></script>
    <script src={{asset("app/js/main.js")}}></script>

    <script src={{asset("app/js/velocity.min.js")}}></script>
    <script src={{asset("app/js/ScrollMagic.min.js")}}></script>
    <script src={{asset("app/js/animation.velocity.min.js")}}></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        const targetDiv = document.getElementById("comment");
        const targetDiv2 = document.getElementById("comments");
        const btn = document.getElementById("toggle");
        btn.onclick = function () {
            if (targetDiv.style.display !== "none") {
                targetDiv.style.display = "none";
            } else {
                targetDiv.style.display = "block";
            }
            if (targetDiv2.style.display !== "none") {
                targetDiv2.style.display = "none";
            } else {
                targetDiv2.style.display = "block";
            }
        };
    </script>

</svg>
</body>

</html>

