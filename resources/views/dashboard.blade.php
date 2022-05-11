<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('All Citizens') }}
        </h2>
    </x-slot>


    <div class="py-12">
        <div class="container">
            <div class="row">
                <div class="col-md-9">
                    <div class="card">

                        {{-- @if(session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <strong>{{session('success')}}</strong>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                          </div>
                          @endif --}}

                        <div class="card-header"> Citizens </div>
                        <div class="card-body">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col"> Name</th>
                                        <th scope="col">Email</th>
                                        <th scope="col">Created At</th>
                                        {{-- <th scope="col">Action</th> --}}
                                    </tr>
                                </thead>
                                <tbody>
                                    @php($i = 1)
                                    @foreach($users as $user)
                                    <tr>
                                        <th scope="row">{{ $i++}}</th>
                                        <td>{{$user->name}}</td>
                                        <td>{{$user->email}}</td>
                                        <td>
                                            @if ($user->created_at == NULL)
                                                <span class="text-danger"> No Date Set</span>
                                            @else
                                            {{$user->created_at}}
                                            @endif

                                        </td>
                                        <td>
                                            <a href="{{url('user/edit/'.$user->id)}}" class="btn btn-info">Edit</a>
                                            <a href="{{url('delete/user/'.$user->id)}}" class="btn btn-danger">Delete</a>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            {{-- {{ $users->links()}} --}}
                        </div>
                    </div>
                </div>

                {{-- <div class="col-md-4">
                    <div class="card">
                        <div class="card-header"> Add Category </div>
                        <div class="card-body">
                            <form action="{{route('store.category')}}" method="POST">
                                @csrf
                                <div class="mb-3">
                                    <label for="exampleInputEmail1" class="form-label">Category Name:</label>
                                    <input type="text" name = "category_name" class="form-control" id="exampleInputEmail1"
                                        aria-describedby="emailHelp">
                                        @error('category_name')
                                            <span class="text-danger"> {{$message}}</span>
                                        @enderror
                                </div>
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </form>
                        </div>
                    </div>
                </div> --}}
            </div>
        </div>
    </div>
</x-app-layout>
