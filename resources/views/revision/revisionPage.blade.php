<x-layout>
  
  
  {{--! Messaggi di stato annunci --}}
  @if (session()->has('message')) 
  @if (session('message') == "Insertion suspended")
  <div class="text-center alert alertFade alert-green-yellow">
    {{__('ui.suspend')}}
  </div>            
  @else
  @endif
  @if (session('message') == "Insertion accepted")
  <div class="text-center alert alertFade alert-green-custom">
    {{__('ui.accepted')}}
  </div> 
  @else 
  @endif
  @if(session('message') == "Insertion deleted")
  <div class="text-center alert alertFade alert-red-custom">
    {{__('ui.deleted')}}
  </div>  
  @endif
  @endif
  {{--! Messaggi di stato annunci end --}}
  
  {{--! Titolo pagina --}}
  {{-- <div class="d-flex justify-content-center">
    <h2 class="fs-1 mt-5 mb-3 fw-bolder txt-CY CBF">
      {{__('ui.revision')}}
    </h2>
  </div> --}}
  {{--! Titolo pagina fine --}}
  
  
  {{--! Accordion container --}}
  <div class="container accordion mt-4" id="accordionExample">
    <div class="row mt-my">
      <h2 class="accordion-header col-12 col-md-4" id="headingOne">
        <button class="accordion-button fw-bold fs-5" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
          {{__('ui.review')}}
        </button>
      </h2>
      <h2 class="accordion-header col-6 col-md-4" id="headingTwo">
        <button class="accordion-button collapsed fw-bold fs-5" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
          {{__('ui.Acc')}}
        </button>
      </h2>
      <h2 class="accordion-header col-6 col-md-4" id="headingThree">
        <button class="accordion-button collapsed fw-bold fs-5" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
          {{__('ui.Sus')}}
        </button>
      </h2>
    </div>
    <div class="accordion-item CBF">
      {{--! Accordion 1 --}}
      <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
        <div class="accordion-body d-flex flex-column align-items-center">
          
          {{--! Primo swiper --}}
          <div class="container p-0" style="overflow-y:scroll; max-height:70vh;">
            @php
            $counter = 0;
            @endphp
            @foreach ($insertions as $insertion)
            @if($insertion->is_accepted === null)
            @php
            $counter ++;
            @endphp
            <div class="row py-4 justify-content-center imagesBox">
              <div class="col-12">
                <div class="swiper mySwiper4">
                  <div class="swiper-wrapper d-flex align-items-center mb-2">
                    @if (!$insertion->images()->get()->isEmpty())
                    @foreach ($insertion->images()->get() as $image)
                    <div class="swiper-slide flex-column flex-md-row">
                      <div class="col-md-3 me-0 me-md-3 mb-2 mb-md-0">
                        {{--! NON TOCCARE PER NESSUNA RAGIONE ALTRIMENTI SALTA LA USER 07 E SARAI KILLATO  --}}
                        <h5 class="txt-CW mb-1">
                          {{__('ui.tags')}}
                        </h5>
                        <div class="">
                          @if ($image->labels)
                          @foreach ($image->labels as $label)
                          <p class="d-inline txt-CW fw-bold">{{$label}},</p>
                          @endforeach
                          @endif
                        </div>
                      </div>
                      <div class="d-flex col align-items-center">
                        <a class="col" href="{{route('insertionDetail',compact('insertion'))}}"><img src="{{$image->getUrl(300,300)}}" alt="No img"></a>
                        <div class="col-md-4 ms-3">
                          <div class="card-body">
                            <h5 class="txt-CW mb-1">API Controller:</h5>
                            <p class="txt-CW mb-1">{{__('ui.adult')}} <span class="{{$image->adult}}"></span></p>
                            <p class="txt-CW mb-1">{{__('ui.spoof')}} <span class="{{$image->spoof}}"></span></p>
                            <p class="txt-CW mb-1">{{__('ui.medical')}} <span class="{{$image->medical}}"></span></p>
                            <p class="txt-CW mb-1">{{__('ui.violence')}} <span class="{{$image->violence}}"></span></p>
                            <p class="txt-CW mb-0">{{__('ui.racy')}} <span class="{{$image->racy}}"></span></p>
                          </div>
                        </div>
                        
                      </div>
                    </div>
                    @endforeach                          
                    @else
                    <div class="swiper-slide">
                      <a href="{{route('insertionDetail',compact('insertion'))}}"><img src="{{URL('media/noimage.png')}}" alt="No img"></a>
                    </div>
                    @endif
                  </div>
                  <div class="swiper-scrollbar"></div>
                  <div class="mb-2 swiper-pagination"></div>
                </div>                
              </div>
              <div class="mt-4 container col-12 col-md-6 col-lg-5 d-flex flex-column justify-content-center align-items-center">
                <h5  class="txt-CW card-title">{{__('ui.title')}}: {{$insertion->title}}</h5>
                <span class="txt-CW card-text mt-1">{{__('ui.description')}}: {{Str::limit($insertion->description, 100)}}</span>
                <span class="txt-CW card-text mt-1">{{__('ui.category')}}: {{__('ui.' . $insertion->category->name)}}</span>
                <span class="txt-CW card-text mt-1">{{__('ui.user')}}: {{$insertion->user->name}}</span>
                <span class="txt-CW card-footer mt-1">{{__('ui.pub')}}: {{$insertion->created_at}}</span>
                <div class="d-flex justify-content-center mt-4">
                  <form class="me-2" action="{{route('acceptInsertion', [$insertion])}}" method="POST">
                    @csrf
                    @method('PATCH')
                    <button type="submit" class="btn fw-bolder fs-4 btn-sucessCustom">{{__('ui.btnA')}}</button>
                  </form>
                  <form class="mx-auto" action="{{route('suspendInsertion', [$insertion])}}" method="POST">
                    @csrf
                    @method('PATCH')
                    <button type="submit" class="btn fw-bolder fs-4 btn-susCustom">{{__('ui.btnS')}}</button>
                  </form>                     
                  <form class="ms-2" action="{{route('deleteInsertion', [$insertion])}}" method="POST">
                    @csrf
                    @method('delete')
                    <button type="submit" class="btn fw-bolder fs-4 btn-dangerCustom">{{__('ui.btnD')}}</button>
                  </form>
                </div>                 
              </div>
            </div>
            @endif
            @endforeach
            @if ($counter == 0)
            <div class="col-12">
              <div class="text-center alert alertFade3 alert-green-yellow mb-0">
                <div>{{__('ui.NTBR')}}</div>
              </div>
            </div>
            @endif
          </div>
          {{--! Primo swiper end --}}
          
        </div>
      </div>
      {{--! Accordion 1 end --}}
      
      {{--! Accordion 2 --}}
      <div class="accordion-item CBF">
        <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#accordionExample">
          <div class="accordion-body d-flex flex-column align-items-center">
            
            {{--! Secondo swiper --}}
            <div class="container p-0" style="overflow-y:scroll; max-height:70vh;">
              @php
              $counter = 0;
              @endphp
              @foreach ($insertions as $insertion)
              @if($insertion->is_accepted === 1)
              @php
              $counter ++;
              @endphp
              <div class="row py-4 justify-content-center imagesBox">
                <div class="col-12">
                  <div class="swiper mySwiper4">
                    <div class="swiper-wrapper d-flex align-items-center mb-2">
                      @if (!$insertion->images()->get()->isEmpty())
                      @foreach ($insertion->images()->get() as $image)
                      <div class="swiper-slide flex-column flex-md-row">
                        <div class="col-md-3 me-0 me-md-3 mb-2 mb-md-0">
                          {{--! NON TOCCARE PER NESSUNA RAGIONE ALTRIMENTI SALTA LA USER 07 E SARAI KILLATO  --}}
                          <h5 class="txt-CW mb-1">
                            {{__('ui.tags')}}
                          </h5>
                          <div class="">
                            @if ($image->labels)
                            @foreach ($image->labels as $label)
                            <p class="d-inline txt-CW fw-bold">{{$label}},</p>
                            @endforeach
                            @endif
                          </div>
                        </div>
                        <div class="d-flex col align-items-center">
                          <a class="col" href="{{route('insertionDetail',compact('insertion'))}}"><img src="{{$image->getUrl(300,300)}}" alt="No img"></a>
                          <div class="col-md-4 ms-3">
                            <div class="card-body">
                              <h5 class="txt-CW mb-1">API Controller:</h5>
                              <p class="txt-CW mb-1">{{__('ui.adult')}} <span class="{{$image->adult}}"></span></p>
                              <p class="txt-CW mb-1">{{__('ui.spoof')}} <span class="{{$image->spoof}}"></span></p>
                              <p class="txt-CW mb-1">{{__('ui.medical')}} <span class="{{$image->medical}}"></span></p>
                              <p class="txt-CW mb-1">{{__('ui.violence')}} <span class="{{$image->violence}}"></span></p>
                              <p class="txt-CW mb-0">{{__('ui.racy')}} <span class="{{$image->racy}}"></span></p>
                            </div>
                          </div>
                          
                        </div>
                      </div>
                      @endforeach                          
                      @else
                      <div class="swiper-slide">
                        <a href="{{route('insertionDetail',compact('insertion'))}}"><img src="{{URL('media/noimage.png')}}" alt="No img"></a>
                      </div>
                      @endif
                    </div>
                    <div class="swiper-scrollbar"></div>
                    <div class="mb-2 swiper-pagination"></div>
                  </div>                
                </div>
                <div class="mt-4 container col-12 col-md-6 col-lg-5 d-flex flex-column justify-content-center align-items-center">
                  <h5  class="txt-CW card-title">{{__('ui.title')}}: {{$insertion->title}}</h5>
                  <span class="txt-CW card-text mt-1">{{__('ui.description')}}: {{Str::limit($insertion->description, 100)}}</span>
                  <span class="txt-CW card-text mt-1">{{__('ui.category')}}: {{__('ui.' . $insertion->category->name)}}</span>
                  <span class="txt-CW card-text mt-1">{{__('ui.user')}}: {{$insertion->user->name}}</span>
                  <span class="txt-CW card-footer mt-1">{{__('ui.pub')}}: {{$insertion->created_at}}</span>
                  <div class="d-flex justify-content-center mt-4">                  
                    <form class="mx-auto" action="{{route('suspendInsertion', [$insertion])}}" method="POST">
                      @csrf
                      @method('PATCH')
                      <button type="submit" class="btn fw-bolder fs-4 btn-susCustom">{{__('ui.btnS')}}</button>
                    </form>                     
                    <form class="ms-2" action="{{route('deleteInsertion', [$insertion])}}" method="POST">
                      @csrf
                      @method('delete')
                      <button type="submit" class="btn fw-bolder fs-4 btn-dangerCustom">{{__('ui.btnD')}}</button>
                    </form>
                  </div>                 
                </div>
              </div>
              @endif
              @endforeach
              @if ($counter == 0)
              <div class="col-12">
                <div class="text-center alert alertFade3 alert-green-yellow mb-0">
                  <div>{{__('ui.NTBR')}}</div>
                </div>
              </div>
              @endif
            </div>
            {{--! Secondo swiper end --}}
            
          </div>
        </div>
      </div>
      {{--! Accordion 2 end --}}
      
      {{--! Accordion 3 --}}
      <div class="accordion-item CBF">
        <div id="collapseThree" class="accordion-collapse collapse" aria-labelledby="headingThree" data-bs-parent="#accordionExample">
          <div class="accordion-body d-flex flex-column align-items-center">
            
            {{--! Terzo swiper --}}
            <div class="container p-0" style="overflow-y:scroll; max-height:70vh;">
              @php
              $counter = 0;
              @endphp
              @foreach ($insertions as $insertion)
              @if($insertion->is_accepted === 0)
              @php
              $counter ++;
              @endphp
              <div class="row py-4 justify-content-center imagesBox">
                <div class="col-12">
                  <div class="swiper mySwiper4">
                    <div class="swiper-wrapper d-flex align-items-center mb-2">
                      @if (!$insertion->images()->get()->isEmpty())
                      @foreach ($insertion->images()->get() as $image)
                      <div class="swiper-slide flex-column flex-md-row">
                        <div class="col-md-3 me-0 me-md-3 mb-2 mb-md-0">
                          {{--! NON TOCCARE PER NESSUNA RAGIONE ALTRIMENTI SALTA LA USER 07 E SARAI KILLATO  --}}
                          <h5 class="txt-CW mb-1">
                            {{__('ui.tags')}}
                          </h5>
                          <div class="">
                            @if ($image->labels)
                            @foreach ($image->labels as $label)
                            <p class="d-inline txt-CW fw-bold">{{$label}},</p>
                            @endforeach
                            @endif
                          </div>
                        </div>
                        <div class="d-flex col align-items-center">
                          <a class="col" href="{{route('insertionDetail',compact('insertion'))}}"><img src="{{$image->getUrl(300,300)}}" alt="No img"></a>
                          <div class="col-md-4 ms-3">
                            <div class="card-body">
                              <h5 class="txt-CW mb-1">API Controller:</h5>
                              <p class="txt-CW mb-1">{{__('ui.adult')}} <span class="{{$image->adult}}"></span></p>
                              <p class="txt-CW mb-1">{{__('ui.spoof')}} <span class="{{$image->spoof}}"></span></p>
                              <p class="txt-CW mb-1">{{__('ui.medical')}} <span class="{{$image->medical}}"></span></p>
                              <p class="txt-CW mb-1">{{__('ui.violence')}} <span class="{{$image->violence}}"></span></p>
                              <p class="txt-CW mb-0">{{__('ui.racy')}} <span class="{{$image->racy}}"></span></p>
                            </div>
                          </div>
                          
                        </div>
                      </div>
                      @endforeach                          
                      @else
                      <div class="swiper-slide">
                        <a href="{{route('insertionDetail',compact('insertion'))}}"><img src="{{URL('media/noimage.png')}}" alt="No img"></a>
                      </div>
                      @endif
                    </div>
                    <div class="swiper-scrollbar"></div>
                    <div class="mb-2 swiper-pagination"></div>
                  </div>                
                </div>
                <div class="mt-4 container col-12 col-md-6 col-lg-5 d-flex flex-column justify-content-center align-items-center">
                  <h5  class="txt-CW card-title">{{__('ui.title')}}: {{$insertion->title}}</h5>
                  <span class="txt-CW card-text mt-1">{{__('ui.description')}}: {{Str::limit($insertion->description, 100)}}</span>
                  <span class="txt-CW card-text mt-1">{{__('ui.category')}}: {{__('ui.' . $insertion->category->name)}}</span>
                  <span class="txt-CW card-text mt-1">{{__('ui.user')}}: {{$insertion->user->name}}</span>
                  <span class="txt-CW card-footer mt-1">{{__('ui.pub')}}: {{$insertion->created_at}}</span>
                  <div class="d-flex justify-content-center mt-4">                  
                    <form class="me-2" action="{{route('acceptInsertion', [$insertion])}}" method="POST">
                      @csrf
                      @method('PATCH')
                      <button type="submit" class="btn fw-bolder fs-4 btn-sucessCustom">{{__('ui.btnA')}}</button>
                    </form>                     
                    <form class="ms-2" action="{{route('deleteInsertion', [$insertion])}}" method="POST">
                      @csrf
                      @method('delete')
                      <button type="submit" class="btn fw-bolder fs-4 btn-dangerCustom">{{__('ui.btnD')}}</button>
                    </form>
                  </div>                 
                </div>
              </div>
              @endif
              @endforeach
              @if ($counter == 0)
              <div class="col-12">
                <div class="text-center alert alertFade3 alert-green-yellow mb-0">
                  <div>{{__('ui.NTBR')}}</div>
                </div>
              </div>
              @endif
            </div>
            {{--! Terzo swiper end --}}
            
          </div>
        </div>
        {{--! Accordion 3 end --}}
        
      </div>     
    </div>     
  </div>   
  
</x-layout>