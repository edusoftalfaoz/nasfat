<?php

namespace App\Filament\Pages;

use App\Models\HomepageSetting;
use Filament\Actions\Action;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Placeholder;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Tabs;
use Filament\Forms\Components\Tabs\Tab;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Form;
use Filament\Notifications\Notification;
use Filament\Pages\Page;

class ManageHomepage extends Page implements HasForms
{
    use InteractsWithForms;

    protected static ?string $navigationIcon  = 'heroicon-o-home-modern';
    protected static ?string $navigationGroup = 'Website';
    protected static ?string $navigationLabel = 'Homepage content';
    protected static ?string $title           = 'Homepage content';
    protected static ?int    $navigationSort  = 1;
    protected static string  $view            = 'filament.pages.manage-homepage';

    public ?array $data = [];

    public function mount(): void
    {
        $this->form->fill(HomepageSetting::current()->attributesToArray());
    }

    protected function getHeaderActions(): array
    {
        return [
            Action::make('viewSite')
                ->label('View website')
                ->icon('heroicon-o-arrow-top-right-on-square')
                ->color('gray')
                ->url(url('/'))
                ->openUrlInNewTab(),
        ];
    }

    public function form(Form $form): Form
    {
        return $form
            ->statePath('data')
            ->schema([
                Tabs::make('Homepage')
                    ->persistTabInQueryString()
                    ->columnSpanFull()
                    ->tabs([
                        $this->heroTab(),
                        $this->aboutTab(),
                        $this->headTab(),
                        $this->admissionsTab(),
                        $this->anthemTab(),
                        $this->contactTab(),
                        $this->announcementTab(),
                    ]),
            ]);
    }

    /* ------------------------------------------------------------------ */

    protected function image(string $name, string $dir, ?string $help = null): FileUpload
    {
        return FileUpload::make($name)
            ->image()
            ->imageEditor()
            ->directory("website/{$dir}")
            ->visibility('public')
            ->maxSize(5120)
            ->imageResizeMode('contain')
            ->imageResizeTargetWidth('1600')
            ->imageResizeUpscale(false)
            ->helperText($help);
    }

    protected function heroTab(): Tab
    {
        return Tab::make('Hero')
            ->icon('heroicon-o-sparkles')
            ->schema([
                Section::make('Headline')
                    ->description('The first thing visitors see at the top of the homepage.')
                    ->schema([
                        TextInput::make('hero_badge')->label('Small badge')->maxLength(60)
                            ->helperText('For example "Admissions now open". Leave empty to hide it.'),
                        TextInput::make('hero_title')->label('Headline')->required()->maxLength(90)
                            ->helperText('Short and clear works best. About 3 to 8 words.'),
                        Textarea::make('hero_subtitle')->label('Supporting text')->rows(3)->maxLength(300)->columnSpanFull(),
                    ])->columns(2),

                Section::make('Buttons')
                    ->description('Use #admissions, #about or #contact to jump to a section, or paste a full web address.')
                    ->schema([
                        TextInput::make('hero_primary_text')->label('Main button text')->maxLength(40),
                        TextInput::make('hero_primary_url')->label('Main button link')->maxLength(255),
                        TextInput::make('hero_secondary_text')->label('Second button text')->maxLength(40),
                        TextInput::make('hero_secondary_url')->label('Second button link')->maxLength(255),
                    ])->columns(2),

                Section::make('Photos and numbers')
                    ->schema([
                        $this->image('hero_image', 'hero', 'Large photo. Portrait or square works best. Leave empty to use the school block photo.'),
                        $this->image('hero_image_2', 'hero', 'Smaller photo that overlaps the first. Leave empty to use the mosque photo.'),
                        Toggle::make('show_stats')->label('Show pupil, teacher and class counts')
                            ->helperText('Counts come live from your student, teacher and class records.')
                            ->columnSpanFull(),
                    ])->columns(2),
            ]);
    }

