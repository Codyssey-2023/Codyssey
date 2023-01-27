<x-layout>
    
    @if ($errors->any()) 
    <div class="text-center alert alertFade2 alert-red-custom mt-5">
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
                                {{__('ui.CP')}}
                            </h2> 
                        </div>
                        <div class="col-12 mb-5 ">
                            <form method="POST" action="{{route('password.confirm')}}">
                                @csrf                 
                                <div class="mt-3 me-5 ms-5">
                                    <label class="form-label txt-CW fs-4">{{__('ui.CP')}}</label>
                                    <input type="password" class="form-control" name="password">
                                </div>                  
                                <div class="text-center mt-3">
                                    <button type="submit" class="btn btn-custom fs-4">{{__('ui.CP')}}</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</x-layout>