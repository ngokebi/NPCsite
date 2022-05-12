<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Citizens <b></b>
        </h2>
    </x-slot>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <div class="py-12">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
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
                                        <th scope="col">State </th>
                                        <th scope="col">Local Government </th>
                                        <th scope="col">Ward </th>
                                        {{-- <th scope="col">Created At</th> --}}
                                        <th scope="col">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    {{-- @php($i = 1) --}}
                                    @foreach ($citizens as $citizen)
                                        <tr>
                                            <td scope="row">{{ $citizens->firstItem() + $loop->index }}</td>
                                            <td>{{ $citizen->name }}</td>
                                            <td>{{ $citizen->gender }}</td>
                                            <td>{{ $citizen->address }}</td>
                                            <td>{{ $citizen->phone }}</td>
                                            <td>{{ $citizen['wards']['name'] }}</td>
                                            {{-- <td>
                                                @if ($citizen->created_at == null)
                                                    <span class="text-danger"> No Date Set</span>
                                                @else
                                                    {{ $citizen->created_at }}
                                                @endif

                                            </td> --}}
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
                                <input type="text" name="name" class="form-control" id="name" aria-describedby="name">
                                @error('name')
                                    <span class="text-danger"> {{ $message }}</span>
                                @enderror
                            </div>
                            <div class="controls">
                                <label for="gender" class="form-label">Gender:</label>
                                <select name="gender" class="form-control">
                                    <option value="" selected="" disabled="">Select Gender</option>
                                    <option value="male">Male</option>
                                    <option value="female">Female</option>
                                </select>
                                @error('gender')
                                    <span class="text-danger"> {{ $message }} </span>
                                @enderror
                            </div>
                            <br>
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
                            <div class="mb-3">
                                <label for="state_id" class="form-label"> State:</label>
                                <div class="controls">
                                    <select name="state_id" class="form-control">
                                        <option value="" selected="" disabled="">Select State
                                        </option>
                                        @foreach ($states as $state)
                                            <option value="{{ $state->id }}">
                                                {{ $state->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('state_id')
                                        <span class="text-danger"> {{ $message }} </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="mb-3">
                                <label for="lga_id" class="form-label">
                                    Local Government Area:</label>
                                <div class="controls">
                                    <select name="lga_id" class="form-control">
                                        <option value="" selected="" disabled="">Select Local Government Area
                                        </option>

                                    </select>
                                    @error('lga_id')
                                        <span class="text-danger"> {{ $message }} </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="mb-3">
                                <label for="ward_id" class="form-label">
                                    Ward:</label>
                                <div class="controls">
                                    <select name="ward_id" class="form-control">
                                        <option value="" selected="" disabled="">Select Ward
                                        </option>

                                    </select>
                                    @error('ward_id')
                                        <span class="text-danger"> {{ $message }} </span>
                                    @enderror
                                </div>
                            </div>

                            <button type="submit" class="btn btn-primary">Add Citizen</button>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
            </div>
        </div>
    </div>

    <script type="text/javascript">
        $(document).ready(function() {
            $('select[name="state_id"]').on('change', function() {
                var state_id = $(this).val();
                if (state_id) {
                    $.ajax({
                        url: "{{ url('/wards/lgas/ajax') }}/" + state_id,
                        type: "GET",
                        dataType: "json",
                        success: function(data) {
                            var d = $('select[name="lga_id"]').empty();
                            $.each(data, function(key, value) {
                                $('select[name="lga_id"]').append(
                                    '<option value="' + value.id + '">' + value
                                    .name + '</option>');
                            });
                        },
                    });
                } else {
                    alert('danger');
                }
            });
        });
    </script>

<script type="text/javascript">
    $(document).ready(function() {
        $('select[name="lga_id"]').on('change', function() {
            var lga_id = $(this).val();
            if (lga_id) {
                $.ajax({
                    url: "{{ url('/wards/lgas/ajax') }}/" + lga_id,
                    type: "GET",
                    dataType: "json",
                    success: function(data) {
                        var d = $('select[name="ward_id"]').empty();
                        $.each(data, function(key, value) {
                            $('select[name="ward_id"]').append(
                                '<option value="' + value.id + '">' + value
                                .name + '</option>');
                        });
                    },
                });
            } else {
                alert('danger');
            }
        });
    });
</script>

</x-app-layout>