    protected function aboutTab(): Tab
    {
        return Tab::make('About')
            ->icon('heroicon-o-building-library')
            ->schema([
                Section::make('About the school')->schema([
                    TextInput::make('about_heading')->label('Heading')->maxLength(90)->columnSpanFull(),
                    TextInput::make('about_lead')->label('Opening sentence')->maxLength(200)->columnSpanFull(),
                    Textarea::make('about_body')->label('Story')->rows(8)
                        ->helperText('Leave a blank line between paragraphs.')->columnSpanFull(),
                    Repeater::make('about_highlights')->label('Key facts (shown with ticks)')
                        ->schema([TextInput::make('text')->label('Fact')->required()->maxLength(120)])
                        ->addActionLabel('Add a fact')->reorderable()->defaultItems(0)->columnSpanFull(),
                    $this->image('about_image', 'about', 'Larger photo. Leave empty to use the default.'),
                    $this->image('about_image_2', 'about', 'Smaller overlapping photo. Leave empty to use the default.'),
                ])->columns(2),

                Section::make('"Why parents choose us" heading')->schema([
                    TextInput::make('features_heading')->label('Heading')->maxLength(90),
                    Placeholder::make('features_note')->label('')
                        ->content('Add, edit or reorder the reasons under Website > Why choose us.'),
                ]),
            ]);
    }

    protected function headTab(): Tab
    {
        return Tab::make('Head of School')
            ->icon('heroicon-o-user-circle')
            ->schema([
                Section::make('Message from the Head of School')->schema([
                    TextInput::make('head_heading')->label('Heading')->maxLength(90),
                    TextInput::make('head_title')->label('Job title')->maxLength(60)
                        ->helperText('Shown under the name, for example "Head of School".'),
                    Textarea::make('head_message')->label('Message')->rows(9)
                        ->helperText('Leave a blank line between paragraphs. Leave the whole message empty to hide this section.')
                        ->columnSpanFull(),
                    $this->image('head_photo', 'head', 'Portrait photo. Leave empty to use the default photo.'),
                    Placeholder::make('head_note')->label('Name and signature')
                        ->content('These come from Controls > Settings (Principal name and Principal signature).'),
                ])->columns(2),
            ]);
    }

    protected function admissionsTab(): Tab
    {
        return Tab::make('Admissions')
            ->icon('heroicon-o-clipboard-document-check')
            ->schema([
                Section::make('How to join')->schema([
                    TextInput::make('admissions_heading')->label('Heading')->maxLength(90)->columnSpanFull(),
                    Textarea::make('admissions_intro')->label('Introduction')->rows(2)->columnSpanFull(),
                    Repeater::make('admissions_steps')->label('Steps')
                        ->schema([
                            TextInput::make('title')->label('Step title')->required()->maxLength(60),
                            Textarea::make('description')->label('What happens')->rows(2)->maxLength(240),
                        ])
                        ->addActionLabel('Add a step')->reorderable()->itemLabel(fn (array $state) => $state['title'] ?? null)
                        ->defaultItems(0)->columnSpanFull(),
                    TextInput::make('admissions_cta_text')->label('Button text')->maxLength(40),
                    TextInput::make('admissions_cta_url')->label('Button link')->maxLength(255),
                ])->columns(2),

                Section::make('Curriculum')->schema([
                    TextInput::make('curriculum_heading')->label('Heading')->maxLength(60),
                    Textarea::make('curriculum_text')->label('Text')->rows(4)->columnSpanFull(),
                ])->columns(1),

                Section::make('Fees')->schema([
                    TextInput::make('fees_heading')->label('Heading')->maxLength(60),
                    Textarea::make('fees_text')->label('Text')->rows(4)->columnSpanFull(),
                    TextInput::make('fees_cta_text')->label('Link text')->maxLength(40),
                    TextInput::make('fees_cta_url')->label('Link address')->maxLength(255),
                ])->columns(2),
            ]);
    }

