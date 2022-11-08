<?php

declare(strict_types=1);

namespace App\Orchid\Layouts\User;

use Orchid\Platform\Models\User;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Actions\DropDown;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Actions\ModalToggle;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Layouts\Persona;
use Orchid\Screen\Layouts\Table;
use Orchid\Screen\TD;

class UserListLayout extends Table
{
    /**
     * @var string
     */
    public $target = 'users';

    /**
     * @return TD[]
     */
    public function columns(): array
    {
        return [
            TD::make('name', __('Name'))
                ->sort()
                ->cantHide()
                ->filter(Input::make())
                ->render(function (User $user) {
                    return new Persona($user->presenter());
                }),

            TD::make('email', __('Email'))
                ->sort()
                ->cantHide()
                ->filter(Input::make())
                ->render(function (User $user) {
                    return ModalToggle::make($user->email)
                        ->modal('asyncEditUserModal')
                        ->modalTitle($user->presenter()->title())
                        ->method('saveUser')
                        ->asyncParameters([
                            'user' => $user->id,
                        ]);
                }),

            TD::make('updated_at', __('Last detection result'))
                ->sort()
                ->render(function (User $user) {
//                    return $user->updated_at->toDateTimeString();
                    return 'Possible glaucoma';
                }),

            TD::make('updated_at', __('Last detection date'))
                ->sort()
                ->render(function (User $user) {
                    return $user->updated_at->toDateTimeString();
                }),

            TD::make('updated_at', __('Suggested treatment methods'))
                ->sort()
                ->render(function (User $user) {
//                    return $user->updated_at->toDateTimeString();
                    return 'Lowering intraocular pressure, eye drops...';
                }),

            TD::make('updated_at', __('Notes'))
                ->sort()
                ->render(function (User $user) {
//                    return $user->updated_at->toDateTimeString();
                    return 'Patient: Ahmed Albakri, Time: 2:18 PM, Day: 4 Nov 2022';
                }),

            TD::make(__('Actions'))
                ->align(TD::ALIGN_CENTER)
                ->width('100px')
                ->render(function (User $user) {
                    return DropDown::make()
                        ->icon('options-vertical')
                        ->list([

                            Link::make(__('Edit'))
                                ->route('platform.systems.users.edit', $user->id)
                                ->icon('pencil'),

                            Button::make(__('Delete'))
                                ->icon('trash')
                                ->confirm(__('Once the account is deleted, all of its resources and data will be permanently deleted. Before deleting your account, please download any data or information that you wish to retain.'))
                                ->method('remove', [
                                    'id' => $user->id,
                                ]),
                        ]);
                }),
        ];
    }
}
