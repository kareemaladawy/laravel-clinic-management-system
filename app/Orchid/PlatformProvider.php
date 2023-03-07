<?php

declare(strict_types=1);

namespace App\Orchid;

use Orchid\Platform\Dashboard;
use Orchid\Platform\ItemPermission;
use Orchid\Platform\OrchidServiceProvider;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Actions\Menu;
use Orchid\Support\Color;

class PlatformProvider extends OrchidServiceProvider
{
    /**
     * @param Dashboard $dashboard
     */
    public function boot(Dashboard $dashboard): void
    {
        parent::boot($dashboard);
    }

    /**
     * @return Menu[]
     */
    public function registerMainMenu(): array
    {
        return [

            Menu::make('Dashboard')
                ->icon('monitor')
                ->route('platform.main'),

            Menu::make(__('Detector'))
                ->icon('frame')
                ->route('platform.system.detector')
                ->permission('platform.system.detector')
                ->title(__('Services')),

            Menu::make(__('Detections'))
                ->icon('eye')
                ->route('platform.system.detections')
                ->permission('platform.system.detections')
                ->title(__('Navigation')),

            Menu::make(__('Patients'))
                ->icon('user')
                ->route('platform.system.patients')
                ->permission('platform.system.patients'),

            Menu::make(__('Appointments'))
                ->icon('calendar')
                ->route('platform.system.appointments')
                ->permission('platform.system.appointments'),

            Menu::make(__('Roles'))
                ->icon('lock')
                ->route('platform.system.roles')
                ->permission('platform.system.roles'),

            Menu::make(__('Users'))
                ->icon('user')
                ->route('platform.system.users')
                ->permission('platform.system.users'),
        ];
    }

    /**
     * @return Menu[]
     */
    public function registerProfileMenu(): array
    {
        return [
            Menu::make('Profile')
                ->route('platform.profile')
                ->icon('user'),
        ];
    }

    /**
     * @return ItemPermission[]
     */
    public function registerPermissions(): array
    {
        return [
            ItemPermission::group(__('System'))
                ->addPermission('platform.system.roles', __('Roles'))
                ->addPermission('platform.system.patients', __('Patients'))
                ->addPermission('platform.system.users', __('Users'))
                ->addPermission('platform.system.detector', __('Detector'))
                ->addPermission('platform.system.detections', __('Detections'))
                ->addPermission('platform.system.appointments', __('Appointments'))
        ];
    }
}