    protected function anthemTab(): Tab
    {
        return Tab::make('Anthem and pledge')
            ->icon('heroicon-o-musical-note')
            ->schema([
                Section::make('School anthem')->schema([
                    Toggle::make('show_anthem')->label('Show the anthem and pledge section on the homepage')->columnSpanFull(),
                    TextInput::make('anthem_heading')->label('Heading')->maxLength(90)->columnSpanFull(),
                    Textarea::make('anthem_arabic')->label('Anthem in Arabic')->rows(8)
                        ->extraInputAttributes(['dir' => 'rtl', 'lang' => 'ar', 'style' => 'font-size:1.2rem'])
                        ->helperText('One line per row. Optional. Paste the exact Arabic text from the school handbook.'),
                    Textarea::make('anthem_meaning')->label('Meaning in English')->rows(8)
                        ->helperText('One line per row.'),
                ])->columns(2),

                Section::make('School pledge')->schema([
                    TextInput::make('pledge_heading')->label('Heading')->maxLength(90),
                    Repeater::make('pledge_items')->label('Pledge lines')
                        ->schema([
                            TextInput::make('meaning')->label('Meaning in English')->maxLength(200),
                            TextInput::make('arabic')->label('Arabic (optional)')->maxLength(300)
                                ->extraInputAttributes(['dir' => 'rtl', 'lang' => 'ar']),
                        ])
                        ->columns(2)->reorderable()->addActionLabel('Add a pledge line')
                        ->itemLabel(fn (array $state) => $state['meaning'] ?? null)
                        ->defaultItems(0),
                ])->columns(1),
            ]);
    }

    protected function contactTab(): Tab
    {
        return Tab::make('Contact and social')
            ->icon('heroicon-o-chat-bubble-left-right')
            ->schema([
                Section::make('Contact section')
                    ->description('The school address and phone number come from Controls > Settings.')
                    ->schema([
                        TextInput::make('contact_heading')->label('Heading')->maxLength(90),
                        TextInput::make('office_hours')->label('Office hours')->maxLength(120),
                        Textarea::make('contact_intro')->label('Introduction')->rows(2)->columnSpanFull(),
                        TextInput::make('contact_email')->label('Public email address')->email()->maxLength(190),
                        TextInput::make('contact_whatsapp')->label('WhatsApp number')->tel()->maxLength(30)
                            ->helperText('Include the country code, for example 2348012345678. Leave empty to hide the WhatsApp button.'),
                        TextInput::make('map_embed_url')->label('Google Maps embed link')
                            ->regex('/^https:\/\/www\.google\.com\/maps\/embed/')
                            ->validationMessages(['regex' => 'Paste the link from Google Maps > Share > Embed a map. It starts with https://www.google.com/maps/embed'])
                            ->helperText('In Google Maps choose Share, then Embed a map, and copy only the src link.')
                            ->columnSpanFull(),
                    ])->columns(2),

                Section::make('Social media and footer')->schema([
                    TextInput::make('facebook_url')->label('Facebook page')->url()->maxLength(255),
                    TextInput::make('instagram_url')->label('Instagram')->url()->maxLength(255),
                    TextInput::make('x_url')->label('X (Twitter)')->url()->maxLength(255),
                    TextInput::make('youtube_url')->label('YouTube')->url()->maxLength(255),
                    Textarea::make('footer_text')->label('Short line under the logo in the footer')->rows(2)->columnSpanFull(),
                ])->columns(2),
            ]);
    }

    protected function announcementTab(): Tab
    {
        return Tab::make('Announcement bar')
            ->icon('heroicon-o-megaphone')
            ->schema([
                Section::make('Announcement bar')
                    ->description('A thin bar above the menu. Good for admissions deadlines or closures.')
                    ->schema([
                        Toggle::make('announcement_enabled')->label('Show the announcement bar')->columnSpanFull(),
                        TextInput::make('announcement_text')->label('Message')->maxLength(160),
                        TextInput::make('announcement_url')->label('Link (optional)')->maxLength(255)
                            ->helperText('Use #contact for a section or paste a full web address.'),
                    ])->columns(2),
            ]);
    }

    /* ------------------------------------------------------------------ */

    public function save(): void
    {
        $state = $this->form->getState();

        $setting = HomepageSetting::query()->first() ?? new HomepageSetting();
        $setting->fill($state)->save();

        Notification::make()
            ->title('Homepage updated')
            ->body('Your changes are live on the website.')
            ->success()
            ->send();
    }
}
