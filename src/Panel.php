<?php
namespace CoreUI;
use CoreUI\Panel\Tabs;
use CoreUI\Panel\Tabs\Dropdown;
use CoreUI\Panel\Tabs\Tab;


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

    const TABS_FILL         = 'fill';
    const TABS_FILL_JUSTIFY = 'justify';

    const FIT     = 'fit';
    const FIT_MIN = 'min';
    const FIT_MAX = 'max';

    const WRAPPER_CARD = 'card';
    const WRAPPER_NONE = 'none';

    private string  $id            = '';
    private string  $title         = '';
    private ?string $subtitle      = '';
    private ?string $url_content   = null;
    private string  $tabs_type     = self::TABS_TYPE_TABS;
    private string  $tabs_position = self::TABS_POS_TOP_LEFT;
    private ?string $tabs_fill     = null;
    private int     $tabs_width    = 200;
    private array   $controls      = [];
    private array   $tabs          = [];
    private mixed   $content       = null;
    private int     $tab_index     = 1;
    private ?string $content_fit   = null;
    private ?string $wrapper_type  = self::WRAPPER_CARD;


    /**
     * @param string|null $panel_id
     */
    public function __construct(string $panel_id = null) {

        $this->id = $panel_id ?: (string)crc32(uniqid());
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
    public function addControls(array $controls): self {

        foreach ($controls as $control) {
            if ($control instanceof Panel\Abstract\Control) {
                $this->controls[] = $control;
            }
        }

        return $this;
    }


    /**
     * Очистка установленных элементов управления
     * @return self
     */
    public function clearControls(): self {

        $this->controls[] = [];
        return $this;
    }


    /**
     * Установка типа табов
     * @param string $tabs_type
     * @return self
     */
    public function setTabsType(string $tabs_type): self {

        $this->tabs_type = $tabs_type;
        return $this;
    }


    /**
     * Установка позиции табов
     * @param string $tabs_position
     * @return self
     */
    public function setTabsPosition(string $tabs_position): self {

        $this->tabs_position = $tabs_position;
        return $this;
    }


    /**
     * Установка выравнивания табов
     * @param string $tabs_fill
     * @return self
     */
    public function setTabsFill(string $tabs_fill): self {

        $this->tabs_fill = $tabs_fill;
        return $this;
    }


    /**
     * Установка ширины табов
     * @param int $tabs_width
     * @return self
     */
    public function setTabsWidth(int $tabs_width): self {

        $this->tabs_width = $tabs_width;
        return $this;
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
     * Установка адреса для загрузки содержимого
     * @param string $url
     * @return self
     */
    public function setUrlContent(string $url): self {

        $this->url_content = $url;
        return $this;
    }


    /**
     * Установка содержимого для контейнера
     * @param mixed $content
     * @return self
     * @throws \Exception
     */
    public function setContent(mixed $content): self {

        if ( ! is_scalar($content) && ! is_array($content)) {
            throw new \Exception('Содержимое может быть в виде строки или массива');
        }

        $this->content = $content;
        return $this;
    }


    /**
     * Получение содержимого для контейнера
     * @return mixed
     */
    public function getContent(): mixed {

        return $this->content;
    }


    /**
     * Получение адреса для загрузки содержимого
     * @return string|null
     */
    public function getUrlContent():? string {

        return $this->url_content;
    }


    /**
     * Установка активного таба
     * @param string $tab_id
     * @return self
     */
    public function setActiveTab(string $tab_id): self {

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

        return $this;
    }


    /**
     * Получение идентификатора активного таба
     * @return string|null
     */
    public function getActiveTabId():? string {

        $active_tab = null;

        foreach ($this->tabs as $tab) {
            if ($tab instanceof Tabs\Dropdown) {
                $items = $tab->getItems();

                foreach ($items as $item) {
                    if ($item instanceof Panel\Tabs\Dropdown\Item) {
                        if ($item->isActive()) {
                            $active_tab = $item->getId();
                            break 2;
                        }
                    }
                }

            } elseif ($tab instanceof Tabs\Tab) {
                if ($tab->isActive()) {
                    $active_tab = $tab->getId();
                    break;
                }
            }
        }

        return $active_tab;
    }


    /**
     * Получение таба по его id
     * @param string $tab_id
     * @return Tab|Dropdown|null
     */
    public function getTabById(string $tab_id): Tabs\Tab|Tabs\Dropdown|null {

        $result = null;

        foreach ($this->tabs as $tab) {
            if ($tab instanceof Tabs\Dropdown) {
                $items = $tab->getItems();

                foreach ($items as $item) {
                    if ($item instanceof Panel\Tabs\Dropdown\Item) {
                        if ($item->getId() == $tab_id) {
                            $result = $tab;
                            break 2;
                        }
                    }
                }

            } elseif ($tab instanceof Tabs\Tab) {
                if ($tab->getId() == $tab_id) {
                    $result = $tab;
                    break;
                }
            }
        }

        return $result;
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
        ];


        if ( ! is_null($this->content)) {
            $result['content'] = $this->content;
        }
        if ( ! is_null($this->url_content)) {
            $result['contentUrl'] = $this->url_content;
        }
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