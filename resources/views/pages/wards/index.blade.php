<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Wards <b></b>
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="container">
            <div class="row">
                <div class="col-md-9">
                    <div class="card">

                        @if (session('success'))
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                <strong>{{ session('success') }}</strong>
                                <button type="button" class="btn-close" data-bs-dismiss="alert"
                                    aria-label="Close"></button>
                            </div>
                        @endif

                        <div class="card-header"> All Wards </div>
                        <div class="card-body">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col"> Name </th>
                                        <th scope="col">Local Government Area </th>
                                        <th scope="col">Created At</th>
                                        <th scope="col">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    {{-- @php($i = 1) --}}
                                    @foreach ($wards as $ward)
                                        <tr>
                                            <th scope="row">{{ $lgas->firstItem() + $loop->index }}</th>
                                            <th>{{$ward['states']['name']}}</th>
                                            <td>{{ $lgas->name }}</td>
                                            <td>
                                                @if ($ward->created_at == null)
                                                    <span class="text-danger"> No Date Set</span>
                                                @else
                                                    {{ $ward->created_at }}
                                                @endif

                                            </td>
                                            <td>
                                                <a href="{{ url('wards/edit/' . $ward->id) }}"
                                                    class="btn btn-info">Edit</a>
                                                <a href="{{ url('delete/wards/' . $ward->id) }}"
                                                    class="btn btn-danger">Delete</a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            {{ $wards->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Trash Part --}}
    <div class="container">
        <div class="row">
            <div class="col-md-9">
                <div class="card">
                    <div class="card-header"> Add Local Government </div>
                    <div class="card-body">
                        <form action="{{ route('store.wards') }}" method="POST">
                            @csrf
                            <div class="mb-3">
                                <label for="lgas" class="form-label">Ward Name:</label>
                                <input type="text" name="name" class="form-control" id="lgas"
                                    aria-describedby="lgas">
                                @error('name')
                                    <span class="text-danger"> {{ $message }}</span>
                                @enderror
                                <br>
                                <div class="controls">
                                    <select name="lga_id" class="form-control">
                                        <option value="" selected="" disabled="">Select Local Government</option>
                                        @foreach ($lgas as $lga)
                                            <option value="{{$lga->id}}">{{$lga->name}}</option>
                                        @endforeach
                                    </select>
                                    @error('lga_id')
                                        <span class="text-danger"> {{ $message }} </span>
                                    @enderror
                                </div>

                            </div>
                            <button type="submit" class="btn btn-primary">Add Local Government Area</button>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
            </div>
        </div>
    </div>

</x-app-layout>
