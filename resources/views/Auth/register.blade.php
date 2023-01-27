<x-layout>
  <div class="d-flex justify-content-center">
    @if ($errors->any()) 
    <div class="text-center alert alertFade2 alert-red-custom">
      @foreach ($errors->all() as $error)
      {{__('ui.' . $error)}}
      @endforeach
    </div>
    @endif
  </div>
  <section class="container-fluid">
    <div class="row justify-content-evenly align-items-center mt-my2">
      <div class="col-12 col-md-6 col-lg-3 d-flex flex-column justify-content-center align-items-center border-custom">
        <div class="row flex-column">
          <div class="col-6 mt-5"></div>
          <div class="col-12">
            <div class="text-center">
              <h2 class="mb-3 display-4 fw-bold txt-CY CBF">
                {{__('ui.register')}}
              </h2>
            </div>
            <div class="col-12">
              <form  method="POST" action="{{route('register')}}">
                @csrf
                <div>
                  <label class="form-label txt-CW fs-4">{{__('ui.EA')}}</label>
                  <input type="email" class="form-control" name="email">
                </div>
                <div class="mt-3">
                  <label class="form-label txt-CW fs-4">{{__('ui.user')}}</label>
                  <input type="text" class="form-control" name="name">
                </div>
                <div class="mt-3">
                  <label  class="form-label txt-CW fs-4">{{__('ui.password')}}</label>
                  <input type="password" class="form-control" name="password">
                </div>
                <div class="mt-3">
                  <label  class="form-label txt-CW fs-4">{{__('ui.CP')}}</label>
                  <input type="password" class="form-control" name="password_confirmation">
                </div>
                <div class="text-center mt-3">
                  <button type="submit" class="btn btn-custom fs-4">{{__('ui.submit')}}</button>
                </div>
              </form>
              <div class="mt-3 text-center txt-CW fs-5">
                {{__('ui.HA')}}<a class="nav-link yellowHover text-decoration-underline" href="{{route('login')}}">{{__('ui.login')}}</a>
              </div>
              <div class="mt-3 text-center txt-CW fs-5">
                {{__('ui.forgot')}} <a class="nav-link yellowHover text-decoration-underline" href="{{route('password.request')}}">{{__('ui.click2')}}</a>
              </div>
              <div class="mt-3 text-center txt-CW fs-5">
                {{__('ui.logWith')}} <a class="nav-link yellowHover text-decoration-underline" href="{{route('authWithGoogle')}}"><i class="fa-brands fa-google"></i></a>
              </div>
            </div>
            <div class="col-6 mb-5"></div>
          </div>
        </div>
      </div>
    </div>
  </section>
</x-layout>