@if (count(\Laravel\Nova\Nova::resourcesForNavigation(request())))
    @foreach($navigation as $group => $resources)
        @if (count($groups) > 1)
            <h3 class="flex items-center font-normal text-white mb-6 text-base no-underline">
                @if(view()->exists('nova.icons.'. \Illuminate\Support\Str::slug($group)))
                    @include('nova.icons.'. \Illuminate\Support\Str::slug($group))
                @else
                    @include('nova.icons.resource')
                @endif

                <span style="cursor: pointer" onclick="if(document.getElementById('{{ \Illuminate\Support\Str::slug($group) }}').style.display === 'none') {document.getElementById('{{ \Illuminate\Support\Str::slug($group) }}').style.display ='block';} else {document.getElementById('{{ \Illuminate\Support\Str::slug($group) }}').style.display = 'none';}" class="sidebar-label">{{ $group === 'Other' ? __('Resources') : $group }}</span>
            </h3>
        @endif

        @php
            $subGrouped = [];
            foreach($resources as $resource) {
                if(method_exists($resource,'subGroup') ) {
                    $subGrouped[$resource::subGroup()][] = $resource;
                }
                else {
                    $subGrouped['nulled'][] = $resource;
                }
            }
        @endphp

        <ul id="{{ \Illuminate\Support\Str::slug($group) }}" class="list-reset mb-8">
            @foreach($subGrouped as $subGroup => $resources)
                @if($subGroup !== 'nulled')
                    <h4 style="cursor: pointer" class="ml-8 mb-4 text-xs text-white-50% uppercase tracking-wide" onclick="if(document.getElementById('{{ \Illuminate\Support\Str::slug($subGroup) }}').style.display === 'none') {document.getElementById('{{ \Illuminate\Support\Str::slug($subGroup) }}').style.display ='block';} else {document.getElementById('{{ \Illuminate\Support\Str::slug($subGroup) }}').style.display = 'none';}" >{{ $subGroup }}</h4>

                    <div id="{{ \Illuminate\Support\Str::slug($subGroup) }}">
                        @foreach($resources as $resource)
                            <li class="leading-tight mb-4 ml-8 text-sm">
                                <router-link :to="{
                        name: 'index',
                        params: {
                            resourceName: '{{ $resource::uriKey() }}'
                        }
                    }" class="text-white text-justify no-underline dim">
                                    {{ $resource::label() }}
                                </router-link>
                            </li>
                        @endforeach
                    </div>
                @else
                    @foreach($resources as $resource)
                        <li class="leading-tight mb-4 ml-8 text-sm">
                            <router-link :to="{
                        name: 'index',
                        params: {
                            resourceName: '{{ $resource::uriKey() }}'
                        }
                    }" class="text-white text-justify no-underline dim">
                                {{ $resource::label() }}
                            </router-link>
                        </li>
                    @endforeach
                @endif
            @endforeach
        </ul>
    @endforeach
@endif
