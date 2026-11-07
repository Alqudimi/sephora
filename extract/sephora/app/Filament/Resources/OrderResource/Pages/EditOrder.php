<?php

namespace App\Filament\Resources\OrderResource\Pages;

use App\Filament\Resources\OrderResource;
use Filament\Actions\DeleteAction;
use Filament\Actions\ViewAction;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Resources\Pages\EditRecord;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class EditOrder extends EditRecord
{
    protected static string $resource = OrderResource::class;

    public function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Fulfilment')
                    ->description('Update tracking and delivery details. Order status changes must be done from the order view page.')
                    ->columns(2)
                    ->schema([
                        TextInput::make('tracking_number')
                            ->maxLength(100),

                        Textarea::make('delivery_instructions')
                            ->rows(2),

                        Textarea::make('gift_message')
                            ->rows(2)
                            ->label('Gift message'),
                    ]),

                Section::make('Customer contact')
                    ->columns(2)
                    ->schema([
                        TextInput::make('customer_name')
                            ->required()
                            ->maxLength(255),

                        TextInput::make('customer_phone')
                            ->required()
                            ->maxLength(40),

                        TextInput::make('customer_email')
                            ->email()
                            ->required()
                            ->maxLength(255),

                        TextInput::make('guest_email')
                            ->email()
                            ->maxLength(255)
                            ->helperText('Used when the order was placed by a guest.'),
                    ]),

                Section::make('Shipping address')
                    ->columns(2)
                    ->schema([
                        TextInput::make('emirate')
                            ->maxLength(100),

                        TextInput::make('area')
                            ->maxLength(255),

                        Textarea::make('shipping_address')
                            ->rows(2)
                            ->columnSpanFull(),
                    ]),
            ]);
    }

    protected function getHeaderActions(): array
    {
        return [
            ViewAction::make(),
            DeleteAction::make(),
        ];
    }
}
