<?php
namespace CoreUI\Panel\Tabs;
use \CoreUI\Panel\Abstract;

/**
 *
 */
class Tab extends Abstract\Tab {

    const BADGE_TYPE_DANGER    = 'danger';
    const BADGE_TYPE_PRIMARY   = 'primary';
    const BADGE_TYPE_SECONDARY = 'secondary';
    const BADGE_TYPE_SUCCESS   = 'success';
    const BADGE_TYPE_WARNING   = 'warning';
    const BADGE_TYPE_INFO      = 'info';
    const BADGE_TYPE_LIGHT     = 'light';
    const BADGE_TYPE_DARK      = 'dark';


    private ?string $url         = null;
    private ?string $url_content = null;
    private ?string $url_count   = null;
    private ?string $url_badge   = null;
    private ?string $url_window  = null;
    private ?string $count       = null;
    private ?array  $badge       = null;


    /**
     * @param string|null $id
     */
    public function __construct(string $id = null) {

        $this->setId($id ?: (string)crc32(uniqid()));
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
     * Установка метки для таба
     * @param string|null $text
     * @param string      $type
     * @param array       $attr
     * @return self
     */
    public function setBadge(string $text = null, string $type = self::BADGE_TYPE_DANGER, array $attr = []): self {

        if (is_null($text)) {
            $this->badge = null;

        } else {
            $this->badge = [
                'text' => $text,
                'type' => $type,
                'attr' => $attr,
            ];
        }

        return $this;
    }


    /**
     * Установка метки для таба в виде точки
     * @param string $type
     * @param array  $attr
     * @return self
     */
    public function setBadgeDot(string $type = self::BADGE_TYPE_DANGER, array $attr = []): self {

        $this->badge = [
            'text' => '',
            'type' => $type,
            'attr' => $attr,
        ];

        return $this;
    }


    /**
     * Получение метки для таба
     * @return array|null
     */
    public function getBadge():? array {

        return $this->badge;
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
     * Установка url таба для загрузки содержимого
     * @param string|null $url
     * @return self
     */
    public function setUrlContent(string $url = null): self {

        $this->url_content = $url;

        return $this;
    }


    /**
     * Получение url таба для загрузки содержимого
     * @return string|null
     */
    public function getUrlContent():? string {

        return $this->url_content;
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
     * Установка url метки таба
     * @param string|null $url_badge
     * @return self
     */
    public function setUrlBadge(string $url_badge = null): self {

        $this->url_badge = $url_badge;

        return $this;
    }


    /**
     * Получение url метки таба
     * @return string|null
     */
    public function getUrlBadge():? string {

        return $this->url_badge;
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
     * @return array
     */
    public function toArray(): array {

        $result = [
            'id'    => $this->getId(),
            'type'  => 'tab',
            'title' => $this->getTitle(),
        ];


        if ($this->isActive()) {
            $result['active'] = true;
        }
        if ($this->isDisabled()) {
            $result['disabled'] = true;
        }
        if ( ! is_null($url = $this->getUrl())) {
            $result['url'] = $url;
        }
        if ( ! is_null($count = $this->getCount())) {
            $result['count'] = $count;
        }
        if ( ! is_null($badge = $this->getBadge())) {
            $result['badge'] = $badge;
        }
        if ( ! is_null($url_content = $this->getUrlContent())) {
            $result['urlContent'] = $url_content;
        }
        if ( ! is_null($url_count = $this->getUrlCount())) {
            $result['urlCount'] = $url_count;
        }
        if ( ! is_null($url_badge = $this->getUrlBadge())) {
            $result['urlBadge'] = $url_badge;
        }
        if ( ! is_null($url_window = $this->getUrlWindow())) {
            $result['urlWindow'] = $url_window;
        }
        if ( ! is_null($side = $this->getSide())) {
            $result['side'] = $side;
        }

        return $result;
    }
}