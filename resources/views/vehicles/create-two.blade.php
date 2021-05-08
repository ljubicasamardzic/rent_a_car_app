@extends('layouts.main')

@section('page_title') Step 2 Create @endsection

@section('content')

    <div class="container-fluid">
        <div class="row">
            <div class="offset-3 col-5 mt-5" style="border: 2px solid lightgray">
                <div class="d-flex flex-row justify-content-between">
                    <h4 class="mt-3">Vehicle Create</h4>
                    <p class="mt-3">Step 2</p>
                </div>                
                <form action="/vehicles/post-two" method="POST" class="mt-3" enctype="multipart/form-data">
                    @csrf
                    <div class="pl-0 mt-4">
                        <label for="photo[]">Add vehicle photos:</label>
                        <input type="file" name="photo[]" 
                                multiple 
                                class="form-control @error('photo.*') is-invalid @enderror">
                        
                        @error('photo.*')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div class="pl-0 mt-4 d-flex flex-row justify-content-between">
                        <a class="btn btn-primary mt-3 mb-4" href="/vehicles/create-one">Back</a>
                        <button type="submit" class="btn btn-success mt-3 mb-4">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection