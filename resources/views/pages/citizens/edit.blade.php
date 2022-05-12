<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Edit State <b></b>
        </h2>
    </x-slot>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
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
                        <div class="card-header"> Edit State </div>
                        <div class="card-body">
                            <form action="{{ url('citizens/update/' . $edit_citizens->id) }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="id" value="{{ $edit_citizens->id }}">
                                    <div class="mb-3">
                                        <label for="name" class="form-label"> Name:</label>
                                        <input type="text" name="name" class="form-control" id="name" value="{{ $edit_citizens->name }}" aria-describedby="name">
                                        @error('name')
                                            <span class="text-danger"> {{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="controls">
                                        <label for="gender" class="form-label">Gender:</label>
                                        <select name="gender" class="form-control" value="{{ $edit_citizens->gender }}">
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
                                        <input type="text" name="address" class="form-control" id="address" value="{{ $edit_citizens->address }}"
                                            aria-describedby="address">
                                        @error('address')
                                            <span class="text-danger"> {{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="mb-3">
                                        <label for="phone" class="form-label">Phone Number:</label>
                                        <input type="text" name="phone" class="form-control" id="phone" value="{{ $edit_citizens->phone }}"
                                            aria-describedby="phone">
                                        @error('phone')
                                            <span class="text-danger"> {{ $message }}</span>
                                        @enderror
                                    </div>
                                        <div class="mb-3">
                                            <label for="state_id" class="form-label">State:</label>
                                            <div class="controls">
                                                <select name="state_id" class="form-control">
                                                    <option value="" selected="" disabled="">Select State</option>
                                                    @foreach ($states as $state)
                                                        <option value="{{ $state->id }}"
                                                            {{ $state->id == $edit_citizens->state_id ? 'selected' : '' }}>
                                                            {{ $state->name }}</option>
                                                    @endforeach
                                                </select>
                                                @error('state_id')
                                                    <span class="text-danger"> {{ $message }} </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="mb-3">
                                            <label for="lga_id" class="form-label"> Local Government Area:</label>
                                            <div class="controls">
                                                <select name="lga_id" class="form-control">
                                                    <option value="" selected="" disabled="">Select Local Government Area</option>
                                                    @foreach ($lgas as $lga)
                                                        <option value="{{ $lga->id }}"
                                                            {{ $lga->id == $edit_citizens->lga_id ? 'selected' : '' }}>
                                                            {{ $lga->name }}</option>
                                                    @endforeach
                                                </select>
                                                @error('lga_id')
                                                    <span class="text-danger"> {{ $message }} </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="mb-3">
                                            <label for="ward_id" class="form-label">Ward :</label>
                                            <div class="controls">
                                                <select name="ward_id" class="form-control">
                                                    <option value="" selected="" disabled="">Select Ward</option>
                                                    @foreach ($wards as $ward)
                                                        <option value="{{ $ward->id }}"
                                                            {{ $ward->id == $edit_citizens->ward_id ? 'selected' : '' }}>
                                                            {{ $ward->name }}</option>
                                                    @endforeach
                                                </select>
                                                @error('ward_id')
                                                    <span class="text-danger"> {{ $message }} </span>
                                                @enderror
                                            </div>
                                        </div>
                                    <button type="submit" class="btn btn-primary">Update Citizen</button>
                                    <a class="btn btn-info" href="{{ route('citizens') }}">Back</a>
                                </form>
                        </div>
                    </div>
                </div>
            </div>
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
                    url: "{{ url('/wards/wards/ajax') }}/" + lga_id,
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
