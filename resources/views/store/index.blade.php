@extends('layouts.app', ['page' => __('Stores'), 'pageSlug' => 'stores'])
@section('content')
    <div>
        <table class="my-table">
            <tr>
                <th>Id</th>
                <th>Name</th>
                <th>Description</th>
                <th>Image</th>
                <th>Address</th>
                <th>Schedule</th>
                <th>longitude</th>
                <th>latitude</th>
                <th>action</th>
            </tr>
            @foreach($stores as $store)
            <tr>
                <td>{{$store->id}}</td>
                <td>{{$store->name}}</td>
                <td>{{$store->decription}}</td>
                <td>
                    @if ($store->image)
                        <img src="{{ asset('storage/'.$store->image) }}" alt="Store Image" width="100">
                    @else
                        No Image
                    @endif
                </td>
                <td>{{$store->address}}</td>
                <td>{{$store->schedule}}</td>
                <td>{{$store->longitude}}</td>
                <td>{{$store->latitude}}</td>
                <td>
                    <div>
                        <a href="{{ route('stores.edit', ['store' => $store->id]) }}">Edit</a>
                        <form action="{{route('stores.delete', ['store' => $store->id])}}" method="post">
                            @csrf
                            @method('delete')
                            <input type="submit" value="Delete">
                        </form>
{{--                        <a href="{{ route('stores.destroy', ['store' => $store->id]) }}">Delete</a>--}}
                    </div>
                </td>
            </tr>
            @endforeach
        </table>

    </div>
@endsection

<style>
    .my-table {
        border-collapse: collapse;
        width: 100%;
    }

    .my-table th, .my-table td {
        border: 1px solid #ddd; /* Границі для стовбців і рядків */
        padding: 8px; /* Зазначити відступи від тексту до границі */
        text-align: left; /* Вирівнювання тексту в стовбцях */
    }

    /*.my-table tr:nth-child(even) {*/
    /*    background-color: #f2f2f2; !* Зафарбовувати парні рядки *!*/
    /*}*/
</style>
