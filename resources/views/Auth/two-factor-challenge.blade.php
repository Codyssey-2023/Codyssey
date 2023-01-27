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
                <div class="col-12 px-3 px-md-5 py-5">
                    <div class="text-center">
                        <h2 class="mb-3 display-4 fw-bold txt-CY CBF">
                            {{__('ui.confirmCode')}}
                        </h2> 
                    </div>
                    <div class="col-12">
                        <form method="POST" action="{{route('two-factor.login')}}">
                            @csrf                 
                            <div class="mt-3">
                                <label class="form-label txt-CW fs-4">{{__('ui.2FAcode')}}</label>
                                <input type="code" class="form-control" name="code">
                            </div>                  
                            <div class="text-center mt-3 mb-5">
                                <button type="submit" class="btn btn-custom fs-4">{{__('ui.confirmCodeBTN')}}</button>
                            </div>
                        </form>    
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-6 col-lg-3 d-flex flex-column justify-content-center align-items-center border-custom mt-4 mt-md-0 ">
                <div class="row flex-column">
                    <div class="col-12 px-3 px-md-5 py-5">
                        <div class="text-center">
                            <h2 class="mb-3 display-4 fw-bold txt-CY CBF">
                                {{__('ui.confirmRecoveryCode')}}
                            </h2> 
                        </div>
                        <div class="col-12 mt-5">
                            <form method="POST" action="{{route('two-factor.login')}}">
                                @csrf                 
                                <div class="mt-3">
                                    <label class="form-label txt-CW fs-4 text-wrap px-2">{{__('ui.2FArecoveryCode')}}</label>
                                    <input type="recovery_code" class="form-control" name="recovery_code">
                                </div>                  
                                <div class="text-center mt-3 mb-5">
                                    <button type="submit" class="btn btn-custom fs-4">{{__('ui.confirmCodeBTN')}}</button>
                                </div>
                            </form>  
                        </div>
                    </div>
                </div>
            </div>
        </div>   
    </section>  
</x-layout>