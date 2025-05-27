<x-app-layout>
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4">
            <span class="text-muted fw-light">Dashboard / Rooms /</span> Add Room
        </h4>

        <div class="card">
            <div class="card-header">
                <a href="{{ route('rooms.index') }}" class="btn btn-dark">
                    <i class="fa fa-arrow-left"></i> Back
                </a>
            </div>
            <div class="card-body">
                <form action="{{ route('rooms.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @include('rooms._form')
                    <div class="text-end mt-3">
                        <button class="btn btn-primary"><i class="fa fa-save"></i> Save Room</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
