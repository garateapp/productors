<nav x-data="{ open: false }" class="bg-white border-b border-gray-100">
    <!-- Primary Navigation Menu -->
    <div class="px-4 mx-auto max-w-7xl sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex">
                <!-- Logo -->
                <div class="flex items-center shrink-0">
                    <a href="{{ route('dashboard') }}">
                        <x-jet-application-mark class="block w-auto h-9" />
                    </a>
                </div>

                <!-- Navigation Links -->
                <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
                    <x-jet-nav-link href="{{ route('dashboard') }}" :active="request()->routeIs('dashboard.*')">
                        {{ __('Inicio') }}
                    </x-jet-nav-link>
                    @can('Ver productores')
                        <x-jet-nav-link href="{{ route('productors.index') }}" :active="request()->routeIs('productors.index')">
                            {{ __('Productores') }}
                        </x-jet-nav-link>
                    @endcan
                    @can('Ver produccion_total')
                        <x-jet-nav-link href="{{ route('production.index') }}" :active="request()->routeIs('production.index')">
                            {{ __('Recepciones') }}
                        </x-jet-nav-link>
                    @endcan
                    @can('Ver produccion_cc')
                        <x-jet-nav-link href="{{ route('productioncc.index') }}" :active="request()->routeIs('productioncc.index')">
                            {{ __('Recepciones CC') }}
                        </x-jet-nav-link>
                    @endcan
                    @can('Ver produccion_propia')
                        <x-jet-nav-link href="{{ route('productionpropia.index') }}" :active="request()->routeIs('productionpropia.index')">
                            {{ __('Recepciones') }}
                        </x-jet-nav-link>
                    @endcan
                    @can('Ver produccion_total')
                        <x-jet-nav-link href="{{ route('procesos.index') }}" :active="request()->routeIs('procesos.*')">
                            {{ __('Procesos') }}
                        </x-jet-nav-link>
                    @endcan
                    @can('Ver procesos_propios')
                        <x-jet-nav-link href="{{ route('procesos.productor.index', auth()->user()->id) }}"
                            :active="request()->routeIs('procesos.*')">
                            {{ __('Procesos') }}
                        </x-jet-nav-link>
                    @endcan
                    @can('Ver procesos_propios')
                        <x-jet-nav-link href="{{ route('mensajes.index') }}" :active="request()->routeIs('mensajes.index')">
                            {{ __('Información Técnica') }}
                        </x-jet-nav-link>
                    @endcan
                </div>
            </div>

            <div class="hidden sm:flex sm:items-center sm:ml-6">
                <!-- Teams Dropdown -->
                @if (Laravel\Jetstream\Jetstream::hasTeamFeatures())
                    <div class="relative ml-3">
                        <x-jet-dropdown align="right" width="60">
                            <x-slot name="trigger">
                                <span class="inline-flex rounded-md">
                                    <button type="button"
                                        class="inline-flex items-center px-3 py-2 text-sm font-medium leading-4 text-gray-500 transition bg-white border border-transparent rounded-md hover:bg-gray-50 hover:text-gray-700 focus:outline-none focus:bg-gray-50 active:bg-gray-50">
                                        {{ Auth::user()->currentTeam->name }}

                                        <svg class="ml-2 -mr-0.5 h-4 w-4" xmlns="http://www.w3.org/2000/svg"
                                            viewBox="0 0 20 20" fill="currentColor">
                                            <path fill-rule="evenodd"
                                                d="M10 3a1 1 0 01.707.293l3 3a1 1 0 01-1.414 1.414L10 5.414 7.707 7.707a1 1 0 01-1.414-1.414l3-3A1 1 0 0110 3zm-3.707 9.293a1 1 0 011.414 0L10 14.586l2.293-2.293a1 1 0 011.414 1.414l-3 3a1 1 0 01-1.414 0l-3-3a1 1 0 010-1.414z"
                                                clip-rule="evenodd" />
                                        </svg>
                                    </button>
                                </span>
                            </x-slot>

                            <x-slot name="content">
                                <div class="w-60">
                                    <!-- Team Management -->
                                    <div class="block px-4 py-2 text-xs text-gray-400">
                                        {{ __('Manage Team') }}
                                    </div>

                                    <!-- Team Settings -->
                                    <x-jet-dropdown-link
                                        href="{{ route('teams.show', Auth::user()->currentTeam->id) }}">
                                        {{ __('Team Settings') }}
                                    </x-jet-dropdown-link>

                                    @can('create', Laravel\Jetstream\Jetstream::newTeamModel())
                                        <x-jet-dropdown-link href="{{ route('teams.create') }}">
                                            {{ __('Create New Team') }}
                                        </x-jet-dropdown-link>
                                    @endcan

                                    <div class="border-t border-gray-100"></div>

                                    <!-- Team Switcher -->
                                    <div class="block px-4 py-2 text-xs text-gray-400">
                                        {{ __('Switch Teams') }}
                                    </div>

                                    @foreach (Auth::user()->allTeams() as $team)
                                        <x-jet-switchable-team :team="$team" />
                                    @endforeach
                                </div>
                            </x-slot>
                        </x-jet-dropdown>
                    </div>
                @endif

                <!-- Settings Dropdown -->
                <div class="relative ml-3">
                    <x-jet-dropdown align="right" width="48">
                        <x-slot name="trigger">
                            @if (Laravel\Jetstream\Jetstream::managesProfilePhotos())
                                <button
                                    class="flex items-center text-sm transition border-2 border-transparent rounded-full py-auto focus:outline-none focus:border-gray-300">
                                    <img class="object-cover w-8 h-8 mr-2 rounded-full"
                                        src="{{ Auth::user()->profile_photo_url }}" alt="{{ Auth::user()->name }}" />
                                    {{ Auth::user()->name }}
                                </button>
                            @else
                                <span class="inline-flex rounded-md">
                                    <button type="button"
                                        class="inline-flex items-center px-3 py-2 text-sm font-medium leading-4 text-gray-500 transition bg-white border border-transparent rounded-md hover:text-gray-700 focus:outline-none">
                                        {{ Auth::user()->name }}

                                        <svg class="ml-2 -mr-0.5 h-4 w-4" xmlns="http://www.w3.org/2000/svg"
                                            viewBox="0 0 20 20" fill="currentColor">
                                            <path fill-rule="evenodd"
                                                d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                                clip-rule="evenodd" />
                                        </svg>
                                    </button>
                                </span>
                            @endif
                        </x-slot>

                        <x-slot name="content">
                            @can('Asignar roles')
                                <x-jet-dropdown-link href="{{ route('admin.roles.index') }}">
                                    {{ __('Roles') }}
                                </x-jet-dropdown-link>
                            @endcan

                            @can('Ver produccion_total')
                                <x-jet-dropdown-link href="{{ route('documentacion') }}">
                                    {{ __('Documentación') }}
                                </x-jet-dropdown-link>
                            @endcan
                            @can('Ver produccion_total')
                                <x-jet-dropdown-link href="{{ route('estadisticas') }}">
                                    {{ __('Estadisticas de Uso') }}
                                </x-jet-dropdown-link>
                            @endcan

                            @can('Soporte')
                                <x-jet-dropdown-link href="{{ route('contacto') }}">
                                    {{ __('Contacto y Soporte') }}
                                </x-jet-dropdown-link>
                            @endcan

                            @can('Ver produccion_total')
                                <x-jet-dropdown-link href="{{ route('user.create') }}">
                                    {{ __('Crear Usuario') }}
                                </x-jet-dropdown-link>
                            @endcan
                            @can('Ver produccion_total')
                                <x-jet-dropdown-link href="{{ route('agronomos.index') }}">
                                    {{ __('Listado de Agrónomos') }}
                                </x-jet-dropdown-link>
                            @endcan

                            <x-jet-dropdown-link href="{{ route('mensajes.index') }}">
                                {{ __('Bandeja de Entrada') }}
                            </x-jet-dropdown-link>
                            @can('Ver produccion_total')
                                <x-jet-dropdown-link href="{{ route('subir.procesos') }}">
                                    {{ __('Subir Procesos') }}
                                </x-jet-dropdown-link>
                                <x-jet-dropdown-link href="{{ route('subir.recepciones') }}">
                                    {{ __('Subir Informes Recepción') }}
                                </x-jet-dropdown-link>

                                <x-jet-dropdown-link href="{{ route('envio.masivo') }}">
                                    {{ __('Envio Masivo') }}
                                </x-jet-dropdown-link>
                            @endcan
                            @can('Asignar roles')
                                <!--Documentación Productores-->
                                <x-jet-dropdown-link href="{{ route('tipodocumentacions.index') }}">
                                    {{ __('Tipo Documentos') }}
                                </x-jet-dropdown-link>
                                <x-jet-dropdown-link href="{{ route('documentacions.index') }}">
                                    {{ __('Documentos Productores') }}
                                </x-jet-dropdown-link>
                            @endcan
                            <!--Fin Documentación Productores-->
                            <!-- Account Management -->
                            <div class="block px-4 py-2 text-xs text-gray-400">
                                {{ __('Configuración') }}
                            </div>

                            <x-jet-dropdown-link href="{{ route('profile.show') }}">
                                {{ __('Perfil') }}
                            </x-jet-dropdown-link>

                            @if (Laravel\Jetstream\Jetstream::hasApiFeatures())
                                <x-jet-dropdown-link href="{{ route('api-tokens.index') }}">
                                    {{ __('API Tokens') }}
                                </x-jet-dropdown-link>
                            @endif

                            <div class="border-t border-gray-100"></div>

                            <!-- Authentication -->
                            <form method="POST" action="{{ route('logout') }}" x-data>
                                @csrf

                                <x-jet-dropdown-link href="{{ route('logout') }}" @click.prevent="$root.submit();">
                                    {{ __('Salir') }}
                                </x-jet-dropdown-link>
                            </form>
                        </x-slot>
                    </x-jet-dropdown>
                </div>
            </div>

            <!-- Hamburger -->
            <div class="flex items-center -mr-2 sm:hidden">
                <button @click="open = ! open"
                    class="inline-flex items-center justify-center p-2 text-gray-400 transition rounded-md hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500">
                    <svg class="w-6 h-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{ 'hidden': open, 'inline-flex': !open }" class="inline-flex"
                            stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{ 'hidden': !open, 'inline-flex': open }" class="hidden" stroke-linecap="round"
                            stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Responsive Navigation Menu -->
    <div :class="{ 'block': open, 'hidden': !open }" class="hidden sm:hidden">
        <div class="pt-2 pb-3 space-y-1">
            <x-jet-responsive-nav-link href="{{ route('dashboard') }}" :active="request()->routeIs('dashboard.*')">
                {{ __('Inicio') }}
            </x-jet-responsive-nav-link>
            @can('Ver productores')
                <x-jet-responsive-nav-link href="{{ route('productors.index') }}" :active="request()->routeIs('productors.index')">
                    {{ __('Productores') }}
                </x-jet-responsive-nav-link>
            @endcan
            @can('Ver produccion_total')
                <x-jet-responsive-nav-link href="{{ route('production.index') }}" :active="request()->routeIs('production.index')">
                    {{ __('Recepciones') }}
                </x-jet-responsive-nav-link>
            @endcan
            @can('Ver produccion_cc')
                <x-jet-responsive-nav-link href="{{ route('productioncc.index') }}" :active="request()->routeIs('productioncc.index')">
                    {{ __('Recepciones CC') }}
                </x-jet-responsive-nav-link>
            @endcan
            @can('Ver produccion_total')
                <x-jet-responsive-nav-link href="{{ route('procesos.index') }}" :active="request()->routeIs('procesos.*')">
                    {{ __('Procesos') }}
                </x-jet-responsive-nav-link>
            @endcan


        </div>

        <!-- Responsive Settings Options -->
        <div class="pt-4 pb-1 border-t border-gray-200">
            <div class="mt-3 space-y-1">
                <!-- Account Management -->
                @can('Asignar roles')
                    <x-jet-responsive-nav-link href="{{ route('admin.roles.index') }}" :active="request()->routeIs('admin.roles.index')">
                        {{ __('Roles') }}
                    </x-jet-responsive-nav-link>
                @endcan

                @can('Ver produccion_total')
                    <x-jet-responsive-nav-link href="{{ route('documentacion') }}" :active="request()->routeIs('documentacion')">
                        {{ __('Documentación') }}
                    </x-jet-responsive-nav-link>
                @endcan

                @can('Ver produccion_total')
                    <x-jet-responsive-nav-link href="{{ route('user.create') }}" :active="request()->routeIs('user.create')">
                        {{ __('Crear Usuario') }}
                    </x-jet-responsive-nav-link>
                @endcan
                @can('Ver produccion_total')
                    <x-jet-responsive-nav-link href="{{ route('agronomos.index') }}" :active="request()->routeIs('agronomos.index')">
                        {{ __('Listado de Agronomos') }}
                    </x-jet-responsive-nav-link>
                @endcan

                <x-jet-responsive-nav-link href="{{ route('mensajes.index') }}" :active="request()->routeIs('mensajes.index')">
                    {{ __('Bandeja de Entrada') }}
                </x-jet-responsive-nav-link>
                @can('Ver produccion_total')
                    <x-jet-responsive-nav-link href="{{ route('subir.procesos') }}" :active="request()->routeIs('subir.procesos')">
                        {{ __('Subir Procesos') }}
                    </x-jet-responsive-nav-link>
                    <x-jet-responsive-nav-link href="{{ route('subir.procesos') }}" :active="request()->routeIs('subir.recepciones')">
                        {{ __('Subir Informes Recepción') }}
                    </x-jet-responsive-nav-link>
                    <x-jet-responsive-nav-link href="{{ route('envio.masivo') }}" :active="request()->routeIs('envio.masivo')">
                        {{ __('Envio Masivo') }}
                    </x-jet-responsive-nav-link>
                @endcan

            </div>
            <div class="flex items-center px-4">
                @if (Laravel\Jetstream\Jetstream::managesProfilePhotos())
                    <div class="mr-3 shrink-0">
                        <img class="object-cover w-10 h-10 rounded-full" src="{{ Auth::user()->profile_photo_url }}"
                            alt="{{ Auth::user()->name }}" />
                    </div>
                @endif

                <div>
                    <div class="text-base font-medium text-gray-800">{{ Auth::user()->name }}</div>
                    <div class="text-sm font-medium text-gray-500">{{ Auth::user()->email }}</div>
                </div>
            </div>

            <div class="mt-3 space-y-1">
                <!-- Account Management -->
                <x-jet-responsive-nav-link href="{{ route('profile.show') }}" :active="request()->routeIs('profile.show')">
                    {{ __('Perfil') }}
                </x-jet-responsive-nav-link>

                @if (Laravel\Jetstream\Jetstream::hasApiFeatures())
                    <x-jet-responsive-nav-link href="{{ route('api-tokens.index') }}" :active="request()->routeIs('api-tokens.index')">
                        {{ __('API Tokens') }}
                    </x-jet-responsive-nav-link>
                @endif

                <!-- Authentication -->
                <form method="POST" action="{{ route('logout') }}" x-data>
                    @csrf

                    <x-jet-responsive-nav-link href="{{ route('logout') }}" @click.prevent="$root.submit();">
                        {{ __('Salir') }}
                    </x-jet-responsive-nav-link>
                </form>

                <!-- Team Management -->
                @if (Laravel\Jetstream\Jetstream::hasTeamFeatures())
                    <div class="border-t border-gray-200"></div>

                    <div class="block px-4 py-2 text-xs text-gray-400">
                        {{ __('Manage Team') }}
                    </div>

                    <!-- Team Settings -->
                    <x-jet-responsive-nav-link href="{{ route('teams.show', Auth::user()->currentTeam->id) }}"
                        :active="request()->routeIs('teams.show')">
                        {{ __('Team Settings') }}
                    </x-jet-responsive-nav-link>

                    @can('create', Laravel\Jetstream\Jetstream::newTeamModel())
                        <x-jet-responsive-nav-link href="{{ route('teams.create') }}" :active="request()->routeIs('teams.create')">
                            {{ __('Create New Team') }}
                        </x-jet-responsive-nav-link>
                    @endcan

                    <div class="border-t border-gray-200"></div>

                    <!-- Team Switcher -->
                    <div class="block px-4 py-2 text-xs text-gray-400">
                        {{ __('Switch Teams') }}
                    </div>

                    @foreach (Auth::user()->allTeams() as $team)
                        <x-jet-switchable-team :team="$team" component="jet-responsive-nav-link" />
                    @endforeach
                @endif
            </div>
        </div>
    </div>
</nav>
