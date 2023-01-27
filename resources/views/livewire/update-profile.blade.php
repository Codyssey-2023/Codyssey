<div>
    @if (session()->has('message')) 
    <div class="text-center alert alertFade alert-green-custom">
        {{__('ui.' . session('message'))}}
    </div>
    @endif
    @if (session('status'))
    <div class="text-center alert alertFade2 alert-green-custom">
        {{__('ui.' .  session('status')) }}
    </div>
    @endif
    <div class="container">
        <div class="row justify-content-center mt-5 mb-3">
            @if (Auth::user()->picPath == null)
            <div class="col-12 col-md-6 col-lg-4 d-flex justify-content-center">
                <img class="avatar mb-3" src="/media/1299805-ffb300.png" alt="No img">
            </div>
            @else
            <div class="col-12 col-md-6 col-lg-4 d-flex flex-column align-items-center">
                <img class="avatar mb-2" src="{{URL('storage') . '/' . Auth::user()->picPath}}" alt="No img">
                <form class="ms-2" action="{{route('deleteProfilePic', [Auth::user()])}}" method="POST">
                    @csrf
                    @method('delete')
                    <button type="submit" class="btn fw-bolder fs-4 btn-dangerCustom mt-3">{{__('ui.btnD')}}</button>
                </form>
            </div>
            @endif
        </div>
    </div>
    
    {{--! Accordion --}}
    <div class="container accordion" id="accordionExample">
        <div class="row mt-5">
            <h2 class="accordion-header col-12 col-md-4" id="headingOne">
                <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                    {{__('ui.' .  'Insert image')}}
                </button>
            </h2>
            <h2 class="accordion-header col-12 col-md-4" id="headingTwo">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                    {{__('ui.' .  'Change Username')}}
                </button>
            </h2>
            <h2 class="accordion-header col-12 col-md-4" id="headingThree">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                    {{__('ui.' .  'Change password')}}
                </button>
            </h2>
        </div>
        <div class="accordion-item">
            
            {{--! Accordion 1 --}}
            <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                <div class="accordion-body CBF">
                    <div class="row justify-content-center">
                        <div class="col-12 col-md-7 col-lg-7 mt-5">
                            <form wire:submit.prevent='store' enctype="multipart/form-data">
                                @csrf
                                <div class="d-flex align-items-center">
                                    <input type="file" class="fileInputBorder form-control shadow @error('temporary_image') is-invalid @enderror" wire:model="temporary_image" name="image" accept="image/*" placeholder="Img"/>
                                    <button type="button" wire:click="removeImage()" class="trashButtonBorder btn btn-dangerCustom fs-5 fw-bold"><i class="txt-CW fa-solid fa-trash-can"></i></button>
                                </div>
                                <div class="txt-CW">
                                    @error('temporary_image')
                                    {{__('ui.' . $message)}}
                                    @enderror
                                    
                                </div>
                                <div class="text-center mt-3">
                                    <button type="submit" class="btn btn-custom fs-4 mb-5">{{__('ui.submit')}}</button>
                                </div>
                                @if ($temporary_image != null)
                                <div class="container">
                                    <p class="fs-5 fs-bold txt-CW">{{__('ui.preview')}}</p>          
                                    <div class="row justify-content-evenly">
                                        <div class="mx-1 position-relative imagesBox d-flex">              
                                            <img class="img-fluid img-preview my-0 mx-auto" id="previewDiv" src="{{$temporary_image->temporaryUrl()}}" alt="">
                                        </div>   
                                    </div>
                                </div>
                                @endif
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            {{--! Accordion 1 end --}}
            
            {{--! Accordion 2 --}}
            <div class="accordion-item">
                <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#accordionExample">
                    <div class="accordion-body CBF">
                        <div class="row justify-content-center">
                            <div class="col-12 col-md-7 col-lg-7 mt-5">
                                <form class="text-center" wire:submit.prevent="updateProfile">
                                    @csrf
                                    <label class="form-label txt-CW fs-4">{{__('ui.email')}}</label>
                                    <input wire:model.defer="state.email" type="text" class="mb-3 form-control @error('email') is-invalid @enderror" name="email">
                                    <div class="txt-CW">
                                        @error('email')
                                        {{__('ui.' . $message)}}
                                        @enderror
                                    </div>
                                    <label class="form-label txt-CW fs-4">{{__('ui.user')}}</label>
                                    <input wire:model.defer="state.name" type="text" class="form-control @error('name') is-invalid @enderror" name="name">
                                    <div class="txt-CW">
                                        @error('name')
                                        {{__('ui.' . $message)}}
                                        @enderror 
                                    </div>
                                    <div class="text-center mt-3">
                                        <button type="submit" class="btn btn-custom mb-5 fs-4">{{__('ui.submit')}}</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            {{--! Accordion 2 end --}}
            
            {{--! Accordion 3 --}}
            <div class="accordion-item">
                <div id="collapseThree" class="accordion-collapse collapse" aria-labelledby="headingThree" data-bs-parent="#accordionExample">
                    <div class="accordion-body CBF">
                        <div class="row justify-content-center">
                            <div class="col-12 col-md-7 col-lg-7 mt-5">
                                <form class="text-center" wire:submit.prevent="changePassword">
                                    @csrf
                                    <div class="mt-3">
                                        <label  class="form-label txt-CW fs-4">{{__('ui.current_password')}}</label>
                                        <input wire:model.defer="state.current_password" type="password" class="form-control @error('current_password') is-invalid @enderror" name="current_password">
                                        <div class="txt-CW">
                                            @error('current_password')
                                            {{__('ui.' . $message)}}
                                            
                                            @enderror 
                                        </div>
                                    </div>
                                    <div class="mt-3">
                                        <label  class="form-label txt-CW fs-4">{{__('ui.password')}}</label>
                                        <input wire:model.defer="state.password" type="password" class="form-control @error('password') is-invalid @enderror" name="password">
                                        <div class="txt-CW">
                                            @error('password')
                                            {{__('ui.' . $message)}}
                                            
                                            @enderror 
                                        </div>
                                    </div>
                                    <div class="mt-3">
                                        <label  class="form-label txt-CW fs-4">{{__('ui.CP')}}</label>
                                        <input wire:model.defer="state.password_confirmation" type="password" class="form-control @error('password_confirmation') is-invalid @enderror" name="password_confirmation">
                                        <div class="txt-CW">
                                            @error('password_confirmation')
                                            {{__('ui.' . $message)}}
                                            
                                            @enderror 
                                        </div>
                                    </div>
                                    <div class="text-center mt-3">
                                        <button type="submit" class="btn btn-custom mb-5 fs-4">{{__('ui.submit')}}</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            {{--! Accordion 3 end --}}
            
        </div>
    </div>
    {{--! Accordion end --}}
    
    <div class="container">
        <div class="row justify-content-center mt-5 mb-3">
            <div class="col-12 col-md-4 d-flex justify-content-center">
                <a class="btn btn-custom fs-4" href="{{route('verifyEmail')}}">{{__('ui.verifyEmail')}}</a>
            </div>
            @if (!Auth::user()->is_revisor && Auth::user()->email_verified_at != NULL)   
            <div class="col-12 col-md-4 mt-3 mt-md-0 d-flex justify-content-center">
                <a href="{{route('workWithUs')}}"><button class="btn btn-custom fs-3">{{__('ui.WWU')}}</button></a>
            </div>   
            @endif
            @if (Auth::user()->password != NULL)
            <form class="col-12 col-md-4 d-flex mt-3 mt-md-0 justify-content-center" method="POST" action="user/two-factor-authentication">
                @csrf
                @if (Auth::user()->two_factor_secret === NULL)
                <button type="submit" class="btn btn-custom fs-3 ms-3"> {{__('ui.2FAoff')}} </button>                    
                @else
                @method('DELETE')                    
                <div class="btn-group dropup">
                    <button type="submit" class="btn btn-custom fs-3"> {{__('ui.2FAon')}} </button>
                    <button type="button" class="btn btn-custom fs-3 dropdown-toggle dropdown-toggle-split" data-bs-toggle="dropdown" aria-expanded="false">
                        <span class="visually-hidden">Toggle Dropdown</span>
                    </button>
                    <div class="p-4 dropdown-menu dropdownBackgroundNeg">
                        <div class="d-flex flex-column align-items-center">
                            <span class="txt-CY mt-3">{{__('ui.scanQr')}}</span>
                            <div class="p-2">{!!Auth::user()->twoFactorQrCodeSvg()!!}</div>
                            
                        </div>
                        <div class="d-flex flex-column align-items-center">
                            
                            <ul class="txt-CY mt-3 dropdownBackgroundNeg2">{{__('ui.recoveryCodes')}}:
                                @foreach (json_decode(decrypt(Auth::user()->two_factor_recovery_codes)) as $code)
                                <li>{{$code}}</li>
                                @endforeach
                            </ul>
                        </div>
                        
                    </div>
                </div>
                @endif
            </form>                    
            @endif
        </div>
    </div>
</div>
