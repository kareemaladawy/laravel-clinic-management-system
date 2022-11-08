</form>
<style>
    * {
        font-family: "cairo" !important;
    }

    fieldset label {
        max-width: 18rem;
    }

    .form-check-input:checked {
        background-color: #20bce2;
        border-color: #20bce2;
    }

    .nav-tabs {
        border-bottom: 1px solid #20bce2;
        margin-block-end: 1.5rem;
    }

    .nav-tabs .nav-item.show .nav-link,
    .nav-tabs .nav-link.active {
        background-color: #20bce2;
        border-color: #20bce2 #20bce2 #20bce2;
        color: #fff;
        font-weight: 600;
    }

    .upload-file {
        background-color: #fff;
        border: 1px solid #20bce2;
        border-radius: 6px !important;
        justify-content: space-between;
    }

    .upload-icon {
        font-family: "Font Awesome 6 Free" !important;
        font-weight: 700;
        color: #20bce2;
    }

    .arrow_up {
        block-size: 1rem;
        transform: rotate(-45deg);
        margin-inline-start: 0.2rem;
    }

    .title {
        font-size: 1.2rem;
        font-weight: 600;
    }

    .face-scanner-img,
    #image-preview {
        inline-size: 15rem;
        block-size: 15rem;
        object-fit: contain;
    }

    .face-scanner-img img {
        max-inline-size: 100%;
    }

    .backArr {
        cursor: pointer;
        color: #20bce2;
        font-weight: 600;
    }

    .backArr .arrow {
        inline-size: 1rem;
        block-size: 1rem;
        margin-inline: .5rem;
    }

    .backArr .arrow img {
        max-inline-size: 100%;

    }

    @media (max-width:991px) {
        #first-form .row {
            flex-direction: column-reverse;
        }

        #first-form button[type="submit"] {
            margin: auto;
        }

        #first-form .title,
        #first-form fieldset,
        #first-form fieldset {
            margin-inline: 50px;
        }
    }
</style>

<div class="bg-white rounded shadow-sm mb-3 p-4" data-controller="table"
     data-table-slug="1bafc579851b6116a5875b8dd7fd7b4522a580a0">

    <form id="first-form" method="" enctype="multipart/form-data"
          action="">
        @csrf
        <div class="row">
            <div class="col-md-6 col-12  mb-3">
                <h3 class="title mb-4">{{ __('Answer the questions') }}</h3>
                <fieldset class="col">
                    <legend class="col-form-label col-sm-2 pt-0 w-100 fw-bold mb-2">{{ __('What is yout age?') }}
                    </legend>
                    @php
                        @endphp
                    @foreach (\App\Enums\AgeRanges::options() as $key => $value)
                        {!! $key % 2 == 0 ? "<div class='row'>" : '' !!}
                        <div class="col-6">
                            <div class="form-check mb-2">
                                <input class="form-check-input" type="radio" name="age"
                                       id="age-{{ $key }}" value="{{ $key }}"
                                    {{ old('age') ? 'checked' : '' }}>
                                <label class="form-check-label" for="age-{{ $key }}">
                                    {{ $value }}
                                </label>
                            </div>
                        </div>
                        {!! $key % 2 ? '</div>' : '' !!}
                    @endforeach
                    @error('age')
                    <div class="invalid-feedback d-block">
                        {{ $message }}
                    </div>
                    @enderror
                </fieldset>
                <fieldset class="col">
                    <legend class="col-form-label col-sm-2 pt-0 w-100 fw-bold  mb-2">
                        {{ __('What is your gender?') }}
                    </legend>
                    @foreach (\App\Enums\Genders::options() as $key => $value)
                        {!! $key % 2 == 0 ? "<div class='row'>" : '' !!}
                        <div class="col-6">
                            <div class="form-check mb-2">
                                <input class="form-check-input" type="radio" name="skin_type"
                                       id="skin-type-{{ $key }}" value="{{ $key }}"
                                    {{ old('skin_type') ? 'checked' : '' }}>
                                <label class="form-check-label" for="skin-type-{{ $key }}">
                                    {{ $value }}
                                </label>
                            </div>
                        </div>
                        {!! $key % 2 ? '</div>' : '' !!}
                    @endforeach
                    @error('skin_type')
                    <div class="invalid-feedback d-block">
                        {{ $message }}
                    </div>
                    @enderror
                </fieldset>
                <button class="btn w-75 d-flex justify-content-center text-light upload-file p-2 mb-3 mt-4"
                        type="submit" style="background-color: #20BCE2;">
                    {{ __('Submit') }}
                    <img class="arrow_up" src="{{ asset('assets/images/diseaseanalyzer/arror-up-solid.svg') }}"
                         alt="">
                </button>
            </div>
            <div class="col-md-6 col-12 justify-content-center mb-3">
                <h3 class="title mb-4 text-center">{{ __('Please upload a photo of your face') }}</h3>
                <div class="face-scanner-img m-auto">
                    <img src="{{ asset('assets/images/diseaseanalyzer/eye.png') }}" id="image-preview"
                         alt="">
                </div>
                <div class="input-group mb-3 ">
                    <label class="input-group-text upload-file w-75 d-flex justify-content-center  m-auto"
                           for="upload-file"> {{ __('Upload your photo here') }}</label>
                    <input type="file" name="face_image" class="form-control d-none" accept="image/*"
                           id="upload-file">
                    <!-- <img src="" alt="Image Preview" id="image-preview"  class=" w-25"></img> -->
                    @error('face_image')
                    <div class="invalid-feedback d-block">
                        {{ $message }}
                    </div>
                    @enderror
                </div>
            </div>
        </div>
    </form>

</div>

<script>
    if (typeof(filePickerEl) == 'undefined') {
        const filePickerEl = document.getElementById('upload-file');
        const imagePreviewEl = document.getElementById('image-preview');

        const showPreview = () => {
            const files = filePickerEl.files;
            const filePicked = files[0];
            imagePreviewEl.src = URL.createObjectURL(filePicked);
            imagePreviewEl.style.display = 'block';
        }

        filePickerEl.addEventListener('change', showPreview);

        $("#change-form").on("click", (e) => {
            e.preventDefault();
            $("#first-form").hide();
            $("#second-form").show();
        });


        $("#second-form .backArr").on("click", () => {
            $("#second-form").hide();
            $("#first-form").show();
        });
    }

    $("#second-form").hide();
</script>
