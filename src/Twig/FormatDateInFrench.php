<?php

declare(strict_types=1);

namespace App\Twig;

use Twig\Extension\AbstractExtension;
use Twig\TwigFilter;

class FormatDateInFrench extends AbstractExtension
{
    public function getFilters(): array
    {
        return [
            new TwigFilter('date_fr', [$this, 'formatDateInFrench']),
        ];
    }

    public function formatDateInFrench($date, $pattern)
    {
        if (!$date instanceof \DateTime) {
            $date = new \DateTime($date);
        }
        $formatter = new \IntlDateFormatter('fr_FR', \IntlDateFormatter::NONE, \IntlDateFormatter::NONE, null, \IntlDateFormatter::GREGORIAN, $pattern);

        return ucfirst($formatter->format($date));
    }
}
