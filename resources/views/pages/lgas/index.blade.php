<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Local Government Area <b></b>
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

                        <div class="card-header"> All Local Government Area </div>
                        <div class="card-body">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col"> State </th>
                                        <th scope="col">Local Government Area </th>
                                        <th scope="col">Created At</th>
                                        <th scope="col">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    {{-- @php($i = 1) --}}
                                    @foreach ($lgas as $lga)
                                        <tr>
                                            <td scope="row">{{ $lgas->firstItem() + $loop->index }}</td>
                                            <td>{{$lga['states']['name']}}</td>
                                            <td>{{ $lga->name }}</td>
                                            <td>
                                                @if ($lga->created_at == null)
                                                    <span class="text-danger"> No Date Set</span>
                                                @else
                                                    {{ $lga->created_at }}
                                                @endif

                                            </td>
                                            <td>
                                                <a href="{{ url('lgas/edit/' . $lga->id) }}"
                                                    class="btn btn-info">Edit</a>
                                                <a href="{{ url('delete/lgas/' . $lga->id) }}"
                                                    class="btn btn-danger">Delete</a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            {{ $lgas->links() }}
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
                        <form action="{{ route('store.lgas') }}" method="POST">
                            @csrf
                                <div class="controls">
                                    <label for="state_id" class="form-label">State:</label>
                                    <select name="state_id" class="form-control">
                                        <option value="" selected="" disabled="">Select State</option>
                                        @foreach ($states as $state)
                                            <option value="{{$state->id}}">{{$state->name}}</option>
                                        @endforeach
                                    </select>
                                    @error('state_id')
                                        <span class="text-danger"> {{ $message }} </span>
                                    @enderror
                                </div>
                                <br>
                                <div class="mb-3">
                                    <label for="lgas" class="form-label">Local Government Name:</label>
                                    <input type="text" name="name" class="form-control" id="lgas"
                                        aria-describedby="lgas">
                                    @error('name')
                                        <span class="text-danger"> {{ $message }}</span>
                                    @enderror
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
