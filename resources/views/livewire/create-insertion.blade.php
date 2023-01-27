<div> 
  
  @if (session()->has('message')) 
  <div class="text-center alert alertFade2 alert-green-custom">
    {{__('ui.insertionS')}}
  </div>
  @endif
  @if (session()->has('status')) 
  <div class="text-center alert alertFade alert-green-custom">
      {{session('status')}}
  </div>
  @endif
  <section class="container-fluid">
    <div class="row justify-content-center fs-5 fs-bold txt-CW mt-my">
      <div class="col-12 col-md-8 col-lg-8 border-custom">
        <div class="col-6 mt-5"></div>
        <div class="row">
          <div class="col-12 d-flex justify-content-center">
            <h2 class="fs-1 mb-3 fw-bold txt-CY">
              {{__('ui.CI')}}
            </h2>
          </div>
        </div>
        <div class="row justify-content-evenly">
          <div class="col-12 col-md-12 col-lg-6 d-flex justify-content-center align-items-center">
            <form wire:submit.prevent='store' enctype="multipart/form-data">
              @csrf
              <div class="mb-3">
                <label for="title" class="form-label">{{__('ui.title')}}</label>
                <input type="text" class="form-control mb-3" wire:model="title" placeholder="{{__('ui.IT')}}">       
                @error('title')
                {{__('ui.' . $message)}}
                
                @enderror 
                
              </div>
              <div class="mb-3">
                <label for="category" class=" form-label">{{__('ui.category')}}</label>
                <select wire:model.defer="category" id="category" class="form-control">
                  <option value="">{{__('ui.CS')}}</option>
                  @foreach ($categories as $category)
                  <option value="{{$category->id}}">{{__('ui.' . $category->name)}}</option>
                  @endforeach
                </select>
                @error('category')
                {{__('ui.' . $message)}}
                @enderror
              </div>
              <div class="mb-3">
                <label class="form-label">{{__('ui.description')}}</label>
                <input type="text" class="form-control" wire:model="description" placeholder="{{__('ui.ID')}}">
                @error('description')
                {{__('ui.' . $message)}}
                @enderror
              </div>
              <div class="mb-3">
                <label class="form-label">{{__('ui.price')}}</label>
                <input type="number" class="form-control mod" wire:model="price" placeholder="{{__('ui.IP')}}">
              </div>
              @error('price')
              {{__('ui.' . $message)}}
              @enderror
              
              {{--! Img --}}
              <div class="">
                <label for="category" class=" form-label">{{__('ui.image')}}</label>
                <div class="d-flex align-items-center">
                  <input type="file" class="fileInputBorder form-control shadow @error('temporary_images') is-invalid @enderror @error('temporary_images.*') is-invalid @enderror" wire:model="temporary_images" name="images" accept="image/*" multiple placeholder="Img"/>
                  <button type="button" wire:click="removeAllImages()" class="trashButtonBorder btn btn-dangerCustom fs-5 fw-bold"><i class="txt-CW fa-solid fa-trash-can"></i></button>
                </div>
                @error('temporary_images')
                {{__('ui.' . $message)}}
                @enderror
                @error('temporary_images.*')
                {{__('ui.' . $message)}}
                @enderror
              </div>
              {{--! Img end --}}
              <div class="text-center">
                <button type="submit" class="btn btn-custom fs-4 my-3">
                  {{__('ui.submit')}}
                </button>
              </div>
            </form>
          </div>
          <div class="col-5 d-flex justify-content-center align-items-center">
            <div class="img-custom"></div>
          </div>
        </div>
        @if (!empty($temporary_images))
        <div class="container">
          <p class="ms-2">{{__('ui.preview')}}</p>          
          <div class="row justify-content-evenly">
            @foreach ($images as $key => $image)
            <div class="mx-1 col-11 col-md-5 col-lg-3 position-relative imagesBox d-flex mt-3">              
              <img class="img-fluid img-preview mx-auto mt-2" id="previewDiv" src="{{$image->temporaryUrl()}}" alt="No img">
              <button class="btnCanc btn btn-dangerCustom fs-5 fw-bold shadow my-3 d-block text-center mx-auto" type="button" wire:click="removeImage({{$key}})">{{__('ui.cancel')}}</button>                
            </div>   
            @endforeach
          </div>
        </div>
        @endif
        <div class="col-6 mb-5"></div>
      </div>
    </div>
  </section>
</div>
