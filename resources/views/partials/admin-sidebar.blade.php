<aside class="w-64 bg-gray-800 text-white shadow-xl flex flex-col p-4">
    <div class="mb-8 text-center">
        <a href="{{ route('admin.dashboard') }}" class="text-3xl font-extrabold text-indigo-400 tracking-wide hover:text-indigo-300 transition duration-300">
            Admin Panel
        </a>
    </div>

    <nav class="flex-1">
        <ul class="space-y-2">
            <li>
                <a href="{{ route('admin.dashboard') }}" class="flex items-center py-2 px-4 rounded-lg transition duration-200 hover:bg-gray-700 @if(request()->routeIs('admin.dashboard')) bg-gray-700 @endif">
                    <i class="fas fa-tachometer-alt mr-3 text-lg"></i>
                    Dashboard
                </a>
            </li>
            <li>
                <a href="{{ route('admin.villas.index') }}" class="flex items-center py-2 px-4 rounded-lg transition duration-200 hover:bg-gray-700 @if(request()->routeIs('admin.villas.*')) bg-gray-700 @endif">
                    <i class="fas fa-hotel mr-3 text-lg"></i>
                    Villas
                </a>
            </li>
                        <li>
                <a href="{{ route('admin.riads.index') }}" class="flex items-center py-2 px-4 rounded-lg transition duration-200 hover:bg-gray-700 @if(request()->routeIs('admin.riads.*')) bg-gray-700 @endif">
                    <i class="fas fa-building mr-3 text-lg"></i>
                    Riads
                </a>
            </li>
           
            <li>
                <a href="{{ route('admin.appartements.index') }}" class="flex items-center py-2 px-4 rounded-lg transition duration-200 hover:bg-gray-700 @if(request()->routeIs('admin.appartements.*')) bg-gray-700 @endif">
                    <i class="fas fa-city mr-3 text-lg"></i>
                    Appartements
                </a>
            </li>
            <li>
                <a href="{{ route('admin.transports.index', ['type' => 'moto']) }}" class="flex items-center py-2 px-4 rounded-lg transition duration-200 hover:bg-gray-700 @if(request()->fullUrlIs('*transports?type=moto*')) bg-gray-700 @endif">
                    <i class="fas fa-motorcycle mr-3 text-lg"></i>
                    Moto
                </a>
            </li>
            <li>
                <a href="{{ route('admin.transports.index', ['type' => 'voiture']) }}" class="flex items-center py-2 px-4 rounded-lg transition duration-200 hover:bg-gray-700 @if(request()->fullUrlIs('*transports?type=voiture*')) bg-gray-700 @endif">
                    <i class="fas fa-car-side mr-3 text-lg"></i>
                    Voiture
                </a>
            </li>
            <li>
                <a href="{{ route('admin.transports.index', ['type' => 'vip']) }}" class="flex items-center py-2 px-4 rounded-lg transition duration-200 hover:bg-gray-700 @if(request()->fullUrlIs('*transports?type=vip*')) bg-gray-700 @endif">
                    <i class="fas fa-crown mr-3 text-lg"></i>
                    VIP
                </a>
            </li>
            {{-- <li>
                <a href="{{ route('admin.users.index') }}" class="flex items-center py-2 px-4 rounded-lg transition duration-200 hover:bg-gray-700 @if(request()->routeIs('admin.users.*')) bg-gray-700 @endif">
                    <i class="fas fa-users mr-3 text-lg"></i>
                    Users
                </a>
            </li> --}}
        </ul>
    </nav>
    <div class="mt-auto pt-4 border-t border-gray-700 text-sm text-gray-400 text-center">
        &copy; {{ date('Y') }} Admin Panel
    </div>
</aside>
