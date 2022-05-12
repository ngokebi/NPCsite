<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Edit Ward <b></b>
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
                        <div class="card-header"> Edit Ward </div>
                        <div class="card-body">
                            <form action="{{ url('wards/update/' . $edit_wards->id) }}" method="POST">
                                @csrf
                                <input type="hidden" name="id" value="{{ $edit_wards->id }}">
                                <div class="mb-3">
                                    <label for="wards" class="form-label"> Wards:</label>
                                    <input type="text" name="name" class="form-control" id="wards"
                                        aria-describedby="wards" value="{{ $edit_wards->name }}">
                                    @error('name')
                                        <span class="text-danger"> {{ $message }}</span>
                                    @enderror
                                    <br>
                                    <div class="controls">
                                        <label for="lga_id" class="form-label">Local Government Area:</label>
                                        <select name="lga_id" class="form-control" disabled>
                                            <option value="" selected="" disabled="">Select Local Government Area</option>
                                            @foreach ($lgas as $lga)
                                                <option value="{{ $lga->id }}"
                                                    {{ $lga->id == $edit_wards->lga_id ? 'selected' : '' }}>
                                                    {{ $lga->name }}</option>
                                            @endforeach
                                        </select>
                                        @error('lga_id')
                                            <span class="text-danger"> {{ $message }} </span>
                                        @enderror
                                    </div>
                                    <div class="mb-3">
                                        <label for="state_id" class="form-label">State:</label>
                                        <div class="controls">
                                            <select name="state_id" class="form-control" disabled>
                                                <option value="" selected="" disabled="">Select State</option>
                                                @foreach ($states as $state)
                                                    <option value="{{ $state->id }}"
                                                        {{ $state->id == $edit_wards->state_id ? 'selected' : '' }}>
                                                        {{ $state->name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            @error('state_id')
                                                <span class="text-danger"> {{ $message }} </span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-primary">Update</button>
                                <a class="btn btn-info" href="{{ route('wards') }}">Back</a>
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
</x-app-layout>
