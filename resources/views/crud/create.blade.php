<x-app-layout>
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4">
            <span class="text-muted fw-light">Dashboard /</span>
            <span class="text-muted fw-light">System Settings /</span> {{ $pagename }}
        </h4>

        <div class="card">
            <div class="card-header">
                @can($permissionPrefix . '-create')
                    <!-- Use dynamic permission for create -->
                    <a href="{{ route($routePrefix . '.create') }}">
                        <x-back-button route="{{ route($routePrefix . '.index') }}" icon="fa-arrow-left" text="Back" />
                    </a>
                @endcan
            </div>
            <div class="card-body">
                <div class="text-nowrap">
                    <form method="POST" action="{{ route($routePrefix . '.store') }}">
                        <!-- Dynamic store route -->
                        @csrf
                        @include($routePrefix . '.form')
                        <x-primary-button>Submit</x-primary-button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
