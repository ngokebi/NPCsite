<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Wards <b></b>
        </h2>
    </x-slot>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
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
                                        <th scope="col">State</th>
                                        <th scope="col"> Local Government Area </th>
                                        <th scope="col">Ward </th>
                                        <th scope="col">Created At</th>
                                        <th scope="col">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    {{-- @php($i = 1) --}}
                                    @foreach ($wards as $ward)
                                        <tr>
                                            <td scope="row">{{ $wards->firstItem() + $loop->index }}</td>
                                            <td>{{ $ward['states']['name'] }}</td>
                                            <td>{{ $ward['lgas']['name'] }}</td>
                                            <td>{{ $ward->name }}</td>
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
                    <div class="card-header"> Add Wards </div>
                    <div class="card-body">
                        <form action="{{ route('store.wards') }}" method="POST">
                            @csrf
                            <div class="mb-3">
                                <label for="state_id" class="form-label"> State:</label>
                                <div class="controls">
                                    <select name="state_id" class="form-control">
                                        <option value="" selected="" disabled="">Select State</option>
                                        @foreach ($states as $state)
                                            <option value="{{ $state->id }}">{{ $state->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('state_id')
                                        <span class="text-danger"> {{ $message }} </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="mb-3">
                                <label for="lga_id" class="form-label">Local Government:</label>
                                <div class="controls">
                                    <select name="lga_id" class="form-control">
                                        <option value="" selected="" disabled="">Select Local Government</option>
                                    </select>
                                    @error('lga_id')
                                        <span class="text-danger"> {{ $message }} </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="mb-3">
                                <label for="wards" class="form-label">Ward Name:</label>
                                <input type="text" name="name" class="form-control" id="wards"
                                    aria-describedby="wards">
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

</x-app-layout>
