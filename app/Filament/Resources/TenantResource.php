<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use App\Models\Tenant;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use Filament\Tables\Filters\Filter;
use Illuminate\Support\Facades\Auth;
use Filament\Tables\Filters\SelectFilter;
use Illuminate\Database\Eloquent\Builder;
use App\Filament\Resources\TenantResource\Pages;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\TenantResource\RelationManagers;
use App\Filament\Resources\TenantResource\RelationManagers\TenantAdminsRelationManager;

class TenantResource extends Resource
{
    protected static ?string $model = Tenant::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->required()
                    ->maxLength(255),
                Forms\Components\Select::make('marketer_id')
                    ->relationship('marketer', 'name')
                    ->searchable()
                    ->preload()
                    ->default(auth()->id())
                    ->required(),
                Forms\Components\Fieldset::make('Address')
                    ->schema([
                        Forms\Components\Select::make('district')
                            ->options([
                                'Alappuzha' => 'Alappuzha',
                                'Ernakulam' => 'Ernakulam',
                                'Idukki' => 'Idukki',
                                'Kannur' => 'Kannur',
                                'Kasaragod' => 'Kasaragod',
                                'Kollam' => 'Kollam',
                                'Kottayam' => 'Kottayam',
                                'Kozhikode' => 'Kozhikode',
                                'Malappuram' => 'Malappuram',
                                'Palakkad' => 'Palakkad',
                                'Pathanamthitta' => 'Pathanamthitta',
                                'Thiruvananthapuram' => 'Thiruvananthapuram',
                                'Thrissur' => 'Thrissur',
                                'Wayanad' => 'Wayanad',
                            ])
                            ->placeholder('Select a district')
                            ->default('Thiruvananthapuram')
                            ->required(),
                        Forms\Components\TextInput::make('place')
                            ->required()
                            ->maxLength(255),
                        Forms\Components\TextInput::make('address')
                            ->required()
                            ->maxLength(255)
                            ->columnSpanFull()
                            ->label('Building/Lane/Street'),
                        Forms\Components\TextInput::make('pincode')
                            ->required()
                            ->rules(['required', 'digits:6'])
                            ->placeholder('Enter pincode'),
                        Forms\Components\TextInput::make('phone')
                            ->required()
                            ->rules(['required', 'numeric', 'digits:10'])
                            ->label('Office phone'),
                    ]),
                Forms\Components\Fieldset::make('Location')
                    ->schema([
                        Forms\Components\TextInput::make('latitude')
                            ->rules(['numeric', 'between:-90,90'])
                            ->placeholder('Enter latitude'),
                        Forms\Components\TextInput::make('longitude')
                            ->rules(['numeric', 'between:-180,180'])
                            ->placeholder('Enter longitude'),
                    ]),
                Forms\Components\Fieldset::make('Status')
                    ->schema([
                        Forms\Components\Select::make('visibility')
                            ->options([
                                'Public' => 'Public',
                                'Private' => 'Private',
                            ])
                            ->default('Public')
                            ->required(),
                        Forms\Components\Select::make('subscription_status')
                            ->options([
                                'Active' => 'Active',
                                'Inactive' => 'Inactive',
                            ])
                            ->default('Active')
                            ->required(),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')->searchable(),
                Tables\Columns\TextColumn::make('marketer.name')->label('Marketer')->searchable(),
                Tables\Columns\TextColumn::make('district'),
                Tables\Columns\TextColumn::make('place')->searchable(),
                Tables\Columns\TextColumn::make('address')->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('pincode')->searchable(),
                Tables\Columns\TextColumn::make('phone')->searchable(),
                Tables\Columns\TextColumn::make('latitude')->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('longitude')->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('visibility')->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('subscription_status')->label('Status'),
                Tables\Columns\TextColumn::make('created_at')->dateTime()->sortable(),
            ])
            ->defaultSort('created_at', 'desc')
            ->filters([
                // Filter::make('is_featured')
                // ->query(fn (Builder $query) => $query->where('is_featured', true)),
                SelectFilter::make('visibility')
                    ->options([
                        'Public' => 'Public',
                        'Private' => 'Private',
                    ]),
                SelectFilter::make('subscription_status')
                    ->options([
                        'Active' => 'Active',
                        'Inactive' => 'Inactive',
                    ]),
                SelectFilter::make('district')
                    ->options([
                        'Alappuzha' => 'Alappuzha',
                        'Ernakulam' => 'Ernakulam',
                        'Idukki' => 'Idukki',
                        'Kannur' => 'Kannur',
                        'Kasaragod' => 'Kasaragod',
                        'Kollam' => 'Kollam',
                        'Kottayam' => 'Kottayam',
                        'Kozhikode' => 'Kozhikode',
                        'Malappuram' => 'Malappuram',
                        'Palakkad' => 'Palakkad',
                        'Pathanamthitta' => 'Pathanamthitta',
                        'Thiruvananthapuram' => 'Thiruvananthapuram',
                        'Thrissur' => 'Thrissur',
                        'Wayanad' => 'Wayanad',
                    ]),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    // Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            TenantAdminsRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListTenants::route('/'),
            'create' => Pages\CreateTenant::route('/create'),
            'edit' => Pages\EditTenant::route('/{record}/edit'),
        ];
    }
}
