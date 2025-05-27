<x-app-layout>
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4">
            <span class="text-muted fw-light">Dashboard / Ashrams /</span> Edit Ashram
        </h4>

        <div class="card">
            <div class="card-body">
                <form action="{{ route('ashrams.update', $ashram->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf @method('PUT')
                    @include('ashrams._form')
                    <div class="mt-3 text-end">
                        <button class="btn btn-primary"><i class="fa fa-save"></i> Update Ashram</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
