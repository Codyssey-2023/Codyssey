<x-layout>
  <div class="container">

    {{--! Titolo pagina dettaglio annuncio --}}
    <div class="row justify-content-center">
      <div class="col-12 col-md-4 col-lg-3">
        <h2 class="fs-1 mt-5 mb-3 fw-bold txt-CY CBF text-center">
          {{$insertion['title']}}
        </h2>
      </div>
    </div>
    {{--! Titolo pagina dettaglio annuncio end --}}
  
    {{--! Card dettaglio annuncio --}}
    <div class='border-custom row justify-content-evenly mt-5 CBF'>
      <div class="col-12 col-md-6 col-lg-5 d-flex justify-content-start py-5 my-5">
          <div class="swiper mySwiper">
            <div class="swiper-wrapper">
              @if (!$insertion->images()->get()->isEmpty())
              @foreach ($insertion->images()->get() as $image)
              <div class="swiper-slide">
                <img src="{{$image->getUrl(300,300)}}" alt="No img">
              </div>
              @endforeach                          
              @else
              <div class="swiper-slide">
                <img src="{{URL('media/noimage.png')}}" alt="No img">
              </div>
              @endif
            </div>
            <div class="swiper-button-next txt-CY"><i class="swipeArrows fa-solid fa-chevron-right"></i></div>
            <div class="swiper-button-prev txt-CY"><i class="swipeArrows fa-solid fa-chevron-left"></i></div>
            <div class="swiper-pagination"></div>
          </div>
      </div>
      <div class="col-12 col-md-6 col-lg-5 txt-CW py-5 my-5">
        <a href="{{route('showInsertions', [$insertion->category->name])}}" class="decorazione"><h4 class="text-center card-text txt-CW mx-3 my-3 yellowHover">{{__('ui.' . $insertion->category->name)}}</h4></a> 
        <div class="text-center">{{$insertion['description']}}</div>
        <p class="card-text my-3 text-center">{{__('ui.createdBy')}} {{$insertion->user->name}}</p>
        <div class="text-end mx-3">{{$insertion['price']}}{{__('ui.moneta')}}</div>
      </div>
    </div>   
    {{--! Card dettaglio annuncio end --}}
  </div>
</x-layout>