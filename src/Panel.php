<?php
namespace CoreUI;
use CoreUI\Panel\Tabs;


/**
 *
 */
class Panel {

    const TABS_TYPE_TABS      = 'tabs';
    const TABS_TYPE_PILLS     = 'pills';
    const TABS_TYPE_UNDERLINE = 'underline';

    const TABS_POS_TOP_LEFT   = 'top-left';
    const TABS_POS_TOP_CENTER = 'top-center';
    const TABS_POS_TOP_RIGHT  = 'top-right';
    const TABS_POS_LEFT       = 'left';
    const TABS_POS_RIGHT      = 'right';

    const TABS_FILL_NONE    = '';
    const TABS_FILL         = 'fill';
    const TABS_FILL_JUSTIFY = 'justify';

    const FIT      = 'fit';
    const FIT_NONE = '';
    const FIT_MIN = 'min';
    const FIT_MAX = 'max';

    const WRAPPER_CARD = 'card';
    const WRAPPER_NONE = 'none';

    private string  $id            = '';
    private string  $title         = '';
    private ?string $subtitle      = '';
    private string  $tabs_type     = self::TABS_TYPE_TABS;
    private string  $tabs_position = self::TABS_POS_TOP_LEFT;
    private string  $tabs_fill     = self::TABS_FILL_NONE;
    private int     $tabs_width    = 200;
    private array   $controls      = [];
    private array   $tabs          = [];
    private mixed   $content       = [];
    private int     $tab_index     = 1;
    private ?string $content_fit   = self::FIT_NONE;
    private ?string $wrapper_type  = self::WRAPPER_CARD;


    /**
     * @param string|null $panel_id
     */
    public function __construct(string $panel_id = null) {

        $this->id = $panel_id ?: crc32(uniqid());
    }


    /**
     * Установка заголовка
     * @param string      $title
     * @param string|null $subtitle
     * @return Panel
     */
    public function setTitle(string $title, string $subtitle = null): self {

        $this->title    = $title;
        $this->subtitle = $subtitle;

        return $this;
    }


    /**
     * Установка правила для отображения панели относительно содержимого
     * @param string|null $fit
     * @return Panel
     */
    public function setContentFit(string $fit = null): self {

        $this->content_fit = $fit;
        return $this;
    }


    /**
     * Установка правила для отображения обертки в панели
     * @param string|null $type
     * @return Panel
     */
    public function setWrapperType(string $type = null): self {

        $this->wrapper_type = $type;
        return $this;
    }


    /**
     * Получение правила для отображения обертки в панели
     * @return string
     */
    public function getWrapperType(): string {

        return $this->wrapper_type;
    }


    /**
     * Установка элементов управления
     * @param array $controls
     * @return self
     */
    public function setControls(array $controls): self {

        $this->controls = [];

        foreach ($controls as $control) {
            if ($control instanceof Panel\Abstract\Control) {
                $this->controls[] = $control;
            }
        }

        return $this;
    }


    /**
     * @param string $tabs_type
     * @return void
     */
    public function setTabsType(string $tabs_type): void {

        $this->tabs_type = $tabs_type;
    }

    /**
     * @param string $tabs_position
     * @return void
     */
    public function setTabsPosition(string $tabs_position): void {

        $this->tabs_position = $tabs_position;
    }


    /**
     * @param string $tabs_fill
     * @return void
     */
    public function setTabsFill(string $tabs_fill): void {

        $this->tabs_fill = $tabs_fill;
    }


    /**
     * @param int $tabs_width
     * @return void
     */
    public function setTabsWidth(int $tabs_width): void {

        $this->tabs_width = $tabs_width;
    }


    /**
     * Добавление таба
     * @param string      $title
     * @param string|null $id
     * @param string|null $url
     * @return Tabs\Tab
     */
    public function addTab(string $title, string $id = null, string $url = null): Tabs\Tab {

        if (empty($id)) {
            $id = "tab{$this->tab_index}";
        }

        $tab = new Tabs\Tab($id);
        $tab->setTitle($title);

        if ($url) {
            $tab->setUrl($url);
        }

        $this->tabs[] = $tab;
        $this->tab_index++;

        return $tab;
    }


    /**
     * Добавление dropdown таба
     * @param string      $title
     * @param string|null $id
     * @return Tabs\Dropdown
     */
    public function addTabDropdown(string $title, string $id = null): Tabs\Dropdown {

        if (empty($id)) {
            $id = "tab{$this->tab_index}";
        }

        $dropdown = new Tabs\Dropdown($id);
        $dropdown->setTitle($title);

        $this->tabs[] = $dropdown;
        $this->tab_index++;

        return $dropdown;
    }


    /**
     * Установка содержимого для контейнера
     * @param mixed $content
     * @throws \Exception
     */
    public function setContent(mixed $content): void {

        if ( ! is_scalar($content) && ! is_array($content)) {
            throw new \Exception('Содержимое может быть в виде строки или массива');
        }

        $this->content = $content;
    }


    /**
     * @param string $tab_id
     * @return void
     */
    public function setActiveTab(string $tab_id): void {

        if ( ! empty($this->tabs)) {
            foreach ($this->tabs as $tab) {
                if ($tab instanceof Tabs\Dropdown) {
                    $items      = $tab->getItems();
                    $tab_active = false;

                    foreach ($items as $item) {
                        if ($item instanceof Panel\Tabs\Dropdown\Item) {
                            if ($item->getId() == $tab_id) {
                                $item->setActive(true);
                                $tab_active = true;
                            } else {
                                $item->setActive(false);
                            }
                        }
                    }

                    $tab->setActive($tab_active);

                } elseif ($tab instanceof Tabs\Tab) {
                    $tab->setActive($tab->getId() == $tab_id);
                }
            }
        }
    }


    /**
     * Формирует данные панели
     * @return array
     */
    public function toArray(): array {

        $tabs     = [];
        $controls = [];

        foreach ($this->tabs as $tab) {
            $tabs[] = $tab->toArray();
        }
        foreach ($this->controls as $control) {
            $controls[] = $control->toArray();
        }

        $result = [
            'component' => 'coreui.panel',
            'id'        => $this->id,
            'content'   => $this->content,
        ];


        if ($this->title) {
            $result['title'] = $this->title;
        }
        if ($this->subtitle) {
            $result['subtitle'] = $this->subtitle;
        }
        if ($controls) {
            $result['controls'] = $controls;
        }
        if ($this->content_fit) {
            $result['contentFit'] = $this->content_fit;
        }
        if ($this->wrapper_type) {
            $result['wrapperType'] = $this->wrapper_type;
        }

        if ($tabs) {
            $result['tabs'] = [];

            if ($this->tabs_type) {
                $result['tabs']['type'] = $this->tabs_type;
            }
            if ($this->tabs_position) {
                $result['tabs']['position'] = $this->tabs_position;
            }
            if ($this->tabs_fill) {
                $result['tabs']['fill'] = $this->tabs_fill;
            }
            if ($this->tabs_width) {
                $result['tabs']['width'] = $this->tabs_width;
            }

            $result['tabs']['items'] = $tabs;
        }

        return $result;
    }
} 