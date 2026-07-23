<?php

namespace App\Filament\Pages;

use Filament\Forms;
use Filament\Forms\ComponentContainer;
use Filament\Pages\Page;
use Filament\Notifications\Notification;
use Illuminate\Support\Facades\Hash;

/**
 * @property ComponentContainer $form
 */
class ChangePassword extends Page implements Forms\Contracts\HasForms
{
    use Forms\Concerns\InteractsWithForms;

    protected static ?string $navigationIcon = 'heroicon-o-key';
    protected static ?string $navigationLabel = 'პაროლის შეცვლა';
    protected static ?string $title = 'პაროლის შეცვლა';
    protected static ?string $slug = 'change-password';

    protected static string $view = 'filament.pages.change-password';

    public $current_password;
    public $new_password;
    public $new_password_confirmation;

    public function mount(): void
    {
        $this->form->fill();
    }

    protected function getFormSchema(): array
    {
        return [
            Forms\Components\Card::make()->schema([
                Forms\Components\TextInput::make('current_password')
                    ->label('მიმდინარე პაროლი')
                    ->password()
                    ->required()
                    ->currentPassword(),
                Forms\Components\TextInput::make('new_password')
                    ->label('ახალი პაროლი')
                    ->password()
                    ->required()
                    ->minLength(6)
                    ->same('new_password_confirmation'),
                Forms\Components\TextInput::make('new_password_confirmation')
                    ->label('დაადასტურეთ ახალი პაროლი')
                    ->password()
                    ->required(),
            ]),
        ];
    }

    public function submit(): void
    {
        $data = $this->form->getState();

        /** @var \App\Models\Admin $user */
        $user = auth()->user();

        $user->update([
            'password' => Hash::make($data['new_password']),
        ]);

        $this->form->fill();

        Notification::make()
            ->title('პაროლი წარმატებით შეიცვალა!')
            ->success()
            ->send();
    }
}
