@extends('layouts.main')

@section('page_title') Vehicles @endsection

@section('content')

    <div class="container-fluid">
        <div class="row">
            <div class="offset-3 col-5 mt-5" style="border: 2px solid lightgray">
                <h4 class="mt-4">Edit Step 2</h4>
                <form action="/vehicles/{{ $ed_vehicle['id'] }}/post-edit-two" method="POST" class="mt-3" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    
                    <div class="row"> 
                        {{-- I adapted the same logic that I used in the previous PHP homework 6 --}}
                        {{-- array into which we store the values of photos that need to be removed --}}
                        <input type="hidden" id="hidden_img" name="hidden_img_ids">
                        <div class="mx-2 mt-2">
                            @if (!empty($photos))
                                @foreach ($photos as $photo)
                                    <div class="img-wrapper mr-3 mb-2">
                                        <img src={{ asset($photo->photo) }} height=150 width=200 id={{ $photo->id }}>
                                        <a><div><i onclick="removePhotos({{ $photo->id }})" class="fas fa-times fa-lg"></i></div></a>
                                    </div>
                                @endforeach
                            @endif
                        </div>
                    </div>
            
                    <div class="pl-0 mt-4">
                        <label for="photo[]">Choose one or more new photos:</label>
                        <input type="file" 
                                name="photo[]" 
                                class="form-control @error('photo.*') is-invalid @enderror" 
                                multiple>
                        @error('photo.*')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    <div class="pl-0 mt-4 d-flex flex-row justify-content-between">
                        <a class="btn btn-primary mt-3 mb-4" href="/vehicles/{{ $ed_vehicle['id'] }}/edit-one">Back</a>
                        <button class="btn btn-success mt-3 mb-4">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
<script>

    function removePhotos(id) {

        document.getElementById(id).classList.toggle('transform');
        let arr_value = document.getElementById("hidden_img").value;
        var img_arr = document.getElementById("hidden_img");

        // array that will be assigned to the hidden input
        // the arr is reinitilised every time, allowing us to simply skip adding a value we want to pop
        var arr = [];
        var flag = true;

        // if hidden input value exists
        if (arr_value) {
            arr_value = JSON.parse(arr_value);

            arr_value.forEach(img_id => {
                // if the image is clicked for the second time
                // do not add it to the arr that will be assigned to the hidden input
                if (img_id == id) {
                    flag = false;
                } else {
                    // place existing values into the empty arr
                    arr.push(img_id);
                }
            });
        }

        if (flag) {
            arr.push(id);
        }

        // the array is stringified so that more values could be placed within the input field
        img_arr.value = JSON.stringify(arr);

        console.log(img_arr.value);
    }
</script>
@endsection