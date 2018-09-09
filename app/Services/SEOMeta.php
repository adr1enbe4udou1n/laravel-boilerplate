<?php

namespace App\Services;

class SEOMeta
{
    /**
     * @var string Titre
     */
    protected $title;

    /**
     * @var string Titre par défaut
     */
    protected $title_default;

    /**
     * @var string Description
     */
    protected $description;

    /**
     * @var string URL canonique
     */
    protected $canonical;

    /**
     * @var array Locales
     */
    protected $alternateLanguages = [];

    /**
     * @var array Lien de feeds
     */
    protected $feeds = [];

    public function setTitleDefault($default)
    {
        $this->title_default = $default;

        return $this;
    }

    public function setTitle($title, $appendDefault = true)
    {
        $title = strip_tags($title);

        if (true === $appendDefault) {
            $this->title = empty($this->title_default) ? $title : "$title | {$this->title_default}";
        } else {
            $this->title = $title;
        }

        return $this;
    }

    public function setDescription($description)
    {
        $this->description = (false === $description) ? $description : strip_tags(htmlentities($description));

        return $this;
    }

    public function setCanonical($url)
    {
        $this->canonical = $url;

        return $this;
    }

    public function addAlternateLanguage($lang, $url)
    {
        $this->alternateLanguages[] = ['lang' => $lang, 'url' => $url];

        return $this;
    }

    public function addFeed($lang, $url, $title)
    {
        return $this->feeds[] = ['lang' => $lang, 'url' => $url, 'title' => $title];
    }

    /**
     * @return string
     */
    public function getTitle()
    {
        return $this->title ?: $this->getTitleDefault();
    }

    /**
     * @return string
     */
    public function getTitleDefault()
    {
        return $this->title_default;
    }

    /**
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @return string
     */
    public function getCanonical()
    {
        return $this->canonical;
    }

    /**
     * @return array
     */
    public function getAlternateLanguages()
    {
        return $this->alternateLanguages;
    }

    /**
     * @return array
     */
    public function getFeeds()
    {
        return $this->feeds;
    }

    /**
     * énération des metas.
     *
     * @return string
     */
    public function generate()
    {
        $html = [];

        $title = $this->getTitle();
        $description = $this->getDescription();
        $canonical = $this->getCanonical();

        if ($title) {
            $html[] = "<title>$title</title>";
        }

        if ($description) {
            $html[] = "<meta name=\"description\" content=\"{$description}\">";
        }

        if ($this->canonical) {
            $html[] = "<link rel=\"canonical\" href=\"{$canonical}\"/>";
        }

        /*
         * Générer les liens alternatifs multilangues
         */
        foreach ($this->alternateLanguages as $lang) {
            $html[] = "<link rel=\"alternate\" hreflang=\"{$lang['lang']}\" href=\"{$lang['url']}\">";
        }

        /*
         * Génération des liens de flux RSS
         */
        foreach ($this->feeds as $feed) {
            $html[] = "<link rel=\"alternate\" hreflang=\"{$feed['lang']}\" type=\"application/rss+xml\" href=\"{$feed['url']}\" title=\"{$feed['title']}\">";
        }

        return implode(PHP_EOL, $html);
    }
}
