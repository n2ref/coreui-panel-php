<?php
namespace CoreUI\Panel\classes\Tabs\Dropdown;

/**
 *
 */
class Item {

    private $id         = '';
    private $title      = '';
    private $url        = '';
    private $url_count  = '';
    private $url_window = '';
    private $count      = '';
    private $disabled   = false;
    private $active     = false;


    /**
     * @param string|null $id
     */
    public function __construct(string $id = null) {

        if ($id) {
            $this->id = $id;
        } else {
            $this->id = crc32(uniqid());
        }
    }


    /**
     * @param string $title
     * @return self
     */
    public function setTitle(string $title): self {

        $this->title = $title;
        return $this;
    }


    /**
     * Получение названия таба
     * @return string
     */
    public function getTitle(): string {
        return $this->title;
    }


    /**
     * Установка количества для таба
     * @param string $count
     * @return self
     */
    public function setCount(string $count): self {

        $this->count = $count;

        return $this;
    }


    /**
     * Получение количества для таба
     * @return string
     */
    public function getCount(): string {

        return $this->count;
    }


    /**
     * @param string $url
     * @return self
     */
    public function setUrl(string $url): self {

        $this->url = $url;
        return $this;
    }


    /**
     * Получение url таба
     * @return string
     */
    public function getUrl(): string {
        return $this->url;
    }


    /**
     * Установка url количества таба
     * @param string $url_count
     * @return self
     */
    public function setUrlCount(string $url_count): self {

        $this->url_count = $url_count;

        return $this;
    }


    /**
     * Получение url количества таба
     * @return string
     */
    public function getUrlCount(): string {

        return $this->url_count;
    }


    /**
     * Установка url для окна браузера
     * @param string $url_window
     * @return self
     */
    public function setUrlWindow(string $url_window): self {

        $this->url_window = $url_window;

        return $this;
    }


    /**
     * Получение url для окна браузера
     * @return string
     */
    public function getUrlWindow(): string {

        return $this->url_window;
    }


    /**
     * Установка ID таба
     * @param string $id
     * @return void
     */
    public function setId(string $id): void {
        $this->id = $id;
    }


    /**
     * Получение ID таба
     * @return string
     */
    public function getId(): string {
        return $this->id;
    }


    /**
     * @param bool $is_disabled
     * @return $this
     */
    public function setDisabled(bool $is_disabled): self {

        $this->disabled = $is_disabled;
        return $this;
    }


    /**
     * @param bool $is_active
     * @return self
     */
    public function setActive(bool $is_active): self {

        $this->active = $is_active;
        return $this;
    }


    /**
     * @return array
     */
    public function toArray(): array {

        return [
            'id'        => $this->getId(),
            'type'      => 'tab',
            'title'     => $this->getTitle(),
            'url'       => $this->getUrl(),
            'count'     => $this->getCount(),
            'urlCount'  => $this->getUrlCount(),
            'urlWindow' => $this->getUrlWindow(),
            'disabled'  => $this->disabled,
            'active'    => $this->active,
        ];
    }
}