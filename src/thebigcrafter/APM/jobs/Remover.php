<?php

namespace thebigcrafter\APM\jobs;

use thebigcrafter\APM\APM;

class Remover
{
    /**
     * Remove repo. If removed, return true else if cannot find repo return false
     * @param string $url
     * @return bool
     */
    public static function removeRepo(string $url): bool
    {
        $repositories = APM::getInstance()->repos;
        $repositoriesList = $repositories->get("repositories");
        if (in_array($url, $repositoriesList)) {
            unset($repositoriesList[array_search($url, $repositoriesList)]);
            $repositories->set("repositories", $repositoriesList);
            $repositories->save();
            return true;
        } else {
            return false;
        }
    }

    /**
     * Remove plugin. If removed, return true else if cannot find plugin return false
     *
     * @return bool
     */
    public static function removePlugin(string $name): bool
    {
        if (file_exists(APM::getInstance()->getServer()->getDataPath() . "plugins/" . $name . ".phar")) {
            unlink(APM::getInstance()->getServer()->getDataPath() . "plugins/" . $name . ".phar");
            return true;
        } else {
            return false;
        }
    }
}
