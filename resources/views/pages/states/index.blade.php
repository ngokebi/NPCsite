<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            States <b></b>
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

                        <div class="card-header"> All States </div>
                        <div class="card-body">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">State </th>
                                        <th scope="col">Created At</th>
                                        <th scope="col">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    {{-- @php($i = 1) --}}
                                    @foreach ($states as $state)
                                        <tr>
                                            <th scope="row">{{ $states->firstItem() + $loop->index }}</th>
                                            <td>{{ $state->name }}</td>
                                            <td>
                                                @if ($state->created_at == null)
                                                    <span class="text-danger"> No Date Set</span>
                                                @else
                                                    {{ $state->created_at }}
                                                @endif

                                            </td>
                                            <td>
                                                <a href="{{ url('states/edit/' . $state->id) }}"
                                                    class="btn btn-info">Edit</a>
                                                <a href="{{ url('delete/states/' . $state->id) }}"
                                                    class="btn btn-danger">Delete</a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            {{ $states->links() }}
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
                        <form action="{{ route('store.states') }}" method="POST">
                            @csrf
                            <div class="mb-3">
                                <label for="state" class="form-label">State Name:</label>
                                <input type="text" name="name" class="form-control" id="state"
                                    aria-describedby="state">
                                @error('name')
                                    <span class="text-danger"> {{ $message }}</span>
                                @enderror
                            </div>
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
