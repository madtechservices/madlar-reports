<?php

namespace TomatoPHP\TomatoSauce\Menus;

use TomatoPHP\TomatoPHP\Services\Menu\Menu;
use TomatoPHP\TomatoPHP\Services\Menu\TomatoMenu;

class ReportMenu extends TomatoMenu
{
    /**
     * @var ?string
     * @example ACL
     */
    public ?string $group = "Reports";

    /**
     * @var ?string
     * @example dashboard
     */
    public ?string $menu = "dashboard";

    /**
     * @return array
     */
    public static function handler(): array
    {
        return [
            Menu::make()
                ->label("Reports")
                ->icon("bx bxs-report")
                ->route("admin.reports.index"),
        ];
    }
}
