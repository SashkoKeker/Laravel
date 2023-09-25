@extends('layouts.app', ['page' => __('Stores'), 'pageSlug' => 'stores.create'])
@section('content')
    <div>
        <form action="{{route('stores.update', $store->id)}}" method="post" enctype="multipart/form-data">
            @csrf
            @method('patch')
            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" name="name" class="form-control" id="name" placeholder="Name" value="{{ $store->name }}">
            </div>
            <div class="form-group">
                <label for="description">Description</label>
                <input type="text" name="description" class="form-control" id="description" placeholder="Description" value="{{ $store->description }}">
            </div>
            <div class="form-group">
                <label for="image">Image</label>
                <input type="file" name="image" class="form-control-file" id="imageInput">
                @if ($store->image)
                    <img id="selectedImage" src="{{ asset('storage/' . $store->image) }}" alt="Selected Image" style="max-width: 300px;">
                @else
                    <img id="selectedImage" src="" alt="Selected Image" style="max-width: 300px;">
                @endif
            </div>
            <div class="form-group">
                <label for="address">Address</label>
                <input type="text" name="address" class="form-control" id="address" placeholder="Address" value="{{ $store->address }}">
            </div>
            <div class="form-group">
                <label for="schedule">Schedule</label>
                <input type="text" name="schedule" class="form-control" id="schedule" placeholder="Schedule" value="{{ $store->schedule }}">
            </div>
            <div class="form-group">
                <label for="longitude">Longitude</label>
                <input type="text" name="longitude" class="form-control" id="longitude" placeholder="Longitude" value="{{ $store->longitude }}">
            </div>
            <div class="form-group">
                <label for="latitude">Latitude</label>
                <input type="text" name="latitude" class="form-control" id="latitude" placeholder="Latitude" value="{{ $store->latitude }}">
            </div>
            <button type="submit" class="btn btn-primary">Update</button>
            <div>
                <a href="{{route('stores.index')}}">Back</a>
            </div>
        </form>
    </div>
    <script>
        console.log(document.getElementById('imageInput'))

        document.getElementById('imageInput').addEventListener('change', function () {
            const fileInput = this;
            const selectedImage = document.getElementById('selectedImage');

            if (fileInput.files && fileInput.files[0]) {
                const reader = new FileReader();
                reader.onload = function (e) {
                    selectedImage.src = e.target.result;
                    selectedImage.style.display = 'block'; // Показуємо зображення
                };

                reader.readAsDataURL(fileInput.files[0]);
            } else if (fileInput.files.length === 0 && selectedImage.src === '') {
                selectedImage.style.display = 'none'; // Приховуємо зображення, якщо файл не вибрано і не було зображення
            }
        });

    </script>
@endsection
