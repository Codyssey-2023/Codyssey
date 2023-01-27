<x-layout>
  @if (session()->has('message'))
  <section class="container">
    <div class="row justify-content-center mt-5">   
      <div class="col-12 col-md-8 text-center">
        <div class="text-center alert alert-success">
          {{session('message')}}
        </div>
      </div>
    </div>
  </section>
  @endif       

  @if (!Auth::user()->is_revisor)
  <section class="container shadow-lg bg-body-tertiary border-custom mt-my py-4 mb-5">
    <div class="txt-CW d-flex flex-column align-items-center">
      <h1 class="fs-1 fw-bold txt-CY">{{__('ui.revisor')}}</h1>
      <p class="fs-3">{{__('ui.datas')}}</p> 
      <p class="fs-3">{{__('ui.name')}}: {{Auth::user()->name}}</p>
      <p class="fs-3">{{__('ui.email')}}: {{Auth::user()->email}}</p>
      <div class="d-flex justify-content-center text-align-center "> 
        <a type="button" class="fs-3 txt-CW btn btn-custom bottone mx-5 my-2" href="{{route('requestRevisor')}}">{{__('ui.Crevisor')}}</a> 
      </div>
    </div>
  </section>
  @endif 
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-8 col-md-2">
        <h2 class="chi-siamo CBF">{{__('ui.chisiamo')}}</h2>
      </div>
    </div>
  </div>
  
  <div class="container wrapperAboutUs d-flex justify-content-center">
    <div class="swiper3 mySwiper3">
      <div class="swiper-wrapper">
        <div class="swiper-slide3 swiper-slide">
          <div class="cS">            
            <a href="https://www.linkedin.com/in/david-boschetti-7a774224a/" target="blank" class="c_Generale">
              <div class="c__iDB"></div>
              <div class="card__overlay">
                <div class="card__header">
                  <svg class="card__arc" xmlns="http://www.w3.org/2000/svg"><path /></svg>                     
                  <img class="card__thumb" src="/media/David.jpeg" alt="Img Membro del team David Boschetti"/>
                  <div class="card__header-text">
                    <h3 class="card__title">David Boschetti</h3>            
                  </div>
                </div>
                <p class="card__description">{{__('ui.descrizioneDavid')}}</p>
              </div>
            </a>             
          </div>
        </div>
        
        <div class="swiper-slide swiper-slide3">
          <div class="cS">
            <a href="https://www.linkedin.com/in/alessandro-salerno-41563323b/" target="blank" class="c_Generale">
              <div class="c__iAS"></div>
              <div class="card__overlay">
                <div class="card__header">
                  <svg class="card__arc" xmlns="http://www.w3.org/2000/svg"><path /></svg>                     
                  <img class="card__thumb" src="/media/alessandroS.jpg" alt=" Img Membro del team Alessandro Salerno" />
                  <div class="card__header-text">
                    <h3 class="card__title">Alessandro Salerno</h3>            
                  </div>
                </div>
                <p class="card__description">{{__('ui.descrizioneAleS')}}
                </p>
              </div>
            </a>             
          </div>
        </div>
        
        <div class="swiper-slide swiper-slide3">
          <div class="cS">
            <a href="https://linkedin.com/in/mariagrazia-leone-a6810225b" target="blank" class="c_Generale">
              <div class="c__iML"></div>
              <div class="card__overlay">
                <div class="card__header">     
                  <svg class="card__arc" xmlns="http://www.w3.org/2000/svg"><path /></svg>             
                  <img class="card__thumb" src="/media/mariagrazia.jpg" alt="Img Membro del team Mariagrazia Leone" />
                  <div class="card__header-text">
                    <h3 class="card__title">Mariagrazia Leone</h3>            
                  </div>
                </div>
                <p class="card__description">{{__('ui.descrizioneMary')}}
                </p>
              </div>
            </a>             
          </div>
        </div>
        
        <div class="swiper-slide swiper-slide3">
          <div class="cS">
            <a href="https://www.linkedin.com/in/antonio-quinand-4b216425a/" target="blank" class="c_Generale">
              <div class="c__iAQ"></div>
              <div class="card__overlay">
                <div class="card__header">
                  <svg class="card__arc" xmlns="http://www.w3.org/2000/svg"><path /></svg>                     
                  <img class="card__thumb" src="https://images-ext-2.discordapp.net/external/zGxa2S5bNluQHouZ51ueEgqdP_ym1nU8CcFdhP3s1_E/%3Fsize%3D1024/https/cdn.discordapp.com/avatars/585784970451353624/41fe75b6e348a2e4ae44d8308ec05601.webp" alt="Img membro del team Antonio Quinand" />
                  <div class="card__header-text">
                    <h3 class="card__title">Antonio Quinand</h3>            
                  </div>
                </div>
                <p class="card__description">{{__('ui.descrizioneAnto')}}
                </p>
              </div>
            </a>             
          </div>
        </div>
        
        
        <div class="swiper-slide swiper-slide3">
          <div class="cS">
            <a href="https://www.linkedin.com/in/luca-pennella-dev/" target="blank" class="c_Generale">
              <div class="c__iLP"></div>
              <div class="card__overlay">
                <div class="card__header">
                  <svg class="card__arc" xmlns="http://www.w3.org/2000/svg"><path /></svg>                     
                  <img class="card__thumb" src="/media/LucaPennella.png" alt="Membro del team Luca Pennella" />
                  <div class="card__header-text">
                    <h3 class="card__title">Luca Pennella</h3>            
                  </div>
                </div>
                <p class="card__description">{{__('ui.descrizioneLuca')}}
                </p>
              </div>
            </a>             
          </div>
        </div> 
      </div>
    </div>
  </div>
</x-layout>