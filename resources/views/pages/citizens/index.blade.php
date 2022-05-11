<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Citizens <b></b>
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="container">
            <div class="row">
                <div class="col-md-11">
                    <div class="card">

                        @if (session('success'))
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                <strong>{{ session('success') }}</strong>
                                <button type="button" class="btn-close" data-bs-dismiss="alert"
                                    aria-label="Close"></button>
                            </div>
                        @endif

                        <div class="card-header"> All States </div>
                        <div class="card-body">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Name </th>
                                        <th scope="col">Gender </th>
                                        <th scope="col">Address </th>
                                        <th scope="col">Phone </th>
                                        <th scope="col">Ward </th>
                                        <th scope="col">Created At</th>
                                        <th scope="col">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    {{-- @php($i = 1) --}}
                                    @foreach ($citizens as $citizen)
                                        <tr>
                                            <th scope="row">{{ $citizens->firstItem() + $loop->index }}</th>
                                            <td>{{ $citizen->name }}</td>
                                            <td>{{ $citizen->gender }}</td>
                                            <td>{{ $citizen->address }}</td>
                                            <td>{{ $citizen->phone }}</td>
                                            <td>{{ $citizen->ward }}</td>
                                            <td>
                                                @if ($citizen->created_at == null)
                                                    <span class="text-danger"> No Date Set</span>
                                                @else
                                                    {{ $citizen->created_at }}
                                                @endif

                                            </td>
                                            <td>
                                                <a href="{{ url('citizens/edit/' . $citizen->id) }}"
                                                    class="btn btn-info">Edit</a>
                                                <a href="{{ url('delete/citizens/' . $citizen->id) }}"
                                                    class="btn btn-danger">Delete</a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            {{ $citizens->links() }}
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
                    <div class="card-header"> Add State </div>
                    <div class="card-body">
                        <form action="{{ route('store.citizens') }}" method="POST">
                            @csrf
                            <div class="mb-3">
                                <label for="name" class="form-label"> Name:</label>
                                <input type="text" name="name" class="form-control" id="name"
                                    aria-describedby="name">
                                @error('name')
                                    <span class="text-danger"> {{ $message }}</span>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="gender" class="form-label">Gender:</label>
                                <input type="text" name="gender" class="form-control" id="gender"
                                    aria-describedby="gender">
                                @error('gender')
                                    <span class="text-danger"> {{ $message }}</span>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="address" class="form-label">Address:</label>
                                <input type="text" name="address" class="form-control" id="address"
                                    aria-describedby="address">
                                @error('address')
                                    <span class="text-danger"> {{ $message }}</span>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="phone" class="form-label">Phone Number:</label>
                                <input type="text" name="phone" class="form-control" id="phone"
                                    aria-describedby="phone">
                                @error('phone')
                                    <span class="text-danger"> {{ $message }}</span>
                                @enderror
                            </div>
                            <div class="controls">
                                <select name="ward_id" class="form-control">
                                    <option value="" selected="" disabled="">Select Ward</option>
                                    @foreach ($wards as $ward)
                                        <option value="{{$ward->id}}">{{$ward->name}}</option>
                                    @endforeach
                                </select>
                                @error('ward_id')
                                    <span class="text-danger"> {{ $message }} </span>
                                @enderror
                            </div>
                            <br>
                            <button type="submit" class="btn btn-primary">Add State</button>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
            </div>
        </div>
    </div>

    {{-- End Trash --}}

</x-app-layout>
