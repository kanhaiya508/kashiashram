<x-app-layout>
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4">
            <span class="text-muted fw-light">Dashboard / Ashrams /</span> Add Ashram
        </h4>

        <div class="card">
            <div class="card-header">
                <a href="{{ route('ashrams.index') }}" class="btn btn-dark">
                    <i class="fa fa-arrow-left"></i> Back
                </a>
            </div>
            <div class="card-body">
                <form action="{{ route('ashrams.store') }}" method="POST" enctype="multipart/form-data">
                    @include('ashrams._form')
                    <div class="mt-3 text-end">
                        <button class="btn btn-primary"><i class="fa fa-save"></i> Save Ashram</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
