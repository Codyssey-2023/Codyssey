<x-layout>
    <header class="bgHead d-flex justify-content-center align-items-center parallaxHeader" id="parallax">
        <div class="container">
            <div class="px-3 px-md-0 mb-5 d-flex flex-column align-items-center">
                <h1 class="fst-italic presto txt-CY mb-2 mb-md-5 px-lg-5" data-aos="fade-right" data-aos-duration="1800">PRESTO!</h1>
                <form class="d-flex formSearchHead" role="search" action="{{route('search.search')}}" method="GET">
                    <form class="d-flex" role="search" action="{{route('search.search')}}" method="GET">
                        <input name='searched' class="rounded-start form-control-custom mx-0 py-2" type="search" placeholder="{{__('ui.searchBarPL')}}" aria-label="Search" data-aos="fade-up" data-aos-duration="1800">
                        <button class="border-0 btn-customNegative rounded-end mx-0" type="submit" data-aos="fade-up" data-aos-duration="1800">{{__('ui.search')}}</button>
                    </form>
                </form>
            </div>
        </div>
    </header>
    <section class="parallax2" id="parallax2">
        <h3 class="py-4 text-center bg-CW fw-bolder fs-1 txt-CB">{{__('ui.exploreProducts')}}</h3>
        <div class="container">
            <div class="row justify-content-evenly mt-5 mb-5">
                <div class="card col-12 col-md-5 col-lg-4 CBF txt-CW mt-5">
                    <div class="swiper mySwiper mt-3">
                        <div class="swiper-wrapper">
                            @php
                            $random1 = rand(1, 10);
                            @endphp
                            @foreach ($insertions as $insertion)
                            @if ($insertion->category_id == $random1)  
                            @if ($insertion->is_accepted != null )
                            @if (!$insertion->images()->get()->isEmpty())
                            <div class="swiper-slide">
                                <a href="{{route('insertionDetail',compact('insertion'))}}"><img src="{{$insertion->images()->first()->getUrl(300,300)}}" alt="No img"></a>
                            </div>  
                            @endif
                            @endif                     
                            @endif
                            @endforeach
                        </div>
                        <div class="swiper-button-next txt-CY"><i class="swipeArrows fa-solid fa-chevron-right"></i></div>
                        <div class="swiper-button-prev txt-CY"><i class="swipeArrows fa-solid fa-chevron-left"></i></div>
                        <div class="swiper-pagination"></div>
                        
                    </div>
                    <div class="card-body d-flex justify-content-center">
                        @foreach ($insertions as $insertion)
                        @if ($insertion->category_id == $random1)
                        <a href="{{route('showInsertions', [$insertion->category->name])}}" class="txt-CW yellowHover decorazione mx-5 my-2"><h4 class="fw-bold text-center card-text mx-3 my-3">{{__('ui.' . $insertion->category->name)}}</h4></a>
                        @break
                        @endif
                        @endforeach
                    </div>
                </div>
                <div class="card col-12 col-md-5 col-lg-7 CBF txt-CW mt-5">
                    <div class="swiper mySwiper2 mt-3">
                        <div class="swiper-wrapper">
                            
                            @php
                            $random2 = 1;
                            @endphp 
                            @while ($random1 == $random2)
                            @php
                            $random2 = rand(1, 10);
                            @endphp                                
                            @endwhile
                            
                            @foreach ($insertions as $insertion)
                            @if ($insertion->category_id == $random2)  
                            @if ($insertion->is_accepted != null )
                            @if (!$insertion->images()->get()->isEmpty())
                            <div class="swiper-slide">
                                <a href="{{route('insertionDetail',compact('insertion'))}}"><img src="{{$insertion->images()->first()->getUrl(300,300)}}" alt="No img"></a>
                            </div>                     
                            @else
                            <div class="swiper-slide">
                                <a href="{{route('insertionDetail',compact('insertion'))}}"><img src="{{URL('media/noimage.png')}}" alt="No img"></a>  
                            </div>
                            @endif
                            @endif                     
                            @endif
                            @endforeach
                        </div>
                        <div class="swiper-button-next txt-CY"><i class="swipeArrows fa-solid fa-chevron-right"></i></div>
                        <div class="swiper-button-prev txt-CY"><i class="swipeArrows fa-solid fa-chevron-left"></i></div>
                        <div class="swiper-pagination"></div>
                    </div>
                    <div class="card-body d-flex justify-content-center">
                        @foreach ($insertions as $insertion)
                        @if ($insertion->category_id == $random2)
                        <a href="{{route('showInsertions', [$insertion->category->name])}}" class="txt-CW yellowHover decorazione mx-5 my-2"><h4 class="fw-bold text-center card-text mx-3 my-3">{{__('ui.' . $insertion->category->name)}}</h4></a>                        
                        @break
                        @endif
                        @endforeach
                    </div>
                </div>
            </div>
            <div class="row justify-content-evenly mt-3 mb-5">
                <div class="card col-12 col-md-5 col-lg-7 CBF txt-CW mt-5">
                    <div class="swiper mySwiper2 mt-3">
                        <div class="swiper-wrapper">
                            
                            @php
                            $random3 = 1;
                            @endphp 
                            @while ($random3 == $random1 || $random3 == $random2)
                            @php
                            $random3 = rand(1, 10);
                            @endphp                                
                            @endwhile
                            
                            @foreach ($insertions as $insertion)
                            @if ($insertion->category_id == $random3)  
                            @if ($insertion->is_accepted != null )
                            @if (!$insertion->images()->get()->isEmpty())
                            <div class="swiper-slide">
                                <a href="{{route('insertionDetail',compact('insertion'))}}"><img src="{{$insertion->images()->first()->getUrl(300,300)}}" alt="No img"></a>
                            </div>                         
                            @else
                            <div class="swiper-slide">
                                <a href="{{route('insertionDetail',compact('insertion'))}}"><img src="{{URL('media/noimage.png')}}" alt="No img"></a>
                            </div>
                            @endif
                            @endif                     
                            @endif
                            @endforeach
                        </div>
                        <div class="swiper-button-next txt-CY"><i class="swipeArrows fa-solid fa-chevron-right"></i></div>
                        <div class="swiper-button-prev txt-CY"><i class="swipeArrows fa-solid fa-chevron-left"></i></div>
                        <div class="swiper-pagination"></div>
                    </div>
                    <div class="card-body d-flex justify-content-center">
                        @foreach ($insertions as $insertion)
                        @if ($insertion->category_id == $random3)
                        <a href="{{route('showInsertions', [$insertion->category->name])}}" class="txt-CW yellowHover decorazione mx-5 my-2"><h4 class="fw-bold text-center card-text mx-3 my-3">{{__('ui.' . $insertion->category->name)}}</h4></a>                        
                        @break
                        @endif
                        @endforeach
                    </div>
                </div>
                <div class="card col-12 col-md-5 col-lg-4 CBF txt-CW mt-5">
                    <div class="swiper mySwiper mt-3">
                        <div class="swiper-wrapper">
                            
                            @php
                            $random4 = rand(1, 10);
                            @endphp 
                            @while ($random4 == $random1 || $random4 == $random2 || $random4 == $random3)
                            @php
                            $random4 = rand(1, 10);
                            @endphp                                
                            @endwhile
                            
                            @foreach ($insertions as $insertion)
                            @if ($insertion->category_id == $random4)  
                            @if ($insertion->is_accepted != null )
                            @if (!$insertion->images()->get()->isEmpty())
                            <div class="swiper-slide">
                                <a href="{{route('insertionDetail',compact('insertion'))}}"><img src="{{$insertion->images()->first()->getUrl(300,300)}}" alt="No img"></a>
                            </div>                         
                            @else
                            <div class="swiper-slide">
                                <a href="{{route('insertionDetail',compact('insertion'))}}"><img src="{{URL('media/noimage.png')}}" alt="No img"></a>
                            </div>
                            @endif
                            @endif                     
                            @endif
                            @endforeach
                        </div>
                        <div class="swiper-button-next txt-CY"><i class="swipeArrows fa-solid fa-chevron-right"></i></div>
                        <div class="swiper-button-prev txt-CY"><i class="swipeArrows fa-solid fa-chevron-left"></i></div>
                        <div class="swiper-pagination"></div>
                    </div>
                    <div class="card-body d-flex justify-content-center">
                        @foreach ($insertions as $insertion)
                        @if ($insertion->category_id == $random4)
                        <a href="{{route('showInsertions', [$insertion->category->name])}}" class="txt-CW yellowHover decorazione mx-5 my-2"><h4 class="fw-bold text-center card-text mx-3 my-3">{{__('ui.' . $insertion->category->name)}}</h4></a>
                        @break
                        @endif
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
        <h3 class="py-4 text-center bg-CW fw-bolder fs-1 m-0 txt-CB">{{__('ui.progetto')}}</h3>
        
    </section>
    <section>
        <div class="container-fluid txt-CW">
            <div class="row justify-content-center mt-5">
                <div class="col-12 col-md-8 shadow-lg bg-body-tertiary border-custom">
                    <p class="fs-3 ms-3 me-3 my-5">{{__('ui.sito')}}</p>
                </div>
            </div>
        </div>
        </section>
    </section>
</x-layout>