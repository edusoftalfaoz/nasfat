<?php

namespace App\Filament\Resources;

use App\Filament\Resources\NewsPostResource\Pages;
use App\Models\NewsPost;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class NewsPostResource extends Resource
{
    protected static ?string $model = NewsPost::class;

    protected static ?string $navigationIcon  = 'heroicon-o-newspaper';
    protected static ?string $navigationGroup = 'Website';
    protected static ?string $navigationLabel = 'News and events';
    protected static ?int    $navigationSort  = 6;
    protected static ?string $modelLabel      = 'post';
    protected static ?string $pluralModelLabel = 'news and events';

    public static function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\Section::make('Post')->schema([
                Forms\Components\TextInput::make('title')->required()->maxLength(150)->columnSpanFull(),
                Forms\Components\Select::make('type')
                    ->options(['news' => 'News story', 'event' => 'Event'])
                    ->default('news')->required()->native(false)->live(),
                Forms\Components\DatePicker::make('event_date')->label('Event date')
                    ->visible(fn (Forms\Get $get) => $get('type') === 'event')
                    ->required(fn (Forms\Get $get) => $get('type') === 'event'),
                Forms\Components\Textarea::make('excerpt')->label('Short summary')->rows(2)->maxLength(300)->columnSpanFull()
                    ->helperText('Shown on the homepage card. Leave empty to use the start of the story.'),
                Forms\Components\Textarea::make('body')->label('Story')->required()->rows(12)->columnSpanFull()
                    ->helperText('Leave a blank line between paragraphs.'),
            ])->columns(2),

            Forms\Components\Section::make('Photo and publishing')->schema([
                Forms\Components\FileUpload::make('image')->image()->imageEditor()
                    ->directory('website/news')->visibility('public')->maxSize(5120)
                    ->imageResizeMode('contain')->imageResizeTargetWidth('1600')->imageResizeUpscale(false),
                Forms\Components\Group::make([
                    Forms\Components\Toggle::make('is_published')->label('Published')->default(true),
                    Forms\Components\DateTimePicker::make('published_at')->label('Publish date')
                        ->helperText('Leave empty to publish now. A future date schedules the post.'),
                    Forms\Components\TextInput::make('slug')->label('Web address ending')->maxLength(160)
                        ->unique(ignoreRecord: true)
                        ->helperText('Created from the title if left empty.'),
                ]),
            ])->columns(2),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\ImageColumn::make('image')->label('')->square()->getStateUsing(fn ($record) => site_image($record->image)),
                Tables\Columns\TextColumn::make('title')->searchable()->weight('bold')->limit(60),
                Tables\Columns\TextColumn::make('type')->badge()
                    ->formatStateUsing(fn ($state) => $state === 'event' ? 'Event' : 'News')
                    ->color(fn ($state) => $state === 'event' ? 'warning' : 'primary'),
                Tables\Columns\IconColumn::make('is_published')->label('Published')->boolean(),
                Tables\Columns\TextColumn::make('published_at')->label('Date')->dateTime('j M Y')->sortable(),
            ])
            ->defaultSort('published_at', 'desc')
            ->filters([
                Tables\Filters\SelectFilter::make('type')->options(['news' => 'News story', 'event' => 'Event']),
                Tables\Filters\TernaryFilter::make('is_published')->label('Published'),
            ])
            ->actions([
                Tables\Actions\Action::make('view')->label('View')->icon('heroicon-o-arrow-top-right-on-square')
                    ->url(fn (NewsPost $record) => route('news.show', $record->slug))->openUrlInNewTab()
                    ->visible(fn (NewsPost $record) => $record->is_published),
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([Tables\Actions\DeleteBulkAction::make()]),
            ])
            ->emptyStateHeading('No news or events yet')
            ->emptyStateDescription('Share announcements, results and upcoming events. They appear on the homepage and the News page.');
    }

    public static function getPages(): array
    {
        return [
            'index'  => Pages\ListNewsPosts::route('/'),
            'create' => Pages\CreateNewsPost::route('/create'),
            'edit'   => Pages\EditNewsPost::route('/{record}/edit'),
        ];
    }
}
