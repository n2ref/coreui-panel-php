<?php
namespace CoreUI\Panel\Tabs\Dropdown;

/**
 *
 */
class Item {

    private $id         = '';
    private $title      = '';
    private $url        = null;
    private $url_count  = null;
    private $url_window = null;
    private $count      = null;
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
     * @param string|null $count
     * @return self
     */
    public function setCount(string $count = null): self {

        $this->count = $count;

        return $this;
    }


    /**
     * Получение количества для таба
     * @return string|null
     */
    public function getCount():? string {

        return $this->count;
    }


    /**
     * Установка url таба
     * @param string|null $url
     * @return self
     */
    public function setUrl(string $url = null): self {

        $this->url = $url;
        return $this;
    }


    /**
     * Получение url таба
     * @return string|null
     */
    public function getUrl():? string {
        return $this->url;
    }


    /**
     * Установка url количества таба
     * @param string|null $url_count
     * @return self
     */
    public function setUrlCount(string $url_count = null): self {

        $this->url_count = $url_count;

        return $this;
    }


    /**
     * Получение url количества таба
     * @return string|null
     */
    public function getUrlCount():? string {

        return $this->url_count;
    }


    /**
     * Установка url для окна браузера
     * @param string|null $url_window
     * @return self
     */
    public function setUrlWindow(string $url_window = null): self {

        $this->url_window = $url_window;

        return $this;
    }


    /**
     * Получение url для окна браузера
     * @return string|null
     */
    public function getUrlWindow():? string {

        return $this->url_window;
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

        $result = [
            'id'       => $this->getId(),
            'type'     => 'tab',
            'title'    => $this->getTitle(),
            'disabled' => $this->disabled,
            'active'   => $this->active,
        ];

        if ( ! is_null($url = $this->getUrl())) {
            $result['url'] = $url;
        }
        if ( ! is_null($count = $this->getCount())) {
            $result['count'] = $count;
        }
        if ( ! is_null($url_count = $this->getUrlCount())) {
            $result['urlCount'] = $url_count;
        }
        if ( ! is_null($url_window = $this->getUrlWindow())) {
            $result['urlWindow'] = $url_window;
        }

        return $result;
    }
}