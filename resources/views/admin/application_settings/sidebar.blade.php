<div class="card-body">
    <div class="sidebar__item">
        <ul class="sidebar__mail__nav">
            <h2>{{__('Global Settings')}}</h2>

            <li>
                <a href="{{ route('settings.general_setting') }}" class="list-item {{ @$generalSettingsActiveClass }}">
                    <img src="{{ asset('admin/images/heroicon/outline/cog.svg') }}" alt="icon">
                    <span>{{__('Global Settings')}}</span>
                </a>
            </li>

            <li>
                <a href="{{ route('settings.social-login-settings') }}" class="list-item">
                    <img src="{{ asset('admin/images/heroicon/outline/cog.svg') }}" alt="icon">
                    <span>{{__('Social Login Settings')}}</span>
                </a>
            </li>

            <li>
                <a href="{{ route('settings.currency.index') }}" class="list-item {{ @$subNavCurrencyActiveClass }}">
                    <img src="{{ asset('admin/images/heroicon/outline/cog.svg') }}" alt="icon">
                    <span>{{ __('Currency Settings') }}</span>
                </a>
            </li>
            <li>
                <a href="{{ route('settings.meta.index') }}" class="list-item {{ @$metaIndexActiveClass }}">
                    <img src="{{ asset('admin/images/heroicon/outline/cog.svg') }}" alt="icon">
                    <span>{{ __('Meta Management') }}</span>
                </a>
            </li>

            <li>
                <a href="{{ route('settings.map-api-key') }}" class="list-item {{ @$siteMapApiKeyActiveClass }}">
                    <img src="{{ asset('admin/images/heroicon/outline/cog.svg') }}" alt="icon">
                    <span>{{ __('Geo Location Api Key') }}</span>
                </a>
            </li>



            <li>
                <a href="{{ route('settings.device_control') }}" class="list-item {{ @$deviceControlActiveClass }}">
                    <img src="{{ asset('admin/images/heroicon/outline/cog.svg') }}" alt="icon">
                    <span>{{ __('Device Control') }}</span>
                </a>
            </li>



        </ul>
    </div>
    <div class="sidebar__item">
        <ul class="sidebar__mail__nav">
            <h2>{{__('Location Settings')}}</h2>

            <li>
                <a href="{{ route('settings.location.country.index') }}" class="list-item {{ @$subNavCountryActiveClass }}">
                    <img src="{{ asset('admin/images/heroicon/outline/cog.svg') }}" alt="icon">
                    <span>{{ __('Country') }}</span>
                </a>
            </li>
            <li>
                <a href="{{ route('settings.location.state.index') }}" class="list-item {{ @$subNavStateActiveClass }}">
                    <img src="{{ asset('admin/images/heroicon/outline/cog.svg') }}" alt="icon">
                    <span>{{ __('State') }}</span>
                </a>
            </li>
            <li>
                <a href="{{ route('settings.location.city.index') }}" class="list-item {{ @$subNavCityActiveClass }}">
                    <img src="{{ asset('admin/images/heroicon/outline/cog.svg') }}" alt="icon">
                    <span>{{ __('City') }}</span>
                </a>
            </li>
        </ul>
    </div>
    <div class="sidebar__item">
        <ul class="sidebar__mail__nav">
            <h2>{{ __('Mail Configuration') }}</h2>

            <li>
                <a href="{{ route('settings.mail-configuration') }}" class="list-item {{ @$mailConfigSettingsActiveClass }}">
                    <img src="{{ asset('admin/images/heroicon/outline/cog.svg') }}" alt="icon">
                    <span>{{ __('Mail Configuration') }}</span>
                </a>
            </li>

        </ul>
    </div>
    <div class="sidebar__item">
        <ul class="sidebar__mail__nav">
            <h2>{{ __('Payment Options') }}</h2>

            <li>
                <a href="{{ route('settings.payment_method_settings') }}" class="list-item {{ @$paymentMethodSettingsActiveClass }}">
                    <img src="{{ asset('admin/images/heroicon/outline/cog.svg') }}" alt="icon">
                    <span>{{ __('Payment Method') }}</span>
                </a>
            </li>
            <li>
                <a href="{{ route('settings.bank.index') }}" class="list-item {{ @$bankSettingsActiveClass }}">
                    <img src="{{ asset('admin/images/heroicon/outline/cog.svg') }}" alt="icon">
                    <span>{{ __('Bank') }}</span>
                </a>
            </li>

        </ul>
    </div>


    <div class="sidebar__item">
        <ul class="sidebar__mail__nav">
            <h2>{{ __('Support Ticket') }}</h2>

            <li>
                <a href="{{ route('settings.support-ticket.cms') }}" class="list-item {{ @$supportCMSSettingsActiveClass }}">
                    <img src="{{ asset('admin/images/heroicon/outline/cog.svg') }}" alt="icon">
                    <span>{{ __('Support Ticket CMS') }}</span>
                </a>
            </li>
            <li>
                <a href="{{ route('settings.support-ticket.question') }}" class="list-item {{ @$supportQuestionActiveClass }}">
                    <img src="{{ asset('admin/images/heroicon/outline/cog.svg') }}" alt="icon">
                    <span>{{ __('Question & Answer') }}</span>
                </a>
            </li>

            <li>
                <a href="{{ route('settings.support-ticket.department') }}" class="list-item {{ @$supportDepartmentActiveClass }}">
                    <img src="{{ asset('admin/images/heroicon/outline/cog.svg') }}" alt="icon">
                    <span>{{ __('Support Ticket Department Field') }}</span>
                </a>
            </li>
            <li>
                <a href="{{ route('settings.support-ticket.priority') }}" class="list-item {{ @$supportPriorityActiveClass }}">
                    <img src="{{ asset('admin/images/heroicon/outline/cog.svg') }}" alt="icon">
                    <span>{{ __('Support Ticket Priority Field') }}</span>
                </a>
            </li>
            <li>
                <a href="{{ route('settings.support-ticket.services') }}" class="list-item {{ @$supportRelatedActiveClass }}">
                    <img src="{{ asset('admin/images/heroicon/outline/cog.svg') }}" alt="icon">
                    <span>{{ __('Support Ticket Related Service') }}</span>
                </a>
            </li>

        </ul>
    </div>

    <div class="sidebar__item">
        <ul class="sidebar__mail__nav">
            <h2>{{ __('About Us') }}</h2>

            <li>
                <a href="{{ route('settings.about.gallery-area') }}" class="list-item {{ @$subNavGalleryAreaActiveClass }}">
                    <img src="{{ asset('admin/images/heroicon/outline/cog.svg') }}" alt="icon">
                    <span>{{ __('Gallery Area') }}</span>
                </a>
            </li>
            <li>
                <a href="{{ route('settings.about.our-history') }}" class="list-item {{ @$subNavOurHistoryActiveClass }}">
                    <img src="{{ asset('admin/images/heroicon/outline/cog.svg') }}" alt="icon">
                    <span>{{ __('Our History') }}</span>
                </a>
            </li>
            <li>
                <a href="{{ route('settings.about.upgrade-skill') }}" class="list-item {{ @$subNavUpgradeSkillActiveClass }}">
                    <img src="{{ asset('admin/images/heroicon/outline/cog.svg') }}" alt="icon">
                    <span>{{ __('Upgrade Skills') }}</span>
                </a>
            </li>
            <li>
                <a href="{{ route('settings.about.team-member') }}" class="list-item {{ @$subNavTeamMemberActiveClass }}">
                    <img src="{{ asset('admin/images/heroicon/outline/cog.svg') }}" alt="icon">
                    <span>{{ __('Team Member') }}</span>
                </a>
            </li>

            <li>
                <a href="{{ route('settings.about.client') }}" class="list-item {{ @$subNavClientActiveClass }}">
                    <img src="{{ asset('admin/images/heroicon/outline/cog.svg') }}" alt="icon">
                    <span>{{ __('Client') }}</span>
                </a>
            </li>

        </ul>
    </div>

    <div class="sidebar__item">
        <ul class="sidebar__mail__nav">
            <h2>{{ __('Contact Us') }}</h2>

            <li>
                <a href="{{ route('settings.contact.cms') }}" class="list-item {{ @$contactUsSettingsActiveClass }}">
                    <img src="{{ asset('admin/images/heroicon/outline/cog.svg') }}" alt="icon">
                    <span>{{ __('Contact Us') }}</span>
                </a>
            </li>

        </ul>
    </div>


</div>
