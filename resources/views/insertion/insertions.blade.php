<x-layout>
    <section class="container">
        <div class='row justify-content-evenly mt-5'>        
            {{--! Titolo pagina --}}
            <div class="d-flex justify-content-center mt-5">
                <h1 class="fs-1 mt-5 mb-5 fw-bold txt-CY CBF">
                    {{__('ui.insertions')}} {{__('ui.'.$category)}}
                </h1>
            </div>
            {{--! Titolo pagina end --}}
            
            {{--! Card --}}
            @foreach ($insertions as $insertion)
            @if ($category == $insertion->category->name && $insertion['is_accepted']==true)
            <div class="card col-12 col-md-4 col-lg-3 CBF txt-CW mx-1 mb-5">
                <div class="card-body">
                    <h5 class="card-title text-center">{{$insertion['title']}}</h5>
                </div>
                <div class="swiper mySwiper">
                    <div class="swiper-wrapper">
                        @if (!$insertion->images()->get()->isEmpty())
                        @foreach ($insertion->images()->get() as $image)
                        <div class="swiper-slide">
                            <a href="{{route('insertionDetail',compact('insertion'))}}"><img src="{{$image->getUrl(300,300)}}" alt="No img"></a>
                        </div>
                        @endforeach                          
                        @else
                        <div class="swiper-slide">
                            <a href="{{route('insertionDetail',compact('insertion'))}}"><img src="{{URL('media/noimage.png')}}" alt="No img"></a>    
                        </div>
                        @endif
                    </div>
                    <div class="swiper-button-next txt-CY"><i class="swipeArrows fa-solid fa-chevron-right"></i></div>
                    <div class="swiper-button-prev txt-CY"><i class="swipeArrows fa-solid fa-chevron-left"></i></div>
                    <div class="swiper-pagination"></div>
                </div>
                <a href="{{route('showInsertions', [$insertion->category->name])}}" class="decorazione"><h4 class="text-center card-text mx-3 my-3 yellowHover">{{__('ui.' . $insertion->category->name)}}</h4></a> 
                <div class="text-center">{{Str::limit($insertion['description'], 50)}}</div>
                <p class="card-text my-3 text-center">{{__('ui.createdBy')}} {{$insertion->user->name}}</p>
                <div class="text-end mx-3">{{$insertion['price']}}{{__('ui.moneta')}}</div>
                <div class="d-flex justify-content-center text-align-center ">
                    <a type="button" class=" txt-CW btn btn-custom bottone mx-5 my-2" href="{{route('insertionDetail',compact('insertion'))}}">{{__('ui.dettaglio')}}</a> 
                </div>
            </div>
            @endif
            @endforeach
            {{--! Card end --}}
        </div>                
    </section>
</x-layout>