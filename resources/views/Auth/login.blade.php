<x-layout>
  
  @if ($errors->any()) 
  <div class="text-center alert alertFade2 alert-red-custom">
    @foreach ($errors->all() as $error)
    {{__('ui.' . $error)}}
    @endforeach
  </div>
  @endif
  @if (session('status'))
  <div class="text-center alert alertFade2 alert-green-custom">
    {{__('ui.' .  session('status')) }}
  </div>
  @endif
  
  <section class="container-fluid">
    <div class="row justify-content-evenly align-items-center mt-my">
      <div class="col-12 col-md-6 col-lg-3 d-flex flex-column justify-content-center align-items-center border-custom">
        <div class="row flex-column">
          <div class="col-6 mt-5"></div>
          <div class="col-12">
            <div class="text-center">
              <h2 class="mb-3 display-4 fw-bold txt-CY CBF">
                {{__('ui.login')}}
              </h2> 
            </div>
            <div class="col-12">
              <form method="POST" action="{{route('login')}}">
                @csrf
                <div class="mt-3">
                  <label class="form-label txt-CW fs-4">{{__('ui.EA')}}</label>
                  <input type="email" class="form-control" name="email">
                </div>
                <div class="mt-3">
                  <label class="form-label txt-CW fs-4">{{__('ui.password')}}</label>
                  <input type="password" class="form-control" name="password">
                </div>
                <div class="mt-3 form-check">
                  <input type="checkbox" class="form-check-input" id="exampleCheck1">
                  <label class="form-check-label txt-CW fs-5" for="exampleCheck1">{{__('ui.RM')}}</label>
                </div>
                <div class="text-center mt-3">
                  <button type="submit" class="btn btn-custom fs-4">{{__('ui.login')}}</button>
                </div>
              </form>
              <div class="mt-3 text-center txt-CW fs-5">
                {{__('ui.account')}} <a class="nav-link yellowHover text-decoration-underline" href="{{route('register')}}">{{__('ui.click')}}</a>
              </div>
              <div class="mt-3 text-center txt-CW fs-5">
                {{__('ui.forgot')}} <a class="nav-link yellowHover text-decoration-underline" href="{{route('password.request')}}">{{__('ui.click2')}}</a>
              </div>
              <div class="mt-3 text-center txt-CW fs-5">
                {{__('ui.logWith')}} <a class="nav-link yellowHover text-decoration-underline" href="{{route('authWithGoogle')}}"><i class="fa-brands fa-google"></i></a>
              </div>
            </div>
          </div>
          <div class="col-6 mb-5"></div>
        </div>
      </div>
    </div>
  </section>
</x-layout>