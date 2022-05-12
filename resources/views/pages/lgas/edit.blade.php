<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Update Local Government Area <b></b>
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="container">
            <div class="row">

                @if (session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <strong>{{ session('success') }}</strong>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-header"> Update Local Government Area </div>
                        <div class="card-body">
                            <form action="{{ url('lgas/update/' . $edit_lgas->id) }}" method="POST">
                                @csrf
                                <div class="mb-3">
                                    <label for="lgas" class="form-label"> Local Government Area:</label>
                                    <input type="text" name="name" class="form-control" id="lgas"
                                        aria-describedby="lgas" value="{{ $edit_lgas->name }}">
                                    @error('name')
                                        <span class="text-danger"> {{ $message }}</span>
                                    @enderror
                                    <br>
                                    <div class="controls">
                                        <label for="phone" class="form-label">State:</label>
                                        <select name="state_id" class="form-control">
                                            <option value="" selected="" disabled="">Select State</option>
                                            @foreach ($states as $state)
                                                <option value="{{ $state->id }}"
                                                    {{ $state->id == $edit_lgas->state_id ? 'selected' : '' }}>
                                                    {{ $state->name }}</option>
                                            @endforeach
                                        </select>
                                        @error('state_id')
                                            <span class="text-danger"> {{ $message }} </span>
                                        @enderror
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-primary">Update</button>
                                <a class="btn btn-info" href="{{ route('lgas') }}">Back</a>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
</x-app-layout>
