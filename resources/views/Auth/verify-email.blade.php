<x-layout>
    @if (session()->has('status')) 
    <div class="text-center alert alertFade alert-green-custom">
        {{__('ui.'.session('status'))}}
    </div>
    @endif
    <section class="container-fluid">
        <div class="row justify-content-evenly align-items-center mt-my">
            <div class="col-12 col-md-8 col-lg-8 d-flex flex-column align-items-center border-custom">
                <div class="col-6 mt-5"></div>
                <div class="col-12 d-flex flex-column align-items-center">
                    <h1 class="fs-1 fw-bold txt-CY">{{__('ui.verifyEmail')}}</h1>
                    <p class="fs-3 txt-CW">{{__('ui.name')}}: {{Auth::user()->name}}</p>
                    <p class="fs-3 txt-CW">{{__('ui.email')}}: {{Auth::user()->email}}</p>
                    <form method="POST" action="{{route('verification.send')}}">
                        @csrf
                        <button type="submit" class="fs-3 txt-CW btn btn-custom bottone mx-5 my-2" >{{__('ui.verifyEmailButton')}}</button> 
                    </form>
                </div>
                <div class="col-6 mb-5"></div>
            </div>
        </div>
    </section>
</x-layout>