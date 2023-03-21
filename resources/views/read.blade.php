@extends("layouts.master");

@section('title')
    <title>Customer List</title>
@endsection

@section("body")
        <!-- Header -->
        <header class="ex-header">
            <div class="container">
                <div class="row">
                    <div class="col-xl-10 offset-xl-1">
                        <h1>This is Customer List</h1>
                    </div> <!-- end of col -->
                </div> <!-- end of row -->
            </div> <!-- end of container -->
        </header> <!-- end of ex-header -->
        <!-- end of header -->

    <div class="text-center text-success">
        @if(session('createSuccess'))
            {{ session('createSuccess') }}
        @endif

        @if(session('updateSuccess'))
            {{ session('updateSuccess') }}
        @endif
    </div>

    <div class="text-center text-danger">
        @if(session('deleteSuccess'))
            {{ session('deleteSuccess') }}
        @endif
    </div>
        <!-- Basic -->
        <div class="ex-basic-1 pt-5 pb-5">
            <div class="container">
                <div class="row">
                    <h3>Total Customers : {{ $data->total() }}</h3>
                    <div class="col-xl-10 offset-xl-1">
                        @foreach ($data as $item)
                            <h3>{{ $item->id }}. {{ $item->name }} <a href="{{ route('update#page',[$item->id]) }}" class="btn btn-outline-dark">Update</a><a href="{{ route('delete',[$item->id]) }}" class="btn btn-outline-danger ms-1">Delete</a></h3>
                            <p class="mb-1">
                                <ul>
                                    <li><b>Email:</b> {{ $item->email }}</li>
                                    <li><b>Phone:</b> {{ $item->phone }}</li>
                                    <li><b>Address:</b> @if ($item->address == "Ygn")
                                        Yangon
                                    @elseif ($item->address == "Mdy")
                                        Mandalay
                                    @elseif ( $item->address  == "Ss")
                                        Shan State
                                    @else
                                        Kachin
                                    @endif</li>
                                    <li><small><b>Created_at:</b> {{ $item->created_at->format("d-M-o") }}</small></li>
                                    <li><small><b>Updated_at:</b> {{ $item->updated_at->format("d-M-o") }}</small></li>

                                </ul>
                            </p>
                        @endforeach
                        {{ $data->links() }}
                    </div> <!-- end of col -->
                </div> <!-- end of row -->
            </div> <!-- end of container -->
        </div> <!-- end of ex-basic-1 -->
        <!-- end of basic -->
@endsection

Create read
